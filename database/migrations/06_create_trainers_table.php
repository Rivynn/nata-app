<?php

	namespace Database\Migrations;

	use Illuminate\Database\Capsule\Manager as Capsule;
	use Illuminate\Database\Schema\Blueprint;

	class CreateTrainersTable extends Migration
	{
		public function up(): void
		{
			Capsule::schema()->create('trainers', function (Blueprint $table) {

				$table->increments('id');

				$table->unsignedInteger('user_id')->unique();

				$table->unsignedInteger('training_field_id');

				$table->string('employee_number', 30)->nullable()->unique();

				$table->string('phone', 20)->nullable();

				$table->string('email', 150)->nullable();

				$table->string('institution', 150)->nullable();

				$table->string('expertise', 150)->nullable();

				$table->string('specialization', 150)->nullable();

				$table->unsignedTinyInteger('experience_year')->nullable();

				$table->text('biography')->nullable();

				$table->string('avatar')->nullable();

				$table->enum('status', [
					'active',
					'inactive',
				])->default('active');

				$table->timestamps();

				$table->index('training_field_id');

				$table->index('expertise');

				$table->index('status');

				$table->foreign('user_id')
					->references('id')
					->on('users')
					->onUpdate('cascade')
					->onDelete('cascade');

				$table->foreign('training_field_id')
					->references('id')
					->on('training_fields')
					->onUpdate('cascade')
					->onDelete('restrict');

			});
		}

		public function down(): void
		{
			Capsule::schema()->dropIfExists('trainers');
		}
	}
