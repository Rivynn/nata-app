<?php

	use Natasya\NataApp\App\Database;

	$db = Database::connection();

	$userStmt = $db->prepare("
	INSERT INTO users
	(
		name,
		username,
		email,
		password,
		role,
		status
	)
	VALUES
	(
		?,?,?,?,?,?
	)
");

	$trainerStmt = $db->prepare("
	INSERT INTO trainers
	(
		user_id,
		training_field_id,
		employee_number,
		phone,
		email,
		institution,
		expertise,
		biography,
		status
	)
	VALUES
	(
		?,?,?,?,?,?,?,?,?
	)
");

	$password = password_hash('password', PASSWORD_DEFAULT);

	$data = [

		[
			'training_field_id' => 1,
			'name' => 'Natasya Deviana, S.Kom',
			'username' => 'pelatih001',
			'email' => 'pelatih001@diskop.go.id',
			'employee_number' => 'TRN-001',
			'phone' => '081234567890',
			'institution' => 'DISKOP UKM',
			'expertise' => 'Web Programming',
			'biography' => 'Instruktur Web Programming.'
		],

		[
			'training_field_id' => 2,
			'name' => 'Michee Puding, S.Ds',
			'username' => 'pelatih002',
			'email' => 'pelatih002@diskop.go.id',
			'employee_number' => 'TRN-002',
			'phone' => '081234567891',
			'institution' => 'Universitas Lambung Mangkurat',
			'expertise' => 'Desain Grafis',
			'biography' => 'Instruktur Desain Grafis.'
		],

		[
			'training_field_id' => 3,
			'name' => 'Devi Andriani, S.M',
			'username' => 'pelatih003',
			'email' => 'pelatih003@diskop.go.id',
			'employee_number' => 'TRN-003',
			'phone' => '081234567892',
			'institution' => 'DISKOP UKM',
			'expertise' => 'Digital Marketing',
			'biography' => 'Trainer Digital Marketing.'
		],

		[
			'training_field_id' => 4,
			'name' => 'Tasya Pramesti, S.A.P',
			'username' => 'pelatih004',
			'email' => 'pelatih004@diskop.go.id',
			'employee_number' => 'TRN-004',
			'phone' => '081234567893',
			'institution' => 'Universitas Terbuka',
			'expertise' => 'Administrasi Perkantoran',
			'biography' => 'Instruktur Administrasi Perkantoran.'
		],

		[
			'training_field_id' => 5,
			'name' => 'Ahmad Fauzan, S.Ak',
			'username' => 'pelatih005',
			'email' => 'pelatih005@diskop.go.id',
			'employee_number' => 'TRN-005',
			'phone' => '081234567894',
			'institution' => 'Politeknik Negeri Banjarmasin',
			'expertise' => 'Akuntansi',
			'biography' => 'Instruktur Akuntansi.'
		],

		[
			'training_field_id' => 6,
			'name' => 'Siti Rahmawati',
			'username' => 'pelatih006',
			'email' => 'pelatih006@diskop.go.id',
			'employee_number' => 'TRN-006',
			'phone' => '081234567895',
			'institution' => 'BLK Banjarbaru',
			'expertise' => 'Menjahit',
			'biography' => 'Trainer Tata Busana.'
		],

		[
			'training_field_id' => 7,
			'name' => 'Rizky Hidayat',
			'username' => 'pelatih007',
			'email' => 'pelatih007@diskop.go.id',
			'employee_number' => 'TRN-007',
			'phone' => '081234567896',
			'institution' => 'SMK Pariwisata',
			'expertise' => 'Tata Boga',
			'biography' => 'Instruktur Tata Boga.'
		],

		[
			'training_field_id' => 11,
			'name' => 'Dimas Saputra',
			'username' => 'pelatih008',
			'email' => 'pelatih008@diskop.go.id',
			'employee_number' => 'TRN-008',
			'phone' => '081234567897',
			'institution' => 'Honda Training Center',
			'expertise' => 'Otomotif',
			'biography' => 'Trainer Otomotif.'
		],

		[
			'training_field_id' => 13,
			'name' => 'Budi Santoso',
			'username' => 'pelatih009',
			'email' => 'pelatih009@diskop.go.id',
			'employee_number' => 'TRN-009',
			'phone' => '081234567898',
			'institution' => 'PT United Tractors',
			'expertise' => 'Operator Forklift',
			'biography' => 'Trainer Operator Forklift.'
		],

		[
			'training_field_id' => 14,
			'name' => 'Agus Setiawan',
			'username' => 'pelatih010',
			'email' => 'pelatih010@diskop.go.id',
			'employee_number' => 'TRN-010',
			'phone' => '081234567899',
			'institution' => 'POLDA Kalimantan Selatan',
			'expertise' => 'Security Management',
			'biography' => 'Instruktur Gada Pratama dan Keamanan.'
		],

	];

	$db->beginTransaction();

	try {

		foreach ($data as $trainer) {

			/*
			|--------------------------------------------------------------------------
			| Users
			|--------------------------------------------------------------------------
			*/

			$userStmt->execute([

				$trainer['name'],

				$trainer['username'],

				$trainer['email'],

				$password,

				'pelatih',

				'active',

			]);

			$userId = (int) $db->lastInsertId();

			/*
			|--------------------------------------------------------------------------
			| Trainers
			|--------------------------------------------------------------------------
			*/

			$trainerStmt->execute([

				$userId,

				$trainer['training_field_id'],

				$trainer['employee_number'],

				$trainer['phone'],

				$trainer['email'],

				$trainer['institution'],

				$trainer['expertise'],

				$trainer['biography'],

				'active',

			]);

		}

		$db->commit();

		echo "Trainer Seeder Success.";

	} catch (Throwable $e) {

		$db->rollBack();

		throw $e;

	}
