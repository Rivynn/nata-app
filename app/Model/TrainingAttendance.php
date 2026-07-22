<?php

	namespace Natasya\NataApp\Model;

	use Illuminate\Database\Eloquent\Relations\BelongsTo;
	use Natasya\NataApp\App\Model;

	class TrainingAttendance extends Model
	{
		protected $table = 'training_attendances';

		protected $fillable = [
			'attendance_session_id',
			'registration_id',
			'attendance_method',
			'status',
			'checked_by',
			'check_in_at',
			'notes',
		];

		protected $casts = [
			'check_in_at' => 'datetime',
		];

		/*
		|--------------------------------------------------------------------------
		| Relationships
		|--------------------------------------------------------------------------
		*/

		public function attendanceSession(): BelongsTo
		{
			return $this->belongsTo(
				TrainingAttendanceSession::class,
				'attendance_session_id'
			);
		}

		public function registration(): BelongsTo
		{
			return $this->belongsTo(Registration::class);
		}

		public function checker(): BelongsTo
		{
			return $this->belongsTo(User::class, 'checked_by');
		}

		/*
		|--------------------------------------------------------------------------
		| Helpers
		|--------------------------------------------------------------------------
		*/

		public function isManual(): bool
		{
			return $this->attendance_method === 'manual';
		}

		public function isQrCode(): bool
		{
			return $this->attendance_method === 'qr_code';
		}

		public function isPresent(): bool
		{
			return $this->status === 'present';
		}

		public function isLate(): bool
		{
			return $this->status === 'late';
		}

		public function isPermission(): bool
		{
			return $this->status === 'permission';
		}

		public function isAbsent(): bool
		{
			return $this->status === 'absent';
		}

		public function hasCheckedIn(): bool
		{
			return $this->check_in_at !== null;
		}

		public function getParticipantName(): string
		{
			return $this->registration?->participant?->user?->getDisplayName() ?? '-';
		}

		public function getTrainingName(): string
		{
			return $this->registration?->training?->name ?? '-';
		}

		public function getCheckerName(): string
		{
			return $this->checker?->getDisplayName() ?? '-';
		}
	}
