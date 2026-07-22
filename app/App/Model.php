<?php

	namespace Natasya\NataApp\App;

	use Illuminate\Database\Eloquent\Model as EloquentModel;

	abstract class Model extends EloquentModel
	{
		public $timestamps = true;

		protected $guarded = [];
	}
