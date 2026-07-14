<?php

	require_once dirname(__DIR__) . '/bootstrap/app.php';

	use \Natasya\NataApp\App\Router;



	require_once ROUTES_PATH . '/web.php';

	Router::run();