<?php

	namespace Database\Migrations;

	use Illuminate\Database\Capsule\Manager as Capsule;
	use Illuminate\Database\Schema\Blueprint;

	class CreateParticipantProfilesTable extends Migration
	{
		public function up(): void
		{
			Capsule::schema()->create('participant_profiles', function (Blueprint $table) {

				$table->increments('id');

				$table->unsignedInteger('participant_id')->unique();

				$table->char('nik', 16)->nullable();

				$table->string('birth_place', 100)->nullable();

				$table->enum('religion', [
					'Islam',
					'Kristen',
					'Katolik',
					'Hindu',
					'Buddha',
					'Konghucu',
				])->nullable();

				$table->enum('marital_status', [
					'belum_menikah',
					'menikah',
					'cerai',
				])->nullable();

				$table->string('province', 100)->nullable();

				$table->string('city', 100)->nullable();

				$table->string('district', 100)->nullable();

				$table->string('village', 100)->nullable();

				$table->string('postal_code', 10)->nullable();

				$table->string('major', 100)->nullable();

				$table->year('graduation_year')->nullable();

				$table->enum('employment_status', [
					'belum_bekerja',
					'bekerja',
					'wirausaha',
					'pelajar',
					'mahasiswa',
					'lainnya',
				])->nullable();

				$table->string('occupation', 100)->nullable();

				$table->string('company_name', 150)->nullable();

				$table->text('training_goal')->nullable();

				$table->text('skill')->nullable();

				$table->string('emergency_contact_name', 100)->nullable();

				$table->string('emergency_contact_phone', 20)->nullable();

				$table->string('photo')->nullable();

				$table->string('ktp_file')->nullable();

				$table->string('ijazah_file')->nullable();

				$table->string('cv_file')->nullable();

				$table->boolean('is_completed')->default(false);

				$table->timestamp('completed_at')->nullable();

				$table->timestamps();

				$table->index('nik');

				$table->index('city');

				$table->index('employment_status');

				$table->index('is_completed');

				$table->foreign('participant_id')
					->references('id')
					->on('participants')
					->onUpdate('cascade')
					->onDelete('cascade');

			});
		}

		public function down(): void
		{
			Capsule::schema()->dropIfExists('participant_profiles');
		}
	}
