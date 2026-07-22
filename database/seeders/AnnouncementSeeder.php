<?php

	use Natasya\NataApp\App\Database;

	$db = Database::connection();

	$batches = $db->query("
    SELECT id
    FROM training_batches
    ORDER BY id
")->fetchAll(PDO::FETCH_ASSOC);

	$stmt = $db->prepare("
INSERT INTO announcements
(
    batch_id,
    title,
    content
)
VALUES
(
    ?, ?, ?
)
");

	$announcements = [

		[
			'Pembukaan Pelatihan',
			'Selamat datang kepada seluruh peserta. Pelatihan akan dimulai sesuai jadwal yang telah ditentukan. Mohon hadir 30 menit sebelum kegiatan dimulai.'
		],

		[
			'Perubahan Jadwal Pertemuan',
			'Terdapat penyesuaian jadwal pada salah satu sesi pelatihan. Silakan melihat menu jadwal untuk informasi terbaru.'
		],

		[
			'Pengumpulan Tugas',
			'Seluruh peserta diwajibkan mengumpulkan tugas praktik sebelum batas waktu yang telah ditentukan.'
		],

		[
			'Pengumuman Ujian Akhir',
			'Ujian akhir pelatihan akan dilaksanakan pada pertemuan terakhir. Pastikan seluruh materi telah dipelajari.'
		],

		[
			'Penerbitan Sertifikat',
			'Sertifikat akan diterbitkan setelah seluruh proses penilaian selesai dan peserta dinyatakan lulus.'
		],

	];

	foreach ($batches as $batch) {

		foreach ($announcements as $announcement) {

			$stmt->execute([

				$batch['id'],

				$announcement[0],

				$announcement[1],

			]);

		}

	}

	echo "Announcement Seeder Success." . PHP_EOL;
