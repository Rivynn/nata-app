<?php

	namespace Database\Migrations;

	use Illuminate\Database\Capsule\Manager as Capsule;
	use Illuminate\Database\Schema\Blueprint;

	class CreateParticipantsTable extends Migration
	{
		public function up(): void
		{
			Capsule::schema()->create('participants', function (Blueprint $table) {

				$table->increments('id');

				$table->unsignedInteger('user_id')->unique();

				$table->string('phone', 20)->nullable();

				$table->enum('gender', [
					'L',
					'P',
				])->nullable();

				$table->date('birth_date')->nullable();

				$table->text('address')->nullable();

				$table->string('education', 100)->nullable();

				$table->string('institution', 150)->nullable();

				$table->timestamps();

				$table->index('phone');

				$table->foreign('user_id')
					->references('id')
					->on('users')
					->onUpdate('cascade')
					->onDelete('cascade');

			});
		}

		public function down(): void
		{
			Capsule::schema()->dropIfExists('participants');
		}
	}
