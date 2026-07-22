<?php

	namespace Database\Migrations;

	use Illuminate\Database\Capsule\Manager as Capsule;
	use Illuminate\Database\Schema\Blueprint;

	class CreateTrainingScoresTable extends Migration
	{
		public function up(): void
		{
			Capsule::schema()->create('training_scores', function (Blueprint $table) {

				$table->increments('id');

				$table->unsignedInteger('registration_id')->unique();

				$table->unsignedInteger('trainer_id');

				$table->decimal('knowledge_score', 5, 2)->nullable();

				$table->decimal('skill_score', 5, 2)->nullable();

				$table->decimal('attitude_score', 5, 2)->nullable();

				$table->decimal('attendance_percentage', 5, 2)->nullable();

				$table->decimal('final_score', 5, 2)->nullable();

				$table->enum('predicate', [
					'A',
					'B',
					'C',
					'D',
					'E',
				])->nullable();

				$table->boolean('is_passed')->nullable();

				$table->text('notes')->nullable();

				$table->dateTime('published_at')->nullable();

				$table->timestamps();

				$table->index('trainer_id');

				$table->index('final_score');

				$table->index('is_passed');

				$table->foreign('registration_id')
					->references('id')
					->on('registrations')
					->onUpdate('cascade')
					->onDelete('cascade');

				$table->foreign('trainer_id')
					->references('id')
					->on('trainers')
					->onUpdate('cascade')
					->onDelete('restrict');

			});
		}

		public function down(): void
		{
			Capsule::schema()->dropIfExists('training_scores');
		}
	}
