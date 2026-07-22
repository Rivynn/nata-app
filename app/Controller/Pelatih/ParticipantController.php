<?php

	namespace Natasya\NataApp\Controller\Pelatih;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Registration;
	use Natasya\NataApp\Model\Trainer;

	class ParticipantController extends Controller
	{
		public function index(): void
		{
			$trainer = Trainer::query()
				->where('user_id', auth()->id())
				->firstOrFail();

			$registrations = Registration::query()
				->with([
					'participant.user',
					'training.trainingField',
				])
				->whereHas('training', function ($query) use ($trainer) {
					$query->where('trainer_id', $trainer->id);
				})
				->latest()
				->get();

			$totalParticipants = $registrations
				->pluck('participant_id')
				->unique()
				->count();

			$totalTrainings = $registrations
				->pluck('training_id')
				->unique()
				->count();

			$maleParticipants = $registrations
				->filter(function ($registration) {
					return $registration->participant?->gender === 'male';
				})
				->pluck('participant_id')
				->unique()
				->count();

			$femaleParticipants = $registrations
				->filter(function ($registration) {
					return $registration->participant?->gender === 'female';
				})
				->pluck('participant_id')
				->unique()
				->count();

			$this->view('Pelatih/Participants/index', [
				'title' => 'Peserta Pelatihan',

				'registrations' => $registrations,

				'totalParticipants' => $totalParticipants,

				'totalTrainings' => $totalTrainings,

				'maleParticipants' => $maleParticipants,

				'femaleParticipants' => $femaleParticipants,
			]);
		}

		public function show(): void
		{
			$id = Request::get('id');

			$trainer = Trainer::query()
				->where('user_id', auth()->id())
				->firstOrFail();

			$registration = Registration::query()
				->with([
					'participant.user',
					'training.trainingField',
					'training.schedules',
					'attendances.attendanceSession.trainingSchedule',
				])
				->whereKey($id)
				->whereHas('training', function ($query) use ($trainer) {
					$query->where('trainer_id', $trainer->id);
				})
				->firstOrFail();

			$attendances = $registration
				->attendances
				->sortBy(function ($attendance) {
					return $attendance->attendanceSession?->trainingSchedule?->meeting_number;
				});

			$totalMeeting = $registration->training
				->schedules
				->count();

			$presentCount = $attendances
				->filter(fn($attendance) => $attendance->isPresent())
				->count();

			$lateCount = $attendances
				->filter(fn($attendance) => $attendance->isLate())
				->count();

			$permissionCount = $attendances
				->filter(fn($attendance) => $attendance->isPermission())
				->count();

			$absentCount = max(
				0,
				$totalMeeting - $presentCount - $lateCount - $permissionCount
			);

			$this->view('Pelatih/Participants/show', [
				'title' => 'Detail Peserta',

				'registration' => $registration,

				'participant' => $registration->participant,

				'attendances' => $attendances,

				'totalMeeting' => $totalMeeting,

				'presentCount' => $presentCount,

				'lateCount' => $lateCount,

				'permissionCount' => $permissionCount,

				'absentCount' => $absentCount,

				'certificate' => null,
			]);
		}
	}
