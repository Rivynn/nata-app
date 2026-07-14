<?php

	namespace Natasya\NataApp\Controller\Peserta;

	use JetBrains\PhpStorm\NoReturn;
	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Certificate;

	class CertificateController extends Controller
	{
		/**
		 * Daftar sertifikat peserta.
		 */
		public function index(): void
		{
			$certificate = new Certificate();

			$this->view(
				'Peserta/Certificates/index',
				[
					'title' => 'Sertifikat Saya',

					'certificates' => $certificate->byUser(
						auth()->id()
					),
				]
			);
		}

		/**
		 * Lihat sertifikat.
		 */
		public function show(): void
		{
			$this->document();
			$id = (int) Request::get('id');

			$certificate = new Certificate();

			$data = $certificate->find($id);

			if (!$data) {

				http_response_code(404);

				exit('Sertifikat tidak ditemukan.');

			}

			/*
			|--------------------------------------------------------------------------
			| Keamanan
			|--------------------------------------------------------------------------
			*/

			if ($data['user_id'] != auth()->id()) {

				http_response_code(403);

				exit('Akses ditolak.');

			}

			$this->view(
				'Peserta/Certificates/show',
				[
					'title' => 'Sertifikat',

					'certificate' => $data,
				]
			);
		}
	}