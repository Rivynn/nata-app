<?php

	use Natasya\NataApp\App\Database;

	$db = Database::connection();

	$stmt = $db->prepare("
INSERT INTO training_fields
(
    name,
    description,
    icon,
    color
)
VALUES
(
    ?,?,?,?
)
");

	$data = [

		[
			'Komputer',
			'Pelatihan komputer dan teknologi informasi',
			'fas fa-laptop-code',
			'primary'
		],

		[
			'Desain Grafis',
			'Pelatihan desain grafis dan multimedia',
			'fas fa-palette',
			'info'
		],

		[
			'Digital Marketing',
			'Pelatihan pemasaran digital dan media sosial',
			'fas fa-bullhorn',
			'warning'
		],

		[
			'Administrasi Perkantoran',
			'Pelatihan administrasi dan perkantoran',
			'fas fa-briefcase',
			'secondary'
		],

		[
			'Akuntansi',
			'Pelatihan pembukuan dan akuntansi',
			'fas fa-calculator',
			'success'
		],

		[
			'Menjahit',
			'Pelatihan tata busana dan menjahit',
			'fas fa-cut',
			'danger'
		],

		[
			'Tata Boga',
			'Pelatihan memasak dan kuliner',
			'fas fa-utensils',
			'warning'
		],

		[
			'Tata Rias',
			'Pelatihan kecantikan dan tata rias',
			'fas fa-spa',
			'pink'
		],

		[
			'Pengelasan',
			'Pelatihan teknik pengelasan',
			'fas fa-tools',
			'dark'
		],

		[
			'Listrik',
			'Pelatihan instalasi listrik',
			'fas fa-bolt',
			'warning'
		],

		[
			'Otomotif',
			'Pelatihan servis kendaraan bermotor',
			'fas fa-car',
			'danger'
		],

		[
			'Alat Berat',
			'Pelatihan operator alat berat',
			'fas fa-truck-monster',
			'success'
		],

		[
			'Forklift',
			'Pelatihan operator forklift',
			'fas fa-dolly',
			'info'
		],

		[
			'Keamanan',
			'Pelatihan tenaga keamanan (Satpam)',
			'fas fa-user-shield',
			'primary'
		],

		[
			'Housekeeping',
			'Pelatihan tata graha dan kebersihan',
			'fas fa-broom',
			'secondary'
		],

		[
			'Perhotelan',
			'Pelatihan pelayanan hotel dan hospitality',
			'fas fa-hotel',
			'info'
		],

		[
			'Barista',
			'Pelatihan meracik kopi profesional',
			'fas fa-coffee',
			'dark'
		],

		[
			'Bahasa Inggris',
			'Pelatihan komunikasi Bahasa Inggris',
			'fas fa-language',
			'primary'
		],

		[
			'Kewirausahaan',
			'Pelatihan membangun usaha dan UMKM',
			'fas fa-store',
			'success'
		],

		[
			'Public Speaking',
			'Pelatihan komunikasi dan presentasi',
			'fas fa-microphone',
			'danger'
		],

	];

	foreach ($data as $row) {

		$stmt->execute($row);

	}

	echo "Training Field Seeder Success." . PHP_EOL;
