<?php

	require dirname(__DIR__) . '/vendor/autoload.php';

	use Natasya\NataApp\App\Database;

	$db = Database::connection();

	foreach (glob(__DIR__ . '/migrations/*.sql') as $file) {

		echo "Running " . basename($file) . PHP_EOL;

		$sql = file_get_contents($file);

		$db->exec($sql);

	}

	echo PHP_EOL . "Migration Success." . PHP_EOL;