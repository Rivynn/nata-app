<?php

	namespace Natasya\NataApp\Middleware;

	use Natasya\NataApp\App\Middleware;

	class AuthMiddleware extends Middleware
	{
		public function before(): void
		{
			if(auth()->guest()){

				redirect('/login');

			}
		}
	}