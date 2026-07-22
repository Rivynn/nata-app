<?php

	namespace Natasya\NataApp\Controller\Admin;


	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Trainer;
	use Natasya\NataApp\Model\TrainingField;
	use Natasya\NataApp\Model\User;

	class TrainerController extends Controller
	{
		public function index(): void
		{
			$this->app();

			$trainers = Trainer::query()
				->with([
					'user',
					'trainingField',
				])
				->latest()
				->get();

			$this->view(
				'Admin/Trainers/index',
				[
					'title' => 'Data Pelatih',

					'trainers' => $trainers,

					'total' => Trainer::query()->count(),

					'active' => Trainer::query()
						->where('status', 'active')
						->count(),

					'inactive' => Trainer::query()
						->where('status', 'inactive')
						->count(),

					'fields' => TrainingField::query()
						->withCount('trainers')
						->get(),
				]
			);
		}

		public function create(): void
		{
			$this->app();

			$this->view(
				'Admin/Trainers/create',
				[
					'title' => 'Tambah Pelatih',

					'fields' => TrainingField::query()
						->orderBy('name')
						->get(),
				]
			);
		}

		public function store(): void
		{
			$name = trim(Request::post('name'));
			$username = trim(Request::post('username'));
			$email = trim(Request::post('email'));

			$password = Request::post('password');
			$passwordConfirmation = Request::post('password_confirmation');

			$trainingFieldId = Request::post('training_field_id');

			$employeeNumber = trim(Request::post('employee_number'));
			$phone = trim(Request::post('phone'));
			$institution = trim(Request::post('institution'));
			$expertise = trim(Request::post('expertise'));
			$specialization = trim(Request::post('specialization'));
			$experienceYear = Request::post('experience_year');
			$biography = trim(Request::post('biography'));

			/*
			|--------------------------------------------------------------------------
			| Validation
			|--------------------------------------------------------------------------
			*/

			if (
				$name === '' ||
				$username === '' ||
				$email === '' ||
				$password === '' ||
				$trainingFieldId === ''
			) {

				error('Semua field wajib harus diisi.');

				redirect('/admin/trainers/create');

			}

			if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {

				error('Format email tidak valid.');

				redirect('/admin/trainers/create');

			}

			if (strlen($password) < 8) {

				error('Password minimal 8 karakter.');

				redirect('/admin/trainers/create');

			}

			if ($password !== $passwordConfirmation) {

				error('Konfirmasi password tidak sesuai.');

				redirect('/admin/trainers/create');

			}

			if (
				User::query()
					->where('username', $username)
					->exists()
			) {

				error('Username sudah digunakan.');

				redirect('/admin/trainers/create');

			}

			if (
				User::query()
					->where('email', $email)
					->exists()
			) {

				error('Email sudah digunakan.');

				redirect('/admin/trainers/create');

			}

			if (
				$employeeNumber !== '' &&
				Trainer::query()
					->where('employee_number', $employeeNumber)
					->exists()
			) {

				error('Nomor induk pelatih sudah digunakan.');

				redirect('/admin/trainers/create');

			}



			try {

				$user = User::query()->create([

					'name' => $name,

					'username' => $username,

					'email' => $email,

					'password' => password_hash(
						$password,
						PASSWORD_BCRYPT
					),

					'role' => 'pelatih',

					'status' => 'active',

				]);

				Trainer::query()->create([

					'user_id' => $user->id,

					'training_field_id' => $trainingFieldId,

					'employee_number' => $employeeNumber ?: null,

					'phone' => $phone ?: null,

					'email' => $email,

					'institution' => $institution ?: null,

					'expertise' => $expertise ?: null,

					'specialization' => $specialization ?: null,

					'experience_year' => $experienceYear ?: null,

					'biography' => $biography ?: null,

					'status' => 'active',

				]);



				success('Pelatih berhasil ditambahkan.');

				redirect('/admin/trainers');

			} catch (\Throwable $e) {


				error('Terjadi kesalahan saat menyimpan data.');

				redirect('/admin/trainers/create');

			}
		}

		public function show(): void
		{
			$this->app();

			$trainer = new Trainer();

			$this->view(
				'Admin/Trainers/show',
				[
					'title' => 'Detail Pelatih',

					'trainer' => $trainer->find(
						(int) Request::get('id')
					),
				]
			);
		}

		public function edit(): void
		{
			$this->app();

			$trainer = Trainer::query()
				->with([
					'user',
					'trainingField',
				])
				->findOrFail(
					(int) Request::get('id')
				);

			$this->view(
				'Admin/Trainers/edit',
				[
					'title' => 'Edit Pelatih',

					'trainer' => $trainer,

					'fields' => TrainingField::query()
						->orderBy('name')
						->get(),
				]
			);
		}

		public function update(): void
		{
			$id = (int) Request::post('id');

			$trainer = Trainer::query()
				->with('user')
				->findOrFail($id);

			$name = trim(Request::post('name'));
			$username = trim(Request::post('username'));
			$email = trim(Request::post('email'));

			$password = Request::post('password');
			$passwordConfirmation = Request::post('password_confirmation');

			$trainingFieldId = Request::post('training_field_id');

			$employeeNumber = trim(Request::post('employee_number'));
			$phone = trim(Request::post('phone'));
			$institution = trim(Request::post('institution'));
			$expertise = trim(Request::post('expertise'));
			$specialization = trim(Request::post('specialization'));
			$experienceYear = Request::post('experience_year');
			$biography = trim(Request::post('biography'));
			$status = Request::post('status');

			/*
			|--------------------------------------------------------------------------
			| Validation
			|--------------------------------------------------------------------------
			*/

			if (
				$name === '' ||
				$username === '' ||
				$email === '' ||
				$trainingFieldId === ''
			) {

				error('Semua field wajib harus diisi.');

				redirect('/admin/trainers/edit?id=' . $id);

			}

			if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {

				error('Format email tidak valid.');

				redirect('/admin/trainers/edit?id=' . $id);

			}

			if (
				$password !== '' &&
				strlen($password) < 8
			) {

				error('Password minimal 8 karakter.');

				redirect('/admin/trainers/edit?id=' . $id);

			}

			if (
				$password !== '' &&
				$password !== $passwordConfirmation
			) {

				error('Konfirmasi password tidak sesuai.');

				redirect('/admin/trainers/edit?id=' . $id);

			}

			if (
				User::query()
					->where('username', $username)
					->where('id', '!=', $trainer->user_id)
					->exists()
			) {

				error('Username sudah digunakan.');

				redirect('/admin/trainers/edit?id=' . $id);

			}

			if (
				User::query()
					->where('email', $email)
					->where('id', '!=', $trainer->user_id)
					->exists()
			) {

				error('Email sudah digunakan.');

				redirect('/admin/trainers/edit?id=' . $id);

			}

			if (
				$employeeNumber !== '' &&
				Trainer::query()
					->where('employee_number', $employeeNumber)
					->where('id', '!=', $trainer->id)
					->exists()
			) {

				error('Nomor induk pelatih sudah digunakan.');

				redirect('/admin/trainers/edit?id=' . $id);

			}


			try {

				$userData = [

					'name' => $name,

					'username' => $username,

					'email' => $email,

					'status' => $status,

				];

				if ($password !== '') {

					$userData['password'] = password_hash(
						$password,
						PASSWORD_BCRYPT
					);

				}

				$trainer->user->update($userData);

				$trainer->update([

					'training_field_id' => $trainingFieldId,

					'employee_number' => $employeeNumber ?: null,

					'phone' => $phone ?: null,

					'institution' => $institution ?: null,

					'expertise' => $expertise ?: null,

					'specialization' => $specialization ?: null,

					'experience_year' => $experienceYear ?: null,

					'biography' => $biography ?: null,

				]);



				success('Data pelatih berhasil diperbarui.');

				redirect('/admin/trainers/show?id=' . $trainer->id);

			} catch (\Throwable $e) {

				error('Terjadi kesalahan saat memperbarui data.');

				redirect('/admin/trainers/edit?id=' . $trainer->id);

			}
		}

		public function delete(): void
		{
			$id = (int) Request::post('id');

			$trainer = Trainer::query()
				->with('user')
				->findOrFail($id);



			try {

				$trainer->delete();

				$trainer->user->delete();


				success('Pelatih berhasil dihapus.');

			} catch (\Throwable $e) {



				error('Terjadi kesalahan saat menghapus data.');

			}

			redirect('/admin/trainers');
		}
	}
