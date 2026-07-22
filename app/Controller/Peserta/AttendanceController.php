<?php

	namespace Natasya\NataApp\Controller\Peserta;

	use Carbon\Carbon;
	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Participant;
	use Natasya\NataApp\Model\Registration;
	use Natasya\NataApp\Model\TrainingAttendance;
	use Natasya\NataApp\Model\TrainingAttendanceSession;
	use function Symfony\Component\Clock\now;

	class AttendanceController extends Controller
	{
		public function index(): void
		{
			$participant = Participant::query()
				->where('user_id', auth()->id())
				->firstOrFail();

			$registration = Registration::query()
				->with('training')
				->where('participant_id', $participant->id)
				->whereIn('status', [
					'approved',
					'running',
				])
				->latest()
				->first();

			$session = null;
			$attendance = null;

			if ($registration) {

				$session = TrainingAttendanceSession::query()
					->with([
						'trainingSchedule.training.trainer.user',
					])
					->whereHas(
						'trainingSchedule',
						fn ($query) => $query->where('training_id', $registration->training_id)
					)
					->whereNotNull('opened_at')
					->whereNull('closed_at')
					->where(function ($query) {
						$query->whereNull('expired_at')
							->orWhere('expired_at', '>', Carbon::now());
					})
					->latest('opened_at')
					->first();

				if ($session) {

					$attendance = TrainingAttendance::query()
						->where('attendance_session_id', $session->id)
						->where('registration_id', $registration->id)
						->first();

				}

			}

			$this->view('Peserta/Attendances/index', [
				'title'        => 'Absensi Hari Ini',
				'registration' => $registration,
				'session'      => $session,
				'attendance'   => $attendance,
			]);
		}

		public function store(): void
		{
			$participant = Participant::query()
				->where('user_id', auth()->id())
				->firstOrFail();

			$registration = Registration::query()
				->where('participant_id', $participant->id)
				->whereIn('status', [
					'approved',
					'running',
				])
				->latest()
				->firstOrFail();

			$token = Request::post('token');

			if (empty($token)) {

				error('QR Code tidak valid.');
				$this->redirect('/peserta/attendances');
				return;

			}

			$session = TrainingAttendanceSession::query()
				->where('qr_token', $token)
				->whereNotNull('opened_at')
				->whereNull('closed_at')
				->where(function ($query) {
					$query->whereNull('expired_at')
						->orWhere('expired_at', '>', Carbon::now());
				})
				->first();

			if (! $session) {

				error('Sesi absensi tidak ditemukan atau sudah berakhir.');
				$this->redirect('/peserta/attendances');
				return;

			}

			if ($registration->training_id != $session->trainingSchedule->training_id) {

				error('Anda tidak terdaftar pada pelatihan ini.');
				$this->redirect('/peserta/attendances');
				return;

			}

			$exists = TrainingAttendance::query()
				->where('attendance_session_id', $session->id)
				->where('registration_id', $registration->id)
				->exists();

			if ($exists) {

				error('Anda sudah melakukan absensi.');
				$this->redirect('/peserta/attendances');


			}

			TrainingAttendance::create([
				'attendance_session_id' => $session->id,
				'registration_id'       => $registration->id,
				'attendance_method'     => 'qr_code',
				'status'                => 'present',
				'checked_by'            => null,
				'check_in_at'           => Carbon::now(),
			]);

			success('Absensi berhasil dilakukan.');
			$this->redirect('/peserta/attendances');
		}
	}
