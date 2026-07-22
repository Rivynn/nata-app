<?php

	namespace Natasya\NataApp\Model;

	use Illuminate\Database\Eloquent\Relations\BelongsTo;
	use Natasya\NataApp\App\Model;


	class Certificate extends Model
	{

		protected $table = 'certificates';



		protected $fillable = [

			'registration_id',

			'certificate_number',

			'verification_code',

			'verification_url',

			'file',

			'status',

			'issued_by',

			'issued_at',

		];



		protected $casts = [

			'issued_at' => 'datetime',

		];



		/*
		|--------------------------------------------------------------------------
		| Relationships
		|--------------------------------------------------------------------------
		*/


		public function registration(): BelongsTo
		{

			return $this->belongsTo(
				Registration::class
			);

		}



		public function issuer(): BelongsTo
		{

			return $this->belongsTo(
				User::class,
				'issued_by'
			);

		}



		/*
		|--------------------------------------------------------------------------
		| Certificate Status
		|--------------------------------------------------------------------------
		*/


		public function isActive(): bool
		{

			return $this->status === 'active';

		}



		public function isRevoked(): bool
		{

			return $this->status === 'revoked';

		}



		public function isExpired(): bool
		{

			return $this->status === 'expired';

		}



		public function isIssued(): bool
		{

			return $this->issued_at !== null;

		}



		public function canVerify(): bool
		{

			return $this->isActive()
				&&
				$this->verification_code !== null;

		}



		/*
		|--------------------------------------------------------------------------
		| Generate Check
		|--------------------------------------------------------------------------
		*/


		public function hasFile(): bool
		{

			return !empty(
			$this->file
			);

		}



		public function hasVerificationUrl(): bool
		{

			return !empty(
			$this->verification_url
			);

		}



		/*
		|--------------------------------------------------------------------------
		| Helpers
		|--------------------------------------------------------------------------
		*/


		public function getParticipantName(): string
		{

			return $this->registration
				?->participant
				?->user
				?->getDisplayName()
			?? '-';

	}



		public function getTrainingName(): string
		{

			return $this->registration
				?->training
				?->name
			?? '-';

	}



		public function getFieldName(): string
		{

			return $this->registration
				?->training
				?->trainingField
				?->name
				?? '-';

	}



		public function getIssuerName(): string
		{

			return $this->issuer?->getDisplayName()
			?? '-';

	}



		public function getCertificateNumber(): string
		{

			return $this->certificate_number;

		}



		public function getVerificationUrl(): string
		{

			return $this->verification_url
				?? url(
					'/verify/certificate?code='
					.$this->verification_code
				);

		}



		/*
		|--------------------------------------------------------------------------
		| Factory Helpers
		|--------------------------------------------------------------------------
		*/


		public static function generateCertificateNumber(): string
		{

			$last = self::latest('id')->first();



			$number = $last

				? $last->id + 1

				: 1;



			return sprintf(

				'CERT-%s-%05d',

				now()->format('Ymd'),

				$number

			);

		}



		public static function generateVerificationCode(): string
		{

			do {


				$code = strtoupper(
					str()->random(8)
				);



			} while (

				self::where(
					'verification_code',
					$code
				)->exists()

			);



			return $code;

		}


	}
