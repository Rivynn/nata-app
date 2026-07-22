<?php

	namespace Database\Seeders;

	use Faker\Factory;
	use Natasya\NataApp\Model\TrainingMaterial;
	use Natasya\NataApp\Model\TrainingSchedule;

	class TrainingMaterialSeeder extends Seeder
	{
		public function run(): void
		{
			$faker = Factory::create('id_ID');

			$schedules = TrainingSchedule::with('training.trainingField')->get();

			foreach ($schedules as $schedule) {

				$field = $schedule->training->trainingField->name ?? '';

				$materials = [

					[
						'title' => 'Modul ' . $schedule->topic,
						'type'  => 'document',
					],

					[
						'title' => 'Slide Presentasi ' . $schedule->topic,
						'type'  => 'document',
					],

					[
						'title' => 'Video Pembelajaran ' . $schedule->topic,
						'type'  => 'video',
					],

				];

				// Tambahkan referensi online untuk bidang tertentu
				if (in_array($field, [
					'Web Programming',
					'Mobile Programming',
					'Digital Marketing',
					'Microsoft Office',
					'Teknik Komputer',
				])) {

					$materials[] = [
						'title' => 'Referensi Online',
						'type'  => 'link',
					];

				}

				$sort = 1;

				foreach ($materials as $material) {

					$file = null;
					$url = null;

					switch ($material['type']) {

						case 'document':
							$file = $faker->randomElement([
								'materials/module.pdf',
								'materials/slide.pdf',
							]);
							break;

						case 'video':
							$file = 'materials/video.mp4';
							break;

						case 'archive':
							$file = 'materials/archive.zip';
							break;

						case 'link':
							$url = $faker->randomElement([
								'https://developer.mozilla.org/',
								'https://laravel.com/docs',
								'https://flutter.dev/docs',
								'https://support.microsoft.com/',
								'https://www.canva.com/learn/',
								'https://www.youtube.com/',
							]);
							break;
					}

					TrainingMaterial::create([
						'training_schedule_id' => $schedule->id,
						'title'                => $material['title'],
						'description'          => $faker->sentence(12),
						'type'                 => $material['type'],
						'file'                 => $file,
						'external_url'         => $url,
						'sort_order'           => $sort++,
					]);
				}
			}
		}
	}
