<?php

	namespace Natasya\NataApp\Model;

	use Illuminate\Database\Eloquent\Relations\BelongsTo;
	use Illuminate\Database\Eloquent\Relations\HasMany;
	use Illuminate\Database\Eloquent\Relations\HasOne;
	use Natasya\NataApp\App\Model;
	use function Illuminate\Support\now;

	class Participant extends Model
	{
		protected $table = 'participants';

		protected $fillable = [
			'user_id',
			'phone',
			'gender',
			'birth_date',
			'address',
			'education',
			'institution',
		];
		protected $casts = [
			'birth_date' => 'date',
		];


		/*
		|--------------------------------------------------------------------------
		| Relationships
		|--------------------------------------------------------------------------
		*/

		public function user(): BelongsTo
		{
			return $this->belongsTo(User::class);
		}

		public function profile(): HasOne
		{
			return $this->hasOne(ParticipantProfile::class);
		}

		public function registrations(): HasMany
		{
			return $this->hasMany(Registration::class);
		}

		/*
		|--------------------------------------------------------------------------
		| Helpers
		|--------------------------------------------------------------------------
		*/

		public function hasProfile(): bool
		{
			return $this->profile()->exists();
		}

		public function isProfileCompleted(): bool
		{
			return (bool) optional($this->profile)->is_completed;
		}

		public function getGenderLabel(): string
		{
			return match ($this->gender) {
				'L' => 'Laki-laki',
				'P' => 'Perempuan',
				default => '-',
			};
		}

		public function getAge(): ?int
		{
			if (! $this->birth_date) {
				return null;
			}

			return now()->parse($this->birth_date)->age;
		}

		public function getFullAddress(): string
		{
			return $this->address ?: '-';
		}
	}
