<?php

	namespace Database\Migrations;

	use Illuminate\Database\Capsule\Manager as Capsule;
	use Illuminate\Database\Schema\Blueprint;

	class CreateTrainingMaterialsTable extends Migration
	{
		public function up(): void
		{
			Capsule::schema()->create('training_materials', function (Blueprint $table) {

				$table->increments('id');

				$table->unsignedInteger('training_schedule_id');

				$table->string('title', 150)->nullable();

				$table->text('description')->nullable();

				$table->enum('type', [
					'document',
					'video',
					'link',
					'archive',
				])->nullable();

				$table->string('file')->nullable();

				$table->string('external_url')->nullable();

				$table->unsignedInteger('sort_order')->default(1);

				$table->timestamps();

				$table->index('training_schedule_id');

				$table->index('type');

				$table->foreign('training_schedule_id')
					->references('id')
					->on('training_schedules')
					->onUpdate('cascade')
					->onDelete('cascade');

			});
		}

		public function down(): void
		{
			Capsule::schema()->dropIfExists('training_materials');
		}
	}
