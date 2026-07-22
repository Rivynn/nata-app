<?php

	use Natasya\NataApp\App\Router;

	Router::get(
		'/verify/certificate',
		\Natasya\NataApp\Controller\CertificateVerificationController::class,
		'verify'
	);
	Router::get('/login', \Natasya\NataApp\Controller\AuthController::class, 'index', [\Natasya\NataApp\Middleware\GuestMiddleware::class]);
	Router::post('/login', \Natasya\NataApp\Controller\AuthController::class, 'login', [\Natasya\NataApp\Middleware\GuestMiddleware::class]);
	Router::get('/logout', \Natasya\NataApp\Controller\AuthController::class, 'logout', [\Natasya\NataApp\Middleware\AuthMiddleware::class]);
	Router::get('/register', \Natasya\NataApp\Controller\AuthController::class, 'showRegister', [\Natasya\NataApp\Middleware\GuestMiddleware::class]);
	Router::post('/register', \Natasya\NataApp\Controller\AuthController::class, 'register', [			\Natasya\NataApp\Middleware\GuestMiddleware::class]);

	Router::get('/', \Natasya\NataApp\Controller\DashboardController::class, 'index', [\Natasya\NataApp\Middleware\AuthMiddleware::class]);
	Router::get('/admin', \Natasya\NataApp\Controller\Admin\DashboardController::class, 'index', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\AdminMiddleware::class]);
	Router::get('/admin/reports', \Natasya\NataApp\Controller\Admin\ReportController::class, 'index', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\AdminMiddleware::class]);
	Router::get('/admin/users', \Natasya\NataApp\Controller\Admin\UserController::class, 'index', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\AdminMiddleware::class]);
	Router::get('/admin/users/create', \Natasya\NataApp\Controller\Admin\UserController::class, 'create', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\AdminMiddleware::class]);
	Router::post('/admin/users/store', \Natasya\NataApp\Controller\Admin\UserController::class, 'store', [			\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\AdminMiddleware::class]);
	Router::get('/admin/users/show', \Natasya\NataApp\Controller\Admin\UserController::class, 'show', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\AdminMiddleware::class]);
	Router::get('/admin/users/edit', \Natasya\NataApp\Controller\Admin\UserController::class, 'edit', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\AdminMiddleware::class]);
	Router::post('/admin/users/update', \Natasya\NataApp\Controller\Admin\UserController::class, 'update', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\AdminMiddleware::class]);
	Router::post('/admin/users/delete', \Natasya\NataApp\Controller\Admin\UserController::class, 'delete', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\AdminMiddleware::class]);
	Router::post('/admin/users/reset-password', \Natasya\NataApp\Controller\Admin\UserController::class, 'resetPassword', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\AdminMiddleware::class]);

	Router::get('/admin/employees', \Natasya\NataApp\Controller\Admin\EmployeeController::class, 'index', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\AdminMiddleware::class]);
	Router::get('/admin/employees/show', \Natasya\NataApp\Controller\Admin\EmployeeController::class, 'show', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\AdminMiddleware::class]);
	Router::get('/admin/employees/create', \Natasya\NataApp\Controller\Admin\EmployeeController::class, 'create', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\AdminMiddleware::class]);
	Router::post('/admin/employees/store', \Natasya\NataApp\Controller\Admin\EmployeeController::class, 'store', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\AdminMiddleware::class]);
	Router::get(
		'/admin/employees/edit',
		\Natasya\NataApp\Controller\Admin\EmployeeController::class,
		'edit',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class
		]
	);

	Router::post(
		'/admin/employees/update',
		\Natasya\NataApp\Controller\Admin\EmployeeController::class,
		'update',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class
		]
	);

	Router::post(
		'/admin/employees/delete',
		\Natasya\NataApp\Controller\Admin\EmployeeController::class,
		'delete',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class
		]
	);

	/*
|--------------------------------------------------------------------------
| Trainer
|--------------------------------------------------------------------------
*/

	Router::get(
		'/admin/trainers',
		\Natasya\NataApp\Controller\Admin\TrainerController::class,
		'index',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);

	Router::get(
		'/admin/trainers/create',
		\Natasya\NataApp\Controller\Admin\TrainerController::class,
		'create',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);

	Router::post(
		'/admin/trainers/store',
		\Natasya\NataApp\Controller\Admin\TrainerController::class,
		'store',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);

	Router::get(
		'/admin/trainers/show',
		\Natasya\NataApp\Controller\Admin\TrainerController::class,
		'show',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);

	Router::get(
		'/admin/trainers/edit',
		\Natasya\NataApp\Controller\Admin\TrainerController::class,
		'edit',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);

	Router::post(
		'/admin/trainers/update',
		\Natasya\NataApp\Controller\Admin\TrainerController::class,
		'update',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);

	Router::post(
		'/admin/trainers/delete',
		\Natasya\NataApp\Controller\Admin\TrainerController::class,
		'delete',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);

	/*
|--------------------------------------------------------------------------
| Schedule
|--------------------------------------------------------------------------
*/

	Router::get(
		'/admin/schedules',
		\Natasya\NataApp\Controller\Admin\ScheduleController::class,
		'index',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);
	Router::get(
		'/admin/trainings/schedules',
		\Natasya\NataApp\Controller\Admin\ScheduleController::class,
		'training',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class
		]
	);

	Router::get(
		'/admin/schedules/create',
		\Natasya\NataApp\Controller\Admin\ScheduleController::class,
		'create',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);

	Router::post(
		'/admin/schedules/store',
		\Natasya\NataApp\Controller\Admin\ScheduleController::class,
		'store',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);

	Router::get(
		'/admin/schedules/show',
		\Natasya\NataApp\Controller\Admin\ScheduleController::class,
		'show',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);

	Router::get(
		'/admin/schedules/edit',
		\Natasya\NataApp\Controller\Admin\ScheduleController::class,
		'edit',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);

	Router::post(
		'/admin/schedules/update',
		\Natasya\NataApp\Controller\Admin\ScheduleController::class,
		'update',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);

	Router::post(
		'/admin/schedules/delete',
		\Natasya\NataApp\Controller\Admin\ScheduleController::class,
		'delete',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);

	Router::get(
		'/admin/training-fields',
		\Natasya\NataApp\Controller\Admin\TrainingFieldController::class,
		'index',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class
		]
	);

	Router::get(
		'/admin/training-fields/create',
		\Natasya\NataApp\Controller\Admin\TrainingFieldController::class,
		'create',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class
		]
	);

	Router::post(
		'/admin/training-fields/store',
		\Natasya\NataApp\Controller\Admin\TrainingFieldController::class,
		'store',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class
		]
	);

	Router::get(
		'/admin/training-fields/show',
		\Natasya\NataApp\Controller\Admin\TrainingFieldController::class,
		'show',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class
		]
	);

	Router::get(
		'/admin/training-fields/edit',
		\Natasya\NataApp\Controller\Admin\TrainingFieldController::class,
		'edit',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class
		]
	);

	Router::post(
		'/admin/training-fields/update',
		\Natasya\NataApp\Controller\Admin\TrainingFieldController::class,
		'update',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class
		]
	);

	Router::post(
		'/admin/training-fields/delete',
		\Natasya\NataApp\Controller\Admin\TrainingFieldController::class,
		'delete',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class
		]
	);

	Router::get(
		'/admin/trainings',
		\Natasya\NataApp\Controller\Admin\TrainingController::class,
		'index',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class
		]
	);

	Router::get(
		'/admin/trainings/create',
		\Natasya\NataApp\Controller\Admin\TrainingController::class,
		'create',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class
		]
	);

	Router::post(
		'/admin/trainings/store',
		\Natasya\NataApp\Controller\Admin\TrainingController::class,
		'store',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class
		]
	);

	Router::get(
		'/admin/trainings/show',
		\Natasya\NataApp\Controller\Admin\TrainingController::class,
		'show',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class
		]
	);

	Router::get(
		'/admin/trainings/edit',
		\Natasya\NataApp\Controller\Admin\TrainingController::class,
		'edit',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class
		]
	);

	Router::post(
		'/admin/trainings/update',
		\Natasya\NataApp\Controller\Admin\TrainingController::class,
		'update',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class
		]
	);

	Router::post(
		'/admin/trainings/status',
		\Natasya\NataApp\Controller\Admin\TrainingController::class,
		'status',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class
		]
	);

	Router::post(
		'/admin/trainings/delete',
		\Natasya\NataApp\Controller\Admin\TrainingController::class,
		'delete',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class
		]
	);

	/*
|--------------------------------------------------------------------------
| Admin Participants
|--------------------------------------------------------------------------
*/

	Router::get(
		'/admin/participants',
		\Natasya\NataApp\Controller\Admin\ParticipantController::class,
		'index',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);

	Router::get(
		'/admin/participants/show',
		\Natasya\NataApp\Controller\Admin\ParticipantController::class,
		'show',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);

	Router::post(
		'/admin/participants/delete',
		\Natasya\NataApp\Controller\Admin\ParticipantController::class,
		'delete',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);

	/*
|--------------------------------------------------------------------------
| Admin Reports
|--------------------------------------------------------------------------
*/

	Router::get(
		'/admin/reports/participants',
		\Natasya\NataApp\Controller\Admin\ReportController::class,
		'participants',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);
	Router::get(
		'/admin/reports/participants/print',
		\Natasya\NataApp\Controller\Admin\ReportController::class,
		'participantPrint',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);
	Router::get(
		'/admin/reports/hutang/print',
		\Natasya\NataApp\Controller\Admin\ReportController::class,
		'hutangPrint',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);
	Router::get(
		'/admin/reports/trainings',
		\Natasya\NataApp\Controller\Admin\ReportController::class,
		'trainings',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);



	Router::get('/admin/reports/trainings/print',
		\Natasya\NataApp\Controller\Admin\ReportController::class,
		'trainingPrint',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);


	Router::get(
		'/admin/reports/attendance',
		\Natasya\NataApp\Controller\Admin\ReportController::class,
		'attendance',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);
	Router::get(
		'/admin/reports/attendance/print',
		\Natasya\NataApp\Controller\Admin\ReportController::class,
		'attendancePrint',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);
	Router::get(
		'/admin/reports/scores',
		\Natasya\NataApp\Controller\Admin\ReportController::class,
		'scores',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);



	Router::get(
		'/admin/reports/scores/print',
		\Natasya\NataApp\Controller\Admin\ReportController::class,
		'scorePrint',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);

	Router::get(
		'/admin/reports/graduations',
		\Natasya\NataApp\Controller\Admin\ReportController::class,
		'graduations',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);



	Router::get(
		'/admin/reports/graduations/print',
		\Natasya\NataApp\Controller\Admin\ReportController::class,
		'graduationPrint',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);
	Router::get(
		'/admin/reports/certificates',
		\Natasya\NataApp\Controller\Admin\ReportController::class,
		'certificates',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);



	Router::get(
		'/admin/reports/certificates/print',
		\Natasya\NataApp\Controller\Admin\ReportController::class,
		'certificatePrint',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);
	Router::get(
		'/admin/reports/recapitulation',
		\Natasya\NataApp\Controller\Admin\ReportController::class,
		'recapitulation',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);



	Router::get(
		'/admin/reports/recapitulation/print',
		\Natasya\NataApp\Controller\Admin\ReportController::class,
		'recapitulationPrint',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\AdminMiddleware::class,
		]
	);

	Router::get('/profile', \Natasya\NataApp\Controller\ProfileController::class, 'index', [\Natasya\NataApp\Middleware\AuthMiddleware::class]);
	Router::get('/profile/password', \Natasya\NataApp\Controller\ProfileController::class, 'password', [\Natasya\NataApp\Middleware\AuthMiddleware::class]);
	Router::post('/profile/password', \Natasya\NataApp\Controller\ProfileController::class, 'updatePassword', [\Natasya\NataApp\Middleware\AuthMiddleware::class]);
	Router::get('/profile/edit', \Natasya\NataApp\Controller\ProfileController::class, 'edit', [\Natasya\NataApp\Middleware\AuthMiddleware::class]);
	Router::post('/profile/edit', \Natasya\NataApp\Controller\ProfileController::class, 'update', [\Natasya\NataApp\Middleware\AuthMiddleware::class]);

	Router::get('/pegawai', \Natasya\NataApp\Controller\Pegawai\DashboardController::class, 'index', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\PegawaiMiddleware::class]);
	Router::get('/pegawai/verifications', \Natasya\NataApp\Controller\Pegawai\VerificationController::class, 'index', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\PegawaiMiddleware::class]);
	Router::get('/pegawai/verifications/show', \Natasya\NataApp\Controller\Pegawai\VerificationController::class,			'show', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\PegawaiMiddleware::class]);
	Router::post('/pegawai/verifications/approve', \Natasya\NataApp\Controller\Pegawai\VerificationController::class, 'approve', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\PegawaiMiddleware::class]);
	Router::post('/pegawai/verifications/reject', \Natasya\NataApp\Controller\Pegawai\VerificationController::class, 'reject', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\PegawaiMiddleware::class]);
	Router::get('/pegawai/participants', \Natasya\NataApp\Controller\Pegawai\ParticipantController::class, 'index', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\PegawaiMiddleware::class]);
	Router::get('/pegawai/participants/show', \Natasya\NataApp\Controller\Pegawai\ParticipantController::class, 'show', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\PegawaiMiddleware::class]);
	Router::get(
		'/pegawai/certificates',
		\Natasya\NataApp\Controller\Pegawai\CertificateController::class,
		'index',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PegawaiMiddleware::class,
		]
	);
	Router::post(
		'/pegawai/certificates/generate',
		\Natasya\NataApp\Controller\Pegawai\CertificateController::class,
		'generate',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PegawaiMiddleware::class,
		]
	);
	Router::get('/pegawai/certificates/show', \Natasya\NataApp\Controller\Pegawai\CertificateController::class,'show', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\PegawaiMiddleware::class]);

	Router::get(
		'/pegawai/graduations',
		\Natasya\NataApp\Controller\Pegawai\GraduationController::class,
		'index',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PegawaiMiddleware::class,
		]
	);

	Router::get('/pegawai/certificates/create', \Natasya\NataApp\Controller\Pegawai\CertificateController::class, 'create',  [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\PegawaiMiddleware::class]);
	Router::post('/pegawai/certificates/store', \Natasya\NataApp\Controller\Pegawai\CertificateController::class, 'store', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\PegawaiMiddleware::class]);

	Router::get('/peserta', \Natasya\NataApp\Controller\Peserta\DashboardController::class, 'index', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\PesertaMiddleware::class]);
	Router::get('/peserta/registrations', \Natasya\NataApp\Controller\Peserta\RegistrationController::class, 'index', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\PesertaMiddleware::class,]);

	Router::get(
		'/peserta/profile',
		\Natasya\NataApp\Controller\Peserta\ProfileController::class,
		'index',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PesertaMiddleware::class,
		]
	);

	Router::post(
		'/peserta/profile',
		\Natasya\NataApp\Controller\Peserta\ProfileController::class,
		'update',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PesertaMiddleware::class,
		]
	);

	Router::get('/peserta/registrations/create', \Natasya\NataApp\Controller\Peserta\RegistrationController::class, 'create', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\PesertaMiddleware::class,]);
	Router::post('/peserta/registrations', \Natasya\NataApp\Controller\Peserta\RegistrationController::class, 'store', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\PesertaMiddleware::class,]);
	Router::get('/peserta/status', \Natasya\NataApp\Controller\Peserta\RegistrationController::class, 'status', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\PesertaMiddleware::class,]);
	Router::get('/peserta/trainings', \Natasya\NataApp\Controller\Peserta\TrainingController::class, 'index',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PesertaMiddleware::class,
		]
	);
	Router::get('/peserta/trainings/show', \Natasya\NataApp\Controller\Peserta\TrainingController::class, 'show',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PesertaMiddleware::class,
		]
	);

	Router::get(
		'/peserta/attendances',
		\Natasya\NataApp\Controller\Peserta\AttendanceController::class,
		'index',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PesertaMiddleware::class,
		]
	);

	Router::post(
		'/peserta/attendances',
		\Natasya\NataApp\Controller\Peserta\AttendanceController::class,
		'store',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PesertaMiddleware::class,
		]
	);
	Router::get('/peserta/history', \Natasya\NataApp\Controller\Peserta\HistoryController::class, 'index',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PesertaMiddleware::class,
		]
	);
	/*
|--------------------------------------------------------------------------
| Sertifikat Peserta
|--------------------------------------------------------------------------
*/

	Router::get('/peserta/certificates', \Natasya\NataApp\Controller\Peserta\CertificateController::class, 'index', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\PesertaMiddleware::class,]);
	Router::get('/peserta/certificates/show', \Natasya\NataApp\Controller\Peserta\CertificateController::class, 'show', [\Natasya\NataApp\Middleware\AuthMiddleware::class, \Natasya\NataApp\Middleware\PesertaMiddleware::class,]);

	Router::get(
		'/test/notification',
		\Natasya\NataApp\Controller\TestController::class,
		'notification'
	);



	Router::get(
		'/pelatih',
		\Natasya\NataApp\Controller\Pelatih\DashboardController::class,
		'index',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);
	Router::get(
		'/pelatih/schedules',
		\Natasya\NataApp\Controller\Pelatih\ScheduleController::class,
		'index',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);

	Router::get(
		'/pelatih/schedules/show',
		\Natasya\NataApp\Controller\Pelatih\ScheduleController::class,
		'show',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);
	/*
|--------------------------------------------------------------------------
| Trainer Attendance
|--------------------------------------------------------------------------
*/

	Router::get(
		'/pelatih/attendances',
		\Natasya\NataApp\Controller\Pelatih\AttendanceController::class,
		'index',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);

	Router::get(
		'/pelatih/attendances/show',
		\Natasya\NataApp\Controller\Pelatih\AttendanceController::class,
		'show',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);

	Router::get(
		'/pelatih/attendances/create',
		\Natasya\NataApp\Controller\Pelatih\AttendanceController::class,
		'create',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);

	Router::post(
		'/pelatih/attendances/store',
		\Natasya\NataApp\Controller\Pelatih\AttendanceController::class,
		'store',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);

	Router::get(
		'/pelatih/attendances/qrcode',
		\Natasya\NataApp\Controller\Pelatih\AttendanceController::class,
		'qrcode',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);
	Router::post(
		'/pelatih/attendances/update-status',
		\Natasya\NataApp\Controller\Pelatih\AttendanceController::class,
		'updateStatus',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);

	Router::post(
		'/pelatih/attendances/manual',
		\Natasya\NataApp\Controller\Pelatih\AttendanceController::class,
		'manual',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);

	Router::post(
		'/pelatih/attendances/permission',
		\Natasya\NataApp\Controller\Pelatih\AttendanceController::class,
		'permission',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);

	Router::post(
		'/pelatih/attendances/close',
		\Natasya\NataApp\Controller\Pelatih\AttendanceController::class,
		'close',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);

	/*
|--------------------------------------------------------------------------
| Trainer - Trainings
|--------------------------------------------------------------------------
*/

	Router::get(
		'/pelatih/trainings',
		\Natasya\NataApp\Controller\Pelatih\TrainingController::class,
		'index',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);

	Router::get(
		'/pelatih/trainings/show',
		\Natasya\NataApp\Controller\Pelatih\TrainingController::class,
		'show',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);

	Router::get(
		'/pelatih/participants',
		\Natasya\NataApp\Controller\Pelatih\ParticipantController::class,
		'index',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);

	Router::get(
		'/pelatih/participants/show',
		\Natasya\NataApp\Controller\Pelatih\ParticipantController::class,
		'show',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);
	Router::get(
		'/pelatih/scores',
		\Natasya\NataApp\Controller\Pelatih\ScoreController::class,
		'index',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);

	Router::get(
		'/pelatih/scores/show',
		\Natasya\NataApp\Controller\Pelatih\ScoreController::class,
		'show',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);
	Router::get(
		'/pelatih/scores/detail',
		\Natasya\NataApp\Controller\Pelatih\ScoreController::class,
		'detail',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);

	Router::get(
		'/pelatih/scores/create',
		\Natasya\NataApp\Controller\Pelatih\ScoreController::class,
		'create',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);

	Router::post(
		'/pelatih/scores/store',
		\Natasya\NataApp\Controller\Pelatih\ScoreController::class,
		'store',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);

	Router::get(
		'/pelatih/scores/edit',
		\Natasya\NataApp\Controller\Pelatih\ScoreController::class,
		'edit',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);

	Router::post(
		'/pelatih/scores/update',
		\Natasya\NataApp\Controller\Pelatih\ScoreController::class,
		'update',
		[
			\Natasya\NataApp\Middleware\AuthMiddleware::class,
			\Natasya\NataApp\Middleware\PelatihMiddleware::class,
		]
	);
