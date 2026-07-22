<?php

	namespace Database\Migrations;

	use Illuminate\Database\Capsule\Manager as Capsule;
	use Illuminate\Database\Schema\Blueprint;

	class CreateUsersTable extends Migration
	{
		public function up(): void
		{
			Capsule::schema()->create('users', function (Blueprint $table) {

				$table->increments('id');

				$table->string('name', 100);

				$table->string('username', 50)->unique();

				$table->string('email', 150)->unique();

				$table->string('avatar')->nullable();

				$table->string('password');

				$table->enum('role', [
					'admin',
					'pegawai',
					'peserta',
					'pelatih',
				])->default('peserta');

				$table->enum('status', [
					'active',
					'inactive',
					'blocked',
				])->default('active');

				$table->timestamp('last_login_at')->nullable();

				$table->timestamps();

				$table->index('role');
				$table->index('status');

			});
		}

		public function down(): void
		{
			Capsule::schema()->dropIfExists('users');
		}
	}
