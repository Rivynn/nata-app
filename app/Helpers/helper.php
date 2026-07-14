<?php

	declare(strict_types=1);
	if (!function_exists('env')) {

		function env(
			string $key,
			mixed $default = null
		): mixed
		{
			return $_ENV[$key]
				?? $_SERVER[$key]
				?? $default;
		}

	}

	use Natasya\NataApp\App\Auth;

	if (!function_exists('config')) {

		function config(string $key, mixed $default = null): mixed
		{
			static $configs = [];

			$segments = explode('.', $key);

			$file = array_shift($segments);

			if (!isset($configs[$file])) {

				$configFile = dirname(__DIR__, 2) . "/config/{$file}.php";

				if (!file_exists($configFile)) {
					return $default;
				}

				$configs[$file] = require $configFile;
			}

			$value = $configs[$file];

			foreach ($segments as $segment) {

				if (!is_array($value) || !array_key_exists($segment, $value)) {
					return $default;
				}

				$value = $value[$segment];
			}

			return $value;
		}

	}

	if (!function_exists('base_url')) {

		function base_url(string $path = ''): string
		{
			$base = rtrim(config('app.url', ''), '/');

			return $base . '/' . ltrim($path, '/');
		}

	}

	if (!function_exists('asset')) {

		function asset(string $path = ''): string
		{
			return '/assets/' . ltrim($path, '/');
		}

	}

	if (!function_exists('url')) {

		function url(string $path = ''): string
		{
			return base_url($path);
		}

	}

	if (!function_exists('redirect')) {

		function redirect(string $path): never
		{
			header('Location: ' . url($path));
			exit;
		}

	}

	if (!function_exists('session')) {

		function session(string $key, mixed $default = null): mixed
		{
			return $_SESSION[$key] ?? $default;
		}

	}

	if (!function_exists('old')) {

		function old(string $key, mixed $default = ''): mixed
		{
			return $_POST[$key] ?? $default;
		}

	}

	if (!function_exists('dd')) {

		function dd(mixed $value): never
		{
			echo '<pre>';
			var_dump($value);
			echo '</pre>';

			exit;
		}

	}

	if (!function_exists('menu')) {

		function menu(): array
		{
			static $menu = null;

			if ($menu === null) {

				$menu = require dirname(__DIR__, 2) . '/config/menu.php';

			}

			return $menu;
		}

	}

	if (!function_exists('auth')) {

		function auth(): Auth
		{
			static $auth;

			if (!$auth) {
				$auth = new Auth();
			}

			return $auth;
		}

	}

	if (!function_exists('app_name')) {

		function app_name(): string
		{
			return config('app.name');
		}

	}

	if (!function_exists('app_description')) {

		function app_description(): string
		{
			return config('app.description');
		}

	}

	if (!function_exists('is_active')) {

		function is_active(string $url): string
		{
			$current = rtrim(
				parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),
				'/'
			);

			$target = rtrim(
				parse_url(url($url), PHP_URL_PATH),
				'/'
			);

			if ($current === '') {
				$current = '/';
			}

			if ($target === '') {
				$target = '/';
			}

			if ($current === $target) {
				return 'active';
			}

			if (
				$target !== '/'
				&& str_starts_with($current, $target . '/')
			) {
				return 'active';
			}

			return '';
		}

	}

	if (!function_exists('role')) {

		function role(): ?string
		{
			return auth()->role();
		}

	}

	if (!function_exists('can')) {

		function can(array|string $roles): bool
		{
			return auth()->hasRole($roles);
		}

	}

	if (!function_exists('dashboard_url')) {

		function dashboard_url(): string
		{
			return match (auth()->role()) {
				'admin'   => '/admin',
				'pegawai' => '/pegawai',
				'peserta' => '/peserta',
				default   => '/login',
			};
		}

	}

	if (!function_exists('user')) {

		function user(): ?array
		{
			return auth()->user();
		}

	}

	if (!function_exists('initials')) {

		function initials(string $name): string
		{
			$name = trim($name);

			if ($name === '') {
				return '?';
			}

			$words = preg_split('/\s+/', $name);

			$initials = '';

			foreach ($words as $word) {

				if ($word === '') {
					continue;
				}

				$initials .= mb_strtoupper(mb_substr($word, 0, 1));

				if (mb_strlen($initials) >= 2) {
					break;
				}

			}

			return $initials;
		}

	}


	if (!function_exists('avatar')) {

		/**
		 * URL avatar user.
		 */
		function avatar(?array $user = NULL): ?string
		{
			$user ??= auth()->user();

			if (!$user) {
				return NULL;
			}

			if (empty($user['avatar'])) {
				return NULL;
			}

			return asset(
				'uploads/avatars/' . $user['avatar']
			);
		}

	}

	if (!function_exists('has_avatar')) {

		/**
		 * Apakah user memiliki avatar.
		 */
		function has_avatar(?array $user = NULL): bool
		{
			return avatar($user) !== NULL;
		}

	}

	if (!function_exists('avatar_or_initial')) {

		/**
		 * Mengembalikan avatar atau inisial.
		 */
		function avatar_or_initial(?array $user = NULL): string
		{
			$user ??= auth()->user();

			if (!$user) {
				return '';
			}

			return has_avatar($user)
				? avatar($user)
				: initials($user['name']);
		}

	}
	if (!function_exists('public_path')) {

		/**
		 * Path absolut ke folder public.
		 */
		function public_path(string $path = ''): string
		{
			return dirname(__DIR__, 2)
				. '/public/'
				. ltrim($path, '/');
		}

	}

	if (!function_exists('training_registration_status')) {

		/**
		 * Status pendaftaran pelatihan.
		 *
		 * coming_soon
		 * open
		 * expired
		 * closed
		 */
		function training_registration_status(array $training): string
		{
			if ($training['status'] !== 'open') {

				return 'closed';

			}

			$today = strtotime(date('Y-m-d'));

			$open = strtotime($training['registration_open']);

			$close = strtotime($training['registration_close']);

			if ($today < $open) {

				return 'coming_soon';

			}

			if ($today > $close) {

				return 'expired';

			}

			return 'open';
		}

	}

	if (!function_exists('training_registration_label')) {

		function training_registration_label(array $training): string
		{
			return match (training_registration_status($training)) {

				'coming_soon' => 'Segera Dibuka',

				'open' => 'Dibuka',

				'expired' => 'Berakhir',

				default => 'Ditutup',

			};
		}

	}

	if (!function_exists('training_registration_color')) {

		function training_registration_color(array $training): string
		{
			return match (training_registration_status($training)) {

				'coming_soon' => 'info',

				'open' => 'success',

				'expired' => 'warning',

				default => 'danger',

			};
		}

	}

	if (!function_exists('training_registration_icon')) {

		function training_registration_icon(array $training): string
		{
			return match (training_registration_status($training)) {

				'coming_soon' => 'fas fa-clock',

				'open' => 'fas fa-lock-open',

				'expired' => 'fas fa-calendar-times',

				default => 'fas fa-lock',

			};
		}

	}

	if (!function_exists('training_registration_badge')) {

		function training_registration_badge(array $training): string
		{
			$color = training_registration_color($training);

			$icon = training_registration_icon($training);

			$label = training_registration_label($training);

			return sprintf(
				'<span class="badge badge-%s px-3 py-2"><i class="%s mr-1"></i>%s</span>',
				$color,
				$icon,
				$label
			);
		}

	}

	if (!function_exists('training_registration_open')) {

		function training_registration_open(array $training): bool
		{
			return training_registration_status($training) === 'open';
		}

	}

	if (!function_exists('training_registration_closed')) {

		function training_registration_closed(array $training): bool
		{
			return training_registration_status($training) === 'closed';
		}

	}

	if (!function_exists('training_registration_expired')) {

		function training_registration_expired(array $training): bool
		{
			return training_registration_status($training) === 'expired';
		}

	}

	if (!function_exists('training_registration_coming_soon')) {

		function training_registration_coming_soon(array $training): bool
		{
			return training_registration_status($training) === 'coming_soon';
		}

	}

	if (!function_exists('storage_path')) {

		/**
		 * Path absolut ke folder storage.
		 */
		function storage_path(string $path = ''): string
		{
			return dirname(__DIR__, 2)
				. '/storage/'
				. ltrim($path, '/');
		}

	}

	if (!function_exists('storage_url')) {

		/**
		 * URL storage public.
		 */
		function storage_url(string $path = ''): string
		{
			return url(
				'storage/' . ltrim($path, '/')
			);
		}

	}
	if (!function_exists('logger')) {

		/**
		 * Logger.
		 */
		if (!function_exists('logger')) {

			/**
			 * Logger helper.
			 */
			function logger(
				string $level,
				string $message,
				array $context = []
			): void
			{
				match ($level) {

					'debug' => \Natasya\NataApp\Support\Log::debug($message, $context),

					'notice' => \Natasya\NataApp\Support\Log::notice($message, $context),

					'warning' => \Natasya\NataApp\Support\Log::warning($message, $context),

					'error' => \Natasya\NataApp\Support\Log::error($message, $context),

					'critical' => \Natasya\NataApp\Support\Log::critical($message, $context),

					'alert' => \Natasya\NataApp\Support\Log::alert($message, $context),

					'emergency' => \Natasya\NataApp\Support\Log::emergency($message, $context),

					default => \Natasya\NataApp\Support\Log::info($message, $context),

				};
			}

		}

	}

	if (!function_exists('session')) {

		function session(
			string $key,
			mixed $default = null
		): mixed
		{
			return \Natasya\NataApp\App\Session::get(
				$key,
				$default
			);
		}

	}
	if (!function_exists('flash')) {

		function flash(
			string $key,
			mixed $value = null
		): mixed
		{
			if (func_num_args() === 2) {

				\Natasya\NataApp\App\Session::flash(
					$key,
					$value
				);

				return null;
			}

			return \Natasya\NataApp\App\Session::getFlash($key);
		}

	}
	if (!function_exists('success')) {

		function success(
			string $message
		): void
		{
			\Natasya\NataApp\App\Session::flash(
				'success',
				$message
			);
		}

	}
	if (!function_exists('error')) {

		function error(
			string $message
		): void
		{
			\Natasya\NataApp\App\Session::flash(
				'error',
				$message
			);
		}

	}

