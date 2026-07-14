<?php

	return [
		'host' => env('DB_HOST', 'localhost'),
		'port' => env('DB_PORT', 3306),
		'database' => env('DB_DATABASE'),
		'username' => env('DB_USERNAME'),
		'password' => env('DB_PASSWORD'),
		'charset' => 'utf8mb4',
	];