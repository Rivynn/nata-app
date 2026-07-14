<?php

	namespace Natasya\NataApp\App;

	abstract class Middleware
	{
		abstract public function before(): void;
	}