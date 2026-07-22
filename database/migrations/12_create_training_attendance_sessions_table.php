<?php

	namespace Database\Migrations;

	use Illuminate\Database\Capsule\Manager as Capsule;
	use Illuminate\Database\Schema\Blueprint;

	class CreateTrainingAttendanceSessionsTable extends Migration
	{
		public function up(): void
		{
			Capsule::schema()->create('training_attendance_sessions', function (Blueprint $table) {

				$table->increments('id');

				$table->unsignedInteger('training_schedule_id');

				$table->string('qr_token', 100)->nullable()->unique();

				$table->enum('attendance_type', [
					'manual',
					'qr',
					'hybrid',
				])->default('manual');
				$table->string('attendance_code',50)
					->nullable()
					->unique();

				$table->decimal('latitude', 10, 7)->nullable();

				$table->decimal('longitude', 10, 7)->nullable();

				$table->unsignedInteger('radius')->default(100);

				$table->unsignedInteger('opened_by')->nullable();

				$table->dateTime('opened_at')->nullable();

				$table->dateTime('expired_at')->nullable();

				$table->dateTime('closed_at')->nullable();

				$table->boolean('is_active')->default(false);

				$table->timestamps();

				$table->index('training_schedule_id');

				$table->index('attendance_type');

				$table->index('is_active');

				$table->foreign('training_schedule_id')
					->references('id')
					->on('training_schedules')
					->onUpdate('cascade')
					->onDelete('cascade');

				$table->foreign('opened_by')
					->references('id')
					->on('users')
					->onUpdate('cascade')
					->onDelete('set null');

			});
		}

		public function down(): void
		{
			Capsule::schema()->dropIfExists('training_attendance_sessions');
		}
	}
