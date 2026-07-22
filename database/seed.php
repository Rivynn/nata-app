<?php

	declare(strict_types=1);

	require_once dirname(__DIR__) . '/vendor/autoload.php';

	$dotenv = Dotenv\Dotenv::createImmutable(
		dirname(__DIR__)
	);

	$dotenv->safeLoad();

	use Database\Seeders\DatabaseSeeder;
	use Natasya\NataApp\App\Database;

	Database::boot();

	/*
	|--------------------------------------------------------------------------
	| Run Database Seeder
	|--------------------------------------------------------------------------
	*/

	echo "Running database seeders..." . PHP_EOL . PHP_EOL;

	(new DatabaseSeeder())->run();

	echo PHP_EOL;
	echo "Database seeding completed successfully." . PHP_EOL;
