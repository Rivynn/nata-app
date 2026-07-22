<?php

	namespace Database\Migrations;

	use Illuminate\Database\Capsule\Manager as Capsule;
	use Illuminate\Database\Schema\Blueprint;

	class CreateTrainingAnnouncementsTable extends Migration
	{
		public function up(): void
		{
			Capsule::schema()->create('training_announcements', function (Blueprint $table) {

				$table->increments('id');

				$table->unsignedInteger('training_id');

				$table->unsignedInteger('created_by');

				$table->string('title', 150)->nullable();

				$table->text('content')->nullable();

				$table->boolean('is_pinned')->default(false);

				$table->timestamps();

				$table->index('training_id');

				$table->index('is_pinned');

				$table->foreign('training_id')
					->references('id')
					->on('trainings')
					->onUpdate('cascade')
					->onDelete('cascade');

				$table->foreign('created_by')
					->references('id')
					->on('users')
					->onUpdate('cascade')
					->onDelete('cascade');

			});
		}

		public function down(): void
		{
			Capsule::schema()->dropIfExists('training_announcements');
		}
	}
