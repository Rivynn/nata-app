<?php

	namespace Natasya\NataApp\App;

	abstract class Controller
	{
		protected function view(
			string $view,
			array $data = [],
			int $statusCode = 200
		): void {
			View::render($view, $data, $statusCode);
		}

		protected function layout(string $layout): void
		{
			View::layout($layout);
		}
		protected function app(): void
		{
			View::layout('Layouts/app');
		}
		protected function blank(): void
		{
			View::layout('Layouts/blank');
		}
		protected function document(): void
		{
			$this->layout('Layouts/document');
		}
		protected function report(): void
		{
			$this->layout('Layouts/report');
		}

		protected function redirect(string $url): never
		{
			redirect($url);
		}
	}