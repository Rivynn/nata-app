<?php

	namespace Natasya\NataApp\Controller\Pelatih;

	use Carbon\Carbon;
	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Trainer;
	use Natasya\NataApp\Model\TrainingAttendanceSession;
	use Natasya\NataApp\Model\TrainingSchedule;

	class ScheduleController extends Controller
	{
		public function index(): void
		{
			$trainer = Trainer::query()
				->where('user_id', auth()->id())
				->firstOrFail();

			$schedules = TrainingSchedule::query()
				->with([
					'training.trainingField',
				])
				->whereHas('training', function ($query) use ($trainer) {
					$query->where('trainer_id', $trainer->id);
				})
				->whereDate('schedule_date', '>=', Carbon::now()->toDateString())
				->orderBy('schedule_date')
				->orderBy('meeting_number')
				->get();

			$todayCount = $schedules
				->filter(fn ($schedule) => $schedule->isToday())
				->count();

			$upcomingCount = $schedules
				->filter(fn ($schedule) => $schedule->isUpcoming())
				->count();

			$totalCount = $schedules->count();

			$this->view('Pelatih/Schedules/index', [
				'title' => 'Jadwal Mengajar',

				'todayCount' => $todayCount,
				'upcomingCount' => $upcomingCount,
				'totalCount' => $totalCount,

				'schedules' => $schedules,
			]);
		}
		public function show(): void
		{
			$trainer = Trainer::query()
				->where('user_id', auth()->id())
				->firstOrFail();

			$schedule = TrainingSchedule::query()
				->with([
					'training',
					'training.trainingField',
					'training.registrations.participant.user',
					'training.registrations.score',
					'training.registrations.certificate',
					'attendanceSessions.attendances',
					'materials',
				])
				->whereKey(Request::get('id'))
				->whereHas('training', function ($query) use ($trainer) {
					$query->where('trainer_id', $trainer->id);
				})
				->firstOrFail();

			/*
			|--------------------------------------------------------------------------
			| Attendance Session
			|--------------------------------------------------------------------------
			*/

			$attendanceSession = $schedule->attendanceSessions()
				->latest('opened_at')
				->first();

			/*
			|--------------------------------------------------------------------------
			| Participants
			|--------------------------------------------------------------------------
			*/

			$participants = $schedule->training->registrations;

			$participantCount = $participants->count();

			/*
			|--------------------------------------------------------------------------
			| Attendance Statistics
			|--------------------------------------------------------------------------
			*/

			$presentCount = 0;
			$permissionCount = 0;
			$lateCount = 0;
			$absentCount = $participantCount;

			if ($attendanceSession) {

				$presentCount = $attendanceSession->attendances()
					->where('status', 'present')
					->count();

				$permissionCount = $attendanceSession->attendances()
					->where('status', 'permission')
					->count();

				$lateCount = $attendanceSession->attendances()
					->where('status', 'late')
					->count();

				$absentCount = max(
					0,
					$participantCount - $presentCount - $permissionCount - $lateCount
				);

			}

			/*
			|--------------------------------------------------------------------------
			| Meeting Progress
			|--------------------------------------------------------------------------
			*/

			$totalMeeting = $schedule->training
				->schedules()
				->count();
			$meetingProgress = $totalMeeting > 0
				? round(($schedule->meeting_number / $totalMeeting) * 100)
				: 0;

			/*
			|--------------------------------------------------------------------------
			| Attendance Progress
			|--------------------------------------------------------------------------
			*/

			$attendanceProgress = $participantCount > 0
				? round((($presentCount + $lateCount) / $participantCount) * 100)
				: 0;

			/*
			|--------------------------------------------------------------------------
			| Session Status
			|--------------------------------------------------------------------------
			*/

			$sessionStatus = 'not_started';

			if ($attendanceSession) {

				if ($attendanceSession->isActive()) {

					$sessionStatus = 'active';

				} elseif ($attendanceSession->isClosed()) {

					$sessionStatus = 'closed';

				} else {

					$sessionStatus = 'expired';

				}

			}

			/*
			|--------------------------------------------------------------------------
			| View
			|--------------------------------------------------------------------------
			*/

			$this->view('Pelatih/Schedules/show', [

				'title' => 'Detail Jadwal',

				'schedule' => $schedule,

				'participants' => $participants,

				'attendanceSession' => $attendanceSession,

				'participantCount' => $participantCount,

				'presentCount' => $presentCount,

				'permissionCount' => $permissionCount,

				'lateCount' => $lateCount,

				'absentCount' => $absentCount,

				'attendanceProgress' => $attendanceProgress,

				'meetingProgress' => $meetingProgress,

				'totalMeeting' => $totalMeeting,

				'sessionStatus' => $sessionStatus,

			]);
		}
	}
