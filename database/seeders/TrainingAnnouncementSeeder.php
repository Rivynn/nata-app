<?php

	namespace Database\Seeders;

	use Faker\Factory;
	use Natasya\NataApp\Model\Training;
	use Natasya\NataApp\Model\TrainingAnnouncement;
	use Natasya\NataApp\Model\User;
	use function Illuminate\Support\now;

	class TrainingAnnouncementSeeder extends Seeder
	{
		public function run(): void
		{
			$faker = Factory::create('id_ID');

			$admin = User::where('role', 'admin')->first();

			$templates = [

				[
					'title' => 'Selamat Datang Peserta',
					'content' => 'Selamat datang pada pelatihan. Pastikan seluruh persyaratan administrasi telah dipenuhi sebelum mengikuti kegiatan.',
				],

				[
					'title' => 'Jadwal Pelatihan',
					'content' => 'Jadwal pelatihan telah dipublikasikan. Mohon hadir tepat waktu sesuai jadwal yang telah ditentukan.',
				],

				[
					'title' => 'Perlengkapan Peserta',
					'content' => 'Peserta diwajibkan membawa alat tulis serta laptop apabila diperlukan selama pelatihan berlangsung.',
				],

				[
					'title' => 'Perubahan Jadwal',
					'content' => 'Apabila terdapat perubahan jadwal, informasi akan diumumkan melalui halaman pelatihan.',
				],

				[
					'title' => 'Materi Pelatihan',
					'content' => 'Materi dapat diunduh melalui menu Materi setelah sesi dimulai.',
				],

				[
					'title' => 'Absensi Peserta',
					'content' => 'Absensi dilakukan menggunakan QR Code sebelum sesi dimulai.',
				],

				[
					'title' => 'Evaluasi Pelatihan',
					'content' => 'Peserta diwajibkan mengikuti evaluasi untuk memperoleh nilai akhir.',
				],

				[
					'title' => 'Sertifikat',
					'content' => 'Sertifikat akan diterbitkan setelah peserta dinyatakan lulus pelatihan.',
				],

			];

			$trainings = Training::all();

			foreach ($trainings as $training) {

				/*
				|--------------------------------------------------------------------------
				| Draft tidak memiliki pengumuman
				|--------------------------------------------------------------------------
				*/

				if ($training->status == 'draft') {
					continue;
				}

				$totalAnnouncement = match ($training->status) {

					'open' => rand(2, 3),

					'closed' => rand(3, 4),

					'running' => rand(4, 5),

					'completed' => rand(5, 6),

					'cancelled' => rand(1, 2),

					default => 2,

				};

				$announcements = collect($templates)
					->shuffle()
					->take($totalAnnouncement);

				$pin = true;

				foreach ($announcements as $announcement) {

					TrainingAnnouncement::create([

						'training_id' => $training->id,

						'title' => $announcement['title'],

						'content' => $announcement['content'],

						'is_pinned' => $pin,

						'created_by' => $admin?->id,

						'created_at' => $faker->dateTimeBetween(
							$training->created_at,
							'now'
						),

						'updated_at' => now(),

					]);

					$pin = false;

				}

			}

		}
	}
