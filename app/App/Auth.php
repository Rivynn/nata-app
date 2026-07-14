<?php

	namespace Natasya\NataApp\App;

	use Natasya\NataApp\Model\User;

	class Auth
	{
		private string $session = 'user';

		public function check(): bool
		{
			return isset($_SESSION[$this->session]);
		}

		public function guest(): bool
		{
			return !$this->check();
		}

		public function user(): ?array
		{
			return $_SESSION[$this->session] ?? null;
		}
		public function refresh(): void
		{
			if (!$this->check()) {
				return;
			}

			$userModel = new User();

			$user = $userModel->findById($this->id());

			if (!$user) {

				$this->logout();

				return;
			}

			$_SESSION['user'] = $user;
		}

		public function id(): int|string|null
		{
			return $this->user()['id'] ?? null;
		}

		public function role(): ?string
		{
			return $this->user()['role'] ?? null;
		}

		public function hasRole(string|array $roles): bool
		{
			if (!$this->check()) {
				return false;
			}

			return in_array(
				$this->role(),
				(array) $roles,
				true
			);
		}

		public function login(array $user): void
		{
			$_SESSION[$this->session] = $user;
		}

		public function logout(): void
		{
			unset($_SESSION[$this->session]);

			session_destroy();
		}
	}