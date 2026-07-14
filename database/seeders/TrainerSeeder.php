<?php

	use Natasya\NataApp\App\Database;

	$db = Database::connection();

	$stmt = $db->prepare("
INSERT INTO trainers
(
    training_field_id,
    name,
    phone,
    email,
    institution,
    expertise,
    status
)
VALUES
(
    ?, ?, ?, ?, ?, ?, ?
)
");

	$data = [

		[
			1,
			'Natasya Deviana, S.Kom',
			'081234567890',
			'tasya.deviana@diskop.go.id',
			'DISKOP UKM',
			'Web Programming',
			'active'
		],

		[
			1,
			'Michee Puding',
			'081234567891',
			'nata.devi@ulm.ac.id',
			'Universitas Lambung Mangkurat',
			'Web Development',
			'active'
		],

		[
			1,
			'Natasya',
			'081234567892',
			'deviana.tasya@gmail.com',
			'DISKOP UKM',
			'Database Administration',
			'active'
		],

		[
			1,
			'Deviana',
			'081234567893',
			'devi.nata@gmail.com',
			'Kominfo',
			'Networking',
			'active'
		],

		[
			1,
			'Tasya',
			'081234567894',
			'tasya.nata@gmail.com',
			'Politeknik Negeri Banjarmasin',
			'Cyber Security',
			'active'
		],

		[
			2,
			'Devi',
			'081234567895',
			'devi.tasya@gmail.com',
			'PT United Tractors',
			'Operator Excavator',
			'active'
		],

		[
			2,
			'Nata Deviana',
			'081234567896',
			'nata.deviana@gmail.com',
			'PT PAMA Persada',
			'Operator Bulldozer',
			'active'
		],

		[
			2,
			'Deviana',
			'081234567897',
			'deviana.devi@gmail.com',
			'PT Adaro Indonesia',
			'Heavy Equipment Maintenance',
			'active'
		],

		[
			3,
			'Tasya Puding',
			'081234567898',
			'tasya.devi@gmail.com',
			'POLDA KALSEL',
			'Security Awareness',
			'active'
		],

		[
			3,
			'Nata Michee',
			'081234567899',
			'nata.tasya@gmail.com',
			'BNSP',
			'Security Management',
			'active'
		],

		[
			3,
			'Natasyaa',
			'081234567900',
			'deviana.nata@gmail.com',
			'Basarnas',
			'Emergency Response',
			'active'
		],

		[
			3,
			'Deviana 10',
			'081234567901',
			'devi.deviana@gmail.com',
			'DISKOP UKM',
			'Public Safety',
			'active'
		],

	];

	foreach ($data as $row) {

		$stmt->execute($row);

	}

	echo "Trainer Seeder Success.";