<?php

	return [

		'enabled' => filter_var(env('MAIL_ENABLED', true), FILTER_VALIDATE_BOOL),
		'host' => env('MAIL_HOST'),
		'port' => (int) env('MAIL_PORT', 465),
		'encryption' => env('MAIL_ENCRYPTION', 'ssl'),
		'username' => env('MAIL_USERNAME'),
		'password' => env('MAIL_PASSWORD', ''),
		'from_email' => env('MAIL_FROM_EMAIL', 'noreply@natasyadvn.co-id.id'),
		'from_name' => env('MAIL_FROM_NAME', config('app.name')),
		'admin_email' => env('MAIL_ADMIN_EMAIL', 'noreply@natasyadvn.co-id.id'),
	];