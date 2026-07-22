<?php

	namespace Natasya\NataApp\Model;

	use Illuminate\Database\Eloquent\Relations\BelongsTo;
	use Illuminate\Database\Eloquent\Relations\HasMany;
	use Natasya\NataApp\App\Model;

	class Trainer extends Model
	{
		protected $table = 'trainers';

		protected $fillable = [
			'user_id',
			'training_field_id',
			'employee_number',
			'phone',
			'email',
			'institution',
			'expertise',
			'specialization',
			'experience_year',
			'biography',
			'avatar',
			'status',
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

		public function trainingField(): BelongsTo
		{
			return $this->belongsTo(TrainingField::class);
		}

		public function trainings(): HasMany
		{
			return $this->hasMany(Training::class);
		}

		public function scores(): HasMany
		{
			return $this->hasMany(TrainingScore::class);
		}

		/*
		|--------------------------------------------------------------------------
		| Helpers
		|--------------------------------------------------------------------------
		*/

		public function isActive(): bool
		{
			return $this->status === 'active';
		}

		public function isInactive(): bool
		{
			return $this->status === 'inactive';
		}

		public function hasAvatar(): bool
		{
			return ! empty($this->avatar);
		}

		public function hasEmployeeNumber(): bool
		{
			return ! empty($this->employee_number);
		}

		public function getDisplayName(): string
		{
			return $this->user?->getDisplayName() ?? '-';
		}

		public function getInstitution(): string
		{
			return $this->institution ?: '-';
		}

		public function getExpertise(): string
		{
			return $this->expertise ?: '-';
		}

		public function getSpecialization(): string
		{
			return $this->specialization ?: '-';
		}

		public function getExperienceLabel(): string
		{
			if (! $this->experience_year) {
				return '-';
			}

			return $this->experience_year . ' Tahun';
		}
	}
