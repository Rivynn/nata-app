<?php

	namespace Natasya\NataApp\Controller;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\Services\EmailService;
	use Natasya\NataApp\Services\NotificationService;

	class TestController extends Controller
	{
		/**
		 * @throws \JsonException
		 */
		public function notification(): void
		{
			$user = [

				'name'  => 'Michee Puding',

				'email' => 'rizkifirdaus2902@gmail.com',

				'phone' => '6283842156390',

			];

			$subject = 'Pendaftaran Peserta Baru';

			$message = "
            <h2>Pendaftaran Peserta Baru</h2>

            <table cellpadding='6' cellspacing='0' border='0'>

                <tr>
                    <td><b>Nama</b></td>
                    <td>: {$user['name']}</td>
                </tr>

                <tr>
                    <td><b>Email</b></td>
                    <td>: {$user['email']}</td>
                </tr>

                <tr>
                    <td><b>Telepon</b></td>
                    <td>: {$user['phone']}</td>
                </tr>

            </table>

            <br>

            Silakan login ke sistem untuk melakukan verifikasi.
        ";

			$result = (new EmailService())->send(
				$user['email'],
				$subject,
				$message
			);

			echo $result
				? '✅ Email berhasil dikirim.'
				: '❌ Email gagal dikirim.';
		}
	}