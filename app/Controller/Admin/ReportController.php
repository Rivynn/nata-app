<?php

	namespace Natasya\NataApp\Controller\Admin;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\App\View;
	use Natasya\NataApp\Model\Certificate;
	use Natasya\NataApp\Model\Participant;
	use Natasya\NataApp\Model\Registration;
	use Natasya\NataApp\Model\Trainer;
	use Natasya\NataApp\Model\Training;
	use Natasya\NataApp\Model\TrainingAttendance;
	use Natasya\NataApp\Model\TrainingField;
	use Natasya\NataApp\Model\TrainingSchedule;
	use Natasya\NataApp\Model\TrainingScore;

	class ReportController extends Controller
	{
		public function index(): void
		{
			$this->view(
				'Admin/Reports/index',
				[

					'title' => 'Dashboard Laporan',


					'reports' => [


						[
							'title' => 'Laporan Pelatihan',

							'description' => 'Data program pelatihan, bidang, trainer, kuota, dan status pelaksanaan.',

							'icon' => 'fas fa-book-open',

							'color' => 'success',

							'url' => url('/admin/reports/trainings'),
						],



						[
							'title' => 'Laporan Peserta',

							'description' => 'Data peserta beserta riwayat pendaftaran pelatihan.',

							'icon' => 'fas fa-user-graduate',

							'color' => 'primary',

							'url' => url('/admin/reports/participants'),
						],




						[
							'title' => 'Laporan Kehadiran',

							'description' => 'Rekap absensi dan tingkat kehadiran peserta pelatihan.',

							'icon' => 'fas fa-calendar-check',

							'color' => 'info',

							'url' => url('/admin/reports/attendance'),
						],




						[
							'title' => 'Laporan Penilaian',

							'description' => 'Data nilai dan evaluasi hasil pelatihan peserta.',

							'icon' => 'fas fa-star',

							'color' => 'warning',

							'url' => url('/admin/reports/scores'),
						],





						[
							'title' => 'Laporan Kelulusan',

							'description' => 'Data peserta yang berhasil menyelesaikan pelatihan.',

							'icon' => 'fas fa-award',

							'color' => 'success',

							'url' => url('/admin/reports/graduations'),
						],






						[
							'title' => 'Laporan Sertifikat',

							'description' => 'Data sertifikat peserta yang telah diterbitkan.',

							'icon' => 'fas fa-certificate',

							'color' => 'danger',

							'url' => url('/admin/reports/certificates'),
						],






						[
							'title' => 'Rekapitulasi',

							'description' => 'Ringkasan data pelatihan, peserta, kehadiran, dan hasil akhir.',

							'icon' => 'fas fa-table',

							'color' => 'secondary',

							'url' => url('/admin/reports/recapitulation'),
						],



					],

				]
			);
		}

		public function participants(): void
		{

			$participants = $this->participantQuery()

				->latest()

				->get();



			$this->view(
				'Admin/Reports/participants',
				[

					'title' => 'Laporan Data Peserta',


					'participants' => $participants,



					'fields' => TrainingField::query()

						->where('is_active', true)

						->get(),



					'trainings' => Training::query()

						->latest()

						->get(),



					'filters' => [

						'keyword' => Request::get('keyword'),

						'field' => Request::get('field'),

						'training' => Request::get('training'),

						'status' => Request::get('status'),

						'start_date' => Request::get('start_date'),

						'end_date' => Request::get('end_date'),

					],

				]
			);

		}





		private function participantQuery()
		{

			$query = Participant::query()

				->with([

					'user',

					'profile',

					'registrations.training.trainingField'

				]);





			if(Request::get('keyword')) {


				$keyword = Request::get('keyword');


				$query->whereHas('user', function($q) use ($keyword){


					$q->where('name','like',"%{$keyword}%")

						->orWhere('email','like',"%{$keyword}%");


				});


			}





			if(Request::get('field')) {


				$field = Request::get('field');


				$query->whereHas(
					'registrations.training',
					function($q) use ($field){


						$q->where(
							'training_field_id',
							$field
						);


					}
				);


			}





			if(Request::get('training')) {


				$training = Request::get('training');


				$query->whereHas(
					'registrations',
					function($q) use ($training){


						$q->where(
							'training_id',
							$training
						);


					}
				);


			}





			if(Request::get('status')) {


				$status = Request::get('status');


				$query->whereHas(
					'registrations',
					function($q) use ($status){


						$q->where(
							'status',
							$status
						);


					}
				);


			}





			if(Request::get('start_date')) {


				$query->whereDate(

					'created_at',

					'>=',

					Request::get('start_date')

				);


			}





			if(Request::get('end_date')) {


				$query->whereDate(

					'created_at',

					'<=',

					Request::get('end_date')

				);


			}





			return $query;

		}





		public function participantPrint(): void
		{

			$this->report();



			$participants = $this->participantQuery()

				->latest()

				->get();





			$this->view(
				'Admin/Reports/participant-print',
				[

					'title' => 'Cetak Laporan Data Peserta',


					'participants' => $participants,


					'printed_at' => date('d M Y H:i'),

				]
			);

		}


		public function trainings(): void
		{

			$trainings = $this->trainingQuery()

				->latest()

				->get();




			$this->view(
				'Admin/Reports/trainings',
				[


					'title' => 'Laporan Data Pelatihan',



					'trainings' => $trainings,



					'fields' => TrainingField::query()

						->where('is_active', true)

						->get(),



					'trainers' => Trainer::query()

						->with('user')

						->where('status', 'active')

						->get(),



					'filters' => [

						'keyword' => Request::get('keyword'),

						'field' => Request::get('field'),

						'trainer' => Request::get('trainer'),

						'status' => Request::get('status'),

						'start_date' => Request::get('start_date'),

						'end_date' => Request::get('end_date'),

					],


				]
			);

		}





		private function trainingQuery(): \Illuminate\Database\Eloquent\Builder
		{

			$query = Training::query()

				->with([

					'trainingField',

					'trainer.user',

					'registrations'

				]);





			if (Request::get('keyword')) {


				$keyword = Request::get('keyword');


				$query->where(function($q) use ($keyword){


					$q->where('name', 'like', "%{$keyword}%")

						->orWhere('code', 'like', "%{$keyword}%");


				});


			}





			if (Request::get('field')) {


				$query->where(

					'training_field_id',

					Request::get('field')

				);


			}





			if (Request::get('trainer')) {


				$query->where(

					'trainer_id',

					Request::get('trainer')

				);


			}





			if (Request::get('status')) {


				$query->where(

					'status',

					Request::get('status')

				);


			}





			if (Request::get('start_date')) {


				$query->whereDate(

					'training_start',

					'>=',

					Request::get('start_date')

				);


			}





			if (Request::get('end_date')) {


				$query->whereDate(

					'training_end',

					'<=',

					Request::get('end_date')

				);


			}





			return $query;

		}





		public function trainingPrint(): void
		{

			$this->report();



			$trainings = $this->trainingQuery()

				->latest()

				->get();





			$this->view(
				'Admin/Reports/training-print',
				[

					'title' => 'Cetak Laporan Pelatihan',


					'trainings' => $trainings,


					'printed_at' => date('d M Y H:i'),

				]
			);

		}






		public function schedules(): void
		{


			$schedules = TrainingSchedule::query()

				->with([

					'training.trainingField',

					'training.trainer.user'

				])


				->orderBy(
					'schedule_date'
				)


				->get();





			$this->view(
				'Admin/Reports/schedules',
				[

					'title'=>'Laporan Jadwal Pelatihan',


					'schedules'=>$schedules,

				]
			);


		}








		public function attendance(): void
		{

			$attendances = $this->attendanceQuery()

				->latest()

				->get();



			$this->view(
				'Admin/Reports/attendances',
				[

					'title' => 'Laporan Kehadiran Peserta',



					'attendances' => $attendances,



					'trainings' => Training::query()

						->latest()

						->get(),



					'fields' => TrainingField::query()

						->where('is_active', true)

						->get(),



					'filters' => [

						'keyword' => Request::get('keyword'),

						'training' => Request::get('training'),

						'field' => Request::get('field'),

						'status' => Request::get('status'),

						'start_date' => Request::get('start_date'),

						'end_date' => Request::get('end_date'),

					],


				]
			);

		}





		private function attendanceQuery(): \Illuminate\Database\Eloquent\Builder
		{

			$query = TrainingAttendance::query()

				->with([

					'attendanceSession.trainingSchedule.training.trainingField',

					'attendanceSession.trainingSchedule.training.trainer.user',

					'registration.participant.user',

				]);





			if(Request::get('keyword')) {


				$keyword = Request::get('keyword');


				$query->whereHas(
					'registration.participant.user',
					function($q) use ($keyword){


						$q->where('name','like',"%{$keyword}%")

							->orWhere('email','like',"%{$keyword}%");


					}
				);


			}





			if(Request::get('training')) {


				$query->whereHas(

					'attendanceSession.trainingSchedule',

					function($q){


						$q->where(
							'training_id',
							Request::get('training')
						);


					}

				);


			}





			if(Request::get('field')) {


				$query->whereHas(

					'attendanceSession.trainingSchedule.training',

					function($q){


						$q->where(
							'training_field_id',
							Request::get('field')
						);


					}

				);


			}





			if(Request::get('status')) {


				$query->where(

					'status',

					Request::get('status')

				);


			}





			if(Request::get('start_date')) {


				$query->whereDate(

					'attended_at',

					'>=',

					Request::get('start_date')

				);


			}





			if(Request::get('end_date')) {


				$query->whereDate(

					'attended_at',

					'<=',

					Request::get('end_date')

				);


			}





			return $query;

		}





		public function attendancePrint(): void
		{

			$this->report();



			$attendances = $this->attendanceQuery()

				->latest()

				->get();





			$this->view(
				'Admin/Reports/attendance-print',
				[

					'title' => 'Cetak Laporan Kehadiran',


					'attendances' => $attendances,


					'printed_at' => date('d M Y H:i'),

				]
			);

		}


		public function scores(): void
		{

			$scores = $this->scoreQuery()

				->latest()

				->get();



			$this->view(
				'Admin/Reports/scores',
				[

					'title' => 'Laporan Penilaian Peserta',



					'scores' => $scores,



					'fields' => TrainingField::query()

						->where('is_active', true)

						->get(),



					'trainings' => Training::query()

						->latest()

						->get(),



					'filters' => [

						'keyword' => Request::get('keyword'),

						'field' => Request::get('field'),

						'training' => Request::get('training'),

						'status' => Request::get('status'),

						'start_date' => Request::get('start_date'),

						'end_date' => Request::get('end_date'),

					],


				]
			);

		}

		private function scoreQuery(): \Illuminate\Database\Eloquent\Builder
		{

			$query = TrainingScore::query()

				->with([

					'registration.participant.user',

					'registration.training.trainingField',

				]);





			/*
			|--------------------------------------------------------------------------
			| Keyword Peserta
			|--------------------------------------------------------------------------
			*/


			if(Request::get('keyword')) {


				$keyword = Request::get('keyword');


				$query->whereHas(

					'registration.participant.user',

					function($q) use ($keyword){


						$q->where('name','like',"%{$keyword}%")

							->orWhere('email','like',"%{$keyword}%");


					}

				);


			}





			/*
			|--------------------------------------------------------------------------
			| Filter Bidang
			|--------------------------------------------------------------------------
			*/


			if(Request::get('field')) {


				$field = Request::get('field');


				$query->whereHas(

					'registration.training',

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
			| Filter Training
			|--------------------------------------------------------------------------
			*/


			if(Request::get('training')) {


				$training = Request::get('training');


				$query->whereHas(

					'registration',

					function($q) use ($training){


						$q->where(

							'training_id',

							$training

						);


					}

				);


			}





			/*
			|--------------------------------------------------------------------------
			| Filter Status Kelulusan
			|--------------------------------------------------------------------------
			*/


			if(Request::get('status')) {


				switch(Request::get('status')){


					case 'passed':


						$query->where(
							'is_passed',
							true
						);


						break;




					case 'failed':


						$query->where(
							'is_passed',
							false
						);


						break;


				}


			}





			/*
			|--------------------------------------------------------------------------
			| Filter Tanggal
			|--------------------------------------------------------------------------
			*/


			if(Request::get('start_date')) {


				$query->whereDate(

					'created_at',

					'>=',

					Request::get('start_date')

				);


			}





			if(Request::get('end_date')) {


				$query->whereDate(

					'created_at',

					'<=',

					Request::get('end_date')

				);


			}





			return $query;

		}
		public function scorePrint(): void
		{

			$this->report();



			$scores = $this->scoreQuery()

				->latest()

				->get();





			$this->view(
				'Admin/Reports/score-print',
				[

					'title' => 'Cetak Laporan Penilaian',


					'scores' => $scores,


					'printed_at' => date('d M Y H:i'),


				]
			);

		}

		public function graduations(): void
		{

			$scores = $this->graduationQuery()

				->latest()

				->get();



			$this->view(
				'Admin/Reports/graduations',
				[

					'title' => 'Laporan Kelulusan Peserta',



					'scores' => $scores,



					'fields' => TrainingField::query()

						->where('is_active', true)

						->get(),



					'trainings' => Training::query()

						->latest()

						->get(),



					'filters' => [

						'keyword' => Request::get('keyword'),

						'field' => Request::get('field'),

						'training' => Request::get('training'),

						'start_date' => Request::get('start_date'),

						'end_date' => Request::get('end_date'),

					],

				]
			);

		}


		private function graduationQuery(): \Illuminate\Database\Eloquent\Builder
		{

			$query = TrainingScore::query()

				->with([

					'registration.participant.user',

					'registration.training.trainingField',

				])

				->where(
					'is_passed',
					true
				);





			/*
			|--------------------------------------------------------------------------
			| Keyword Peserta
			|--------------------------------------------------------------------------
			*/


			if(Request::get('keyword')) {


				$keyword = Request::get('keyword');


				$query->whereHas(

					'registration.participant.user',

					function($q) use ($keyword){


						$q->where('name','like',"%{$keyword}%")

							->orWhere('email','like',"%{$keyword}%");


					}

				);


			}





			/*
			|--------------------------------------------------------------------------
			| Bidang
			|--------------------------------------------------------------------------
			*/


			if(Request::get('field')) {


				$query->whereHas(

					'registration.training',

					function($q){


						$q->where(

							'training_field_id',

							Request::get('field')

						);


					}

				);


			}





			/*
			|--------------------------------------------------------------------------
			| Training
			|--------------------------------------------------------------------------
			*/


			if(Request::get('training')) {


				$query->whereHas(

					'registration',

					function($q){


						$q->where(

							'training_id',

							Request::get('training')

						);


					}

				);


			}





			/*
			|--------------------------------------------------------------------------
			| Periode Kelulusan
			|--------------------------------------------------------------------------
			*/


			if(Request::get('start_date')) {


				$query->whereDate(

					'published_at',

					'>=',

					Request::get('start_date')

				);


			}





			if(Request::get('end_date')) {


				$query->whereDate(

					'published_at',

					'<=',

					Request::get('end_date')

				);


			}





			return $query;

		}





		public function graduationPrint(): void
		{

			$this->report();



			$scores = $this->graduationQuery()

				->latest()

				->get();





			$this->view(
				'Admin/Reports/graduation-print',
				[

					'title' => 'Cetak Laporan Kelulusan',


					'scores' => $scores,


					'printed_at' => date('d M Y H:i'),

				]
			);

		}







		public function monitoring(): void
		{


			$this->view(
				'Admin/Reports/monitoring',
				[

					'title'=>'Laporan Monitoring'

				]
			);


		}








		public function recapitulation(): void
		{

			$summary = $this->recapitulationData();



			$this->view(
				'Admin/Reports/recapitulation',
				[

					'title' => 'Laporan Rekapitulasi',


					'summary' => $summary,



					'fields' => TrainingField::query()

						->where('is_active', true)

						->get(),



					'filters' => [

						'field' => Request::get('field'),

						'start_date' => Request::get('start_date'),

						'end_date' => Request::get('end_date'),

					],

				]
			);

		}





		private function recapitulationData(): array
		{

			$trainingQuery = Training::query();



			if(Request::get('field')) {


				$trainingQuery->where(
					'training_field_id',
					Request::get('field')
				);


			}





			if(Request::get('start_date')) {


				$trainingQuery->whereDate(
					'training_start',
					'>=',
					Request::get('start_date')
				);


			}





			if(Request::get('end_date')) {


				$trainingQuery->whereDate(
					'training_end',
					'<=',
					Request::get('end_date')
				);


			}





			$trainings = $trainingQuery

				->with([

					'trainingField',

					'registrations',

				])

				->get();





			return [

				'total_training' => $trainings->count(),



				'total_registration' => Registration::query()

					->whereIn(
						'training_id',
						$trainings->pluck('id')
					)

					->count(),



				'total_participant' => Registration::query()

					->whereIn(
						'training_id',
						$trainings->pluck('id')
					)

					->distinct('participant_id')

					->count('participant_id'),




				'total_attendance' => TrainingAttendance::query()

					->whereHas(
						'attendanceSession.trainingSchedule',
						function($q) use ($trainings){

							$q->whereIn(
								'training_id',
								$trainings->pluck('id')
							);

						}
					)

					->where(
						'status',
						'present'
					)

					->count(),




				'total_graduation' => TrainingScore::query()

					->whereIn(
						'registration_id',

						Registration::query()

							->whereIn(
								'training_id',
								$trainings->pluck('id')
							)

							->pluck('id')

					)

					->where(
						'is_passed',
						true
					)

					->count(),




				'trainings' => $trainings,

			];

		}
		public function recapitulationPrint(): void
		{

			$this->report();



			$summary = $this->recapitulationData();





			$this->view(
				'Admin/Reports/recapitulation-print',
				[

					'title' => 'Cetak Laporan Rekapitulasi',


					'summary' => $summary,


					'printed_at' => date('d M Y H:i'),

				]
			);

		}
		public function certificates(): void
		{

			$certificates = $this->certificateQuery()

				->latest()

				->get();



			$this->view(
				'Admin/Reports/certificates',
				[

					'title' => 'Laporan Sertifikat Peserta',



					'certificates' => $certificates,



					'fields' => TrainingField::query()

						->where('is_active', true)

						->get(),



					'trainings' => Training::query()

						->latest()

						->get(),



					'filters' => [

						'keyword' => Request::get('keyword'),

						'field' => Request::get('field'),

						'training' => Request::get('training'),

						'status' => Request::get('status'),

						'start_date' => Request::get('start_date'),

						'end_date' => Request::get('end_date'),

					],

				]
			);

		}





		private function certificateQuery(): \Illuminate\Database\Eloquent\Builder
		{

			$query = Certificate::query()

				->with([

					'registration.participant.user',

					'registration.training.trainingField',

				]);





			/*
			|--------------------------------------------------------------------------
			| Keyword Peserta
			|--------------------------------------------------------------------------
			*/


			if(Request::get('keyword')) {


				$keyword = Request::get('keyword');


				$query->whereHas(

					'registration.participant.user',

					function($q) use ($keyword){


						$q->where('name','like',"%{$keyword}%")

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


			if(Request::get('field')) {


				$field = Request::get('field');


				$query->whereHas(

					'registration.training',

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


			if(Request::get('training')) {


				$training = Request::get('training');


				$query->whereHas(

					'registration',

					function($q) use ($training){


						$q->where(
							'training_id',
							$training
						);


					}

				);


			}





			/*
			|--------------------------------------------------------------------------
			| Status
			|--------------------------------------------------------------------------
			*/


			if(Request::get('status')) {


				$query->where(

					'status',

					Request::get('status')

				);


			}





			/*
			|--------------------------------------------------------------------------
			| Periode Terbit
			|--------------------------------------------------------------------------
			*/


			if(Request::get('start_date')) {


				$query->whereDate(

					'issued_at',

					'>=',

					Request::get('start_date')

				);


			}





			if(Request::get('end_date')) {


				$query->whereDate(

					'issued_at',

					'<=',

					Request::get('end_date')

				);


			}





			return $query;

		}





		public function certificatePrint(): void
		{

			$this->report();



			$certificates = $this->certificateQuery()

				->latest()

				->get();





			$this->view(
				'Admin/Reports/certificate-print',
				[

					'title' => 'Cetak Laporan Sertifikat',


					'certificates' => $certificates,


					'printed_at' => date('d M Y H:i'),

				]
			);

		}

		public function hutangPrint(): void
		{
			$this->report();

			$this->view(
				'Admin/Reports/hutang-print',
				[

					'title' => 'Surat Penagihan Hutang',


					'printed_at' => date('d M Y H:i'),



					'creditor' => [

						'name' => 'Rizki Firdaus',

						'address' => 'Banjarbaru',

					],




					'debtor' => [

						'name' => 'Natasya Deviana',

						'address' => 'Banjarbaru',

					],




					'debt' => [

						'amount' => 100000000,

						'formatted' => 'Rp100.000.000,-',

						'label' => 'Seratus Juta Rupiah',

					],




					'letter' => [

						'number' => '001/SPH/RF/VII/2026',

						'city' => 'Banjarbaru',

					],


				]
			);

		}
	}
