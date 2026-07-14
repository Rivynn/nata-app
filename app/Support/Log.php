<?php

	namespace Natasya\NataApp\Support;

	use Monolog\Formatter\LineFormatter;
	use Monolog\Handler\StreamHandler;
	use Monolog\Level;
	use Monolog\Logger;

	class Log
	{
		protected static ?Logger $logger = null;

		protected static function logger(): Logger
		{
			if (self::$logger !== null) {
				return self::$logger;
			}

			$logger = new Logger('nata-app');

			$handler = new StreamHandler(
				storage_path('logs/app.log'),
				Level::Debug
			);

			$handler->setFormatter(
				new LineFormatter(
					"[%datetime%] %level_name%: %message% %context%\n",
					'Y-m-d H:i:s',
					true,
					true
				)
			);

			$logger->pushHandler($handler);

			self::$logger = $logger;

			return $logger;
		}

		public static function debug(string $message, array $context = []): void
		{
			self::logger()->debug($message, $context);
		}

		public static function info(string $message, array $context = []): void
		{
			self::logger()->info($message, $context);
		}

		public static function notice(string $message, array $context = []): void
		{
			self::logger()->notice($message, $context);
		}

		public static function warning(string $message, array $context = []): void
		{
			self::logger()->warning($message, $context);
		}

		public static function error(string $message, array $context = []): void
		{
			self::logger()->error($message, $context);
		}

		public static function critical(string $message, array $context = []): void
		{
			self::logger()->critical($message, $context);
		}

		public static function alert(string $message, array $context = []): void
		{
			self::logger()->alert($message, $context);
		}

		public static function emergency(string $message, array $context = []): void
		{
			self::logger()->emergency($message, $context);
		}
	}