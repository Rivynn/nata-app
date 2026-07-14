<?php

	namespace Natasya\NataApp\Controller\Pegawai;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Certificate;
	use Natasya\NataApp\Model\Registration;

	class CertificateController extends Controller
	{
		public function create(): void
		{
			$registration = new Registration();

			$id = (int) Request::get('id');

			$participant = $registration->find($id);

			if (!$participant) {

				$_SESSION['error'] = 'Peserta tidak ditemukan.';

				$this->redirect('/pegawai/participants');
			}

			$this->view(
				'Pegawai/Certificates/create',
				[
					'title' => 'Terbitkan Sertifikat',

					'participant' => $participant,
				]
			);
		}

		/**
		 * @throws \Random\RandomException
		 */
		public function store(): void
		{
			$certificate = new Certificate();

			$registrationId = (int) Request::post('registration_id');

			$number = trim(Request::post('number'));

			$issuedAt = Request::post('issued_at');

			$expiredAt = Request::post('expired_at');

			$certificate->create([

				'registration_id' => $registrationId,

				'certificate_number' => $number,

				'verification_code' => strtoupper(
					substr(md5(uniqid('', true)), 0, 16)
				),

				'file' => null,

				'issued_at' => $issuedAt,

			]);

			$_SESSION['success'] = 'Sertifikat berhasil diterbitkan.';

			$this->redirect('/pegawai/participants');
		}

		public function show(): void
		{
			$this->document();
			$id = (int) Request::get('id');

			$certificate = new Certificate();

			$data = $certificate->find($id);

			if (!$data) {

				$_SESSION['error'] = 'Sertifikat tidak ditemukan.';

				$this->redirect('/pegawai/participants');

			}

			$this->view(
				'Pegawai/Certificates/show',
				[

					'title' => 'Sertifikat',

					'certificate' => $data,

				]
			);
		}
	}