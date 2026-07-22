<?php

	namespace Database\Migrations;

	use Illuminate\Database\Capsule\Manager as Capsule;
	use Illuminate\Database\Schema\Blueprint;

	class CreateRegistrationsTable extends Migration
	{
		public function up(): void
		{
			Capsule::schema()->create('registrations', function (Blueprint $table) {

				$table->increments('id');

				$table->unsignedInteger('training_id');

				$table->unsignedInteger('participant_id');

				$table->string('registration_number', 40)->unique();

				$table->text('motivation')->nullable();

				$table->enum('status', [
					'pending',
					'approved',
					'rejected',
					'cancelled',
					'completed',
				])->default('pending');

				$table->unsignedInteger('approved_by')->nullable();

				$table->timestamp('approved_at')->nullable();

				$table->unsignedInteger('rejected_by')->nullable();

				$table->timestamp('rejected_at')->nullable();

				$table->text('rejected_reason')->nullable();

				$table->timestamp('cancelled_at')->nullable();

				$table->timestamp('completed_at')->nullable();

				$table->text('notes')->nullable();

				$table->dateTime('registered_at')->nullable();

				$table->timestamps();

				$table->index('training_id');

				$table->index('participant_id');

				$table->index('status');

				$table->foreign('training_id')
					->references('id')
					->on('trainings')
					->onUpdate('cascade')
					->onDelete('cascade');

				$table->foreign('participant_id')
					->references('id')
					->on('participants')
					->onUpdate('cascade')
					->onDelete('cascade');

				$table->foreign('approved_by')
					->references('id')
					->on('users')
					->onUpdate('cascade')
					->onDelete('set null');

				$table->foreign('rejected_by')
					->references('id')
					->on('users')
					->onUpdate('cascade')
					->onDelete('set null');

				$table->unique([
					'training_id',
					'participant_id',
				]);

			});
		}

		public function down(): void
		{
			Capsule::schema()->dropIfExists('registrations');
		}
	}
