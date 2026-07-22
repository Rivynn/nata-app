<?php

	namespace Database\Seeders;

	class DatabaseSeeder extends Seeder
	{
		public function run(): void
		{
			(new UserSeeder())->run();

			(new ParticipantSeeder())->run();

			(new EmployeeSeeder())->run();

			(new TrainingFieldSeeder())->run();

			(new TrainerSeeder())->run();

			(new TrainingSeeder())->run();

			(new TrainingScheduleSeeder())->run();

			(new TrainingMaterialSeeder())->run();

			(new RegistrationSeeder())->run();

			(new TrainingAnnouncementSeeder())->run();

			(new TrainingAttendanceSessionSeeder())->run();

			(new TrainingAttendanceSeeder())->run();

			(new TrainingScoreSeeder())->run();

			(new CertificateSeeder())->run();
		}
	}
