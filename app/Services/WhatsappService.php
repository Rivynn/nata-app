<?php

	namespace Natasya\NataApp\Services;

	class WhatsappService
	{
		/**
		 * Endpoint API
		 */
		private string $url;

		/**
		 * Token API
		 */
		private string $token;

		/**
		 * Admin Phone
		 */
		private string $admin;

		public function __construct()
		{
			$this->url = config('fontee.url');
			$this->token = config('fontee.token');
			$this->admin = config('fontee.admin_phone');
		}

		/**
		 * Mengirim pesan WhatsApp.
		 */
		public function send(
			string $phone,
			string $message
		): bool
		{
			$ch = curl_init();

			curl_setopt_array($ch, [

				CURLOPT_URL => $this->url,

				CURLOPT_RETURNTRANSFER => true,

				CURLOPT_ENCODING => '',

				CURLOPT_MAXREDIRS => 10,

				CURLOPT_TIMEOUT => 30,

				CURLOPT_FOLLOWLOCATION => true,

				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

				CURLOPT_CUSTOMREQUEST => 'POST',

				CURLOPT_POSTFIELDS => [

					'target' => $phone,

					'message' => $message,

				],

				CURLOPT_HTTPHEADER => [

					'Authorization: '.$this->token,

				],

			]);

			$response = curl_exec($ch);

			if ($response === false) {

				dd([
					'curl_error' => curl_error($ch),
					'curl_errno' => curl_errno($ch),
				]);

			}

			$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			curl_close($ch);


			return $status === 200
				&& isset($result['status'])
				&& $result['status'];
		}

		/**
		 * Notifikasi Admin
		 *
		 * @throws \JsonException
		 */
		public function notifyAdminRegistration(array $user): bool
		{
			$message =
				"🔔 *NOTIFIKASI PENDAFTARAN PESERTA BARU*\n\n".

				"Yth. Admin,\n\n".

				"Telah diterima satu pendaftaran peserta baru melalui aplikasi *".app_name()."* dengan rincian sebagai berikut:\n\n".

				"━━━━━━━━━━━━━━━━━━━━━━\n".

				"👤 *Nama Peserta*\n".
				"{$user['name']}\n\n".

				"📧 *Email*\n".
				"{$user['email']}\n\n".

				"📱 *Nomor Telepon*\n".
				"{$user['phone']}\n\n".

				"🕒 *Waktu Pendaftaran*\n".
				date('d F Y, H:i').' WIB'."\n".

				"━━━━━━━━━━━━━━━━━━━━━━\n\n".

				"Mohon segera melakukan verifikasi dan persetujuan pendaftaran melalui dashboard administrator.\n\n".

				"Terima kasih.\n\n".

				"— ".app_name();

			return $this->send(
				$this->admin,
				$message
			);
		}

		/**
		 * Notifikasi ke peserta setelah register.
		 *
		 * @throws \JsonException
		 */
		public function notifyParticipantRegistration(array $user): bool
		{
			$message =
				"🎉 *Pendaftaran Berhasil*\n\n".

				"Halo *{$user['name']}*,\n\n".

				"Terima kasih telah melakukan pendaftaran pada sistem pelatihan.\n\n".

				"📌 Status pendaftaran Anda saat ini:\n".
				"⏳ *Menunggu Verifikasi Admin*\n\n".

				"Silakan menunggu hingga admin melakukan verifikasi data Anda.\n\n".

				"Anda akan menerima notifikasi kembali apabila pendaftaran telah disetujui atau ditolak.\n\n".

				"Terima kasih.";

			return $this->send(
				$user['phone'],
				$message
			);
		}

		/**
		 * Peserta disetujui
		 */
		public function notifyParticipantApproved(
			string $phone,
			string $name
		): bool
		{
			$message =
				"🎉 Halo {$name}\n\n" .

				"Pendaftaran Anda telah *DISETUJUI*.\n\n" .

				"Silakan login ke aplikasi.\n\n" .

				"Terima kasih.";

			return $this->send(
				$phone,
				$message
			);
		}

		/**
		 * Peserta ditolak
		 */
		public function notifyParticipantRejected(
			string $phone,
			string $name
		): bool
		{
			$message =
				"Halo {$name}\n\n" .

				"Mohon maaf.\n\n" .

				"Pendaftaran Anda belum dapat kami setujui.\n\n" .

				"Silakan hubungi admin untuk informasi lebih lanjut.";

			return $this->send(
				$phone,
				$message
			);
		}

		/**
		 * Custom Message
		 */
		public function notify(
			string $phone,
			string $message
		): bool
		{
			return $this->send(
				$phone,
				$message
			);
		}
	}