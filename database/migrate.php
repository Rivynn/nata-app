<?php

	declare(strict_types=1);

	require_once dirname(__DIR__) . '/vendor/autoload.php';


	$dotenv = Dotenv\Dotenv::createImmutable(
		dirname(__DIR__)
	);

	$dotenv->safeLoad();


	use Database\Migrations\Migration;
	use Natasya\NataApp\App\Database;

	Database::boot();

	/*
	|--------------------------------------------------------------------------
	| Load Base Migration
	|--------------------------------------------------------------------------
	*/

	require_once __DIR__ . '/migrations/Migration.php';

	/*
	|--------------------------------------------------------------------------
	| Load All Migration Files
	|--------------------------------------------------------------------------
	*/

	$files = glob(__DIR__ . '/migrations/*.php');

	sort($files);

	foreach ($files as $file) {

		if (basename($file) === 'Migration.php') {
			continue;
		}

		require_once $file;
	}

	/*
	|--------------------------------------------------------------------------
	| Execute Migrations
	|--------------------------------------------------------------------------
	*/

	foreach (get_declared_classes() as $class) {

		if (!is_subclass_of($class, Migration::class)) {
			continue;
		}

		echo "Migrating: {$class}" . PHP_EOL;

		/** @var Migration $migration */
		$migration = new $class();

		$migration->up();

		echo "Migrated: {$class}" . PHP_EOL;
	}

	echo PHP_EOL;
	echo "All migrations completed successfully." . PHP_EOL;
