<?php

	namespace Database\Seeders;

	use Faker\Factory;
	use Natasya\NataApp\Model\User;

	class UserSeeder extends Seeder
	{
		public function run(): void
		{


			User::create([
				'name'     => 'Administrator',
				'username' => 'admin',
				'email'    => 'admin@natasyadvn.co-id.id',
				'avatar'   => null,
				'password' => password_hash('admin123', PASSWORD_DEFAULT),
				'role'     => 'admin',
				'status'   => 'active',
			]);

			User::create([
				'name'     => 'Pegawai',
				'username' => 'pegawai',
				'email'    => 'pegawai@gmail.com',
				'avatar'   => null,
				'password' => password_hash('pegawai123', PASSWORD_DEFAULT),
				'role'     => 'pegawai',
				'status'   => 'active',
			]);

			User::create([
				'name'     => 'Pelatih',
				'username' => 'pelatih',
				'email'    => 'pelatih@example.com',
				'avatar'   => null,
				'password' => password_hash('pelatih123', PASSWORD_DEFAULT),
				'role'     => 'pelatih',
				'status'   => 'active',
			]);

			User::create([
				'name'     => 'Peserta',
				'username' => 'peserta',
				'email'    => 'peserta@example.com',
				'avatar'   => null,
				'password' => password_hash('peserta123', PASSWORD_DEFAULT),
				'role'     => 'peserta',
				'status'   => 'active',
			]);

			$faker = Factory::create('id_ID');

			$roles = [
				'pegawai',
				'pelatih',
				'peserta',
			];

			for ($i = 1; $i <= 50; $i++) {

				User::create([
					'name'     => $faker->name(),
					'username' => $faker->unique()->userName(),
					'email'    => $faker->unique()->safeEmail(),
					'avatar'   => null,
					'password' => password_hash('password', PASSWORD_DEFAULT),
					'role'     => $faker->randomElement($roles),
					'status'   => 'active',
					'last_login_at' => $faker->optional()->dateTimeBetween('-3 months'),
				]);

			}
		}
	}
