<?php

	namespace Natasya\NataApp\App;

	class Router
	{
		private static array $routes = [];

		private static array $middlewareGroup = [];

		public static function add(
			string $method,
			string $path,
			string $controller,
			string $function,
			array $middlewares = []
		): void
		{
			self::$routes[] = [

				'method' => strtoupper($method),

				'path' => $path,

				'controller' => $controller,

				'function' => $function,

				'middlewares' => array_merge(
					self::$middlewareGroup,
					$middlewares
				),

			];
		}
		public static function middleware(
			array $middlewares,
			callable $callback
		): void
		{
			$previous = self::$middlewareGroup;

			self::$middlewareGroup = array_merge(
				self::$middlewareGroup,
				$middlewares
			);

			$callback();

			self::$middlewareGroup = $previous;
		}

		public static function get(
			string $path,
			string $controller,
			string $function,
			array  $middlewares = []
		): void
		{
			self::add('GET', $path, $controller, $function, $middlewares);
		}

		public static function post(
			string $path,
			string $controller,
			string $function,
			array  $middlewares = []
		): void
		{
			self::add('POST', $path, $controller, $function, $middlewares);
		}

		public static function run(): void
		{
			$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

			// Jika project berada di subfolder (htdocs/nata-app/public)
			$basePath = dirname($_SERVER['SCRIPT_NAME']);

			if ($basePath !== '/' && str_starts_with($path, $basePath)) {
				$path = substr($path, strlen($basePath));
			}

			$path = $path ?: '/';

			$method = $_SERVER['REQUEST_METHOD'];

			foreach (self::$routes as $route) {

				if ($method !== $route['method']) {
					continue;
				}

				$pattern = "#^{$route['path']}$#";

				if (!preg_match($pattern, $path, $variables)) {
					continue;
				}

				foreach ($route['middlewares'] as $middleware) {
					(new $middleware())->before();
				}

				if (!class_exists($route['controller'])) {
					View::internalServerError("Controller tidak ditemukan.");
					return;
				}

				$controller = new $route['controller'];

				if (!method_exists($controller, $route['function'])) {
					View::internalServerError("Method tidak ditemukan.");
					return;
				}

				array_shift($variables);

				call_user_func_array(
					[$controller, $route['function']],
					$variables
				);

				return;
			}

			View::notFound();
		}
	}