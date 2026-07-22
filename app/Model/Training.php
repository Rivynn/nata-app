<?php

	namespace Natasya\NataApp\Model;

	use Illuminate\Database\Eloquent\Relations\BelongsTo;
	use Illuminate\Database\Eloquent\Relations\HasMany;
	use Illuminate\Database\Eloquent\Relations\HasManyThrough;
	use Natasya\NataApp\App\Model;

	class Training extends Model
	{
		protected $table = 'trainings';

		protected $fillable = [
			'training_field_id',
			'trainer_id',
			'code',
			'name',
			'slug',
			'thumbnail',
			'description',
			'objective',
			'requirement',
			'benefit',
			'quota',
			'duration',
			'location',
			'registration_open',
			'registration_close',
			'training_start',
			'training_end',
			'status',
			'published_at',
			'created_by',
			'updated_by',
		];

		protected $casts = [
			'registration_open' => 'date',
			'registration_close' => 'date',
			'training_start' => 'date',
			'training_end' => 'date',
			'published_at' => 'datetime',
		];

		/*
		|--------------------------------------------------------------------------
		| Relationships
		|--------------------------------------------------------------------------
		*/

		public function trainingField(): BelongsTo
		{
			return $this->belongsTo(TrainingField::class);
		}

		public function trainer(): BelongsTo
		{
			return $this->belongsTo(Trainer::class);
		}

		public function creator(): BelongsTo
		{
			return $this->belongsTo(User::class, 'created_by');
		}

		public function updater(): BelongsTo
		{
			return $this->belongsTo(User::class, 'updated_by');
		}

		public function schedules(): HasMany
		{
			return $this->hasMany(
				TrainingSchedule::class,
				'training_id'
			);
		}
		public function scores(): HasManyThrough
		{
			return $this->hasManyThrough(
				TrainingScore::class,
				Registration::class,
				'training_id',
				'registration_id',
				'id',
				'id'
			);
		}

		public function registrations(): HasMany
		{
			return $this->hasMany(Registration::class);
		}

		public function announcements(): HasMany
		{
			return $this->hasMany(TrainingAnnouncement::class);
		}

		/*
		|--------------------------------------------------------------------------
		| Helpers
		|--------------------------------------------------------------------------
		*/

		public function isDraft(): bool
		{
			return $this->status === 'draft';
		}

		public function isOpen(): bool
		{
			return $this->status === 'open';
		}

		public function isClosed(): bool
		{
			return $this->status === 'closed';
		}

		public function isRunning(): bool
		{
			return $this->status === 'running';
		}

		public function isCompleted(): bool
		{
			return $this->status === 'completed';
		}

		public function isCancelled(): bool
		{
			return $this->status === 'cancelled';
		}

		public function isPublished(): bool
		{
			return $this->published_at !== null;
		}

		public function hasThumbnail(): bool
		{
			return ! empty($this->thumbnail);
		}

		public function getLocation(): string
		{
			return $this->location ?: '-';
		}

		public function getDurationLabel(): string
		{
			return $this->duration . ' Hari';
		}

		public function getQuotaLabel(): string
		{
			return $this->quota . ' Peserta';
		}
	}
