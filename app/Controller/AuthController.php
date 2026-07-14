<?php

	namespace Natasya\NataApp\Controller;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Participant;
	use Natasya\NataApp\Model\User;
	use Natasya\NataApp\Services\NotificationService;

	class AuthController extends Controller
	{
		public function index(): void
		{
			$this->layout('Layouts/blank');

			$this->view('Auth/login', [
				'title' => 'Login'
			]);
		}
		public function showRegister(): void
		{
			$this->layout('Layouts/blank');

			$this->view('Auth/register', [
				'title' => 'Registrasi Peserta'
			]);
		}

		public function register(): void
		{
			$name = trim(Request::post('name'));
			$username = trim(Request::post('username'));
			$email = trim(Request::post('email'));
			$phone = trim(Request::post('phone'));

			$password = Request::post('password');
			$confirmation = Request::post('password_confirmation');

			if ($password !== $confirmation) {

				$_SESSION['error'] = 'Konfirmasi password tidak sama.';

				$this->redirect('/register');
			}

			$userModel = new User();

			if ($userModel->findByUsername($username)) {

				$_SESSION['error'] = 'Username sudah digunakan.';

				$this->redirect('/register');
			}

			if ($userModel->findByEmail($email)) {

				$_SESSION['error'] = 'Email sudah digunakan.';

				$this->redirect('/register');
			}

			$userId = $userModel->create([
				'name' => $name,
				'username' => $username,
				'email' => $email,
				'password' => password_hash($password, PASSWORD_DEFAULT),
				'role' => 'peserta'
			]);

			$participant = new Participant();

			$participant->create([
				'user_id' => $userId,
				'phone' => $phone
			]);

			(new NotificationService())
				->registration([
					'name'  => $name,
					'email' => $email,
					'phone' => $phone
				]);


			$_SESSION['success'] = 'Registrasi berhasil. Silakan login.';

			$this->redirect('/login');
		}

		public function login(): void
		{
			$login = trim(Request::post('login'));

			$password = Request::post('password');

			$userModel = new User();

			$user = $userModel->findByLogin($login);

			if (!$user) {

				$_SESSION['error'] = 'Username/Email atau Password salah.';

				$this->redirect('/login');
			}

			if (!password_verify($password, $user['password'])) {

				$_SESSION['error'] = 'Username/Email atau Password salah.';

				$this->redirect('/login');
			}

			if ($user['status'] !== 'active') {

				$_SESSION['error'] = 'Akun telah dinonaktifkan.';

				$this->redirect('/login');
			}
			$userModel->updateLastLogin($user['id']);

			auth()->login($user);

			switch ($user['role']) {

				case 'admin':
					$this->redirect('/admin');

				case 'pegawai':
					$this->redirect('/pegawai');

				case 'peserta':
					$this->redirect('/peserta');

				default:
					$this->redirect('/login');
			}
		}

		public function logout(): void
		{
			auth()->logout();

			$this->redirect('/login');
		}
	}