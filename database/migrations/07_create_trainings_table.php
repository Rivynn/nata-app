<?php

	namespace Database\Migrations;

	use Illuminate\Database\Capsule\Manager as Capsule;
	use Illuminate\Database\Schema\Blueprint;

	class CreateTrainingsTable extends Migration
	{
		public function up(): void
		{
			Capsule::schema()->create('trainings', function (Blueprint $table) {

				$table->increments('id');

				$table->unsignedInteger('training_field_id');

				$table->unsignedInteger('trainer_id');

				$table->string('code', 30)->unique();

				$table->string('name', 150);

				$table->string('slug', 180)->unique();

				$table->string('thumbnail')->nullable();

				$table->text('description')->nullable();

				$table->text('objective')->nullable();

				$table->text('requirement')->nullable();

				$table->text('benefit')->nullable();

				$table->unsignedInteger('quota');

				$table->unsignedInteger('duration');

				$table->string('location', 150)->nullable();

				$table->date('registration_open')->nullable();

				$table->date('registration_close')->nullable();

				$table->date('training_start')->nullable();

				$table->date('training_end')->nullable();

				$table->enum('status', [
					'draft',
					'open',
					'closed',
					'running',
					'completed',
					'cancelled',
				])->default('draft');

				$table->timestamp('published_at')->nullable();

				$table->unsignedInteger('created_by')->nullable();

				$table->unsignedInteger('updated_by')->nullable();

				$table->timestamps();

				$table->index('training_field_id');

				$table->index('trainer_id');

				$table->index('status');

				$table->index('registration_open');

				$table->index('registration_close');

				$table->index('training_start');

				$table->foreign('training_field_id')
					->references('id')
					->on('training_fields')
					->onUpdate('cascade')
					->onDelete('restrict');

				$table->foreign('trainer_id')
					->references('id')
					->on('trainers')
					->onUpdate('cascade')
					->onDelete('restrict');

				$table->foreign('created_by')
					->references('id')
					->on('users')
					->onUpdate('cascade')
					->onDelete('set null');

				$table->foreign('updated_by')
					->references('id')
					->on('users')
					->onUpdate('cascade')
					->onDelete('set null');

			});
		}

		public function down(): void
		{
			Capsule::schema()->dropIfExists('trainings');
		}
	}
