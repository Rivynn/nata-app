<?php

	namespace Natasya\NataApp\Services;

	class NotificationService
	{
		/**
		 * Master Notification.
		 */
		private bool $enabled;

		/**
		 * WhatsApp.
		 */
		private bool $whatsapp;

		/**
		 * Email.
		 */
		private bool $email;

		private WhatsAppService $whatsappService;

		private EmailService $emailService;

		public function __construct()
		{
			$this->enabled = config('notification.enabled', true);

			$this->whatsapp = config('notification.whatsapp', true);

			$this->email = config('notification.email', false);

			$this->whatsappService = new WhatsAppService();

			$this->emailService = new EmailService();
		}

		/**
		 * Apakah notification aktif.
		 */
		private function isEnabled(): bool
		{
			return $this->enabled;
		}

		/**
		 * Registrasi peserta baru.
		 *
		 * @throws \JsonException
		 */
		public function registration(array $user): void
		{
			if (!$this->isEnabled()) {
				return;
			}

			if ($this->whatsapp) {

				$this->whatsappService
					->notifyAdminRegistration($user);

				$this->whatsappService
					->notifyParticipantRegistration($user);

			}

			if ($this->email) {

				$this->emailService
					->notifyAdminRegistration($user);

			}
		}

		/**
		 * Peserta disetujui.
		 */
		public function approved(array $user): void
		{
			if (!$this->isEnabled()) {
				return;
			}

			if ($this->whatsapp) {

				$this->whatsappService
					->notifyParticipantApproved(
						$user['phone'],
						$user['name']
					);

			}

			if ($this->email) {

				$this->emailService
					->notifyParticipantApproved($user);

			}
		}

		/**
		 * Peserta ditolak.
		 */
		public function rejected(array $user): void
		{
			if (!$this->isEnabled()) {
				return;
			}

			if ($this->whatsapp) {

				$this->whatsappService
					->notifyParticipantRejected(
						$user['phone'],
						$user['name']
					);

			}

			if ($this->email) {

				$this->emailService
					->notifyParticipantRejected($user);

			}
		}

		/**
		 * Kirim custom notification.
		 */
		public function send(
			string $phone,
			string $email,
			string $subject,
			string $message
		): void
		{
			if (!$this->isEnabled()) {
				return;
			}

			if ($this->whatsapp) {

				$this->whatsappService
					->notify(
						$phone,
						$message
					);

			}

			if ($this->email) {

				$this->emailService
					->notify(
						$email,
						$subject,
						$message
					);

			}
		}
	}