<?php

	namespace Database\Migrations;

	use Illuminate\Database\Capsule\Manager as Capsule;
	use Illuminate\Database\Schema\Blueprint;

	class CreateEmployeesTable extends Migration
	{
		public function up(): void
		{
			Capsule::schema()->create('employees', function (Blueprint $table) {

				$table->increments('id');

				$table->unsignedInteger('user_id')->unique();

				$table->string('employee_number', 30)->unique();

				$table->string('phone', 20)->nullable();

				$table->string('position', 100)->nullable();

				$table->string('department', 100)->nullable();

				$table->timestamps();

				$table->index('department');

				$table->index('position');

				$table->foreign('user_id')
					->references('id')
					->on('users')
					->onUpdate('cascade')
					->onDelete('cascade');

			});
		}

		public function down(): void
		{
			Capsule::schema()->dropIfExists('employees');
		}
	}
