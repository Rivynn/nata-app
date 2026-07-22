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
			$user = User::findOrFail(auth()->id());

			$this->view(
				'Profile/index',
				[
					'title' => 'Profil Saya',
					'user' => $user,
				]
			);
		}

		public function edit(): void
		{
			$user = User::findOrFail(auth()->id());

			$participant = Participant::firstOrCreate([
				'user_id' => $user->id,
			]);

			$this->view(
				'Profile/edit',
				[
					'title' => 'Ubah Profil',
					'user' => $user,
					'participant' => $participant,
				]
			);
		}

		public function update(): void
		{
			$name = trim(Request::post('name'));

			$email = trim(Request::post('email'));

			$phone = trim(Request::post('phone'));

			$user = User::findOrFail(auth()->id());

			/*
			|--------------------------------------------------------------------------
			| Validasi Email
			|--------------------------------------------------------------------------
			*/

			$exists = User::where('email', $email)
				->whereKeyNot($user->id)
				->exists();

			if ($exists) {

				error('Email sudah digunakan oleh pengguna lain.');

				redirect('/profile/edit');
			}

			/*
			|--------------------------------------------------------------------------
			| Update User
			|--------------------------------------------------------------------------
			*/

			$user->update([
				'name' => $name,
				'email' => $email,
			]);

			/*
			|--------------------------------------------------------------------------
			| Update Participant
			|--------------------------------------------------------------------------
			*/

			$participant = Participant::firstOrCreate([
				'user_id' => $user->id,
			]);

			$participant->update([
				'phone' => $phone,
			]);

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

					error(
						'Format avatar harus JPG, JPEG, PNG atau WEBP.'
					);

					redirect('/profile/edit');
				}

				if ($file['size'] > 2 * 1024 * 1024) {

					error(
						'Ukuran avatar maksimal 2 MB.'
					);

					redirect('/profile/edit');
				}

				$directory = public_path(
					'assets/uploads/avatars/'
				);

				if (!is_dir($directory)) {

					if (!mkdir($directory, 0755, true) && !is_dir($directory)) {
						throw new \RuntimeException(sprintf('Directory "%s" was not created', $directory));
					}

				}

				/*
				|--------------------------------------------------------------------------
				| Hapus Avatar Lama
				|--------------------------------------------------------------------------
				*/

				if ($user->avatar) {

					$oldFile = $directory . $user->avatar;

					if (file_exists($oldFile)) {

						unlink($oldFile);

					}

				}

				/*
				|--------------------------------------------------------------------------
				| Simpan Avatar
				|--------------------------------------------------------------------------
				*/

				$filename = 'user-' . $user->id . '.' . $extension;

				move_uploaded_file(
					$file['tmp_name'],
					$directory . $filename
				);

				$user->update([
					'avatar' => $filename,
				]);
			}

			auth()->refresh();

			success(
				'Profil berhasil diperbarui.'
			);

			redirect('/profile');
		}

		public function password(): void
		{
			$this->view(
				'Profile/password',
				[
					'title' => 'Ubah Password',
				]
			);
		}

		public function updatePassword(): void
		{
			$currentPassword = Request::post('current_password');

			$newPassword = Request::post('password');

			$confirmation = Request::post('password_confirmation');

			$user = User::findOrFail(auth()->id());

			if (!password_verify(
				$currentPassword,
				$user->password
			)) {

				error(
					'Password lama tidak sesuai.'
				);

				redirect('/profile/password');
			}

			if ($newPassword !== $confirmation) {

				error(
					'Konfirmasi password tidak sama.'
				);

				redirect('/profile/password');
			}

			if (strlen($newPassword) < 6) {

				error(
					'Password minimal 6 karakter.'
				);

				redirect('/profile/password');
			}

			$user->update([
				'password' => password_hash(
					$newPassword,
					PASSWORD_DEFAULT
				),
			]);

			success(
				'Password berhasil diubah.'
			);

			redirect('/profile/password');
		}
	}
