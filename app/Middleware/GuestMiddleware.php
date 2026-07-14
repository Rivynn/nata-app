<?php

	namespace Natasya\NataApp\Middleware;

	use Natasya\NataApp\App\Middleware;

	class GuestMiddleware extends Middleware
	{
		public function before(): void
		{
			if (auth()->check()) {

				$dashboard = '/' . auth()->role();

				redirect($dashboard);

			}
		}
	}