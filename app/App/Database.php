<?php

	namespace Natasya\NataApp\App;

	use Illuminate\Database\Capsule\Manager as Capsule;
	use PDO;

	class Database
	{
		private static ?Capsule $capsule = null;


		public static function boot(): void
		{
			if (self::$capsule !== null) {
				return;
			}

			$config = require dirname(__DIR__, 2) . '/config/database.php';

			$capsule = new Capsule();


			$capsule->addConnection([
				'driver'    => 'mysql',
				'host'      => $config['host'],
				'port'      => $config['port'],
				'database'  => $config['database'],
				'username'  => $config['username'],
				'password'  => $config['password'],
				'charset'   => $config['charset'],
				'collation' => 'utf8mb4_unicode_ci',
				'prefix'    => '',
			]);

			$capsule->setAsGlobal();
			$capsule->bootEloquent();

			self::$capsule = $capsule;
		}

		public static function connection(): PDO
		{
			self::boot();

			return self::$capsule
				->getConnection()
				->getPdo();
		}

		public static function capsule(): Capsule
		{
			self::boot();

			return self::$capsule;
		}
	}
