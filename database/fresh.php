<?php

	declare(strict_types=1);

	require_once dirname(__DIR__) . '/vendor/autoload.php';

	$dotenv = Dotenv\Dotenv::createImmutable(
		dirname(__DIR__)
	);

	$dotenv->safeLoad();

	use Illuminate\Database\Capsule\Manager as Capsule;
	use Natasya\NataApp\App\Database;

	Database::boot();

	echo PHP_EOL;
	echo "==========================================" . PHP_EOL;
	echo "Refreshing Database..." . PHP_EOL;
	echo "==========================================" . PHP_EOL;

	$connection = Capsule::connection();

	$database = $connection->getDatabaseName();

	/*
	|--------------------------------------------------------------------------
	| Disable Foreign Key Checks
	|--------------------------------------------------------------------------
	*/

	$connection->statement('SET FOREIGN_KEY_CHECKS = 0');

	/*
	|--------------------------------------------------------------------------
	| Get All Tables
	|--------------------------------------------------------------------------
	*/

	$tables = $connection->select(
		"
        SELECT table_name
        FROM information_schema.tables
        WHERE table_schema = ?
    ",
		[$database]
	);

	/*
	|--------------------------------------------------------------------------
	| Drop Tables
	|--------------------------------------------------------------------------
	*/

	echo PHP_EOL;
	echo "Dropping tables..." . PHP_EOL;

	foreach ($tables as $table) {

		$tableName = array_values((array) $table)[0];

		$connection->statement(
			sprintf(
				'DROP TABLE IF EXISTS `%s`',
				$tableName
			)
		);

		echo "✓ Dropped {$tableName}" . PHP_EOL;
	}

	/*
	|--------------------------------------------------------------------------
	| Enable Foreign Key Checks
	|--------------------------------------------------------------------------
	*/

	$connection->statement('SET FOREIGN_KEY_CHECKS = 1');

	echo PHP_EOL;
	echo "Running migrations..." . PHP_EOL;
	echo "------------------------------------------" . PHP_EOL;

	require __DIR__ . '/migrate.php';

	echo PHP_EOL;
	echo "Running seeders..." . PHP_EOL;
	echo "------------------------------------------" . PHP_EOL;

	require __DIR__ . '/seed.php';

	echo PHP_EOL;
	echo "==========================================" . PHP_EOL;
	echo "Database refreshed successfully." . PHP_EOL;
	echo "==========================================" . PHP_EOL;
