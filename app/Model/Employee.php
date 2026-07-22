<?php

	namespace Natasya\NataApp\Model;

	use Illuminate\Database\Eloquent\Relations\BelongsTo;
	use Natasya\NataApp\App\Model;

	class Employee extends Model
	{
		protected $table = 'employees';

		protected $fillable = [
			'user_id',
			'employee_number',
			'phone',
			'position',
			'department',
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

		/*
		|--------------------------------------------------------------------------
		| Helpers
		|--------------------------------------------------------------------------
		*/

		public function hasPhone(): bool
		{
			return ! empty($this->phone);
		}

		public function hasDepartment(): bool
		{
			return ! empty($this->department);
		}

		public function hasPosition(): bool
		{
			return ! empty($this->position);
		}

		public function getDisplayName(): string
		{
			return $this->user?->getDisplayName() ?? '-';
		}

		public function getDepartmentLabel(): string
		{
			return $this->department ?: '-';
		}

		public function getPositionLabel(): string
		{
			return $this->position ?: '-';
		}
	}
