<?php

	namespace Natasya\NataApp\Controller\Admin;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Schedule;
	use Natasya\NataApp\Model\Trainer;
	use Natasya\NataApp\Model\Training;

	class ScheduleController extends Controller
	{
		public function index(): void
		{
			$this->app();

			$schedule = new Schedule();

			$this->view(
				'Admin/Schedules/index',
				[
					'title' => 'Penjadwalan',

					'schedules' => $schedule->all(),

					'total' => $schedule->count(),

					'draft' => $schedule->draft(),

					'ongoing' => $schedule->ongoing(),

					'completed' => $schedule->completed(),
				]
			);
		}

		public function create(): void
		{
			$this->app();

			$training = new Training();

			$trainer = new Trainer();

			$this->view(
				'Admin/Schedules/create',
				[
					'title' => 'Tambah Jadwal',

					'trainings' => $training->all(),

					'trainers' => $trainer->activeList(),
				]
			);
		}

		public function store(): void
		{
			$schedule = new Schedule();

			$schedule->create(
				Request::all()
			);

			$this->redirect('/admin/schedules');
		}

		public function show(): void
		{
			$this->app();

			$schedule = new Schedule();

			$this->view(
				'Admin/Schedules/show',
				[
					'title' => 'Detail Jadwal',

					'schedule' => $schedule->find(
						(int) Request::get('id')
					),
				]
			);
		}

		public function edit(): void
		{
			$this->app();

			$schedule = new Schedule();

			$training = new Training();

			$trainer = new Trainer();

			$this->view(
				'Admin/Schedules/edit',
				[
					'title' => 'Edit Jadwal',

					'schedule' => $schedule->find(
						(int) Request::get('id')
					),

					'trainings' => $training->all(),

					'trainers' => $trainer->activeList(),
				]
			);
		}

		public function update(): void
		{
			$schedule = new Schedule();

			$schedule->update(
				(int) Request::post('id'),
				Request::all()
			);

			$this->redirect('/admin/schedules');
		}

		public function delete(): void
		{
			$schedule = new Schedule();

			$schedule->delete(
				(int) Request::post('id')
			);

			$this->redirect('/admin/schedules');
		}
	}