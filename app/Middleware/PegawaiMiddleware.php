<?php

	namespace Natasya\NataApp\Middleware;

	use Natasya\NataApp\App\Middleware;
	use Natasya\NataApp\App\View;

	class PegawaiMiddleware extends Middleware
	{
		public function before(): void
		{
			if (!auth()->hasRole('pegawai')) {

				View::forbidden();

				exit;

			}
		}
	}