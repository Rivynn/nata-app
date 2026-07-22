<?php

	namespace Database\Migrations;

	use Illuminate\Database\Capsule\Manager as Capsule;
	use Illuminate\Database\Schema\Blueprint;

	class CreateTrainingAttendancesTable extends Migration
	{
		public function up(): void
		{
			Capsule::schema()->create('training_attendances', function (Blueprint $table) {

				$table->increments('id');

				$table->unsignedInteger('attendance_session_id');

				$table->unsignedInteger('registration_id');

				$table->enum('attendance_method', [
					'manual',
					'qr_code',
				]);

				$table->enum('status', [
					'present',
					'late',
					'permission',
					'absent',
				]);

				$table->unsignedInteger('checked_by')->nullable();

				$table->dateTime('check_in_at')->nullable();

				$table->text('notes')->nullable();

				$table->timestamps();

				$table->index('attendance_session_id');

				$table->index('registration_id');

				$table->index('status');

				$table->foreign('attendance_session_id')
					->references('id')
					->on('training_attendance_sessions')
					->onUpdate('cascade')
					->onDelete('cascade');

				$table->foreign('registration_id')
					->references('id')
					->on('registrations')
					->onUpdate('cascade')
					->onDelete('cascade');

				$table->foreign('checked_by')
					->references('id')
					->on('users')
					->onUpdate('cascade')
					->onDelete('set null');

				$table->unique(
					[
						'attendance_session_id',
						'registration_id',
					],
					'ta_session_registration_unique'
				);
			});
		}

		public function down(): void
		{
			Capsule::schema()->dropIfExists('training_attendances');
		}
	}
