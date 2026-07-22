<?php

	namespace Database\Seeders;

	use Faker\Factory;
	use Natasya\NataApp\Model\Trainer;
	use Natasya\NataApp\Model\TrainingField;
	use Natasya\NataApp\Model\User;

	class TrainerSeeder extends Seeder
	{
		public function run(): void
		{
			$faker = Factory::create('id_ID');

			$institutions = [
				'DISKOPUMTK Kota Banjarbaru',
				'Universitas Lambung Mangkurat',
				'Poliban',
				'SMKN 1 Banjarbaru',
				'Balai Latihan Kerja',
				'PT Telkom Indonesia',
				'PT Indocement Tunggal Prakarsa',
				'Freelance Professional',
			];

			/*
			|--------------------------------------------------------------------------
			| Akun bawaan
			|--------------------------------------------------------------------------
			*/

			$user = User::where('username', 'pelatih')->first();

			if ($user && ! Trainer::where('user_id', $user->id)->exists()) {

				$field = TrainingField::inRandomOrder()->first();

				Trainer::create([
					'user_id' => $user->id,
					'training_field_id' => $field->id,
					'employee_number' => 'TRN0001',
					'phone' => $faker->phoneNumber(),
					'email' => 'pelatih@example.com',
					'institution' => 'DISKOPUMTK Kota Banjarbaru',
					'expertise' => $field->name,
					'specialization' => $field->name,
					'experience_year' => 10,
					'biography' => $faker->paragraph(3),
					'avatar' => null,
					'status' => 'active',
				]);

			}

			/*
			|--------------------------------------------------------------------------
			| Generate pelatih tambahan
			|--------------------------------------------------------------------------
			*/

			for ($i = 2; $i <= 12; $i++) {

				$field = TrainingField::inRandomOrder()->first();

				$user = User::create([
					'name' => $faker->name(),
					'username' => sprintf('pelatih%03d', $i),
					'email' => "pelatih{$i}@example.com",
					'avatar' => null,
					'password' => password_hash('password', PASSWORD_DEFAULT),
					'role' => 'pelatih',
					'status' => $faker->randomElement([
						'active',
						'active',
						'active',
						'inactive',
					]),
					'last_login_at' => $faker->optional(0.8)
						->dateTimeBetween('-6 months'),
				]);

				Trainer::create([
					'user_id' => $user->id,
					'training_field_id' => $field->id,
					'employee_number' => sprintf('TRN%04d', $i),
					'phone' => $faker->phoneNumber(),
					'email' => $user->email,
					'institution' => $faker->randomElement($institutions),
					'expertise' => $field->name,
					'specialization' => $field->name,
					'experience_year' => $faker->numberBetween(2, 20),
					'biography' => $faker->paragraph(rand(2, 4)),
					'avatar' => null,
					'status' => $faker->randomElement([
						'active',
						'active',
						'active',
						'inactive',
					]),
				]);

			}
		}
	}
