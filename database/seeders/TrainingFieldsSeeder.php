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
			'Pelatihan bidang komputer',
			'fas fa-laptop',
			'primary'
		],

		[
			'Alat Berat',
			'Operator alat berat',
			'fas fa-truck-moving',
			'success'
		],

		[
			'Security',
			'Pelatihan keamanan',
			'fas fa-user-shield',
			'warning'
		],

	];

	foreach ($data as $row) {

		$stmt->execute($row);

	}

	echo "Training Field Seeder Success.";