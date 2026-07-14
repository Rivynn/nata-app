<?php

	namespace Natasya\NataApp\Controller\Admin;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Participant;
	use Natasya\NataApp\Model\Training;
	use Natasya\NataApp\Model\TrainingField;

	class ReportController extends Controller
	{
		public function index(): void
		{
			$this->app();

			$this->view(
				'Admin/Reports/index',
				[
					'title' => 'Laporan',
				]
			);
		}

		public function participants(): void
		{
			$this->app();

			$participant = new Participant();
			$training = new Training();
			$field = new TrainingField();

			$filters = [

				'keyword'    => Request::get('keyword'),
				'field'      => Request::get('field'),
				'training'   => Request::get('training'),
				'status'     => Request::get('status'),
				'start_date' => Request::get('start_date'),
				'end_date'   => Request::get('end_date'),

			];

			$participants = $participant->report($filters);

			$this->view(
				'Admin/Reports/participants',
				[
					'title' => 'Laporan Data Peserta',

					'participants' => $participants,

					'fields' => $field->all(),

					'trainings' => $training->all(),

					'filters' => $filters,
				]
			);
		}
		public function participantPrint(): void
		{
			$this->report();

			$participant = new Participant();

			$filters = [

				'keyword'    => Request::get('keyword'),
				'field'      => Request::get('field'),
				'training'   => Request::get('training'),
				'status'     => Request::get('status'),
				'start_date' => Request::get('start_date'),
				'end_date'   => Request::get('end_date'),

			];

			$this->view(
				'Admin/Reports/participant-print',
				[
					'title' => 'Cetak Laporan Peserta',

					'participants' => $participant->report($filters),
				]
			);
		}

		public function attendance(): void
		{
			$this->app();

			$this->view(
				'Admin/Reports/attendance',
				[
					'title' => 'Laporan Kehadiran',
				]
			);
		}

		public function graduation(): void
		{
			$this->app();

			$this->view(
				'Admin/Reports/graduation',
				[
					'title' => 'Laporan Kelulusan',
				]
			);
		}

		public function monitoring(): void
		{
			$this->app();

			$this->view(
				'Admin/Reports/monitoring',
				[
					'title' => 'Laporan Monitoring',
				]
			);
		}

		public function recap(): void
		{
			$this->app();

			$this->view(
				'Admin/Reports/recap',
				[
					'title' => 'Laporan Rekap',
				]
			);
		}
	}