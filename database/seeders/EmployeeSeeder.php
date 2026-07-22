<?php

	namespace Database\Seeders;

	use Faker\Factory;
	use Natasya\NataApp\Model\Employee;
	use Natasya\NataApp\Model\User;

	class EmployeeSeeder extends Seeder
	{
		public function run(): void
		{
			$faker = Factory::create('id_ID');

			$positions = [
				'Kepala Bidang',
				'Kepala Seksi',
				'Analis Pelatihan',
				'Staf Administrasi',
				'Staf Pelayanan',
				'Operator Sistem',
				'Verifikator',
				'Pengelola Data',
				'Koordinator Pelatihan',
				'Pengawas',
			];

			$departments = [
				'Pelatihan',
				'Administrasi',
				'Keuangan',
				'Pelayanan',
				'Teknologi Informasi',
				'SDM',
			];

			/*
			|--------------------------------------------------------------------------
			| Pegawai bawaan
			|--------------------------------------------------------------------------
			*/

			$user = User::where('username', 'pegawai')->first();

			if ($user && ! Employee::where('user_id', $user->id)->exists()) {

				Employee::create([
					'user_id' => $user->id,
					'employee_number' => 'EMP0001',
					'phone' => $faker->phoneNumber(),
					'position' => 'Administrator Sistem',
					'department' => 'Teknologi Informasi',
				]);

			}

			/*
			|--------------------------------------------------------------------------
			| Generate 14 pegawai lagi
			|--------------------------------------------------------------------------
			*/

			for ($i = 2; $i <= 15; $i++) {

				$user = User::create([
					'name' => $faker->name(),
					'username' => sprintf('pegawai%03d', $i),
					'email' => "pegawai{$i}@example.com",
					'avatar' => null,
					'password' => password_hash('password', PASSWORD_DEFAULT),
					'role' => 'pegawai',
					'status' => $faker->randomElement([
						'active',
						'active',
						'active',
						'inactive',
					]),
					'last_login_at' => $faker->optional(0.8)
						->dateTimeBetween('-3 months'),
				]);

				Employee::create([
					'user_id' => $user->id,
					'employee_number' => sprintf('EMP%04d', $i),
					'phone' => $faker->phoneNumber(),
					'position' => $faker->randomElement($positions),
					'department' => $faker->randomElement($departments),
				]);

			}
		}
	}
