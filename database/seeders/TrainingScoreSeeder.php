<?php

	namespace Database\Seeders;

	use Faker\Factory;
	use Natasya\NataApp\Model\Registration;
	use Natasya\NataApp\Model\Trainer;
	use Natasya\NataApp\Model\TrainingScore;

	class TrainingScoreSeeder extends Seeder
	{
		public function run(): void
		{
			$faker = Factory::create('id_ID');

			$registrations = Registration::with([
				'training',
			])->where('status', 'approved')->get();

			foreach ($registrations as $registration) {

				/*
				|--------------------------------------------------------------------------
				| Hanya training yang selesai memiliki nilai
				|--------------------------------------------------------------------------
				*/

				if ($registration->training->status !== 'completed') {
					continue;
				}

				$trainer = Trainer::find($registration->training->trainer_id);

				$knowledge = rand(65, 100);

				$skill = rand(65, 100);

				$attitude = rand(70, 100);

				$attendance = rand(75, 100);

				/*
				|--------------------------------------------------------------------------
				| Bobot
				|--------------------------------------------------------------------------
				|
				| Knowledge : 35%
				| Skill     : 35%
				| Attitude  : 20%
				| Attendance: 10%
				|
				*/

				$finalScore = round(
					($knowledge * 0.35)
					+ ($skill * 0.35)
					+ ($attitude * 0.20)
					+ ($attendance * 0.10),
					2
				);

				$predicate = 'D';

				if ($finalScore >= 90) {

					$predicate = 'A';

				} elseif ($finalScore >= 80) {

					$predicate = 'B';

				} elseif ($finalScore >= 70) {

					$predicate = 'C';

				}

				$isPassed = $finalScore >= 70;

				TrainingScore::create([

					'registration_id' => $registration->id,

					'trainer_id' => $trainer?->id,

					'knowledge_score' => $knowledge,

					'skill_score' => $skill,

					'attitude_score' => $attitude,

					'attendance_percentage' => $attendance,

					'final_score' => $finalScore,

					'predicate' => $predicate,

					'is_passed' => $isPassed,

					'notes' => $isPassed
						? $faker->randomElement([
							'Kompeten.',
							'Menyelesaikan pelatihan dengan baik.',
							'Layak memperoleh sertifikat.',
						])
						: $faker->randomElement([
							'Perlu meningkatkan kompetensi.',
							'Belum memenuhi standar kelulusan.',
							'Disarankan mengikuti pelatihan kembali.',
						]),

					'published_at' => $faker->dateTimeBetween(
						$registration->training->training_end,
						'now'
					),

				]);

			}
		}
	}
