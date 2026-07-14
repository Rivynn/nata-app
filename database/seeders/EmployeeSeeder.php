<?php

	use Natasya\NataApp\App\Database;

	$db = Database::connection();

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

	foreach ($users as $index => $user) {

		$field = $fields[$index % count($fields)];

		$stmt->execute([

			$user['id'],

			$field['id'],

			'0812345678' . str_pad($index + 1, 2, '0', STR_PAD_LEFT),

			'Instruktur',

			'Kabupaten Ngawi'

		]);

	}

	echo "Employee Seeder Success." . PHP_EOL;