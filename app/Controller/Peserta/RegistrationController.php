<?php

	namespace Natasya\NataApp\Controller\Peserta;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Participant;
	use Natasya\NataApp\Model\Registration;
	use Natasya\NataApp\Model\Training;

	class RegistrationController extends Controller
	{
		public function index(): void
		{
			$training = new Training();

			$this->view(
				'Peserta/Registrations/index',
				[
					'title' => 'Daftar Pelatihan',

					'trainings' => $training->opened(),
				]
			);
		}

		/**
		 * Status pendaftaran.
		 */
		public function status(): void
		{
			$registration = new Registration();

			$this->view(
				'Peserta/Registrations/status',
				[

					'title' => 'Status Pendaftaran',

					'registrations' => $registration->byUser(
						auth()->id()
					),

				]
			);
		}

		public function create(): void
		{
			$id = (int) Request::get('id');

			$trainingModel = new Training();

			$training = $trainingModel->find($id);

			if (!$training) {

				$_SESSION['error'] = 'Pelatihan tidak ditemukan.';

				$this->redirect('/peserta/registrations');
			}

			$registration = new Registration();

			if (
				$registration->exists(
					auth()->id(),
					$id
				)
			) {

				$_SESSION['error'] = 'Anda sudah terdaftar pada pelatihan ini.';

				$this->redirect('/peserta/registrations');
			}

			$participantModel = new Participant();

			$participant = $participantModel->findByUserId(
				auth()->id()
			);

			$this->view(
				'Peserta/Registrations/create',
				[
					'title'       => 'Daftar Pelatihan',

					'training'    => $training,

					'participant' => $participant,
				]
			);
		}

		/**
		 * Simpan pendaftaran.
		 */
		public function store(): void
		{
			$trainingId = (int) Request::post('training_id');

			$motivation = trim(
				Request::post('motivation')
			);

			$trainingModel = new Training();

			$training = $trainingModel->find($trainingId);

			if (!$training) {

				$_SESSION['error'] = 'Pelatihan tidak ditemukan.';

				$this->redirect('/peserta/registrations');
			}

			$registration = new Registration();

			if (
				$registration->exists(
					auth()->id(),
					$trainingId
				)
			) {

				$_SESSION['error'] = 'Anda sudah pernah mendaftar pelatihan tersebut.';

				$this->redirect('/peserta/registrations');
			}

			$registration->create([

				'user_id' => auth()->id(),

				'training_id' => $trainingId,

				'motivation' => $motivation,

			]);

			/*
			|--------------------------------------------------------------------------
			| Notification
			|--------------------------------------------------------------------------
			*/

			// (new NotificationService())
			//     ->trainingRegistration(...);

			$_SESSION['success'] = 'Pendaftaran pelatihan berhasil dikirim.';

			$this->redirect('/peserta/status');
		}
	}