<?php

	namespace Natasya\NataApp\Controller\Peserta;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Participant;
	use Natasya\NataApp\Model\ParticipantProfile;
	use Natasya\NataApp\Model\Registration;
	use Natasya\NataApp\Model\Training;

	class TrainingController extends Controller
	{

		public function index(): void
		{
			$trainingModel = new Training();

			$this->view(
				'Peserta/Trainings/index',
				[
					'title' => 'Pelatihan Saya',

					'trainings' => $trainingModel->myTrainings(
						auth()->id()
					),
				]
			);
		}
		/**
		 * Detail Pelatihan.
		 */
		public function show(): void
		{
			$id = (int) Request::get('id');

			if (!$id) {

				error('Pelatihan tidak ditemukan.');

				redirect('/peserta/registrations');
			}

			$trainingModel = new Training();

			$training = $trainingModel->find($id);

			if (!$training) {

				error('Pelatihan tidak ditemukan.');

				redirect('/peserta/registrations');
			}

			/*
			|--------------------------------------------------------------------------
			| Participant
			|--------------------------------------------------------------------------
			*/

			$participant = (new Participant())
				->findByUserId(auth()->id());

			$profile = (new ParticipantProfile())
				->findByParticipantId($participant['id']);

			/*
			|--------------------------------------------------------------------------
			| Registration
			|--------------------------------------------------------------------------
			*/

			$registration = new Registration();

			$alreadyRegistered = $registration->exists(
				auth()->id(),
				$training['id']
			);

			/*
			|--------------------------------------------------------------------------
			| View
			|--------------------------------------------------------------------------
			*/

			$this->view(
				'Peserta/Trainings/show',
				[

					'title' => $training['name'],

					'training' => $training,

					'participant' => $participant,

					'profile' => $profile,

					'profileCompleted' => (bool) ($profile['is_completed'] ?? false),

					'alreadyRegistered' => $alreadyRegistered,

				]
			);
		}
	}
