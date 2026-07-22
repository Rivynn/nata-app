<?php

	namespace Database\Seeders;

	use Faker\Factory;
	use Illuminate\Support\Str;
	use Natasya\NataApp\Model\TrainingAttendanceSession;
	use Natasya\NataApp\Model\TrainingSchedule;
	use Natasya\NataApp\Model\User;
	use function Illuminate\Support\now;

	class TrainingAttendanceSessionSeeder extends Seeder
	{
		public function run(): void
		{
			$faker = Factory::create('id_ID');

			$admin = User::where('role', 'admin')->first();

			$schedules = TrainingSchedule::with('training')->get();

			foreach ($schedules as $schedule) {

				$training = $schedule->training;

				$isActive = false;

				$openedAt = null;
				$expiredAt = null;
				$closedAt = null;

				switch ($training->status) {

					case 'running':

						$isActive = true;

						$openedAt = now()->subMinutes(rand(10, 30));

						$expiredAt = now()->addMinutes(rand(15, 45));

						break;

					case 'completed':

						$openedAt = $faker->dateTimeBetween(
							$training->training_start,
							$training->training_end
						);

						$expiredAt = (clone $openedAt)->modify('+30 minutes');

						$closedAt = (clone $openedAt)->modify('+45 minutes');

						break;

					default:

						break;

				}

				TrainingAttendanceSession::create([

					'training_schedule_id' => $schedule->id,

					'qr_token' => Str::uuid(),

					'attendance_type' => $faker->randomElement([
						'manual',
						'qr',
						'hybrid',
					]),

					'latitude' => -3.4418600,

					'longitude' => 114.8314900,

					'radius' => 100,

					'opened_by' => $admin?->id,

					'opened_at' => $openedAt,

					'expired_at' => $expiredAt,

					'closed_at' => $closedAt,

					'is_active' => $isActive,

				]);

			}

		}
	}
