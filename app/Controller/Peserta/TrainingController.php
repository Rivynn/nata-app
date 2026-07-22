<?php

	namespace Natasya\NataApp\Controller\Peserta;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Participant;
	use Natasya\NataApp\Model\Registration;
	use Natasya\NataApp\Model\Training;

	class TrainingController extends Controller
	{
		public function index(): void
		{
			$participant = Participant::where('user_id', auth()->id())
				->firstOrFail();

			$registrations = Registration::with([
				'training.trainingField',
				'training.trainer.user',
				'training.schedules',
				'certificate',
			])
				->where('participant_id', $participant->id)
				->latest()
				->get();

			$this->view('Peserta/Trainings/index', [
				'title' => 'Pelatihan Saya',
				'registrations' => $registrations,
			]);
		}

		/**
		 * Detail Pelatihan.
		 */
		public function show(): void
		{
			$id = (int) Request::get('id');

			if (! $id) {
				error('Pelatihan tidak ditemukan.');
				redirect('/peserta/trainings');
			}

			$participant = Participant::with('profile')
				->where('user_id', auth()->id())
				->firstOrFail();

			$registration = Registration::with([
				'training.trainingField',
				'training.trainer.user',
				'training.schedules',
				'certificate',
				'score',
			])
				->where('participant_id', $participant->id)
				->where('training_id', $id)
				->first();

			if (! $registration) {
				error('Pelatihan tidak ditemukan.');
				redirect('/peserta/trainings');
			}

			$this->view('Peserta/Trainings/show', [
				'title' => $registration->training->name,
				'registration' => $registration,
				'training' => $registration->training,
				'participant' => $participant,
				'profile' => $participant->profile,
				'profileCompleted' => $participant->profile?->isCompleted() ?? false,
				'alreadyRegistered' => true,
			]);
		}
	}
