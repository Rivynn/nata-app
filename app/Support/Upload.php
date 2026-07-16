<?php

	namespace Natasya\NataApp\Support;

	class Upload
	{
		/**
		 * Upload file apa pun yang didukung.
		 */
		public static function file(
			array $file,
			string $directory
		): ?string
		{
			return self::upload(
				$file,
				$directory,
				[
					'jpg',
					'jpeg',
					'png',
					'webp',

					'pdf',

					'doc',
					'docx',

					'xls',
					'xlsx',

					'ppt',
					'pptx',

					'zip',
					'rar',

					'txt',

					'csv',
				]
			);
		}

		/**
		 * Upload gambar.
		 */
		public static function image(
			array $file,
			string $directory
		): ?string
		{
			return self::upload(
				$file,
				$directory,
				[
					'jpg',
					'jpeg',
					'png',
					'webp',
				]
			);
		}

		/**
		 * Upload dokumen.
		 */
		public static function document(
			array $file,
			string $directory
		): ?string
		{
			return self::upload(
				$file,
				$directory,
				[
					'jpg',
					'jpeg',
					'png',
					'webp',

					'pdf',

					'doc',
					'docx',

					'xls',
					'xlsx',

					'ppt',
					'pptx',

					'zip',
					'rar',

					'txt',

					'csv',
				]
			);
		}

		private static function upload(
			array $file,
			string $directory,
			array $allowed
		): ?string
		{
			if (
				empty($file)
				|| $file['error'] === UPLOAD_ERR_NO_FILE
			) {
				return null;
			}

			if ($file['error'] !== UPLOAD_ERR_OK) {
				return null;
			}

			$extension = strtolower(
				pathinfo(
					$file['name'],
					PATHINFO_EXTENSION
				)
			);

			if (!in_array($extension, $allowed, true)) {
				return null;
			}

			$filename = uniqid('', true) . '.' . $extension;

			$path = public_path(asset(
				'uploads/' . trim($directory, '/')
				)
			);

			if (!is_dir($path)) {
				if (!mkdir($path, 0777, true) && !is_dir($path)) {
					throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
				}
			}

			if (!move_uploaded_file(
				$file['tmp_name'],
				$path . '/' . $filename
			)) {
				return null;
			}

			return $filename;
		}
	}
