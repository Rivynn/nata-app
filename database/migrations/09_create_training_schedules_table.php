<?php

	namespace Database\Migrations;

	use Illuminate\Database\Capsule\Manager as Capsule;
	use Illuminate\Database\Schema\Blueprint;

	class CreateTrainingSchedulesTable extends Migration
	{
		public function up(): void
		{
			Capsule::schema()->create('training_schedules', function (Blueprint $table) {

				$table->increments('id');

				$table->unsignedInteger('training_id');

				$table->unsignedInteger('meeting_number');

				$table->string('topic', 150);

				$table->text('description')->nullable();

				$table->date('schedule_date');

				$table->time('start_time')->nullable();

				$table->time('end_time')->nullable();

				$table->string('room', 120)->nullable();

				$table->timestamps();

				$table->index('training_id');

				$table->index('schedule_date');

				$table->foreign('training_id')
					->references('id')
					->on('trainings')
					->onUpdate('cascade')
					->onDelete('cascade');

			});
		}

		public function down(): void
		{
			Capsule::schema()->dropIfExists('training_schedules');
		}
	}
