<?php

	namespace Natasya\NataApp\Controller\Peserta;

	use Natasya\NataApp\App\Controller;

	class DashboardController extends Controller
	{
		public function index(): void
		{
			$this->view(
				'Dashboard/peserta',
				[
					'title' => 'Dashboard'
				]
			);
		}
	}