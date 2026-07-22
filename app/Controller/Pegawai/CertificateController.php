<?php

	namespace Natasya\NataApp\Controller\Pegawai;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Certificate;
	use Natasya\NataApp\Model\Registration;


	class CertificateController extends Controller
	{
		public function index(): void
		{

			$registrations = Registration::query()

				->with([

					'participant.user',

					'training.trainingField',

					'score',

					'certificate',

				])


				/*
				|--------------------------------------------------------------------------
				| Hanya peserta yang sudah punya nilai
				|--------------------------------------------------------------------------
				*/

				->whereHas('score')


				->latest()


				->get();





			$this->view(
				'Pegawai/Certificates/index',
				[

					'title' => 'Penerbitan Sertifikat',


					'registrations' => $registrations,

				]
			);

		}
		public function generate(): void
		{

			$registrationId = Request::post('registration_id');



			$registration = Registration::with([

				'score',

				'certificate',

			])

				->find($registrationId);





			if(!$registration){

				die('Data registrasi tidak ditemukan');

			}





			if($registration->certificate){


				die('Sertifikat sudah pernah diterbitkan');


			}





			if(!$registration->score){


				die('Peserta belum memiliki nilai');


			}





			if(!$registration->score->is_passed){


				die('Peserta belum dinyatakan lulus');


			}





			/*
			|--------------------------------------------------------------------------
			| Generate Certificate Number
			|--------------------------------------------------------------------------
			*/


			$number = Certificate::count() + 1;



			$certificateNumber = sprintf(

				'CERT-%s-%05d',

				date('Y'),

				$number

			);





			/*
			|--------------------------------------------------------------------------
			| Create Verification Code
			|--------------------------------------------------------------------------
			*/


			$verificationCode = strtoupper(

				bin2hex(random_bytes(5))

			);


			Certificate::create([


				'registration_id' => $registration->id,


				'certificate_number' => $certificateNumber,


				'verification_code' => $verificationCode,


				'issued_by' => null,


				'issued_at' => date('Y-m-d H:i:s'),


				'status' => 'active',


			]);





			redirect(
				'/pegawai/certificates'

			);

		}
		public function show(): void
		{

			$this->document();
			$id = Request::get('id');



			$certificate = Certificate::with([

				'issuer',

				'registration.participant.user',

				'registration.training.trainingField',

				'registration.score',

			])

				->find($id);





			if(!$certificate){

				die('Sertifikat tidak ditemukan');

			}





			/*
			|--------------------------------------------------------------------------
			| Generate QR Code
			|--------------------------------------------------------------------------
			*/


			/*
		|--------------------------------------------------------------------------
		| Generate QR Code
		|--------------------------------------------------------------------------
		*/

			$verifyUrl = url(
				'/verify/certificate?code=' .
				$certificate->verification_code
			);


			$generator = new \SimpleSoftwareIO\QrCode\Generator();


			$qrcode = $generator

				->format('svg')

				->size(150)

				->generate($verifyUrl);



			$this->view(
				'Pegawai/Certificates/show',
				[


					'title' => 'Detail Sertifikat',



					'certificate' => $certificate,



					'qrcode' => $qrcode,



				]
			);

		}

//		public function create(): void
//		{
//			$registration = new Registration();
//
//			$id = (int) Request::get('id');
//
//			$participant = $registration->find($id);
//
//			if (!$participant) {
//
//				$_SESSION['error'] = 'Peserta tidak ditemukan.';
//
//				$this->redirect('/pegawai/participants');
//			}
//
//			$this->view(
//				'Pegawai/Certificates/create',
//				[
//					'title' => 'Terbitkan Sertifikat',
//
//					'participant' => $participant,
//				]
//			);
//		}
//
//		/**
//		 * @throws \Random\RandomException
//		 */
//		public function store(): void
//		{
//			$certificate = new Certificate();
//
//			$registrationId = (int) Request::post('registration_id');
//
//			if ($certificate->existsByRegistration($registrationId)) {
//
//				$_SESSION['error'] = 'Peserta sudah memiliki sertifikat.';
//
//				$this->redirect('/pegawai/participants');
//			}
//
//			$number = trim(Request::post('number'));
//
//			if ($certificate->existsByNumber($number)) {
//				$_SESSION['error'] = 'Nomor sertifikat sudah digunakan.';
//
//				$this->redirect('/pegawai/certificates/create?id=' . $registrationId);
//			}
//
//			$issuedAt = Request::post('issued_at');
//
//			$expiredAt = Request::post('expired_at');
//
//			$certificate->create([
//
//				'registration_id' => $registrationId,
//
//				'certificate_number' => $number,
//
//				'verification_code' => strtoupper(
//					substr(md5(uniqid('', true)), 0, 16)
//				),
//
//				'file' => null,
//
//				'issued_at' => $issuedAt,
//
//			]);
//
//			$_SESSION['success'] = 'Sertifikat berhasil diterbitkan.';
//
//			$this->redirect('/pegawai/participants');
//		}
//
//		public function show(): void
//		{
//			$this->document();
//			$id = (int) Request::get('id');
//
//			$certificate = new Certificate();
//
//			$data = $certificate->find($id);
//
//			if (!$data) {
//
//				$_SESSION['error'] = 'Sertifikat tidak ditemukan.';
//
//				$this->redirect('/pegawai/participants');
//
//			}
//
//			$this->view(
//				'Pegawai/Certificates/show',
//				[
//
//					'title' => 'Sertifikat',
//
//					'certificate' => $data,
//
//				]
//			);
//		}
	}
