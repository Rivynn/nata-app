<?php

	use Natasya\NataApp\App\Database;

	$db = Database::connection();

	$stmt = $db->prepare("
INSERT INTO trainings
(
    training_field_id,
    name,
    description,
    quota,
    duration,
    location,
    registration_open,
    registration_close,
    status
)
VALUES
(
?,?,?,?,?,?,?,?,?
)
");

	$data = [

		[
			1,
			'Web Programming',
			'Belajar PHP, HTML, CSS, JavaScript',
			25,
			30,
			'DISKOP',
			'2026-07-01',
			'2026-07-31',
			'open'
		],

		[
			2,
			'Operator Forklift',
			'Pelatihan operator forklift',
			20,
			14,
			'Workshop',
			'2026-07-10',
			'2026-08-01',
			'open'
		],

		[
			3,
			'Gada Pratama',
			'Pelatihan Satpam',
			30,
			21,
			'Aula DISKOP',
			'2026-07-15',
			'2026-08-10',
			'open'
		],

	];

	foreach($data as $row){

		$stmt->execute($row);

	}

	echo "Training Seeder Success.";