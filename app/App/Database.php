<?php

	namespace Natasya\NataApp\App;

	use PDO;

	class Database
	{
		private static ?\PDO $connection = null;

		public static function connection(): PDO
		{
			if (self::$connection === null) {

				$config = require dirname(__DIR__, 2) . '/config/database.php';

				try {

					self::$connection = new PDO(
						"mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}",
						$config['username'],
						$config['password']
					);

					self::$connection->setAttribute(
						PDO::ATTR_ERRMODE,
						PDO::ERRMODE_EXCEPTION
					);

					self::$connection->setAttribute(
						PDO::ATTR_DEFAULT_FETCH_MODE,
						PDO::FETCH_ASSOC
					);

				} catch (\PDOException $e) {

					die("Database Error : " . $e->getMessage());

				}
			}

			return self::$connection;
		}
	}