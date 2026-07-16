<?php

	use Natasya\NataApp\App\Database;

	$db = Database::connection();

	$stmt = $db->prepare("
INSERT INTO training_schedules
(
    training_batch_id,
    meeting_number,
    topic,
    schedule_date,
    start_time,
    end_time,
    notes
)
VALUES
(
    ?, ?, ?, ?, ?, ?, ?
)
");

	$topics = [

		'Orientasi Peserta',
		'Pengenalan Dasar',
		'Materi Inti I',
		'Materi Inti II',
		'Praktik I',
		'Praktik II',
		'Studi Kasus',
		'Workshop',
		'Review Materi',
		'Evaluasi Akhir',

	];

	/*
	|--------------------------------------------------------------------------
	| Total Batch = 40
	|--------------------------------------------------------------------------
	*/

	for ($batchId = 1; $batchId <= 40; $batchId++) {

		$date = new DateTime('2026-08-01');

		// Batch genap dimulai lebih lambat
		if ($batchId % 2 === 0) {

			$date = new DateTime('2026-09-10');

		}

		for ($meeting = 1; $meeting <= 10; $meeting++) {

			$stmt->execute([

				$batchId,

				$meeting,

				$topics[$meeting - 1],

				$date->format('Y-m-d'),

				'08:00:00',

				'12:00:00',

				'Pertemuan ke-' . $meeting

			]);

			// Jadwal tiap 3 hari
			$date->modify('+3 days');

		}

	}

	echo "Training Schedule Seeder Success." . PHP_EOL;
