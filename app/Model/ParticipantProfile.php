<?php

	namespace Natasya\NataApp\Model;

	use Illuminate\Database\Eloquent\Relations\BelongsTo;
	use Natasya\NataApp\App\Model;

	class ParticipantProfile extends Model
	{
		protected $table = 'participant_profiles';

		protected $fillable = [
			'participant_id',
			'nik',
			'birth_place',
			'religion',
			'marital_status',
			'province',
			'city',
			'district',
			'village',
			'postal_code',
			'major',
			'graduation_year',
			'employment_status',
			'occupation',
			'company_name',
			'training_goal',
			'skill',
			'emergency_contact_name',
			'emergency_contact_phone',
			'photo',
			'ktp_file',
			'ijazah_file',
			'cv_file',
			'is_completed',
			'completed_at',
		];

		protected $casts = [
			'is_completed' => 'boolean',
			'completed_at' => 'datetime',
		];

		/*
		|--------------------------------------------------------------------------
		| Relationships
		|--------------------------------------------------------------------------
		*/

		public function participant(): BelongsTo
		{
			return $this->belongsTo(Participant::class);
		}

		/*
		|--------------------------------------------------------------------------
		| Helpers
		|--------------------------------------------------------------------------
		*/

		public function isCompleted(): bool
		{
			return $this->is_completed;
		}

		public function hasPhoto(): bool
		{
			return ! empty($this->photo);
		}

		public function hasKtp(): bool
		{
			return ! empty($this->ktp_file);
		}

		public function hasIjazah(): bool
		{
			return ! empty($this->ijazah_file);
		}

		public function hasCv(): bool
		{
			return ! empty($this->cv_file);
		}

		public function getFullAddress(): string
		{
			$parts = array_filter([
				$this->village,
				$this->district,
				$this->city,
				$this->province,
				$this->postal_code,
			]);

			return implode(', ', $parts);
		}

		public function getEmploymentStatusLabel(): string
		{
			return match ($this->employment_status) {
				'belum_bekerja' => 'Belum Bekerja',
				'bekerja' => 'Bekerja',
				'wirausaha' => 'Wirausaha',
				'pelajar' => 'Pelajar',
				'mahasiswa' => 'Mahasiswa',
				'lainnya' => 'Lainnya',
				default => '-',
			};
		}

		public function getMaritalStatusLabel(): string
		{
			return match ($this->marital_status) {
				'belum_menikah' => 'Belum Menikah',
				'menikah' => 'Menikah',
				'cerai' => 'Cerai',
				default => '-',
			};
		}
		public function calculateCompleted(): bool
		{
			$required = [

				$this->nik,
				$this->birth_place,
				$this->religion,

				$this->province,
				$this->city,
				$this->district,
				$this->village,

				$this->major,
				$this->graduation_year,

				$this->training_goal,

				$this->photo,
				$this->ktp_file,

			];

			foreach ($required as $value) {

				if (blank($value)) {
					return false;
				}

			}

			return true;
		}
	}
