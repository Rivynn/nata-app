<?php

	namespace Natasya\NataApp\Controller;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Participant;
	use Natasya\NataApp\Model\User;
	use Natasya\NataApp\Services\NotificationService;
	use function Illuminate\Support\now;

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

				error('Konfirmasi password tidak sama.');

				$this->redirect('/register');
			}

			if (User::where('username', $username)->exists()) {

				error('Username sudah digunakan.');

				$this->redirect('/register');
			}

			if (User::where('email', $email)->exists()) {

				error('Email sudah digunakan.');

				$this->redirect('/register');
			}

			$user = User::create([
				'name' => $name,
				'username' => $username,
				'email' => $email,
				'password' => password_hash($password, PASSWORD_DEFAULT),
				'role' => 'peserta',
				'status' => 'active',
			]);

			Participant::create([
				'user_id' => $user->id,
				'phone' => $phone,
			]);

//			(new NotificationService())->registration([
//				'name' => $name,
//				'email' => $email,
//				'phone' => $phone,
//			]);
			success('Registrasi berhasil. Silakan login.');

			$this->redirect('/login');
		}

		public function login(): void
		{
			$login = trim(Request::post('login'));
			$password = Request::post('password');

			$user = User::where('username', $login)
				->orWhere('email', $login)
				->first();

			if (! $user || ! password_verify($password, $user->password)) {

				error('Username/Email atau Password salah.');

				$this->redirect('/login');
			}

			if ($user->status !== 'active') {

				error('Akun telah dinonaktifkan.');

				$this->redirect('/login');
			}

			$user->update([
				'last_login_at' => now(),
			]);

			auth()->login($user);



			switch ($user->role) {

				case 'admin':

					$this->redirect('/admin');
					break;

				case 'pegawai':
					$this->redirect('/pegawai');
					break;

				case 'peserta':
					$this->redirect('/peserta');
					break;

				case 'pelatih':
					$this->redirect('/pelatih');
					break;

				default:
					auth()->logout();
					$this->redirect('/login');
			}
		}

		public function logout(): void
		{
			auth()->logout();

			$this->redirect('/login');
		}
	}
