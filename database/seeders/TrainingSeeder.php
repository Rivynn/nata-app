<?php

	namespace Database\Seeders;

	use Faker\Factory;
	use Natasya\NataApp\Model\Trainer;
	use Natasya\NataApp\Model\Training;
	use Natasya\NataApp\Model\TrainingField;
	use Natasya\NataApp\Model\User;

	class TrainingSeeder extends Seeder
	{
		public function run(): void
		{
			$faker = Factory::create('id_ID');

			$admin = User::where('role', 'admin')->first();

			$locations = [
				'DISKOPUMTK Kota Banjarbaru',
				'Balai Latihan Kerja Banjarbaru',
				'Aula Kecamatan Banjarbaru Selatan',
				'SMKN 1 Banjarbaru',
				'SMKN 2 Banjarbaru',
				'Universitas Lambung Mangkurat',
				'Politeknik Negeri Banjarmasin',
				'Gedung Serbaguna Banjarbaru',
			];

			$requirements = [
				'Usia minimal 17 tahun.',
				'Membawa KTP saat registrasi ulang.',
				'Memiliki motivasi belajar yang tinggi.',
				'Bersedia mengikuti pelatihan hingga selesai.',
			];

			$benefits = [
				'Sertifikat Pelatihan',
				'Modul Pelatihan',
				'Konsumsi',
				'Relasi dengan peserta lain',
				'Pendampingan instruktur',
			];

			$trainingPool = [

				'Web Programming' => [
					'Laravel Fundamental',
					'Laravel Intermediate',
					'PHP Native',
					'REST API PHP',
				],

				'Mobile Programming' => [
					'Flutter Fundamental',
					'Android Dasar',
				],

				'Digital Marketing' => [
					'Digital Marketing',
					'SEO Fundamental',
					'Content Creator',
				],

				'Desain Grafis' => [
					'CorelDRAW',
					'Adobe Photoshop',
					'Canva Professional',
				],

				'Microsoft Office' => [
					'Microsoft Excel',
					'Microsoft Word',
					'Microsoft Office',
				],

				'Akuntansi' => [
					'Akuntansi UMKM',
					'Laporan Keuangan',
				],

				'Tata Boga' => [
					'Pastry Dasar',
					'Kuliner Nusantara',
				],

				'Tata Busana' => [
					'Menjahit Dasar',
					'Fashion Design',
				],

				'Barber' => [
					'Barbershop Professional',
				],

				'Teknik Komputer' => [
					'Perakitan Komputer',
					'Jaringan Komputer',
				],

			];

			$statuses = [

				'draft',
				'draft',

				'open',
				'open',
				'open',
				'open',
				'open',

				'closed',
				'closed',
				'closed',

				'running',
				'running',
				'running',
				'running',

				'completed',
				'completed',
				'completed',
				'completed',
				'completed',

				'cancelled',

			];

			shuffle($statuses);

			$counter = 1;

			foreach ($trainingPool as $fieldName => $trainings) {

				$field = TrainingField::where('name', $fieldName)->first();

				if (! $field) {
					continue;
				}

				foreach ($trainings as $title) {

					if ($counter > 20) {
						break 2;
					}

					$trainer = Trainer::where('training_field_id', $field->id)
						->inRandomOrder()
						->first();

					if (! $trainer) {
						continue;
					}

					$status = $statuses[$counter - 1];

					/*
					|--------------------------------------------------------------------------
					| Timeline berdasarkan status
					|--------------------------------------------------------------------------
					*/

					$registrationOpen = null;
					$registrationClose = null;
					$trainingStart = null;
					$trainingEnd = null;
					$publishedAt = null;

					switch ($status) {

						case 'draft':

							break;

						case 'open':

							$registrationOpen = $faker->dateTimeBetween('-5 days', 'today');
							$registrationClose = $faker->dateTimeBetween('+5 days', '+20 days');
							$trainingStart = $faker->dateTimeBetween('+21 days', '+40 days');
							$trainingEnd = (clone $trainingStart)->modify('+' . rand(2, 7) . ' days');
							$publishedAt = $faker->dateTimeBetween('-15 days', '-5 days');

							break;

						case 'closed':

							$registrationOpen = $faker->dateTimeBetween('-40 days', '-25 days');
							$registrationClose = $faker->dateTimeBetween('-20 days', '-10 days');
							$trainingStart = $faker->dateTimeBetween('+3 days', '+15 days');
							$trainingEnd = (clone $trainingStart)->modify('+' . rand(2, 7) . ' days');
							$publishedAt = $faker->dateTimeBetween('-45 days', '-25 days');

							break;

						case 'running':

							$registrationOpen = $faker->dateTimeBetween('-45 days', '-30 days');
							$registrationClose = $faker->dateTimeBetween('-25 days', '-15 days');
							$trainingStart = $faker->dateTimeBetween('-3 days', 'today');
							$trainingEnd = (clone $trainingStart)->modify('+' . rand(3, 7) . ' days');
							$publishedAt = $faker->dateTimeBetween('-60 days', '-35 days');

							break;

						case 'completed':

							$registrationOpen = $faker->dateTimeBetween('-10 months', '-8 months');
							$registrationClose = $faker->dateTimeBetween('-8 months', '-7 months');
							$trainingStart = $faker->dateTimeBetween('-7 months', '-6 months');
							$trainingEnd = (clone $trainingStart)->modify('+' . rand(3, 7) . ' days');
							$publishedAt = $faker->dateTimeBetween('-11 months', '-9 months');

							break;

						case 'cancelled':

							$registrationOpen = $faker->dateTimeBetween('-3 months', '-2 months');
							$registrationClose = $faker->dateTimeBetween('-2 months', '-1 months');
							$trainingStart = null;
							$trainingEnd = null;
							$publishedAt = $faker->dateTimeBetween('-3 months', '-2 months');

							break;

					}

					Training::create([

						'training_field_id' => $field->id,

						'trainer_id' => $trainer->id,

						'code' => sprintf('TRN-%04d', $counter),

						'name' => 'Pelatihan ' . $title,

						'slug' => strtolower(str_replace(' ', '-', 'pelatihan-' . $title)),

						'thumbnail' => 'training/default.webp',

						'description' => 'Pelatihan ini dirancang untuk meningkatkan kompetensi peserta pada bidang ' . strtolower($field->name) . '.',

						'objective' => 'Peserta mampu memahami konsep dasar dan praktik sesuai bidang pelatihan.',

						'requirement' => implode("\n", $faker->randomElements($requirements, 3)),

						'benefit' => implode("\n", $faker->randomElements($benefits, 4)),

						'quota' => $faker->randomElement([
							20,
							25,
							30,
							35,
							40,
							50,
						]),

						'duration' => $faker->randomElement([
							2,
							3,
							5,
							7,
						]),

						'location' => $faker->randomElement($locations),

						'registration_open' => $registrationOpen,

						'registration_close' => $registrationClose,

						'training_start' => $trainingStart,

						'training_end' => $trainingEnd,

						'status' => $status,

						'published_at' => $publishedAt,

						'created_by' => $admin?->id,

						'updated_by' => $admin?->id,

					]);

					$counter++;

				}

			}
		}
	}
