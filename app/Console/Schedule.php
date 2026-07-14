<?php

	namespace Natasya\NataApp\Console;

	use Cron\CronExpression;

	class Schedule
	{
		private string $expression;

		private $callback;

		public function __construct(
			string $expression,
			callable $callback
		)
		{
			$this->expression = $expression;

			$this->callback = $callback;
		}

		public function due(): bool
		{
			return CronExpression::factory(
				$this->expression
			)->isDue();
		}

		public function run(): void
		{
			call_user_func($this->callback);
		}
	}