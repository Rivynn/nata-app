<?php

	namespace Natasya\NataApp\Middleware;

	use Natasya\NataApp\App\Middleware;
	use Natasya\NataApp\App\View;

	class AdminMiddleware extends Middleware
	{
		public function before(): void
		{
			if (!auth()->hasRole('admin')) {

				View::forbidden();

				exit;

			}
		}
	}