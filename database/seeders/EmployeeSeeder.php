<?php

	use Faker\Factory;
	use Natasya\NataApp\App\Database;

	$db = Database::connection();

	$faker = Factory::create('id_ID');

	/*
	|--------------------------------------------------------------------------
	| Ambil Semua Pegawai
	|--------------------------------------------------------------------------
	*/

	$users = $db->query("
    SELECT id
    FROM users
    WHERE role = 'pegawai'
    ORDER BY id
")->fetchAll(PDO::FETCH_ASSOC);

	/*
	|--------------------------------------------------------------------------
	| Ambil Semua Bidang Pelatihan
	|--------------------------------------------------------------------------
	*/

	$fields = $db->query("
    SELECT id
    FROM training_fields
    ORDER BY id
")->fetchAll(PDO::FETCH_ASSOC);

	$stmt = $db->prepare("
    INSERT INTO employees
    (
        user_id,
        training_field_id,
        phone,
        position,
        address
    )
    VALUES
    (
        ?,?,?,?,?
    )
");

	$positions = [
		'Instruktur',
		'Staff Pelatihan',
		'Koordinator Pelatihan',
		'Analis Pelatihan',
		'Pengelola Program',
		'Fasilitator',
		'Administrator Pelatihan',
		'Pembimbing Teknis',
	];

	foreach ($users as $index => $user) {

		$field = $fields[$index % count($fields)];

		$stmt->execute([

			$user['id'],

			$field['id'],

			$faker->phoneNumber(),

			$faker->randomElement($positions),

			$faker->address(),

		]);
	}

	echo "Employee Seeder Success." . PHP_EOL;
