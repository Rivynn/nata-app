<?php

	namespace Natasya\NataApp\Model;

	use Illuminate\Database\Eloquent\Relations\BelongsTo;
	use Illuminate\Database\Eloquent\Relations\HasMany;
	use Natasya\NataApp\App\Model;

	class TrainingAttendanceSession extends Model
	{
		protected $table = 'training_attendance_sessions';


		protected $fillable = [

			'training_schedule_id',

			'qr_token',

			'attendance_code',

			'attendance_type',

			'latitude',

			'longitude',

			'radius',

			'opened_by',

			'opened_at',

			'expired_at',

			'closed_at',

			'is_active',

		];


		protected $casts = [

			'latitude' => 'float',

			'longitude' => 'float',

			'radius' => 'integer',

			'is_active' => 'boolean',

			'opened_at' => 'datetime',

			'expired_at' => 'datetime',

			'closed_at' => 'datetime',

		];


		/*
		|--------------------------------------------------------------------------
		| Relationships
		|--------------------------------------------------------------------------
		*/


		public function trainingSchedule(): BelongsTo
		{
			return $this->belongsTo(
				TrainingSchedule::class,
				'training_schedule_id'
			);
		}


		public function opener(): BelongsTo
		{
			return $this->belongsTo(
				User::class,
				'opened_by'
			);
		}


		public function attendances(): HasMany
		{
			return $this->hasMany(
				TrainingAttendance::class,
				'attendance_session_id'
			);
		}



		/*
		|--------------------------------------------------------------------------
		| Helpers
		|--------------------------------------------------------------------------
		*/


		public function isActive(): bool
		{
			return (bool) $this->is_active;
		}



		public function isManual(): bool
		{
			return $this->attendance_type === 'manual';
		}



		public function isQr(): bool
		{
			return $this->attendance_type === 'qr';
		}



		public function isHybrid(): bool
		{
			return $this->attendance_type === 'hybrid';
		}



		public function hasQrToken(): bool
		{
			return ! empty($this->qr_token);
		}



		public function hasAttendanceCode(): bool
		{
			return ! empty($this->attendance_code);
		}



		public function verifyCode(string $code): bool
		{
			return strtoupper(
					trim($code)
				) === strtoupper(
					$this->attendance_code
				);
		}



		public function hasLocation(): bool
		{
			return $this->latitude !== null
				&& $this->longitude !== null;
		}



		public function isOpened(): bool
		{
			return $this->opened_at !== null;
		}



		public function isClosed(): bool
		{
			return $this->closed_at !== null;
		}



		public function isExpired(): bool
		{
			return $this->expired_at?->isPast() ?? false;
		}



		public function getRadiusLabel(): string
		{
			return ($this->radius ?? 0) . ' Meter';
		}



		public function getAttendanceCode(): string
		{
			return $this->attendance_code ?: '-';
		}



		public function getMethodLabel(): string
		{

			return match($this->attendance_type){

				'qr' => 'QR Code',

				'manual' => 'Kode Absensi',

				'hybrid' => 'QR + Kode Absensi',

				default => '-',

			};

		}

	}
