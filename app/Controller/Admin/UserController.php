<?php

	namespace Natasya\NataApp\Controller\Admin;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\User;

	class UserController extends Controller
	{
		public function index(): void
		{
			$this->view('Admin/Users/index', [

				'title' => 'Kelola User',

				'users' => User::query()
					->latest()
					->get(),

				'total' => User::query()->count(),

				'admins' => User::query()
					->where('role', 'admin')
					->count(),

				'employees' => User::query()
					->where('role', 'pegawai')
					->count(),

				'participants' => User::query()
					->where('role', 'peserta')
					->count(),

			]);
		}

		public function show(): void
		{
			$user = User::query()
				->findOrFail(Request::get('id'));

			$this->view('Admin/Users/show', [

				'title' => 'Detail User',

				'user' => $user,

			]);
		}

		public function create(): void
		{
			$this->view('Admin/Users/create', [

				'title' => 'Tambah User',

			]);
		}

		public function store(): void
		{
			User::query()->create([

				'name' => Request::post('name'),

				'username' => Request::post('username'),

				'email' => Request::post('email'),

				'password' => password_hash(
					Request::post('password'),
					PASSWORD_BCRYPT
				),

				'role' => Request::post('role'),

			]);

			success('User berhasil ditambahkan.');

			redirect('/admin/users');
		}

		public function edit(): void
		{
			$user = User::query()
				->findOrFail(Request::get('id'));

			$this->view('Admin/Users/edit', [

				'title' => 'Edit User',

				'user' => $user,

			]);
		}

		public function update(): void
		{
			$user = User::query()
				->findOrFail(Request::post('id'));

			$user->update([

				'name' => Request::post('name'),

				'email' => Request::post('email'),

			]);

			success('User berhasil diperbarui.');

			redirect('/admin/users');
		}

		public function resetPassword(): void
		{
			$user = User::query()
				->findOrFail(Request::post('id'));

			$user->update([

				'password' => password_hash(
					'password123',
					PASSWORD_BCRYPT
				),

			]);

			success('Password berhasil direset.');

			redirect('/admin/users');
		}

		public function delete(): void
		{
			User::query()
				->findOrFail(Request::post('id'))
				->delete();

			success('User berhasil dihapus.');

			redirect('/admin/users');
		}
	}
