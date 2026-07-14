<?php

	use Natasya\NataApp\App\Database;

	$db = Database::connection();

	$stmt = $db->prepare("
    INSERT INTO registrations
    (
        user_id,
        training_id,
        motivation,
        status,
        approved_at,
        rejected_at,
        rejected_reason
    )
    VALUES
    (
        ?, ?, ?, ?, ?, ?, ?
    )
");

	$data = [

		[
			1,
			1,
			'Saya ingin meningkatkan kemampuan Web Programming untuk bekerja sebagai Web Developer.',
			'approved',
			date('Y-m-d H:i:s'),
			null,
			null,
		],

		[
			1,
			2,
			'Saya ingin memiliki kompetensi sebagai operator forklift.',
			'pending',
			null,
			null,
			null,
		],

		[
			1,
			3,
			'Saya ingin mengikuti pelatihan security untuk menambah peluang kerja.',
			'rejected',
			null,
			date('Y-m-d H:i:s'),
			'Kuota pelatihan telah penuh.',
		],

	];

	foreach ($data as $row) {

		$stmt->execute($row);

	}

	echo "Registration Seeder Success.";