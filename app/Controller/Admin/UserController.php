<?php

	namespace Natasya\NataApp\Controller\Admin;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\User;

	class UserController extends Controller
	{
		public function index(): void
		{
			$user = new User();

			$this->view(
				'Admin/Users/index',
				[
					'title'        => 'Kelola User',

					'users'        => $user->all(),

					'total'        => $user->count(),

					'admins'       => $user->countByRole('admin'),

					'employees'    => $user->countByRole('pegawai'),

					'participants' => $user->countByRole('peserta'),
				]
			);
		}

		public function show(): void
		{
			$id = (int) Request::get('id');

			$user = new User();

			$data = $user->findById($id);

			if (!$data) {

				$_SESSION['error'] = 'User tidak ditemukan.';

				$this->redirect('/admin/users');

			}

			$this->view(
				'Admin/Users/show',
				[
					'title' => 'Detail User',

					'user'  => $data,
				]
			);
		}

		public function create(): void
		{
			$this->view(
				'Admin/Users/create',
				[
					'title' => 'Tambah User',
				]
			);
		}

		public function store(): void
		{
			$user = new User();

			$user->create([

				'name'     => Request::post('name'),

				'username' => Request::post('username'),

				'email'    => Request::post('email'),

				'password' => password_hash(
					Request::post('password'),
					PASSWORD_BCRYPT
				),

				'role'     => Request::post('role'),

			]);

			$_SESSION['success'] = 'User berhasil ditambahkan.';

			$this->redirect('/admin/users');
		}

		public function edit(): void
		{
			$id = (int) Request::get('id');

			$user = new User();

			$data = $user->findById($id);

			if (!$data) {

				$_SESSION['error'] = 'User tidak ditemukan.';

				$this->redirect('/admin/users');

			}

			$this->view(
				'Admin/Users/edit',
				[
					'title' => 'Edit User',

					'user'  => $data,
				]
			);
		}

		public function update(): void
		{
			$id = (int) Request::post('id');

			$user = new User();

			$user->updateProfile(
				$id,
				[
					'name'  => Request::post('name'),

					'email' => Request::post('email'),
				]
			);

			$_SESSION['success'] = 'User berhasil diperbarui.';

			$this->redirect('/admin/users');
		}

		public function resetPassword(): void
		{
			$id = (int) Request::post('id');

			$user = new User();

			$user->updatePassword(
				$id,
				password_hash('password123', PASSWORD_BCRYPT)
			);

			$_SESSION['success'] = 'Password berhasil direset menjadi password123.';

			$this->redirect('/admin/users');
		}

		public function delete(): void
		{
			$id = (int) Request::post('id');

			$user = new User();

			$user->delete($id);

			$_SESSION['success'] = 'User berhasil dihapus.';

			$this->redirect('/admin/users');
		}
	}