<?php

	namespace Natasya\NataApp\Model;

	use Illuminate\Database\Eloquent\Relations\HasMany;
	use Natasya\NataApp\App\Model;

	class TrainingField extends Model
	{
		protected $table = 'training_fields';

		protected $fillable = [
			'name',
			'slug',
			'description',
			'icon',
			'color',
			'is_active',
		];

		protected $casts = [
			'is_active' => 'boolean',
		];

		/*
		|--------------------------------------------------------------------------
		| Relationships
		|--------------------------------------------------------------------------
		*/

		public function trainers(): HasMany
		{
			return $this->hasMany(Trainer::class);
		}

		public function trainings(): HasMany
		{
			return $this->hasMany(Training::class);
		}

		/*
		|--------------------------------------------------------------------------
		| Helpers
		|--------------------------------------------------------------------------
		*/

		public function isActive(): bool
		{
			return $this->is_active;
		}

		public function isInactive(): bool
		{
			return ! $this->is_active;
		}

		public function hasIcon(): bool
		{
			return ! empty($this->icon);
		}

		public function hasColor(): bool
		{
			return ! empty($this->color);
		}

		public function getIcon(): string
		{
			return $this->icon ?: 'ti ti-category';
		}

		public function getColor(): string
		{
			return $this->color ?: '#6C757D';
		}

		public function getDescription(): string
		{
			return $this->description ?: '-';
		}
	}
