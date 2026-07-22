<?php

	namespace Natasya\NataApp\Model;

	use Illuminate\Database\Eloquent\Relations\HasOne;
	use Natasya\NataApp\App\Model;

	class User extends Model
	{
		protected $table = 'users';

		protected $fillable = [
			'name',
			'username',
			'email',
			'avatar',
			'password',
			'role',
			'status',
			'last_login_at',
		];

		protected $hidden = [
			'password',
		];

		protected $casts = [
			'last_login_at' => 'datetime',
		];

		/*
		|--------------------------------------------------------------------------
		| Relationships
		|--------------------------------------------------------------------------
		*/

		public function participant(): HasOne
		{
			return $this->hasOne(Participant::class);
		}

		public function employee(): HasOne
		{
			return $this->hasOne(Employee::class);
		}

		public function trainer(): HasOne
		{
			return $this->hasOne(Trainer::class);
		}

		/*
		|--------------------------------------------------------------------------
		| Helpers
		|--------------------------------------------------------------------------
		*/

		public function isAdmin(): bool
		{
			return $this->role === 'admin';
		}

		public function isEmployee(): bool
		{
			return $this->role === 'employee';
		}

		public function isTrainer(): bool
		{
			return $this->role === 'trainer';
		}

		public function isParticipant(): bool
		{
			return $this->role === 'participant';
		}

		public function isActive(): bool
		{
			return $this->status === 'active';
		}

		public function isInactive(): bool
		{
			return $this->status === 'inactive';
		}

		public function isBanned(): bool
		{
			return $this->status === 'banned';
		}

		public function hasAvatar(): bool
		{
			return ! empty($this->avatar);
		}

		public function getInitials(): string
		{
			$name = trim($this->name ?: $this->username);

			if ($name === '') {
				return '?';
			}

			$words = preg_split('/\s+/', $name);

			if (count($words) === 1) {
				return strtoupper(substr($words[0], 0, 2));
			}

			return strtoupper(
				substr($words[0], 0, 1) .
				substr(end($words), 0, 1)
			);
		}

		public function getDisplayName(): string
		{
			return $this->name ?: $this->username;
		}
	}
