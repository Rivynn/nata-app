<?php

	namespace Natasya\NataApp\Controller\Admin;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Employee;
	use Natasya\NataApp\Model\TrainingField;
	use Natasya\NataApp\Model\User;

	class EmployeeController extends Controller
	{
		public function index(): void
		{
			$employee = new Employee();

			$this->view(
				'Admin/Employees/index',
				[
					'title' => 'Data Pegawai',

					'employees' => $employee->all(),

					'total' => $employee->count(),

					'fields' => $employee->countByField(),
				]
			);
		}

		public function show(): void
		{
			$id = (int) Request::get('id');

			$employee = new Employee();

			$data = $employee->find($id);

			if (!$data) {

				$_SESSION['error'] = 'Pegawai tidak ditemukan.';

				$this->redirect('/admin/employees');
			}

			$this->view(
				'Admin/Employees/show',
				[
					'title' => 'Detail Pegawai',

					'employee' => $data,
				]
			);
		}

		public function create(): void
		{
			$field = new TrainingField();

			$this->view(
				'Admin/Employees/create',
				[
					'title' => 'Tambah Pegawai',

					'fields' => $field->all(),
				]
			);
		}

		public function store(): void
		{
			$user = new User();

			$employee = new Employee();

			$userId = $user->create([

				'name' => Request::post('name'),

				'username' => Request::post('username'),

				'email' => Request::post('email'),

				'password' => password_hash(
					Request::post('password'),
					PASSWORD_BCRYPT
				),

				'role' => 'pegawai',

				'status' => Request::post('status'),

			]);

			$employee->create([

				'user_id' => $userId,

				'training_field_id' => Request::post('training_field_id'),

				'phone' => Request::post('phone'),

				'position' => Request::post('position'),

				'address' => Request::post('address'),

			]);

			$_SESSION['success'] = 'Pegawai berhasil ditambahkan.';

			$this->redirect('/admin/employees');
		}

		public function edit(): void
		{
			$id = (int) Request::get('id');

			$employee = new Employee();

			$field = new TrainingField();

			$data = $employee->find($id);

			if (!$data) {

				$_SESSION['error'] = 'Pegawai tidak ditemukan.';

				$this->redirect('/admin/employees');
			}

			$this->view(
				'Admin/Employees/edit',
				[
					'title' => 'Edit Pegawai',

					'employee' => $data,

					'fields' => $field->all(),
				]
			);
		}

		public function update(): void
		{
			$user = new User();

			$employee = new Employee();

			$id = (int) Request::post('id');

			$data = $employee->find($id);

			if (!$data) {

				$_SESSION['error'] = 'Pegawai tidak ditemukan.';

				$this->redirect('/admin/employees');
			}

			$user->update(
				$data['user_id'],
				[
					'name' => Request::post('name'),

					'username' => Request::post('username'),

					'email' => Request::post('email'),

					'role' => 'pegawai',
				]
			);

			$employee->update(
				$id,
				[
					'training_field_id' => Request::post('training_field_id'),

					'phone' => Request::post('phone'),

					'position' => Request::post('position'),

					'address' => Request::post('address'),
				]
			);

			$_SESSION['success'] = 'Pegawai berhasil diperbarui.';

			$this->redirect('/admin/employees');
		}

		public function delete(): void
		{
			$id = (int) Request::post('id');

			$employee = new Employee();

			$data = $employee->find($id);

			if (!$data) {

				$_SESSION['error'] = 'Pegawai tidak ditemukan.';

				$this->redirect('/admin/employees');
			}

			/*
			|--------------------------------------------------------------------------
			| Hapus Profil Pegawai
			|--------------------------------------------------------------------------
			*/

			$employee->delete($id);

			/*
			|--------------------------------------------------------------------------
			| Hapus User
			|--------------------------------------------------------------------------
			*/

			(new User())->delete($data['user_id']);

			$_SESSION['success'] = 'Pegawai berhasil dihapus.';

			$this->redirect('/admin/employees');
		}
	}