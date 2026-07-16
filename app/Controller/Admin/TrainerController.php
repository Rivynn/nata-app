<?php

	namespace Natasya\NataApp\Controller\Admin;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Trainer;
	use Natasya\NataApp\Model\TrainingField;

	class TrainerController extends Controller
	{
		public function index(): void
		{
			$this->app();

			$trainer = new Trainer();

			$this->view(
				'Admin/Trainers/index',
				[
					'title' => 'Data Pelatih',

					'trainers' => $trainer->all(),

					'total' => $trainer->count(),

					'fields' => $trainer->countByField(),
					'active' => '10',
					'inactive' => '1'
				]
			);
		}

		public function create(): void
		{
			$this->app();

			$field = new TrainingField();

			$this->view(
				'Admin/Trainers/create',
				[
					'title' => 'Tambah Pelatih',

					'fields' => $field->all(),
				]
			);
		}

		public function store(): void
		{
			$trainer = new Trainer();

			$trainer->create(Request::all());

			$this->redirect('/admin/trainers');
		}

		public function show(): void
		{
			$this->app();

			$trainer = new Trainer();

			$this->view(
				'Admin/Trainers/show',
				[
					'title' => 'Detail Pelatih',

					'trainer' => $trainer->find(
						(int) Request::get('id')
					),
				]
			);
		}

		public function edit(): void
		{
			$this->app();

			$trainer = new Trainer();

			$field = new TrainingField();

			$this->view(
				'Admin/Trainers/edit',
				[
					'title' => 'Edit Pelatih',

					'trainer' => $trainer->find(
						(int) Request::get('id')
					),

					'fields' => $field->all(),
				]
			);
		}

		public function update(): void
		{
			$trainer = new Trainer();

			$trainer->update(
				(int) Request::post('id'),
				Request::all()
			);

			$this->redirect('/admin/trainers');
		}

		public function delete(): void
		{
			$trainer = new Trainer();

			$trainer->delete(
				(int) Request::post('id')
			);

			$this->redirect('/admin/trainers');
		}
	}
