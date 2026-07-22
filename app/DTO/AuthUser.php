<?php

	namespace Natasya\NataApp\DTO;

	use Natasya\NataApp\Model\User;

	final  class AuthUser
	{
		public function __construct(
			public int $id,
			public string $username,
			public string $name,
			public string $email,
			public string $role,
			public string $status,
			public ?string $avatar,
		) {}
		public static function fromUser(User $user): self
		{
			return new self(
				id: $user->id,
				username: $user->username,
				name: $user->name,
				email: $user->email,
				role: $user->role,
				status: $user->status,
				avatar: $user->avatar,
			);
		}
		public static function fromArray(array $data): self
		{
			return new self(
				id: (int) $data['id'],
				username: (string) $data['username'],
				name: (string) $data['name'],
				email: (string) $data['email'],
				role: (string) $data['role'],
				status: (string) $data['status'],
				avatar: $data['avatar'] ?? null,
			);
		}

		public function toArray(): array
		{
			return [
				'id' => $this->id,
				'username' => $this->username,
				'name' => $this->name,
				'email' => $this->email,
				'role' => $this->role,
				'status' => $this->status,
				'avatar' => $this->avatar,
			];
		}
	}
