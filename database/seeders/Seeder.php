<?php

	namespace Database\Seeders;

	use Illuminate\Database\Capsule\Manager as Capsule;

	abstract class Seeder
	{
		abstract public function run(): void;

		protected function call(string $seeder): void
		{
			Capsule::statement('SET FOREIGN_KEY_CHECKS=0;');

			try {

				(new $seeder())->run();

			} finally {

				Capsule::statement('SET FOREIGN_KEY_CHECKS=1;');

			}
		}
	}
