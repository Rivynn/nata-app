<?php

	namespace Natasya\NataApp\App;

	use Natasya\NataApp\DTO\AuthUser;
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
			return ! $this->check();
		}

		public function user(): ?AuthUser
		{
			if (! isset($_SESSION[$this->session])) {
				return null;
			}

			return AuthUser::fromArray($_SESSION[$this->session]);
		}
		public function refresh(): void
		{
			if ($this->guest()) {
				return;
			}

			$user = User::find($this->id());

			if (! $user) {
				$this->logout();
				return;
			}

			$this->login($user);
		}

		public function id(): ?int
		{
			return $this->user()->id ?? null;
		}

		public function role(): ?string
		{
			return $this->user()->role ?? null;
		}

		public function hasRole(string|array $roles): bool
		{
			if ($this->guest()) {
				return false;
			}

			return in_array(
				$this->role(),
				(array) $roles,
				true
			);
		}

		public function login(User $user): void
		{
			session_regenerate_id(true);

			$_SESSION[$this->session] = AuthUser::fromUser($user)
				->toArray();
		}

		public function logout(): void
		{
			unset($_SESSION[$this->session]);

			if (session_status() === PHP_SESSION_ACTIVE) {

				session_regenerate_id(true);

				session_destroy();
			}
		}
	}

