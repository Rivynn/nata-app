<?php

	namespace Natasya\NataApp\Controller;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Participant;
	use Natasya\NataApp\Model\User;

	class ProfileController extends Controller
	{
		public function index(): void
		{
			$this->view(
				'Profile/index',
				[
					'title' => 'Profil Saya'
				]
			);
		}
		public function edit(): void
		{
			$this->view(
				'Profile/edit',
				[
					'title' => 'Ubah Profil'
				]
			);
		}
		public function update(): void
		{
			$name = trim(Request::post('name'));

			$email = trim(Request::post('email'));

			$phone = trim(Request::post('phone'));

			$userModel = new User();

			if ($userModel->emailExists($email, auth()->id())) {

				$_SESSION['error'] = 'Email sudah digunakan oleh pengguna lain.';

				$this->redirect('/profile/edit');
			}

			$participant = new Participant();

			/*
			|--------------------------------------------------------------------------
			| Update User
			|--------------------------------------------------------------------------
			*/

			$userModel->updateProfile(
				auth()->id(),
				[
					'name'  => $name,
					'email' => $email,
				]
			);

			/*
			|--------------------------------------------------------------------------
			| Update Participant
			|--------------------------------------------------------------------------
			*/

			$participant->updateProfile(
				auth()->id(),
				[
					'phone' => $phone,
				]
			);

			/*
			|--------------------------------------------------------------------------
			| Upload Avatar
			|--------------------------------------------------------------------------
			*/

			if (
				isset($_FILES['avatar']) &&
				$_FILES['avatar']['error'] === UPLOAD_ERR_OK
			) {

				$file = $_FILES['avatar'];

				$extension = strtolower(
					pathinfo(
						$file['name'],
						PATHINFO_EXTENSION
					)
				);

				$allowed = [
					'jpg',
					'jpeg',
					'png',
					'webp',
				];

				if (!in_array($extension, $allowed, true)) {

					$_SESSION['error'] = 'Format avatar harus JPG, JPEG, PNG atau WEBP.';

					$this->redirect('/profile/edit');
				}

				/*
				|--------------------------------------------------------------------------
				| Maksimal 2 MB
				|--------------------------------------------------------------------------
				*/

				if ($file['size'] > 2 * 1024 * 1024) {

					$_SESSION['error'] = 'Ukuran avatar maksimal 2 MB.';

					$this->redirect('/profile/edit');
				}

				$directory = public_path('assets/uploads/avatars/');

				if (!is_dir($directory)) {

					if (!mkdir($directory,
							0755,
							true) && !is_dir($directory)) {
						throw new \RuntimeException(sprintf('Directory "%s" was not created', $directory));
					}

				}

				/*
				|--------------------------------------------------------------------------
				| Hapus Avatar Lama
				|--------------------------------------------------------------------------
				*/

				if ($oldAvatar = $userModel->avatar(auth()->id())) {

					$oldFile = public_path(
						'assets/uploads/avatars/' . $oldAvatar
					);

					if (file_exists($oldFile)) {

						unlink($oldFile);

					}

				}

				/*
				|--------------------------------------------------------------------------
				| Simpan Avatar
				|--------------------------------------------------------------------------
				*/

				$filename = 'user-' . auth()->id() . '.' . $extension;

				move_uploaded_file(
					$file['tmp_name'],
					$directory . $filename
				);

				$userModel->updateAvatar(
					auth()->id(),
					$filename
				);
			}

			auth()->refresh();

			$_SESSION['success'] = 'Profil berhasil diperbarui.';

			$this->redirect('/profile');
		}
		public function password(): void
		{
			$this->view(
				'Profile/password',
				[
					'title' => 'Ubah Password'
				]
			);
		}
		public function updatePassword(): void
		{
			$currentPassword = Request::post('current_password');
			$newPassword = Request::post('password');
			$confirmation = Request::post('password_confirmation');

			$user = auth()->user();

			if (!password_verify($currentPassword, $user['password'])) {

				$_SESSION['error'] = 'Password lama tidak sesuai.';

				redirect('/profile/password');
			}

			if ($newPassword !== $confirmation) {

				$_SESSION['error'] = 'Konfirmasi password tidak sama.';

				redirect('/profile/password');
			}

			if (strlen($newPassword) < 6) {

				$_SESSION['error'] = 'Password minimal 6 karakter.';

				redirect('/profile/password');
			}

			$userModel = new User();

			$userModel->updatePassword(
				$user['id'],
				password_hash($newPassword, PASSWORD_DEFAULT)
			);

			$_SESSION['success'] = 'Password berhasil diubah.';

			redirect('/profile/password');
		}
	}