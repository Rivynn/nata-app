<?php

	namespace Database\Seeders;

	use Faker\Factory;
	use Natasya\NataApp\Model\Registration;
	use Natasya\NataApp\Model\TrainingAttendance;
	use Natasya\NataApp\Model\TrainingAttendanceSession;
	use Natasya\NataApp\Model\User;

	class TrainingAttendanceSeeder extends Seeder
	{
		public function run(): void
		{
			$faker = Factory::create('id_ID');

			$admin = User::where('role', 'admin')->first();

			$sessions = TrainingAttendanceSession::with([
				'trainingSchedule.training',
			])->get();

			foreach ($sessions as $session) {

				$schedule = $session->trainingSchedule;

				if (! $schedule) {
					continue;
				}

				$training = $schedule->training;

				if (! $training) {
					continue;
				}

				/*
				|--------------------------------------------------------------------------
				| Hanya training yang sedang berjalan atau selesai
				|--------------------------------------------------------------------------
				*/

				if (! in_array($training->status, [
					'running',
					'completed',
				])) {
					continue;
				}

				$registrations = Registration::where('training_id', $training->id)
					->where('status', 'approved')
					->get();

				foreach ($registrations as $registration) {

					/*
					|--------------------------------------------------------------------------
					| Generate status absensi
					|--------------------------------------------------------------------------
					*/

					if ($training->status === 'running') {

						$roll = rand(1, 100);

						if ($roll <= 90) {

							$status = 'present';

						} elseif ($roll <= 97) {

							$status = 'permission';

						} else {

							$status = 'absent';

						}

					} else {

						$roll = rand(1, 100);

						if ($roll <= 82) {

							$status = 'present';

						} elseif ($roll <= 92) {

							$status = 'late';

						} elseif ($roll <= 97) {

							$status = 'permission';

						} else {

							$status = 'absent';

						}

					}

					/*
					|--------------------------------------------------------------------------
					| Attendance Method
					|--------------------------------------------------------------------------
					*/

					$attendanceMethod = $faker->randomElement([
						'qr_code',
						'qr_code',
						'qr_code',
						'manual',
					]);

					$checkInAt = null;
					/*
|--------------------------------------------------------------------------
| Generate Check In Time
|--------------------------------------------------------------------------
*/

					if ($status === 'present') {

						if ($session->opened_at && $session->expired_at) {

							$start = clone $session->opened_at;
							$end = clone $session->expired_at;

							if ($start < $end) {
								$checkInAt = $faker->dateTimeBetween(
									$start,
									$end
								);
							}
						}

					} elseif ($status === 'late') {

						if (
							$session->expired_at &&
							$session->closed_at
						) {

							$start = clone $session->expired_at;
							$end = clone $session->closed_at;

							if ($start < $end) {

								$checkInAt = $faker->dateTimeBetween(
									$start,
									$end
								);

							}
						}

					}

					/*
					|--------------------------------------------------------------------------
					| Notes
					|--------------------------------------------------------------------------
					*/

					$notes = match ($status) {

						'late' => 'Datang terlambat.',

						'permission' => $faker->randomElement([
							'Izin sakit.',
							'Izin pekerjaan.',
							'Izin keluarga.',
							'Izin keperluan mendesak.',
						]),

						'absent' => 'Tidak hadir.',

						default => null,

					};

					TrainingAttendance::create([

						'attendance_session_id' => $session->id,

						'registration_id' => $registration->id,

						'attendance_method' => $attendanceMethod,

						'status' => $status,

						'checked_by' => $attendanceMethod === 'manual'
							? $admin?->id
							: null,

						'check_in_at' => $checkInAt,

						'notes' => $notes,

					]);

				}

			}

		}
	}
