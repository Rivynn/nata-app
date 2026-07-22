<?php

	use Natasya\NataApp\App\Database;

	$db = Database::connection();

	$stmt = $db->prepare("
INSERT INTO training_batches
(
    training_id,
    trainer_id,
    code,
    batch_name,
    start_date,
    end_date,
    max_participants,
    room,
    status
)
VALUES
(
    ?, ?, ?, ?, ?, ?, ?, ?, ?
)
");

	$data = [];

	$rooms = [
		'Ruang A',
		'Ruang B',
		'Ruang C',
		'Lab Komputer 1',
		'Lab Komputer 2',
		'Workshop 1',
		'Workshop 2',
		'Aula Utama',
	];

	for ($trainingId = 1; $trainingId <= 20; $trainingId++) {

		// Batch 1
		$data[] = [
			$trainingId,
			(($trainingId - 1) % 10) + 1,
			sprintf('TRN-%03d-B01', $trainingId),
			'Batch 1',
			'2026-08-01',
			'2026-08-30',
			rand(20, 35),
			$rooms[array_rand($rooms)],
			'completed'
		];

		// Batch 2
		$data[] = [
			$trainingId,
			(($trainingId - 1) % 10) + 1,
			sprintf('TRN-%03d-B02', $trainingId),
			'Batch 2',
			'2026-09-10',
			'2026-10-09',
			rand(20, 35),
			$rooms[array_rand($rooms)],
			'registration'
		];
	}

	foreach ($data as $row) {
		$stmt->execute($row);
	}

	echo "Training Batch Seeder Success." . PHP_EOL;
