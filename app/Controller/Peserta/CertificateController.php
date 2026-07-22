<?php

	namespace Natasya\NataApp\Controller\Peserta;

	use JetBrains\PhpStorm\NoReturn;
	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Certificate;
	use Natasya\NataApp\Model\Participant;

	class CertificateController extends Controller
	{
		/**
		 * Daftar sertifikat peserta.
		 */
		public function index(): void
		{
			$participant = Participant::where(
				'user_id',
				auth()->id()
			)->firstOrFail();

			$certificates = Certificate::with([
				'registration.training.trainingField',
				'registration.score',
			])
				->whereHas('registration', function ($query) use ($participant) {

					$query->where(
						'participant_id',
						$participant->id
					);

				})
				->latest()
				->get();

			$this->view(
				'Peserta/Certificates/index',
				[
					'title' => 'Sertifikat Saya',

					'certificates' => $certificates,
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

			$participant = Participant::where(
				'user_id',
				auth()->id()
			)->firstOrFail();

			$certificate = Certificate::with([
				'registration.training.trainingField',
				'registration.training.trainer.user',
				'registration.score',
			])
				->whereKey($id)
				->whereHas('registration', function ($query) use ($participant) {

					$query->where(
						'participant_id',
						$participant->id
					);

				})
				->first();

			if (! $certificate) {

				http_response_code(404);

				exit('Sertifikat tidak ditemukan.');
			}

			$this->view(
				'Peserta/Certificates/show',
				[
					'title' => 'Sertifikat',

					'certificate' => $certificate,
				]
			);
		}
	}
