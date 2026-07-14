<?php

	declare(strict_types=1);

	/*
	|--------------------------------------------------------------------------
	| Base Directory
	|--------------------------------------------------------------------------
	*/

	define('BASE_PATH', dirname(__DIR__));

	define('APP_PATH', BASE_PATH . '/app');

	define('CONFIG_PATH', BASE_PATH . '/config');

	define('PUBLIC_PATH', BASE_PATH . '/public');

	define('STORAGE_PATH', BASE_PATH . '/storage');

	define('ROUTES_PATH', BASE_PATH . '/routes');

	define('BOOTSTRAP_PATH', BASE_PATH . '/bootstrap');

	define('VENDOR_PATH', BASE_PATH . '/vendor');

	/*
	|--------------------------------------------------------------------------
	| Environment
	|--------------------------------------------------------------------------
	*/

	define('APP_ENV', env('APP_ENV', 'production'));

	define(
		'APP_DEBUG',
		filter_var(
			env('APP_DEBUG', false),
			FILTER_VALIDATE_BOOL
		)
	);

	define(
		'APP_NAME',
		env('APP_NAME', 'Nata App')
	);

	define(
		'APP_URL',
		rtrim(
			env('APP_URL', ''),
			'/'
		)
	);

	define(
		'APP_TIMEZONE',
		env(
			'APP_TIMEZONE',
			'Asia/Makassar'
		)
	);