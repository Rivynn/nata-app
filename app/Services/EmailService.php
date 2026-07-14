<?php

	namespace Natasya\NataApp\Services;

	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\PHPMailer;

	class EmailService
	{
		private bool $enabled;

		private string $fromEmail;

		private string $fromName;

		private string $adminEmail;

		public function __construct()
		{
			$this->enabled = config('mail.enabled', false);

			$this->fromEmail = config('mail.from_email');

			$this->fromName = config('mail.from_name');

			$this->adminEmail = config('mail.admin_email');
		}

		/**
		 * Kirim Email
		 */
		/**
		 * Kirim Email.
		 */
		public function send(
			string $to,
			string $subject,
			string $message
		): bool
		{
			if (!$this->enabled) {
				return false;
			}

			$mail = new PHPMailer(true);

			try {


				/*
				|--------------------------------------------------------------------------
				| Debug (sementara)
				|--------------------------------------------------------------------------
				*/
//
//				$mail->SMTPDebug = 3;
//				$mail->Debugoutput = 'html';

				/*
				|--------------------------------------------------------------------------
				| SMTP
				|--------------------------------------------------------------------------
				*/

				$mail->isSMTP();

				$mail->Host = config('mail.host');

				$mail->SMTPAuth = true;

				$mail->Username = config('mail.username');

				$mail->Password = config('mail.password');

				$mail->Port = (int) config('mail.port');

				/*
				|--------------------------------------------------------------------------
				| Encryption
				|--------------------------------------------------------------------------
				*/

				$mail->SMTPSecure = match (config('mail.encryption')) {
					'ssl' => PHPMailer::ENCRYPTION_SMTPS,
					'tls' => PHPMailer::ENCRYPTION_STARTTLS,
					default => false,
				};

				/*
				|--------------------------------------------------------------------------
				| SSL Options
				|--------------------------------------------------------------------------
				*/

				$mail->SMTPOptions = [

					'ssl' => [

						'verify_peer'       => false,

						'verify_peer_name'  => false,

						'allow_self_signed' => true,

					],

				];

				/*
				|--------------------------------------------------------------------------
				| Charset
				|--------------------------------------------------------------------------
				*/

				$mail->CharSet = 'UTF-8';

				$mail->Encoding = 'base64';

				/*
				|--------------------------------------------------------------------------
				| Sender
				|--------------------------------------------------------------------------
				*/

				$mail->setFrom(

					config('mail.from_email'),

					config('mail.from_name')

				);

				/*
				|--------------------------------------------------------------------------
				| Recipient
				|--------------------------------------------------------------------------
				*/

				$mail->addAddress($to);

				/*
				|--------------------------------------------------------------------------
				| Content
				|--------------------------------------------------------------------------
				*/

				$mail->isHTML(true);

				$mail->Subject = $subject;

				$mail->Body = $message;

				$mail->AltBody = strip_tags($message);

				/*
				|--------------------------------------------------------------------------
				| Send
				|--------------------------------------------------------------------------
				*/

				if (!$mail->send()) {


					return false;

				}

				return true;

			} catch (Exception $e) {


				return false;

			}

		}

		/**
		 * Admin mendapat pendaftaran baru.
		 */
		public function notifyAdminRegistration(array $user): bool
		{
			$subject = "Pendaftaran Peserta Baru";

			$message = "
            <h2>Pendaftaran Peserta Baru</h2>

            <table cellpadding='6'>

                <tr>
                    <td>Nama</td>
                    <td>: {$user['name']}</td>
                </tr>

                <tr>
                    <td>Email</td>
                    <td>: {$user['email']}</td>
                </tr>

                <tr>
                    <td>Telepon</td>
                    <td>: {$user['phone']}</td>
                </tr>

            </table>

            <br>

            Silakan login ke sistem untuk melakukan verifikasi.
        ";

			return $this->send(
				$this->adminEmail,
				$subject,
				$message
			);
		}

		/**
		 * Peserta disetujui.
		 */
		public function notifyParticipantApproved(array $user): bool
		{
			$subject = "Pendaftaran Disetujui";

			$message = "
            Halo <b>{$user['name']}</b>,
            <br><br>

            Selamat 🎉

            <br><br>

            Pendaftaran Anda telah disetujui.

            <br><br>

            Silakan login ke aplikasi.

            <br><br>

            Terima kasih.
        ";

			return $this->send(
				$user['email'],
				$subject,
				$message
			);
		}

		/**
		 * Peserta ditolak.
		 */
		public function notifyParticipantRejected(array $user): bool
		{
			$subject = "Pendaftaran Ditolak";

			$message = "
            Halo <b>{$user['name']}</b>,
            <br><br>

            Mohon maaf.

            <br><br>

            Pendaftaran Anda belum dapat kami setujui.

            <br><br>

            Silakan menghubungi administrator.

            <br><br>

            Terima kasih.
        ";

			return $this->send(
				$user['email'],
				$subject,
				$message
			);
		}
		/**
		 * Test template registrasi.
		 */
		public function testRegistration(string $email): bool
		{
			return $this->notifyAdminRegistration([

				'name'  => 'Michee Puding',

				'email' => $email,

				'phone' => '6283842156390',

			]);
		}


		/**
		 * Custom Email
		 */
		public function notify(
			string $email,
			string $subject,
			string $message
		): bool
		{
			return $this->send(
				$email,
				$subject,
				$message
			);
		}
	}