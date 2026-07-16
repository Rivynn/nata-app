<?php

	use Natasya\NataApp\App\Database;

	$db = Database::connection();

	$stmt = $db->prepare("
INSERT INTO assessment_items
(
    training_field_id,
    name,
    weight
)
VALUES
(
    ?, ?, ?
)
");

	$data = [];

	/*
	|--------------------------------------------------------------------------
	| Semua bidang pelatihan memiliki komponen penilaian yang sama
	|--------------------------------------------------------------------------
	*/

	for ($fieldId = 1; $fieldId <= 20; $fieldId++) {

		$data[] = [$fieldId, 'Kehadiran', 10];
		$data[] = [$fieldId, 'Disiplin', 15];
		$data[] = [$fieldId, 'Teori', 30];
		$data[] = [$fieldId, 'Praktik', 45];

	}

	foreach ($data as $row) {
		$stmt->execute($row);
	}

	echo "Assessment Item Seeder Success." . PHP_EOL;
