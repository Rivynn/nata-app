<?php

	namespace Natasya\NataApp\Controller;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\View;

	class HomeController extends Controller
	{
		public function index(): void
		{
			$model = [
				"title" => "Belajar PHP MVC",
				"content" => "Selamat Belajar PHP MVC dari Programmer Zaman Now"
			];

			$this->view('Home/index');
		}
	}