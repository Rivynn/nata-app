<?php

	declare(strict_types=1);

	echo PHP_EOL;
	echo "==============================" . PHP_EOL;
	echo " Reset Database" . PHP_EOL;
	echo "==============================" . PHP_EOL;
	echo PHP_EOL;

	require __DIR__ . '/migrate.php';

	echo PHP_EOL;

	require __DIR__ . '/seed.php';

	echo PHP_EOL;
	echo "==============================" . PHP_EOL;
	echo " Database berhasil direset." . PHP_EOL;
	echo "==============================" . PHP_EOL;