<?php

	namespace Natasya\NataApp\App;

	class Request
	{
		public static function all(): array
		{
			return array_merge($_GET, $_POST);
		}

		public static function get(string $key, mixed $default = null): mixed
		{
			return $_GET[$key] ?? $default;
		}

		public static function post(string $key, mixed $default = null): mixed
		{
			return $_POST[$key] ?? $default;
		}

		public static function input(string $key, mixed $default = null): mixed
		{
			return $_POST[$key]
				?? $_GET[$key]
				?? $default;
		}

		public static function only(array $keys): array
		{
			$data = [];

			foreach ($keys as $key) {
				$data[$key] = self::input($key);
			}

			return $data;
		}

		public static function except(array $keys): array
		{
			$data = self::all();

			foreach ($keys as $key) {
				unset($data[$key]);
			}

			return $data;
		}

		public static function has(string $key): bool
		{
			return self::input($key) !== null;
		}

		public static function filled(string $key): bool
		{
			$value = self::input($key);

			return $value !== null && $value !== '';
		}

		public static function file(string $key): ?array
		{
			return $_FILES[$key] ?? null;
		}

		public static function method(): string
		{
			return strtoupper($_SERVER['REQUEST_METHOD']);
		}

		public static function isGet(): bool
		{
			return self::method() === 'GET';
		}

		public static function isPost(): bool
		{
			return self::method() === 'POST';
		}

		public static function uri(): string
		{
			return parse_url(
				$_SERVER['REQUEST_URI'],
				PHP_URL_PATH
			);
		}

		public static function ip(): string
		{
			return $_SERVER['REMOTE_ADDR'] ?? '';
		}

		public static function userAgent(): string
		{
			return $_SERVER['HTTP_USER_AGENT'] ?? '';
		}

		public static function ajax(): bool
		{
			return (
					$_SERVER['HTTP_X_REQUESTED_WITH'] ?? ''
				) === 'XMLHttpRequest';
		}

		public static function bearerToken(): ?string
		{
			$header = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

			if (str_starts_with($header, 'Bearer ')) {
				return substr($header, 7);
			}

			return null;
		}
	}