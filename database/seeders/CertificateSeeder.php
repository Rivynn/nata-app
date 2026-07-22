<?php

	namespace Database\Seeders;

	use Faker\Factory;
	use Natasya\NataApp\Model\Certificate;
	use Natasya\NataApp\Model\TrainingScore;
	use Natasya\NataApp\Model\User;

	class CertificateSeeder extends Seeder
	{
		public function run(): void
		{
			$faker = Factory::create('id_ID');

			$admin = User::where('role', 'admin')->first();

			$scores = TrainingScore::with([
				'registration.training',
				'registration.participant.user',
			])
				->where('is_passed', true)
				->get();

			$runningNumber = 1;

			foreach ($scores as $score) {

				$registration = $score->registration;

				$verificationCode = strtoupper($faker->bothify('??##??##'));

				$issuedAt = $faker->dateTimeBetween(
					$registration->training->training_end,
					'now'
				);

				Certificate::create([

					'registration_id' => $registration->id,

					'certificate_number' => sprintf(
						'CERT/%s/%05d',
						date('Y', strtotime($issuedAt->format('Y-m-d'))),
						$runningNumber++
					),

					'verification_code' => $verificationCode,

					'verification_url' => sprintf(
						'https://diklat.example.id/certificate/%s',
						$verificationCode
					),

					'certificate_file' => sprintf(
						'certificates/%s.pdf',
						$verificationCode
					),

					'issued_by' => $admin?->id,

					'issued_at' => $issuedAt,

				]);

			}

		}
	}
