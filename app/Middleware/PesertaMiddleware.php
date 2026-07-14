<?php

	namespace Natasya\NataApp\Middleware;

	use Natasya\NataApp\App\Middleware;
	use Natasya\NataApp\App\View;

	class PesertaMiddleware extends Middleware
	{
		public function before(): void
		{
			if (!auth()->hasRole('peserta')) {

				View::forbidden();

				exit;

			}
		}
	}