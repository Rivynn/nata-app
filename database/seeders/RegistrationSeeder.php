<?php

	namespace Database\Seeders;

	use Carbon\Carbon;
	use Faker\Factory;
	use Natasya\NataApp\Model\Participant;
	use Natasya\NataApp\Model\Registration;
	use Natasya\NataApp\Model\Training;
	use Natasya\NataApp\Model\User;

	class RegistrationSeeder extends Seeder
	{
		public function run(): void
		{
			$faker = Factory::create('id_ID');

			$admin = User::where('role', 'admin')->first();

			$participants = Participant::all();

			$trainings = Training::all();

			$registrationNumber = 1;

			foreach ($trainings as $training) {

				/*
				|--------------------------------------------------------------------------
				| Tentukan jumlah peserta berdasarkan status training
				|--------------------------------------------------------------------------
				*/

				switch ($training->status) {

					case 'draft':

						$totalParticipant = 0;

						break;

					case 'open':

						$totalParticipant = rand(
							(int) ($training->quota * 0.30),
							(int) ($training->quota * 0.70)
						);

						break;

					case 'closed':

						$totalParticipant = rand(
							(int) ($training->quota * 0.80),
							$training->quota
						);

						break;

					case 'running':

						$totalParticipant = rand(
							(int) ($training->quota * 0.80),
							$training->quota
						);

						break;

					case 'completed':

						$totalParticipant = rand(
							(int) ($training->quota * 0.90),
							$training->quota
						);

						break;

					case 'cancelled':

						$totalParticipant = rand(
							0,
							(int) ($training->quota * 0.20)
						);

						break;

					default:

						$totalParticipant = 0;

				}

				if ($totalParticipant == 0) {
					continue;
				}

				/*
				|--------------------------------------------------------------------------
				| Ambil peserta acak
				|--------------------------------------------------------------------------
				*/

				$selectedParticipants = $participants
					->shuffle()
					->take($totalParticipant);

				foreach ($selectedParticipants as $participant) {

					$status = 'pending';

					$approvedBy = null;
					$approvedAt = null;

					$rejectedBy = null;
					$rejectedAt = null;

					$notes = null;

					$registeredAt = null;

					switch ($training->status) {

						case 'open':

							$status = $faker->randomElement([
								'pending',
								'pending',
								'approved',
								'approved',
								'rejected',
							]);

							break;

						case 'closed':

							$status = $faker->randomElement([
								'approved',
								'approved',
								'approved',
								'approved',
								'rejected',
							]);

							break;

						case 'running':

							$status = 'approved';

							break;

						case 'completed':

							$status = 'approved';

							break;

						case 'cancelled':

							$status = $faker->randomElement([
								'approved',
								'cancelled',
								'rejected',
							]);

							break;

					}

					/*
					|--------------------------------------------------------------------------
					| Waktu registrasi
					|--------------------------------------------------------------------------
					*/

					if ($training->registration_open && $training->registration_close) {

						$registeredAt = $faker->dateTimeBetween(
							$training->registration_open,
							$training->registration_close
						);

					}

					/*
					|--------------------------------------------------------------------------
					| Approval
					|--------------------------------------------------------------------------
					*/

					if ($status == 'approved') {

						$approvedBy = $admin?->id;

						$approvedAt = $registeredAt
							? Carbon::instance($registeredAt)->addDays(rand(1, 3))
							: null;

					}

					/*
					|--------------------------------------------------------------------------
					| Rejected
					|--------------------------------------------------------------------------
					*/

					if ($status == 'rejected') {

						$rejectedBy = $admin?->id;

						$rejectedAt = $registeredAt
							? Carbon::instance($registeredAt)->addDays(rand(1, 2))
							: null;

						$notes = $faker->randomElement([
							'Kuota telah penuh.',
							'Dokumen belum lengkap.',
							'Tidak memenuhi persyaratan.',
						]);

					}
					/*
|--------------------------------------------------------------------------
| Cancelled
|--------------------------------------------------------------------------
*/

					if ($status == 'cancelled') {

						$notes = $faker->randomElement([
							'Pelatihan dibatalkan.',
							'Peserta mengundurkan diri.',
							'Registrasi dibatalkan oleh admin.',
						]);

					}

					/*
					|--------------------------------------------------------------------------
					| Registration
					|--------------------------------------------------------------------------
					*/

					Registration::create([

						'training_id' => $training->id,

						'participant_id' => $participant->id,

						'registration_number' => sprintf(
							'REG-%s-%06d',
							date('Y'),
							$registrationNumber++
						),

						'motivation' => $faker->randomElement([
							'Ingin meningkatkan keterampilan untuk dunia kerja.',
							'Menambah kompetensi dan memperoleh sertifikat.',
							'Persiapan memasuki dunia industri.',
							'Menunjang pekerjaan saat ini.',
							'Memulai usaha mandiri.',
							'Meningkatkan kemampuan sesuai bidang yang diminati.',
						]),

						'status' => $status,

						'approved_by' => $approvedBy,

						'approved_at' => $approvedAt,

						'rejected_by' => $rejectedBy,

						'rejected_at' => $rejectedAt,

						'notes' => $notes,

						'registered_at' => $registeredAt,

					]);

				}

			}

		}
	}
