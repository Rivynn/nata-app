<?php

	require dirname(__DIR__) . '/bootstrap/app.php';

	require __DIR__ . '/seeders/UserSeeder.php';

	require __DIR__ . '/seeders/TrainingFieldsSeeder.php';
	require __DIR__ . '/seeders/EmployeeSeeder.php';
	require __DIR__ . '/seeders/TrainerSeeder.php';

	require __DIR__ . '/seeders/TrainingSeeder.php';
	require __DIR__ . '/seeders/TrainingBatchesSeeder.php';
	require __DIR__ . '/seeders/TrainingScheduleSeeder.php';
	require __DIR__ . '/seeders/TrainingMaterialSeeder.php';
	require __DIR__ . '/seeders/AnnouncementSeeder.php';

	require __DIR__ . '/seeders/AssessmentItemSeeder.php';

	require __DIR__ . '/seeders/ParticipantSeeder.php';
