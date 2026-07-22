<?php

	namespace Natasya\NataApp\Controller;

	use Natasya\NataApp\App\Controller;

	class DashboardController extends Controller
	{
		public function index(): void
		{
			if (!auth()->check()) {

				$this->redirect('/login');

			}

			switch (auth()->role()) {

				case 'admin':

					$this->redirect('/admin');
					break;

				case 'pegawai':

					$this->redirect('/pegawai');
					break;

				case 'peserta':

					$this->redirect('/peserta');
					break;

				case 'pelatih':
					$this->redirect('/pelatih');
					break;

				default:

					auth()->logout();

					$this->redirect('/login');
			}
		}
	}
