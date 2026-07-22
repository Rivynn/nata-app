<?php

	declare(strict_types=1);

	use Illuminate\Database\Capsule\Manager as Capsule;

	$capsule = new Capsule();

	$capsule->addConnection([
		'driver'    => env('DB_CONNECTION', 'mysql'),
		'host'      => env('DB_HOST'),
		'port'      => env('DB_PORT'),
		'database'  => env('DB_DATABASE'),
		'username'  => env('DB_USERNAME'),
		'password'  => env('DB_PASSWORD'),
		'charset'   => 'utf8mb4',
		'collation' => 'utf8mb4_unicode_ci',
		'prefix'    => '',
	]);

	$capsule->setAsGlobal();

	$capsule->bootEloquent();
