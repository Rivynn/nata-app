<?php

	namespace Database\Migrations;

	use Illuminate\Database\Capsule\Manager as Capsule;
	use Illuminate\Database\Schema\Blueprint;

	class CreateTrainingFieldsTable extends Migration
	{
		public function up(): void
		{
			Capsule::schema()->create('training_fields', function (Blueprint $table) {

				$table->increments('id');

				$table->string('name', 100);

				$table->string('slug', 100)->unique();

				$table->text('description')->nullable();

				$table->string('icon', 100)->nullable();

				$table->string('color', 20)->nullable();

				$table->boolean('is_active')->default(true);

				$table->timestamps();

				$table->index('is_active');

			});
		}

		public function down(): void
		{
			Capsule::schema()->dropIfExists('training_fields');
		}
	}
