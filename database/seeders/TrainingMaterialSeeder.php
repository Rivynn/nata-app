<?php

	use Natasya\NataApp\App\Database;

	$db = Database::connection();

	$schedules = $db->query("
    SELECT id
    FROM training_schedules
    ORDER BY id
")->fetchAll(PDO::FETCH_ASSOC);

	$stmt = $db->prepare("
INSERT INTO training_materials
(
    schedule_id,
    title,
    description,
    file
)
VALUES
(
    ?, ?, ?, ?
)
");

	$materials = [

		[
			'Orientasi Peserta',
			'Pengenalan pelatihan, tata tertib, dan tujuan pembelajaran.',
		],

		[
			'Dasar-Dasar Materi',
			'Materi dasar yang wajib dipahami oleh seluruh peserta.',
		],

		[
			'Konsep Inti',
			'Penjelasan konsep utama sesuai bidang pelatihan.',
		],

		[
			'Pendalaman Materi',
			'Pendalaman teori beserta contoh penerapan.',
		],

		[
			'Praktik Dasar',
			'Praktik awal menggunakan studi kasus sederhana.',
		],

		[
			'Praktik Lanjutan',
			'Latihan lanjutan untuk meningkatkan kompetensi peserta.',
		],

		[
			'Studi Kasus',
			'Penyelesaian kasus nyata berdasarkan materi yang dipelajari.',
		],

		[
			'Workshop',
			'Sesi workshop dan diskusi kelompok.',
		],

		[
			'Review Materi',
			'Rangkuman seluruh materi sebelum evaluasi.',
		],

		[
			'Evaluasi Akhir',
			'Materi persiapan evaluasi dan penugasan akhir.',
		],

	];

	foreach ($schedules as $index => $schedule) {

		$material = $materials[$index % count($materials)];

		$stmt->execute([

			$schedule['id'],

			$material[0],

			$material[1],

			null

		]);

	}

	echo "Training Material Seeder Success." . PHP_EOL;
