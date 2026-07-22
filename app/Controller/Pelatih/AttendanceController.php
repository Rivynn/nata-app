<?php

	namespace Natasya\NataApp\Controller\Pelatih;

	use Illuminate\Support\Str;
	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Trainer;
	use Natasya\NataApp\Model\Training;
	use Natasya\NataApp\Model\TrainingAttendance;
	use Natasya\NataApp\Model\TrainingAttendanceSession;
	use Natasya\NataApp\Model\TrainingSchedule;
	use function Illuminate\Support\now;

	class AttendanceController extends Controller
	{
		public function index(): void
		{
			$trainer = Trainer::query()
				->where('user_id', auth()->id())
				->firstOrFail();

			$training = null;

			$query = TrainingSchedule::query()
				->with([
					'training',
					'training.trainingField',
					'training.registrations',
					'attendanceSessions',
					'attendanceSessions.attendances',
					'attendanceSessions.opener',
				])
				->whereHas('training', function ($query) use ($trainer) {
					$query
						->where('trainer_id', $trainer->id)
						->where('status', 'running');
				});

			if ($trainingId = Request::get('training')) {

				$training = $trainer
					->trainings()
					->with('trainingField')
					->findOrFail($trainingId);

				$query->where('training_id', $training->id);
			}

			$schedules = $query
				->orderByDesc('schedule_date')
				->orderBy('meeting_number')
				->get();

			$totalMeeting = $schedules->count();

			$openedMeeting = 0;
			$activeMeeting = 0;
			$closedMeeting = 0;

			foreach ($schedules as $schedule) {

				$session = $schedule->attendanceSessions->first();

				if (!$session) {
					continue;
				}

				$openedMeeting++;

				if ($session->isActive()) {
					$activeMeeting++;
				} else {
					$closedMeeting++;
				}
			}

			$this->view('Pelatih/Attendances/index', [
				'title' => $training
					? 'Absensi - ' . $training->name
					: 'Absensi Pelatihan',

				'training' => $training,

				'schedules' => $schedules,

				'totalMeeting' => $totalMeeting,

				'openedMeeting' => $openedMeeting,

				'activeMeeting' => $activeMeeting,

				'closedMeeting' => $closedMeeting,
			]);
		}
		public function show(): void
		{
			$trainer = Trainer::query()
				->where('user_id', auth()->id())
				->firstOrFail();

			$session = TrainingAttendanceSession::query()
				->with([
					'trainingSchedule.training',
					'trainingSchedule.training.trainingField',
					'trainingSchedule.training.registrations.participant.user',
					'attendances.registration.participant.user',
				])
				->whereKey(Request::get('session'))
				->whereHas('trainingSchedule.training', function ($query) use ($trainer) {
					$query->where('trainer_id', $trainer->id);
				})
				->firstOrFail();

			$schedule = $session->trainingSchedule;

			$participants = $schedule->training->registrations;

			$participantCount = $participants->count();

			$presentCount = $session->attendances()
				->where('status', 'present')
				->count();

			$lateCount = $session->attendances()
				->where('status', 'late')
				->count();

			$permissionCount = $session->attendances()
				->where('status', 'permission')
				->count();

			$absentCount = max(
				0,
				$participantCount - $presentCount - $lateCount - $permissionCount
			);

			$this->view('Pelatih/Attendances/show', [
				'title' => 'Monitoring Absensi',
				'session' => $session,
				'schedule' => $schedule,
				'participants' => $participants,
				'participantCount' => $participantCount,
				'presentCount' => $presentCount,
				'lateCount' => $lateCount,
				'permissionCount' => $permissionCount,
				'absentCount' => $absentCount,
			]);
		}
		public function create(): void
		{
			$trainer = Trainer::query()
				->where('user_id', auth()->id())
				->firstOrFail();

			$schedules = TrainingSchedule::query()
				->with('training')
				->whereHas('training', function ($query) use ($trainer) {
					$query->where('trainer_id', $trainer->id);
				})
				->whereDoesntHave('attendanceSessions')
				->orderBy('schedule_date')
				->orderBy('meeting_number')
				->get();

			$this->view('Pelatih/Attendances/create', [
				'title' => 'Buka Absensi',
				'schedules' => $schedules,
			]);
		}

		/**
		 * @throws \Random\RandomException
		 */
		public function store(): void
		{
			$schedule = TrainingSchedule::query()
				->findOrFail(
					Request::post('schedule_id')
				);


			$exists = TrainingAttendanceSession::query()
				->where(
					'training_schedule_id',
					$schedule->id
				)
				->exists();


			if ($exists) {

				error('Absensi untuk pertemuan ini sudah pernah dibuka.');

				redirect(
					'/pelatih/attendances/create'
				);

				return;

			}


			$type = Request::post('attendance_type');


			$attendanceCode = null;


			/*
			|--------------------------------------------------------------------------
			| Generate Manual Attendance Code
			|--------------------------------------------------------------------------
			*/

			if (
				$type === 'manual'
				||
				$type === 'hybrid'
			) {

				$attendanceCode = strtoupper(
					Str::random(6)
				);

			}



			TrainingAttendanceSession::query()->create([


				'training_schedule_id' => $schedule->id,


				'attendance_type' => $type,


				'qr_token' => bin2hex(
					random_bytes(16)
				),


				'attendance_code' => $attendanceCode,


				'opened_by' => auth()->id(),


				'opened_at' => now(),


				'expired_at' => now()->addMinutes(
					(int) Request::post('duration')
				),


				'is_active' => true,


			]);


			success(
				'Absensi berhasil dibuka.'
			);


			redirect(
				'/pelatih/schedules/show?id=' . $schedule->id
			);
		}
		public function qrcode(): void
		{
			$trainer = Trainer::query()
				->where('user_id', auth()->id())
				->firstOrFail();

			$session = TrainingAttendanceSession::query()
				->with([
					'trainingSchedule.training',
				])
				->whereKey(Request::get('session'))
				->whereHas('trainingSchedule.training', function ($query) use ($trainer) {
					$query->where('trainer_id', $trainer->id);
				})
				->firstOrFail();

			if (!$session->isActive()) {

				error('Sesi absensi sudah ditutup.');

				redirect('/pelatih/attendances');

				return;

			}

			$this->view('Pelatih/Attendances/qrcode', [
				'title' => 'QR Code Absensi',
				'session' => $session,
			]);
		}
		public function updateStatus(): void
		{
			$attendance = TrainingAttendance::query()
				->firstOrNew([
					'attendance_session_id' => Request::post('session_id'),
					'registration_id' => Request::post('registration_id'),
				]);

			$attendance->attendance_method = 'manual';

			$attendance->status = Request::post('status');

			$attendance->checked_by = auth()->id();

			$attendance->check_in_at = now();

			$attendance->notes = Request::post('notes');

			$attendance->save();

			success('Status absensi berhasil diperbarui.');

			redirect(
				'/pelatih/attendances/show?session=' .
				Request::post('session_id')
			);
		}
		public function close(): void
		{
			$session = TrainingAttendanceSession::query()
				->findOrFail(Request::post('session_id'));

			$session->closed_at = now();

			$session->is_active = false;

			$session->save();

			success('Absensi berhasil ditutup.');

			redirect(
				'/pelatih/attendances/show?session=' .
				$session->id
			);
		}
	}

