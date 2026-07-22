<?php

	namespace Database\Migrations;

	use Illuminate\Database\Capsule\Manager as Capsule;
	use Illuminate\Database\Schema\Blueprint;

	class CreateCertificatesTable extends Migration
	{
		public function up(): void
		{
			Capsule::schema()->create('certificates', function (Blueprint $table) {

				$table->increments('id');


				$table->unsignedInteger('registration_id')
					->unique();


				$table->string('certificate_number', 50)
					->unique();


				$table->string('verification_code', 100)
					->unique();


				$table->string('verification_url')
					->nullable();

				$table->string('file')
					->nullable();


				$table->enum('status', [

					'active',
					'revoked',
					'expired'

				])

					->default('active');


				$table->unsignedInteger('issued_by')
					->nullable();

				$table->dateTime('issued_at')
					->nullable();
				$table->timestamps();

				$table->foreign('registration_id')
					->references('id')
					->on('registrations')
					->onUpdate('cascade')
					->onDelete('cascade');


				$table->foreign('issued_by')

					->references('id')

					->on('users')

					->onUpdate('cascade')

					->onDelete('set null');


			});
		}

		public function down(): void
		{
			Capsule::schema()->dropIfExists('certificates');
		}
	}
