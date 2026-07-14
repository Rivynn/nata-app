<?php

	use Natasya\NataApp\App\Database;

	$db = Database::connection();

	$stmt = $db->prepare("
    INSERT INTO users
    (
        name,
        username,
        email,
        password,
        role
    )
    VALUES
    (
        ?,
        ?,
        ?,
        ?,
        ?
    )
");

	/*
	|--------------------------------------------------------------------------
	| Administrator
	|--------------------------------------------------------------------------
	*/

	$stmt->execute([

		'Administrator',

		'admin',

		'admin@diskop.test',

		password_hash('admin123', PASSWORD_DEFAULT),

		'admin',

	]);

	/*
	|--------------------------------------------------------------------------
	| Pegawai
	|--------------------------------------------------------------------------
	*/

	for ($i = 1; $i <= 10; $i++) {

		$stmt->execute([

			"Pegawai {$i}",

			"pegawai{$i}",

			"pegawai{$i}@diskop.test",

			password_hash('pegawai123', PASSWORD_DEFAULT),

			'pegawai',

		]);

	}

	/*
	|--------------------------------------------------------------------------
	| Peserta Demo
	|--------------------------------------------------------------------------
	*/

	$stmt->execute([

		'Peserta Demo',

		'peserta',

		'peserta@diskop.test',

		password_hash('peserta123', PASSWORD_DEFAULT),

		'peserta',

	]);

	echo "User Seeder Success." . PHP_EOL;