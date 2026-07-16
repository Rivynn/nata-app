<?php

	namespace Natasya\NataApp\Controller\Peserta;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\Model\Certificate;
	use Natasya\NataApp\Model\Participant;
	use Natasya\NataApp\Model\Registration;
	use Natasya\NataApp\Model\Training;
	use Natasya\NataApp\Model\TrainingField;

	class DashboardController extends Controller
	{
		public function index(): void
		{
			$participant = new Participant();

			$field = new TrainingField();

			$registration = new Registration();

			$training = new Training();

			$certificate = new Certificate();

			$userId = auth()->id();

			$profile = $participant->profile($userId);

			$registrations = $registration->byUser($userId);

			$certificates = $certificate->byUser($userId);

			$this->view(
				'Dashboard/peserta',
				[
					'title' => 'Dashboard',

					'fields' => $field->active(),

					'participant' => $participant->findByUserId($userId),

					'profile' => $profile,

					'profileCompleted' => $participant->profileCompleted($userId),

					'registrations' => $registrations,

					'certificates' => $certificates,
				]
			);
		}
	}
