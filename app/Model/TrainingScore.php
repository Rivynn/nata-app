<?php

	namespace Natasya\NataApp\Model;

	use Illuminate\Database\Eloquent\Relations\BelongsTo;
	use Natasya\NataApp\App\Model;

	class TrainingScore extends Model
	{
		protected $table = 'training_scores';

		protected $fillable = [
			'registration_id',
			'trainer_id',
			'knowledge_score',
			'skill_score',
			'attitude_score',
			'attendance_percentage',
			'final_score',
			'predicate',
			'is_passed',
			'notes',
			'published_at',
		];

		protected $casts = [
			'knowledge_score' => 'float',
			'skill_score' => 'float',
			'attitude_score' => 'float',
			'attendance_percentage' => 'float',
			'final_score' => 'float',
			'is_passed' => 'boolean',
			'published_at' => 'datetime',
		];

		/*
		|--------------------------------------------------------------------------
		| Relationships
		|--------------------------------------------------------------------------
		*/

		public function registration(): BelongsTo
		{
			return $this->belongsTo(Registration::class);
		}

		public function trainer(): BelongsTo
		{
			return $this->belongsTo(Trainer::class);
		}

		/*
		|--------------------------------------------------------------------------
		| Helpers
		|--------------------------------------------------------------------------
		*/

		public function isPublished(): bool
		{
			return $this->published_at !== null;
		}

		public function isPassed(): bool
		{
			return (bool) $this->is_passed;
		}

		public function isFailed(): bool
		{
			return ! $this->isPassed();
		}

		public function hasFinalScore(): bool
		{
			return $this->final_score !== null;
		}

		public function getPredicateLabel(): string
		{
			return $this->predicate ?: '-';
		}

		public function getFinalScore(): string
		{
			return $this->final_score !== null
				? number_format($this->final_score, 2)
				: '-';
		}

		public function getTrainerName(): string
		{
			return $this->trainer?->user?->getDisplayName() ?? '-';
		}

		public function getParticipantName(): string
		{
			return $this->registration?->participant?->user?->getDisplayName() ?? '-';
		}

		public function getTrainingName(): string
		{
			return $this->registration?->training?->name ?? '-';
		}
	}
