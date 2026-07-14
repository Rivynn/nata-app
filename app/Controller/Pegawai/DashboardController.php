<?php

	namespace Natasya\NataApp\Controller\Pegawai;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\Model\Participant;
	use Natasya\NataApp\Model\Registration;

	class DashboardController extends Controller
	{
		public function index(): void
		{
			$registration = new Registration();

			$participant = new Participant();

			$this->view(
				'Dashboard/pegawai',
				[
					'title' => 'Dashboard Pegawai',

					'pending' => $registration->countByStatus('pending'),

					'approved' => $registration->countByStatus('approved'),

					'rejected' => $registration->countByStatus('rejected'),

					'participants' => $participant->count(),

					'approvedToday' => $registration->countToday('approved'),

					'rejectedToday' => $registration->countToday('rejected'),
				]
			);
		}
	}