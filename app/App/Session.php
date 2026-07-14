<?php

	namespace Natasya\NataApp\App;

	class Session
	{
		public static function put(
			string $key,
			mixed $value
		): void
		{
			$_SESSION[$key] = $value;
		}

		public static function get(
			string $key,
			mixed $default = null
		): mixed
		{
			return $_SESSION[$key] ?? $default;
		}

		public static function has(
			string $key
		): bool
		{
			return array_key_exists($key, $_SESSION);
		}

		public static function forget(
			string $key
		): void
		{
			unset($_SESSION[$key]);
		}

		public static function flush(): void
		{
			$_SESSION = [];
		}

		public static function pull(
			string $key,
			mixed $default = null
		): mixed
		{
			$value = self::get($key, $default);

			self::forget($key);

			return $value;
		}

		/*
		|--------------------------------------------------------------------------
		| Flash Session
		|--------------------------------------------------------------------------
		*/

		public static function flash(
			string $key,
			mixed $value
		): void
		{
			$_SESSION['_flash'][$key] = $value;
		}

		public static function getFlash(
			string $key,
			mixed $default = null
		): mixed
		{
			if (!isset($_SESSION['_flash'][$key])) {

				return $default;

			}

			$value = $_SESSION['_flash'][$key];

			unset($_SESSION['_flash'][$key]);

			return $value;
		}

		public static function hasFlash(
			string $key
		): bool
		{
			return isset($_SESSION['_flash'][$key]);
		}

		public static function forgetFlash(
			string $key
		): void
		{
			unset($_SESSION['_flash'][$key]);
		}

		/*
		|--------------------------------------------------------------------------
		| Counter
		|--------------------------------------------------------------------------
		*/

		public static function increment(
			string $key,
			int $step = 1
		): int
		{
			$_SESSION[$key] = (self::get($key, 0) + $step);

			return $_SESSION[$key];
		}

		public static function decrement(
			string $key,
			int $step = 1
		): int
		{
			$_SESSION[$key] = (self::get($key, 0) - $step);

			return $_SESSION[$key];
		}

		/*
		|--------------------------------------------------------------------------
		| Destroy
		|--------------------------------------------------------------------------
		*/

		public static function destroy(): void
		{
			session_destroy();

			$_SESSION = [];
		}
	}