<?php

	namespace Database\Seeders;

	use Carbon\Carbon;
	use Faker\Factory;
	use Natasya\NataApp\Model\Training;
	use Natasya\NataApp\Model\TrainingField;
	use Natasya\NataApp\Model\TrainingSchedule;

	class TrainingScheduleSeeder extends Seeder
	{
		public function run(): void
		{
			$faker = Factory::create('id_ID');

			$topics = [

				'Web Programming' => [
					'Pengenalan Web Programming',
					'HTML & CSS',
					'PHP Dasar',
					'Laravel Routing',
					'Laravel MVC',
					'Database MySQL',
					'REST API',
					'Deployment',
				],

				'Mobile Programming' => [
					'Pengenalan Flutter',
					'Dart Dasar',
					'Widget',
					'Navigation',
					'State Management',
					'Firebase',
					'Build APK',
				],

				'Digital Marketing' => [
					'Digital Branding',
					'Content Marketing',
					'SEO',
					'Facebook Ads',
					'Instagram Ads',
					'TikTok Marketing',
					'Marketplace',
				],

				'Desain Grafis' => [
					'Dasar Desain',
					'Canva',
					'CorelDRAW',
					'Adobe Photoshop',
					'Logo Design',
					'Poster Design',
				],

				'Microsoft Office' => [
					'Microsoft Word',
					'Microsoft Excel',
					'Formula Excel',
					'Pivot Table',
					'PowerPoint',
					'Mail Merge',
				],

				'Akuntansi' => [
					'Dasar Akuntansi',
					'Jurnal Umum',
					'Buku Besar',
					'Neraca Saldo',
					'Laporan Keuangan',
				],

				'Tata Boga' => [
					'Kitchen Safety',
					'Food Preparation',
					'Basic Cooking',
					'Dessert',
					'Food Plating',
				],

				'Tata Busana' => [
					'Pengukuran',
					'Pembuatan Pola',
					'Menjahit',
					'Finishing',
				],

				'Barber' => [
					'Pengenalan Peralatan',
					'Basic Haircut',
					'Fade Technique',
					'Hair Styling',
				],

				'Teknik Komputer' => [
					'Hardware',
					'Perakitan Komputer',
					'BIOS',
					'Instalasi Windows',
					'Troubleshooting',
					'Networking',
				],

			];

			$rooms = [
				'Ruang Pelatihan A',
				'Ruang Pelatihan B',
				'Laboratorium Komputer',
				'Lab Multimedia',
				'Aula Utama',
				'Workshop',
			];

			$trainings = Training::with('trainingField')->get();

			foreach ($trainings as $training) {

				if (! $training->training_start) {
					continue;
				}

				$fieldName = $training->trainingField->name;

				$materials = $topics[$fieldName] ?? [
					'Pengenalan',
					'Materi Inti',
					'Praktik',
					'Evaluasi',
				];

				$startDate = Carbon::parse($training->training_start);

				for ($meeting = 1; $meeting <= $training->duration; $meeting++) {

					$topic = $materials[min($meeting - 1, count($materials) - 1)];

					$date = (clone $startDate)->addDays($meeting - 1);

					$startTime = Carbon::createFromTime(8, 0);

					$endTime = Carbon::createFromTime(16, 0);

					TrainingSchedule::create([

						'training_id' => $training->id,

						'meeting_number' => $meeting,

						'topic' => $topic,

						'description' => $faker->sentence(15),

						'schedule_date' => $date->format('Y-m-d'),

						'start_time' => $startTime->format('H:i:s'),

						'end_time' => $endTime->format('H:i:s'),

						'room' => $faker->randomElement($rooms),

					]);

				}

			}
		}
	}
