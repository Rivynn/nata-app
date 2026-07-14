<?php

	namespace Natasya\NataApp\Controller\Pegawai;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Registration;

	class VerificationController extends Controller
	{
		/**
		 * Daftar verifikasi.
		 */
		public function index(): void
		{
			$registration = new Registration();

			$this->view(
				'Pegawai/Verifications/index',
				[
					'title' => 'Verifikasi Peserta',

					'registrations' => $registration->pending(),

					'pending' => $registration->countByStatus('pending'),

					'approved' => $registration->countByStatus('approved'),

					'rejected' => $registration->countByStatus('rejected'),
				]
			);
		}

		/**
		 * Detail pendaftaran.
		 */
		public function show(): void
		{
			$id = (int) Request::get('id');

			$registration = new Registration();

			$data = $registration->find($id);

			if (!$data) {

				$_SESSION['error'] = 'Data tidak ditemukan.';

				$this->redirect('/pegawai/verifications');
			}

			$this->view(
				'Pegawai/Verifications/show',
				[
					'title' => 'Detail Verifikasi',

					'registration' => $data,
				]
			);
		}

		/**
		 * Setujui pendaftaran.
		 */
		public function approve(): void
		{
			$id = (int) Request::post('id');

			$registration = new Registration();

			$data = $registration->find($id);

			if (!$data) {

				$_SESSION['error'] = 'Data tidak ditemukan.';

				$this->redirect('/pegawai/verifications');
			}

			$registration->approve(
				$id,
				auth()->id()
			);

			/*
			|--------------------------------------------------------------------------
			| Notification
			|--------------------------------------------------------------------------
			*/
			$_SESSION['success'] = 'Peserta berhasil disetujui.';

			$this->redirect('/pegawai/verifications');
		}

		/**
		 * Tolak pendaftaran.
		 */
		public function reject(): void
		{
			$id = (int) Request::post('id');

			$reason = trim(
				Request::post('reason')
			);

			$registration = new Registration();

			$data = $registration->find($id);

			if (!$data) {

				$_SESSION['error'] = 'Data tidak ditemukan.';

				$this->redirect('/pegawai/verifications');
			}

			$registration->reject(
				$id,
				auth()->id(),
				$reason
			);

			/*
			|--------------------------------------------------------------------------
			| Notification
			|--------------------------------------------------------------------------
			*/


			$_SESSION['success'] = 'Pendaftaran berhasil ditolak.';

			$this->redirect('/pegawai/verifications');
		}
	}