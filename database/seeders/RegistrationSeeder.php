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
    ?, ?, ?, ?, ?, ?, ?, ?, ?
)
");

	$data = [

		[
			1,
			'Web Programming Fundamental',
			'Belajar HTML, CSS, JavaScript dan PHP.',
			30,
			30,
			'Laboratorium Komputer',
			'2026-07-01',
			'2026-07-31',
			'open'
		],

		[
			2,
			'Desain Grafis dengan Adobe Photoshop',
			'Pelatihan desain grafis dasar hingga menengah.',
			25,
			21,
			'Lab Multimedia',
			'2026-07-05',
			'2026-08-05',
			'open'
		],

		[
			3,
			'Digital Marketing untuk UMKM',
			'Strategi pemasaran digital melalui media sosial.',
			35,
			14,
			'Aula DISKOP',
			'2026-07-10',
			'2026-08-10',
			'open'
		],

		[
			4,
			'Administrasi Perkantoran Modern',
			'Microsoft Office dan administrasi digital.',
			30,
			21,
			'Ruang Pelatihan A',
			'2026-07-12',
			'2026-08-12',
			'open'
		],

		[
			5,
			'Akuntansi Dasar',
			'Pencatatan transaksi dan laporan keuangan.',
			25,
			30,
			'Ruang Pelatihan B',
			'2026-07-15',
			'2026-08-15',
			'open'
		],

		[
			6,
			'Menjahit Dasar',
			'Membuat pola dan menjahit pakaian sederhana.',
			20,
			30,
			'Workshop Menjahit',
			'2026-07-18',
			'2026-08-18',
			'open'
		],

		[
			7,
			'Tata Boga Nusantara',
			'Pelatihan memasak makanan khas Indonesia.',
			25,
			21,
			'Kitchen Training',
			'2026-07-20',
			'2026-08-20',
			'open'
		],

		[
			8,
			'Make Up Artist Professional',
			'Pelatihan tata rias profesional.',
			20,
			14,
			'Beauty Class',
			'2026-07-22',
			'2026-08-22',
			'open'
		],

		[
			9,
			'Pengelasan SMAW',
			'Teknik dasar pengelasan SMAW.',
			20,
			30,
			'Workshop Las',
			'2026-07-25',
			'2026-08-25',
			'open'
		],

		[
			10,
			'Instalasi Listrik Rumah',
			'Pelatihan instalasi listrik rumah tangga.',
			20,
			30,
			'Workshop Listrik',
			'2026-08-01',
			'2026-08-31',
			'open'
		],

		[
			11,
			'Servis Sepeda Motor',
			'Perawatan dan servis kendaraan roda dua.',
			25,
			30,
			'Workshop Otomotif',
			'2026-08-05',
			'2026-09-05',
			'open'
		],

		[
			12,
			'Operator Excavator',
			'Pelatihan pengoperasian excavator.',
			20,
			21,
			'Workshop Alat Berat',
			'2026-08-08',
			'2026-09-08',
			'open'
		],

		[
			13,
			'Operator Forklift',
			'Pelatihan operator forklift bersertifikat.',
			20,
			14,
			'Workshop Forklift',
			'2026-08-10',
			'2026-09-10',
			'open'
		],

		[
			14,
			'Gada Pratama',
			'Pelatihan dasar tenaga keamanan.',
			35,
			21,
			'Aula Utama',
			'2026-08-12',
			'2026-09-12',
			'open'
		],

		[
			15,
			'Housekeeping Hotel',
			'Pelatihan tata graha hotel.',
			25,
			14,
			'Hotel Training Center',
			'2026-08-15',
			'2026-09-15',
			'open'
		],

		[
			16,
			'Front Office Hotel',
			'Pelayanan tamu dan reservasi hotel.',
			20,
			21,
			'Hotel Training Center',
			'2026-08-18',
			'2026-09-18',
			'open'
		],

		[
			17,
			'Barista Basic',
			'Pelatihan dasar meracik kopi dan espresso.',
			20,
			14,
			'Coffee Lab',
			'2026-08-20',
			'2026-09-20',
			'open'
		],

		[
			18,
			'English for Workplace',
			'Bahasa Inggris untuk kebutuhan dunia kerja.',
			30,
			21,
			'Language Center',
			'2026-08-22',
			'2026-09-22',
			'open'
		],

		[
			19,
			'Kewirausahaan UMKM',
			'Membangun dan mengembangkan usaha mikro.',
			40,
			14,
			'Aula DISKOP',
			'2026-08-25',
			'2026-09-25',
			'open'
		],

		[
			20,
			'Public Speaking Professional',
			'Komunikasi efektif dan presentasi publik.',
			30,
			14,
			'Ruang Seminar',
			'2026-08-28',
			'2026-09-28',
			'open'
		],

	];

	foreach ($data as $row) {
		$stmt->execute($row);
	}

	echo "Training Seeder Success." . PHP_EOL;
