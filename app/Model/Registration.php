<?php

	namespace Natasya\NataApp\Model;

	use Illuminate\Database\Eloquent\Relations\BelongsTo;
	use Illuminate\Database\Eloquent\Relations\HasOne;
	use Natasya\NataApp\App\Model;
	use function Illuminate\Support\now;

	class Registration extends Model
	{
		protected $table = 'registrations';

		protected $fillable = [
			'training_id',
			'participant_id',
			'registration_number',
			'motivation',
			'status',
			'approved_by',
			'approved_at',
			'rejected_by',
			'rejected_at',
			'rejected_reason',
			'cancelled_at',
			'completed_at',
			'notes',
			'registered_at',
		];

		protected $casts = [
			'approved_at' => 'datetime',
			'rejected_at' => 'datetime',
			'cancelled_at' => 'datetime',
			'completed_at' => 'datetime',
			'registered_at' => 'datetime',
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

		public function participant(): BelongsTo
		{
			return $this->belongsTo(Participant::class);
		}

		public function approver(): BelongsTo
		{
			return $this->belongsTo(User::class, 'approved_by');
		}

		public function rejector(): BelongsTo
		{
			return $this->belongsTo(User::class, 'rejected_by');
		}

		public function score(): HasOne
		{
			return $this->hasOne(TrainingScore::class);
		}

		public function certificate(): HasOne
		{
			return $this->hasOne(Certificate::class);
		}

		public function attendances()
		{
			return $this->hasMany(TrainingAttendance::class);
		}

		/*
		|--------------------------------------------------------------------------
		| Helpers
		|--------------------------------------------------------------------------
		*/

		public function isPending(): bool
		{
			return $this->status === 'pending';
		}
		public static function generateRegistrationNumber(): string
		{
			$last = self::latest('id')->first();

			$number = $last
				? $last->id + 1
				: 1;

			return sprintf(
				'REG-%s-%05d',
				now()->format('Ymd'),
				$number
			);
		}

		public function isApproved(): bool
		{
			return $this->status === 'approved';
		}

		public function isRejected(): bool
		{
			return $this->status === 'rejected';
		}

		public function isCancelled(): bool
		{
			return $this->status === 'cancelled';
		}

		public function isCompleted(): bool
		{
			return $this->status === 'completed';
		}

		public function hasScore(): bool
		{
			return $this->score()->exists();
		}

		public function hasCertificate(): bool
		{
			return $this->certificate()->exists();
		}

		public function getParticipantName(): string
		{
			return $this->participant?->user?->getDisplayName() ?? '-';
		}

		public function getTrainingName(): string
		{
			return $this->training?->name ?? '-';
		}
	}
