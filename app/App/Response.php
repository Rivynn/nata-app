<?php

	namespace Natasya\NataApp\App;

	class Response
	{
		public static function status(int $code): void
		{
			http_response_code($code);
		}

		public static function redirect(string $url): never
		{
			header('Location: ' . url($url));
			exit();
		}

		public static function json(
			mixed $data,
			int $status = 200
		): never {

			self::status($status);

			header('Content-Type: application/json');

			echo json_encode(
				$data,
				JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
			);

			exit();
		}

		public static function download(
			string $file,
			?string $name = null
		): never {

			if (!file_exists($file)) {

				self::status(404);

				exit('File tidak ditemukan.');

			}

			header('Content-Type: application/octet-stream');

			header(
				'Content-Disposition: attachment; filename="' .
				($name ?? basename($file)) .
				'"'
			);

			header('Content-Length: ' . filesize($file));

			readfile($file);

			exit();
		}

		public static function back(): never
		{
			header(
				'Location: ' .
				($_SERVER['HTTP_REFERER'] ?? '/')
			);

			exit();
		}

		public static function refresh(): never
		{
			header(
				'Location: ' .
				$_SERVER['REQUEST_URI']
			);

			exit();
		}
	}