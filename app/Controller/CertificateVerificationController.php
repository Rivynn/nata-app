<?php

	namespace Natasya\NataApp\Controller;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Certificate;

	class CertificateVerificationController extends Controller
	{
		public function verify(): void
		{

			$this->document();

			$code = Request::get('code');



			if(!$code){


				$this->view(
					'Verify/certificate',
					[

						'title' => 'Verifikasi Sertifikat',

						'valid' => false,

						'certificate' => null,

					]
				);


				return;

			}




			$certificate = Certificate::query()

				->with([

					'registration.participant.user',

					'registration.training.trainingField',

					'issuer',

				])

				->where(
					'verification_code',
					$code
				)

				->first();





			$this->view(
				'Verify/certificate',
				[


					'title' => 'Verifikasi Sertifikat',



					'valid' => (bool) $certificate,



					'certificate' => $certificate,


				]
			);



		}

	}
