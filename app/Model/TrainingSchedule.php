<?php

	namespace Natasya\NataApp\Model;

	use Illuminate\Database\Eloquent\Relations\BelongsTo;
	use Illuminate\Database\Eloquent\Relations\HasMany;
	use Natasya\NataApp\App\Model;

	class TrainingSchedule extends Model
	{
		protected $table = 'training_schedules';

		protected $fillable = [
			'training_id',
			'meeting_number',
			'topic',
			'description',
			'schedule_date',
			'start_time',
			'end_time',
			'room',
		];

		protected $casts = [
			'schedule_date' => 'date',
		];

		/*
		|--------------------------------------------------------------------------
		| Relationships
		|--------------------------------------------------------------------------
		*/

		public function training(): BelongsTo
		{
			return $this->belongsTo(Training::class);
		}

		public function materials(): HasMany
		{
			return $this->hasMany(TrainingMaterial::class);
		}

		public function attendanceSessions(): HasMany
		{
			return $this->hasMany(TrainingAttendanceSession::class);
		}

		/*
		|--------------------------------------------------------------------------
		| Helpers
		|--------------------------------------------------------------------------
		*/

		public function hasRoom(): bool
		{
			return ! empty($this->room);
		}

		public function hasDescription(): bool
		{
			return ! empty($this->description);
		}

		public function getMeetingLabel(): string
		{
			return 'Pertemuan ' . $this->meeting_number;
		}

		public function getRoom(): string
		{
			return $this->room ?: '-';
		}

		public function getTimeRange(): string
		{
			if (! $this->start_time || ! $this->end_time) {
				return '-';
			}

			return substr($this->start_time, 0, 5)
				. ' - '
				. substr($this->end_time, 0, 5);
		}

		public function isToday(): bool
		{
			return $this->schedule_date?->isToday() ?? false;
		}

		public function isPast(): bool
		{
			return $this->schedule_date?->isPast() ?? false;
		}

		public function isUpcoming(): bool
		{
			return $this->schedule_date?->isFuture() ?? false;
		}
	}
