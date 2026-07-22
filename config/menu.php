<?php

	return [
		/*
		|--------------------------------------------------------------------------
		| Admin
		|--------------------------------------------------------------------------
		*/

		[
			'title' => 'Dashboard',
			'url'   => '/admin',
			'icon'  => 'fas fa-fw fa-home',
			'roles' => ['admin'],
		],

		[
			'title' => 'Master Data',
			'icon'  => 'fas fa-fw fa-database',
			'roles' => ['admin'],

			'children' => [

				[
					'title' => 'Kelola User',
					'url'   => '/admin/users',
					'icon'  => 'fas fa-users',
				],

				[
					'title' => 'Data Pegawai',
					'url'   => '/admin/employees',
					'icon'  => 'fas fa-user-tie',
				],

				[
					'title' => 'Data Pelatih',
					'url'   => '/admin/trainers',
					'icon'  => 'fas fa-chalkboard-teacher',
				],

				[
					'title' => 'Data Peserta',
					'url'   => '/admin/participants',
					'icon'  => 'fas fa-user-graduate',
				],

				[
					'title' => 'Jenis Pelatihan',
					'url'   => '/admin/training-fields',
					'icon'  => 'fas fa-layer-group',
				],

			],
		],

		[
			'title' => 'Pelatihan',
			'icon'  => 'fas fa-fw fa-book-open',
			'roles' => ['admin'],

			'children' => [

				[
					'title' => 'Data Pelatihan',
					'url'   => '/admin/trainings',
					'icon'  => 'fas fa-book',
				],

				[
					'title' => 'Penjadwalan',
					'url'   => '/admin/schedules',
					'icon'  => 'fas fa-calendar-alt',
				],

			],
		],

		[
			'title' => 'Monitoring',
			'icon'  => 'fas fa-fw fa-chart-line',
			'roles' => ['admin'],

			'children' => [

				[
					'title' => 'Monitoring Pelatihan',
					'url'   => '/admin/monitoring/trainings',
					'icon'  => 'fas fa-book-reader',
				],

				[
					'title' => 'Monitoring Kehadiran',
					'url'   => '/admin/monitoring/attendance',
					'icon'  => 'fas fa-calendar-check',
				],

				[
					'title' => 'Monitoring Kelulusan',
					'url'   => '/admin/monitoring/graduations',
					'icon'  => 'fas fa-award',
				],

				[
					'title' => 'Monitoring Sertifikat',
					'url'   => '/admin/monitoring/certificates',
					'icon'  => 'fas fa-certificate',
				],

			],
		],

		[
			'title' => 'Laporan',
			'icon'  => 'fas fa-fw fa-file-alt',
			'roles' => ['admin'],

			'children' => [

				[
					'title' => 'Dashboard Laporan',
					'url'   => '/admin/reports',
					'icon'  => 'fas fa-chart-pie',
				],

				[
					'title' => 'Laporan Pelatihan',
					'url'   => '/admin/reports/trainings',
					'icon'  => 'fas fa-book-open',
				],

				[
					'title' => 'Laporan Peserta',
					'url'   => '/admin/reports/participants',
					'icon'  => 'fas fa-user-graduate',
				],

				[
					'title' => 'Laporan Kehadiran',
					'url'   => '/admin/reports/attendance',
					'icon'  => 'fas fa-calendar-check',
				],

				[
					'title' => 'Laporan Penilaian',
					'url'   => '/admin/reports/scores',
					'icon'  => 'fas fa-star',
				],

				[
					'title' => 'Laporan Kelulusan',
					'url'   => '/admin/reports/graduations',
					'icon'  => 'fas fa-award',
				],

				[
					'title' => 'Laporan Sertifikat',
					'url'   => '/admin/reports/certificates',
					'icon'  => 'fas fa-certificate',
				],

				[
					'title' => 'Rekapitulasi',
					'url'   => '/admin/reports/recapitulation',
					'icon'  => 'fas fa-table',
				],

			],
		],

		/*
		|--------------------------------------------------------------------------
		| Pegawai
		|--------------------------------------------------------------------------
		*/

		[
			'title' => 'Dashboard',
			'url'   => '/pegawai',
			'icon'  => 'fas fa-fw fa-home',
			'roles' => ['pegawai'],
		],

		[
			'title' => 'Verifikasi Peserta',
			'url'   => '/pegawai/verifications',
			'icon'  => 'fas fa-fw fa-clipboard-check',
			'roles' => ['pegawai'],
		],

		[
			'title' => 'Data Peserta',
			'url'   => '/pegawai/participants',
			'icon'  => 'fas fa-fw fa-users',
			'roles' => ['pegawai'],
		],
		[
			'title' => 'Pelatihan',
			'url'   => '/pegawai/trainings',
			'icon'  => 'fas fa-fw fa-book-open',
			'roles' => ['pegawai'],
		],
		[
			'title' => 'Kelulusan',
			'url'   => '/pegawai/graduations',
			'icon'  => 'fas fa-fw fa-award',
			'roles' => ['pegawai'],
		],
		[
			'title' => 'Sertifikat',
			'url'   => '/pegawai/certificates',
			'icon'  => 'fas fa-fw fa-certificate',
			'roles' => ['pegawai'],
		],
		/*
	|--------------------------------------------------------------------------
	| Peserta
	|--------------------------------------------------------------------------
	*/

		[
			'title' => 'Dashboard',
			'url'   => '/peserta',
			'icon'  => 'fas fa-fw fa-home',
			'roles' => ['peserta'],
		],

		[
			'title' => 'Daftar Pelatihan',
			'url'   => '/peserta/registrations',
			'icon'  => 'fas fa-fw fa-clipboard-list',
			'roles' => ['peserta'],
		],

		[
			'title' => 'Pelatihan Saya',
			'url'   => '/peserta/trainings',
			'icon'  => 'fas fa-fw fa-graduation-cap',
			'roles' => ['peserta'],
		],

		[
			'title' => 'Status Pendaftaran',
			'url'   => '/peserta/status',
			'icon'  => 'fas fa-fw fa-hourglass-half',
			'roles' => ['peserta'],
		],
		[
			'title' => 'Absensi',
			'url'   => '/peserta/attendances',
			'icon'  => 'fas fa-fw fa-qrcode',
			'roles' => ['peserta'],
		],


		[
			'title' => 'Riwayat Pelatihan',
			'url'   => '/peserta/history',
			'icon'  => 'fas fa-fw fa-history',
			'roles' => ['peserta'],
		],

		[
			'title' => 'Sertifikat',
			'url'   => '/peserta/certificates',
			'icon'  => 'fas fa-fw fa-certificate',
			'roles' => ['peserta'],
		],

		/*
|--------------------------------------------------------------------------
| Pelatih
|--------------------------------------------------------------------------
*/

		[
			'title' => 'Dashboard',
			'url'   => '/pelatih',
			'icon'  => 'fas fa-fw fa-home',
			'roles' => ['pelatih'],
		],

		[
			'title' => 'Jadwal Mengajar',
			'url'   => '/pelatih/schedules',
			'icon'  => 'fas fa-fw fa-calendar-alt',
			'roles' => ['pelatih'],
		],

		[
			'title' => 'Pelatihan',
			'url'   => '/pelatih/trainings',
			'icon'  => 'fas fa-fw fa-book-open',
			'roles' => ['pelatih'],
		],

		[
			'title' => 'Absensi',
			'url'   => '/pelatih/attendances',
			'icon'  => 'fas fa-fw fa-qrcode',
			'roles' => ['pelatih'],
		],

		[
			'title' => 'Penilaian',
			'url'   => '/pelatih/scores',
			'icon'  => 'fas fa-fw fa-star',
			'roles' => ['pelatih'],
		],

		[
			'title' => 'Peserta',
			'url'   => '/pelatih/participants',
			'icon'  => 'fas fa-fw fa-user-graduate',
			'roles' => ['pelatih'],
		],
	];
