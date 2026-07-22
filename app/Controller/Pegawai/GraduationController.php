<?php

	namespace Natasya\NataApp\Controller\Pegawai;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Registration;
	use Natasya\NataApp\Model\Training;
	use Natasya\NataApp\Model\TrainingField;

	class GraduationController extends Controller
	{
		public function index(): void
		{


			$registrations = $this->graduationQuery()

				->latest()

				->get();




			$this->view(
				'Pegawai/Graduations/index',
				[


					'title' => 'Data Kelulusan Peserta',



					'registrations' => $registrations,



					'fields' => TrainingField::query()

						->where(
							'is_active',
							true
						)

						->get(),



					'trainings' => Training::query()

						->latest()

						->get(),



					'filters' => [

						'keyword' => Request::get('keyword'),

						'field' => Request::get('field'),

						'training' => Request::get('training'),

						'status' => Request::get('status'),

					],

				]
			);


		}






		private function graduationQuery()
		{


			$query = Registration::query()


				->with([


					'participant.user',


					'training.trainingField',


					'score',


					'certificate',


				])

				/*
				|--------------------------------------------------------------------------
				| Peserta yang sudah punya nilai
				|--------------------------------------------------------------------------
				*/

				->whereHas(
					'score'
				);






			/*
			|--------------------------------------------------------------------------
			| Keyword
			|--------------------------------------------------------------------------
			*/


			if(Request::get('keyword')){


				$keyword = Request::get('keyword');



				$query->whereHas(

					'participant.user',

					function($q) use ($keyword){


						$q->where(

							'name',

							'like',

							"%{$keyword}%"

						)

							->orWhere(

								'email',

								'like',

								"%{$keyword}%"

							);


					}

				);


			}





			/*
			|--------------------------------------------------------------------------
			| Bidang
			|--------------------------------------------------------------------------
			*/


			if(Request::get('field')){


				$field = Request::get('field');



				$query->whereHas(

					'training',

					function($q) use ($field){


						$q->where(

							'training_field_id',

							$field

						);


					}

				);


			}





			/*
			|--------------------------------------------------------------------------
			| Training
			|--------------------------------------------------------------------------
			*/


			if(Request::get('training')){


				$query->where(

					'training_id',

					Request::get('training')

				);


			}





			/*
			|--------------------------------------------------------------------------
			| Status Kelulusan
			|--------------------------------------------------------------------------
			*/


			if(
				Request::get('status') === 'passed'
			){


				$query->whereHas(

					'score',

					function($q){


						$q->where(

							'is_passed',

							1

						);


					}

				);


			}





			if(
				Request::get('status') === 'failed'
			){


				$query->whereHas(

					'score',

					function($q){


						$q->where(

							'is_passed',

							0

						);


					}

				);


			}





			return $query;


		}


	}
