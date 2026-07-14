<?php

	namespace Natasya\NataApp\Controller\Admin;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Training;
	use Natasya\NataApp\Model\TrainingField;

	class TrainingController extends Controller
	{
		public function index(): void
		{
			$training = new Training();

			$this->view(
				'Admin/Trainings/index',
				[
					'title' => 'Data Pelatihan',

					'trainings' => $training->all(),

					'total' => count($training->all()),
				]
			);
		}

		public function show(): void
		{
			$id = (int) Request::get('id');

			$training = new Training();

			$data = $training->find($id);

			if (!$data) {

				$_SESSION['error'] = 'Pelatihan tidak ditemukan.';

				$this->redirect('/admin/trainings');

			}

			$this->view(
				'Admin/Trainings/show',
				[
					'title' => 'Detail Pelatihan',

					'training' => $data,
				]
			);
		}

		public function create(): void
		{
			$field = new TrainingField();

			$this->view(
				'Admin/Trainings/create',
				[
					'title' => 'Tambah Pelatihan',

					'fields' => $field->all(),
				]
			);
		}

		public function store(): void
		{
			$training = new Training();

			$training->create([

				'training_field_id' => Request::post('training_field_id'),

				'name' => Request::post('name'),

				'description' => Request::post('description'),

				'quota' => Request::post('quota'),

				'duration' => Request::post('duration'),

				'location' => Request::post('location'),

				'registration_open' => Request::post('registration_open'),

				'registration_close' => Request::post('registration_close'),

				'status' => Request::post('status'),

			]);

			$_SESSION['success'] = 'Pelatihan berhasil ditambahkan.';

			$this->redirect('/admin/trainings');
		}

		public function edit(): void
		{
			$id = (int) Request::get('id');

			$training = new Training();

			$field = new TrainingField();

			$data = $training->find($id);

			if (!$data) {

				$_SESSION['error'] = 'Pelatihan tidak ditemukan.';

				$this->redirect('/admin/trainings');

			}

			$this->view(
				'Admin/Trainings/edit',
				[
					'title' => 'Edit Pelatihan',

					'training' => $data,

					'fields' => $field->all(),
				]
			);
		}

		public function update(): void
		{
			$training = new Training();

			$training->update(
				(int) Request::post('id'),
				[

					'training_field_id' => Request::post('training_field_id'),

					'name' => Request::post('name'),

					'description' => Request::post('description'),

					'quota' => Request::post('quota'),

					'duration' => Request::post('duration'),

					'location' => Request::post('location'),

					'registration_open' => Request::post('registration_open'),

					'registration_close' => Request::post('registration_close'),

					'status' => Request::post('status'),

				]
			);

			$_SESSION['success'] = 'Pelatihan berhasil diperbarui.';

			$this->redirect('/admin/trainings');
		}

		public function delete(): void
		{
			(new Training())->delete(
				(int) Request::post('id')
			);

			$_SESSION['success'] = 'Pelatihan berhasil dihapus.';

			$this->redirect('/admin/trainings');
		}
	}