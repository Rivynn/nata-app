<?php

	namespace Natasya\NataApp\Controller\Admin;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\Model\Participant;
	use Natasya\NataApp\Model\User;

	class DashboardController extends Controller
	{
		public function index(): void
		{
			$user = new User();
			$participant = new Participant();

			$this->view(
				'Dashboard/admin',
				[
					'title'             => 'Dashboard',
					'totalUsers'        => $user->count(),
					'totalEmployees'    => $user->countByRole('pegawai'),
					'totalParticipants' => $participant->count(),

					// nanti tinggal ganti kalau tabel training sudah ada
					'totalTrainings'    => 0,
				]
			);
		}
	}