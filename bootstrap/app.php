<?php

	declare(strict_types=1);
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
	require_once dirname(__DIR__) . '/vendor/autoload.php';

	$dotenv = \Dotenv\Dotenv::createImmutable(
		dirname(__DIR__)
	);

	$dotenv->safeLoad();

	require_once __DIR__ . '/database.php';
	require_once __DIR__ . '/constants.php';

	date_default_timezone_set(
		env('APP_TIMEZONE', 'Asia/Makassar')
	);

	if (APP_DEBUG) {

		ini_set('display_errors', '1');

		error_reporting(E_ALL);

	} else {

		ini_set('display_errors', '0');

	}
