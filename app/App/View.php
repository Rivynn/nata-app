<?php

	namespace Natasya\NataApp\App;

	class View
	{
		/**
		 * Layout default
		 */
		private static string $layout = 'Layouts/app';

		/**
		 * Mengubah layout yang digunakan.
		 */
		public static function layout(string $layout): void
		{
			self::$layout = $layout;
		}

		/**
		 * Render view.
		 */
		public static function render(
			string $view,
			array $data = [],
			int $statusCode = 200
		): void
		{

			http_response_code($statusCode);

			$viewFile = __DIR__ . '/../View/' . $view . '.php';

			if (!file_exists($viewFile)) {
				self::internalServerError(
					"View '{$view}' tidak ditemukan."
				);

				return;
			}

			extract($data);

			ob_start();

			require $viewFile;

			$content = ob_get_clean();

			$layoutFile = __DIR__ . '/../View/' . self::$layout . '.php';

			if (!file_exists($layoutFile)) {
				echo $content;
				return;
			}

			require $layoutFile;

			// Reset layout supaya request berikutnya kembali normal
			self::$layout = 'Layouts/app';
		}

		/**
		 * Cek apakah view tersedia.
		 */
		public static function exists(string $view): bool
		{
			return file_exists(
				__DIR__ . '/../View/' . $view . '.php'
			);
		}

		/**
		 * 404
		 */
		public static function notFound(): void
		{
			self::layout('Layouts/blank');

			self::render(
				'Errors/404',
				[
					'title' => '404 Not Found'
				],
				404
			);
		}

		/**
		 * 403
		 */
		public static function forbidden(): void
		{
			self::layout('Layouts/blank');

			self::render(
				'Errors/403',
				[
					'title' => '403 Forbidden'
				],
				403
			);
		}

		/**
		 * 500
		 */
		public static function internalServerError(
			string $message = ''
		): void
		{
			self::layout('Layouts/blank');

			self::render(
				'Errors/500',
				[
					'title' => '500 Internal Server Error',
					'message' => $message
				],
				500
			);
		}
	}