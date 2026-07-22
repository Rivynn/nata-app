<?php

	namespace Natasya\NataApp\Controller\Admin;

	use Illuminate\Support\Facades\DB;
	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Employee;
	use Natasya\NataApp\Model\TrainingField;
	use Natasya\NataApp\Model\User;

	class EmployeeController extends Controller
	{
		public function index(): void
		{
			$this->view('Admin/Employees/index', [

				'title' => 'Data Pegawai',

				'employees' => Employee::query()
					->with('user')
					->latest()
					->get(),

				'total' => Employee::query()->count(),

			]);
		}

		public function show(): void
		{
			$employee = Employee::query()
				->with('user')
				->findOrFail(Request::get('id'));

			$this->view('Admin/Employees/show', [

				'title' => 'Detail Pegawai',

				'employee' => $employee,

			]);
		}

		public function create(): void
		{
			$this->view('Admin/Employees/create', [

				'title' => 'Tambah Pegawai',

			]);
		}

		public function store(): void
		{
			$name = trim(Request::post('name'));
			$username = trim(Request::post('username'));
			$email = trim(Request::post('email'));
			$password = Request::post('password');
			$passwordConfirmation = Request::post('password_confirmation');

			$employeeNumber = trim(Request::post('employee_number'));
			$phone = trim(Request::post('phone'));
			$department = trim(Request::post('department'));
			$position = trim(Request::post('position'));

			/*
			|--------------------------------------------------------------------------
			| Validation
			|--------------------------------------------------------------------------
			*/

			if (
				$name === '' ||
				$username === '' ||
				$email === '' ||
				$password === ''
			) {
				error('Semua field wajib harus diisi.');
				redirect('/admin/employees/create');
			}

			if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
				error('Format email tidak valid.');
				redirect('/admin/employees/create');
			}

			if (strlen($password) < 8) {
				error('Password minimal 8 karakter.');
				redirect('/admin/employees/create');
			}

			if ($password !== $passwordConfirmation) {
				error('Konfirmasi password tidak sesuai.');
				redirect('/admin/employees/create');
			}

			if (User::query()->where('username', $username)->exists()) {
				error('Username sudah digunakan.');
				redirect('/admin/employees/create');
			}

			if (User::query()->where('email', $email)->exists()) {
				error('Email sudah digunakan.');
				redirect('/admin/employees/create');
			}

			if (
				$employeeNumber !== '' &&
				Employee::query()
					->where('employee_number', $employeeNumber)
					->exists()
			) {
				error('Nomor pegawai sudah digunakan.');
				redirect('/admin/employees/create');
			}

			/*
			|--------------------------------------------------------------------------
			| Transaction
			|--------------------------------------------------------------------------
			*/

			DB::beginTransaction();

			try {

				$user = User::query()->create([

					'name' => $name,

					'username' => $username,

					'email' => $email,

					'password' => password_hash($password, PASSWORD_BCRYPT),

					'role' => 'pegawai',

					'status' => 'active',

				]);

				Employee::query()->create([

					'user_id' => $user->id,

					'employee_number' => $employeeNumber ?: null,

					'phone' => $phone ?: null,

					'department' => $department ?: null,

					'position' => $position ?: null,

				]);

				DB::commit();

				success('Pegawai berhasil ditambahkan.');

				redirect('/admin/employees');

			} catch (\Throwable $e) {

				DB::rollBack();

				error('Terjadi kesalahan saat menyimpan data.');

				redirect('/admin/employees/create');
			}
		}

		public function edit(): void
		{
			$employee = Employee::query()
				->with('user')
				->findOrFail(Request::get('id'));

			$this->view('Admin/Employees/edit', [

				'title' => 'Edit Pegawai',

				'employee' => $employee,

			]);
		}

		public function update(): void
		{
			$employee = Employee::query()
				->with('user')
				->findOrFail(Request::post('id'));

			$employee->user->update([

				'name' => Request::post('name'),

				'username' => Request::post('username'),

				'email' => Request::post('email'),

				'status' => Request::post('status'),

			]);

			$employee->update([

				'employee_number' => Request::post('employee_number'),

				'phone' => Request::post('phone'),

				'position' => Request::post('position'),

				'department' => Request::post('department'),

			]);

			success('Pegawai berhasil diperbarui.');

			redirect('/admin/employees');
		}

		public function delete(): void
		{
			$employee = Employee::query()
				->with('user')
				->findOrFail(Request::post('id'));

			$user = $employee->user;

			$employee->delete();

			if ($user) {
				$user->delete();
			}

			success('Pegawai berhasil dihapus.');

			redirect('/admin/employees');
		}
	}
