<?php

	namespace Natasya\NataApp\Model;

	use Illuminate\Database\Eloquent\Relations\BelongsTo;
	use Natasya\NataApp\App\Model;

	class TrainingMaterial extends Model
	{
		protected $table = 'training_materials';

		protected $fillable = [
			'training_schedule_id',
			'title',
			'description',
			'type',
			'file',
			'external_url',
			'sort_order',
		];

		/*
		|--------------------------------------------------------------------------
		| Relationships
		|--------------------------------------------------------------------------
		*/

		public function trainingSchedule(): BelongsTo
		{
			return $this->belongsTo(TrainingSchedule::class);
		}

		/*
		|--------------------------------------------------------------------------
		| Helpers
		|--------------------------------------------------------------------------
		*/

		public function isDocument(): bool
		{
			return $this->type === 'document';
		}

		public function isVideo(): bool
		{
			return $this->type === 'video';
		}

		public function isLink(): bool
		{
			return $this->type === 'link';
		}

		public function isArchive(): bool
		{
			return $this->type === 'archive';
		}

		public function hasFile(): bool
		{
			return ! empty($this->file);
		}

		public function hasExternalUrl(): bool
		{
			return ! empty($this->external_url);
		}

		public function getTitle(): string
		{
			return $this->title ?: '-';
		}

		public function getDescription(): string
		{
			return $this->description ?: '-';
		}

		public function getTypeLabel(): string
		{
			return match ($this->type) {
				'document' => 'Dokumen',
				'video' => 'Video',
				'link' => 'Link',
				'archive' => 'Arsip',
				default => '-',
			};
		}
	}
