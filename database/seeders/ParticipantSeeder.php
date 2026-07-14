<?php

	use Natasya\NataApp\App\Database;

	$db = Database::connection();

	$users = $db->query("
    SELECT id
    FROM users
    WHERE role = 'peserta'
")->fetchAll(PDO::FETCH_ASSOC);

	$stmt = $db->prepare("
    INSERT INTO participants
    (
        user_id,
        phone,
        gender,
        birth_date,
        address,
        education,
        institution
    )
    VALUES
    (
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?
    )
");

	foreach ($users as $index => $user) {

		$stmt->execute([

			$user['id'],

			'0812345678' . str_pad((string)($index + 1), 2, '0', STR_PAD_LEFT),

			$index % 2 === 0 ? 'L' : 'P',

			'2003-01-' . str_pad((string)($index + 1), 2, '0', STR_PAD_LEFT),

			'Banjarmasin',

			'SMA/SMK',

			'Belum Bekerja',

		]);

	}

	echo "Participant Seeder Success." . PHP_EOL;