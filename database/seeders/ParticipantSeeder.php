<?php

	namespace Database\Seeders;

	use Faker\Factory;
	use Natasya\NataApp\Model\Participant;
	use Natasya\NataApp\Model\ParticipantProfile;
	use Natasya\NataApp\Model\User;

	class ParticipantSeeder extends Seeder
	{
		public function run(): void
		{
			$faker = Factory::create('id_ID');

			$religions = [
				'Islam',
				'Kristen',
				'Katolik',
				'Hindu',
				'Buddha',
				'Konghucu',
			];

			$educations = [
				'SMP',
				'SMA',
				'SMK',
				'D3',
				'S1',
				'S2',
			];

			$majors = [
				'Teknik Informatika',
				'Sistem Informasi',
				'Akuntansi',
				'Manajemen',
				'Teknik Mesin',
				'Tata Boga',
				'Tata Busana',
				'Multimedia',
				'Administrasi Perkantoran',
				'Pemasaran',
			];

			$employmentStatus = [
				'belum_bekerja',
				'bekerja',
				'wirausaha',
				'pelajar',
				'mahasiswa',
				'lainnya',
			];

			/*
|--------------------------------------------------------------------------
| User bawaan (peserta)
|--------------------------------------------------------------------------
|
| User ini sudah memiliki akun tetapi belum pernah melengkapi biodata.
| Jadi hanya dibuat data participants tanpa participant_profiles.
|
*/

			$user = User::where('username', 'peserta')->first();

			if ($user && ! Participant::where('user_id', $user->id)->exists()) {

				Participant::create([
					'user_id' => $user->id,
					'phone' => null,
					'gender' => null,
					'birth_date' => null,
					'address' => null,
					'education' => null,
					'institution' => null,
				]);

			}

			for ($i = 1; $i <= 250; $i++) {

				$user = User::create([
					'name' => $faker->name(),
					'username' => 'peserta' . str_pad((string) $i, 4, '0', STR_PAD_LEFT),
					'email' => "peserta{$i}@example.com",
					'avatar' => null,
					'password' => password_hash('password', PASSWORD_DEFAULT),
					'role' => 'peserta',
					'status' => $faker->randomElement([
						'active',
						'active',
						'active',
						'active',
						'inactive',
					]),
					'last_login_at' => $faker->optional(0.7)
						->dateTimeBetween('-6 months'),
				]);

				$participant = Participant::create([
					'user_id' => $user->id,
					'phone' => $faker->phoneNumber(),
					'gender' => $faker->randomElement([
						'L',
						'P',
					]),
					'birth_date' => $faker->dateTimeBetween('-45 years', '-17 years'),
					'address' => $faker->address(),
					'education' => $faker->randomElement($educations),
					'institution' => $faker->company(),
				]);

				/*
				|--------------------------------------------------------------------------
				| 30% belum pernah isi profile
				|--------------------------------------------------------------------------
				*/

				if ($faker->numberBetween(1, 100) <= 30) {
					continue;
				}

				/*
				|--------------------------------------------------------------------------
				| 25% profile lengkap
				| 45% profile belum lengkap
				|--------------------------------------------------------------------------
				*/

				$isCompleted = $faker->numberBetween(1, 100) <= 25;

				$photo = $isCompleted || $faker->boolean(40)
					? 'uploads/photos/default.jpg'
					: null;

				$ktp = $isCompleted || $faker->boolean(45)
					? 'uploads/documents/ktp.pdf'
					: null;

				$ijazah = $isCompleted || $faker->boolean(35)
					? 'uploads/documents/ijazah.pdf'
					: null;

				$cv = $isCompleted || $faker->boolean(25)
					? 'uploads/documents/cv.pdf'
					: null;

				ParticipantProfile::create([

					'participant_id' => $participant->id,

					'nik' => $faker->unique()->numerify('################'),

					'birth_place' => $faker->city(),

					'religion' => $faker->randomElement($religions),

					'marital_status' => $faker->randomElement([
						'belum_menikah',
						'menikah',
						'cerai',
					]),

					'province' => 'Kalimantan Selatan',

					'city' => $faker->randomElement([
						'Banjarbaru',
						'Banjarmasin',
						'Martapura',
						'Kotabaru',
						'Tanah Laut',
						'Barabai',
						'Pelaihari',
					]),

					'district' => $faker->citySuffix(),

					'village' => $faker->streetName(),

					'postal_code' => $faker->postcode(),

					'major' => $faker->randomElement($majors),

					'graduation_year' => $faker->numberBetween(2012, 2025),

					'employment_status' => $faker->randomElement($employmentStatus),

					'occupation' => $faker->optional(0.7)->jobTitle(),

					'company_name' => $faker->optional(0.5)->company(),

					'training_goal' => $faker->paragraph(),

					'skill' => implode(', ', $faker->randomElements([
						'Microsoft Office',
						'Public Speaking',
						'Desain Grafis',
						'PHP',
						'HTML',
						'CSS',
						'JavaScript',
						'Digital Marketing',
						'Canva',
						'Administrasi',
					], rand(2, 5))),

					'emergency_contact_name' => $faker->name(),

					'emergency_contact_phone' => $faker->phoneNumber(),

					'photo' => $photo,

					'ktp_file' => $ktp,

					'ijazah_file' => $ijazah,

					'cv_file' => $cv,

					'is_completed' => $isCompleted,

					'completed_at' => $isCompleted
						? $faker->dateTimeBetween('-1 year')
						: null,

				]);

			}
		}
	}
