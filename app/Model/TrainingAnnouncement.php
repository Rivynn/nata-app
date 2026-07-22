<?php

	namespace Natasya\NataApp\Model;

	use Illuminate\Database\Eloquent\Relations\BelongsTo;
	use Natasya\NataApp\App\Model;

	class TrainingAnnouncement extends Model
	{
		protected $table = 'training_announcements';

		protected $fillable = [
			'training_id',
			'created_by',
			'title',
			'content',
			'is_pinned',
		];

		protected $casts = [
			'is_pinned' => 'boolean',
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

		public function creator(): BelongsTo
		{
			return $this->belongsTo(User::class, 'created_by');
		}

		/*
		|--------------------------------------------------------------------------
		| Helpers
		|--------------------------------------------------------------------------
		*/

		public function isPinned(): bool
		{
			return $this->is_pinned;
		}

		public function getTitle(): string
		{
			return $this->title ?: '-';
		}

		public function getContent(): string
		{
			return $this->content ?: '-';
		}

		public function getCreatorName(): string
		{
			return $this->creator?->getDisplayName() ?? '-';
		}
	}
