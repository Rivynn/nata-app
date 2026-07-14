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
			'title' => 'Kelola User',
			'url'   => '/admin/users',
			'icon'  => 'fas fa-fw fa-users',
			'roles' => ['admin'],
		],

		[
			'title' => 'Data Pegawai',
			'url'   => '/admin/employees',
			'icon'  => 'fas fa-fw fa-user-tie',
			'roles' => ['admin'],
		],

		[
			'title' => 'Jenis Pelatihan',
			'url'   => '/admin/training-fields',
			'icon'  => 'fas fa-fw fa-layer-group',
			'roles' => ['admin'],
		],

		[
			'title' => 'Data Pelatihan',
			'url'   => '/admin/trainings',
			'icon'  => 'fas fa-fw fa-book-open',
			'roles' => ['admin'],
		],
		[
			'title' => 'Data Pelatih',
			'url'   => '/admin/trainers',
			'icon'  => 'fas fa-fw fa-chalkboard-teacher',
			'roles' => ['admin'],
		],

		[
			'title' => 'Penjadwalan',
			'url'   => '/admin/schedules',
			'icon'  => 'fas fa-fw fa-calendar-alt',
			'roles' => ['admin'],
		],

		[
			'title' => 'Data Peserta',
			'url'   => '/admin/participants',
			'icon'  => 'fas fa-fw fa-user-graduate',
			'roles' => ['admin'],
		],
		[
			'title' => 'Laporan',
			'icon'  => 'fas fa-fw fa-file-alt',
			'roles' => ['admin'],

			'children' => [
				[
					'title' => 'Cetak Laporan',
					'icon' => 'fas fa-print',
					'url' => '/admin/reports',
				],


				[
					'title' => 'Data Peserta',
					'url'   => '/admin/reports/participants',
					'icon'  => 'fas fa-user-graduate',
				],

				[
					'title' => 'Kehadiran',
					'url'   => '/admin/reports/attendance',
					'icon'  => 'fas fa-calendar-check',
				],

				[
					'title' => 'Kelulusan',
					'url'   => '/admin/reports/graduations',
					'icon'  => 'fas fa-award',
				],

				[
					'title' => 'Monitoring Pelatihan',
					'url'   => '/admin/reports/trainings',
					'icon'  => 'fas fa-chart-bar',
				],

				[
					'title' => 'Rekap Peserta',
					'url'   => '/admin/reports/recap',
					'icon'  => 'fas fa-users',
				],

			]
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
			'icon'  => 'fas fa-fw fa-file-alt',
			'roles' => ['peserta'],
		],

		[
			'title' => 'Status Pendaftaran',
			'url'   => '/peserta/status',
			'icon'  => 'fas fa-fw fa-info-circle',
			'roles' => ['peserta'],
		],

		[
			'title' => 'Cetak Sertifikat',
			'url'   => '/peserta/certificates',
			'icon'  => 'fas fa-fw fa-print',
			'roles' => ['peserta'],
		],

	];
