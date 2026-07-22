<?php

	namespace Database\Seeders;

	use Natasya\NataApp\Model\TrainingField;

	class TrainingFieldSeeder extends Seeder
	{
		public function run(): void
		{
			$fields = [

				[
					'name' => 'Web Programming',
					'slug' => 'web-programming',
					'description' => 'Pelatihan pengembangan website menggunakan teknologi modern.',
					'icon' => 'fas fa-code',
					'color' => 'primary',
				],

				[
					'name' => 'Mobile Programming',
					'slug' => 'mobile-programming',
					'description' => 'Pelatihan pengembangan aplikasi Android dan iOS.',
					'icon' => 'fas fa-mobile-alt',
					'color' => 'success',
				],

				[
					'name' => 'Digital Marketing',
					'slug' => 'digital-marketing',
					'description' => 'Pelatihan pemasaran digital melalui berbagai platform.',
					'icon' => 'fas fa-bullhorn',
					'color' => 'warning',
				],

				[
					'name' => 'Desain Grafis',
					'slug' => 'desain-grafis',
					'description' => 'Pelatihan desain grafis menggunakan software profesional.',
					'icon' => 'fas fa-palette',
					'color' => 'info',
				],

				[
					'name' => 'Microsoft Office',
					'slug' => 'microsoft-office',
					'description' => 'Pelatihan Microsoft Word, Excel, dan PowerPoint.',
					'icon' => 'fas fa-file-word',
					'color' => 'info',
				],

				[
					'name' => 'Akuntansi',
					'slug' => 'akuntansi',
					'description' => 'Pelatihan pembukuan dan laporan keuangan.',
					'icon' => 'fas fa-calculator',
					'color' => 'danger',
				],

				[
					'name' => 'Tata Boga',
					'slug' => 'tata-boga',
					'description' => 'Pelatihan memasak dan pengolahan makanan.',
					'icon' => 'fas fa-utensils',
					'color' => 'warning',
				],

				[
					'name' => 'Tata Busana',
					'slug' => 'tata-busana',
					'description' => 'Pelatihan menjahit dan desain busana.',
					'icon' => 'fas fa-tshirt',
					'color' => 'danger',
				],

				[
					'name' => 'Barber',
					'slug' => 'barber',
					'description' => 'Pelatihan pangkas rambut profesional.',
					'icon' => 'fas fa-cut',
					'color' => 'dark',
				],

				[
					'name' => 'Teknik Komputer',
					'slug' => 'teknik-komputer',
					'description' => 'Pelatihan perakitan dan perawatan komputer.',
					'icon' => 'fas fa-laptop',
					'color' => 'primary',
				],

			];

			foreach ($fields as $field) {

				TrainingField::create([
					'name' => $field['name'],
					'slug' => $field['slug'],
					'description' => $field['description'],
					'icon' => $field['icon'],
					'color' => $field['color'],
					'is_active' => true,
				]);

			}
		}
	}
