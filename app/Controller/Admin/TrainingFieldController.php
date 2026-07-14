<?php

	namespace Natasya\NataApp\Controller\Admin;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\TrainingField;

	class TrainingFieldController extends Controller
	{
		public function index(): void
		{
			$field = new TrainingField();

			$this->view(
				'Admin/TrainingFields/index',
				[
					'title' => 'Jenis Pelatihan',

					'fields' => $field->all(),

					'total' => $field->count(),
				]
			);
		}

		public function show(): void
		{
			$id = (int) Request::get('id');

			$field = new TrainingField();

			$data = $field->find($id);

			if (!$data) {

				$_SESSION['error'] = 'Jenis pelatihan tidak ditemukan.';

				$this->redirect('/admin/training-fields');

			}

			$this->view(
				'Admin/TrainingFields/show',
				[
					'title' => 'Detail Jenis Pelatihan',

					'field' => $data,
				]
			);
		}

		public function create(): void
		{
			$this->view(
				'Admin/TrainingFields/create',
				[
					'title' => 'Tambah Jenis Pelatihan',
				]
			);
		}

		public function store(): void
		{
			$field = new TrainingField();

			$field->create([

				'name' => Request::post('name'),

				'description' => Request::post('description'),

				'icon' => Request::post('icon'),

				'color' => Request::post('color'),

				'is_active' => Request::post('is_active') ?? 1,

			]);

			$_SESSION['success'] = 'Jenis pelatihan berhasil ditambahkan.';

			$this->redirect('/admin/training-fields');
		}

		public function edit(): void
		{
			$id = (int) Request::get('id');

			$field = new TrainingField();

			$data = $field->find($id);

			if (!$data) {

				$_SESSION['error'] = 'Jenis pelatihan tidak ditemukan.';

				$this->redirect('/admin/training-fields');

			}

			$this->view(
				'Admin/TrainingFields/edit',
				[
					'title' => 'Edit Jenis Pelatihan',

					'field' => $data,
				]
			);
		}

		public function update(): void
		{
			$field = new TrainingField();

			$field->update(
				(int) Request::post('id'),
				[
					'name' => Request::post('name'),

					'description' => Request::post('description'),

					'icon' => Request::post('icon'),

					'color' => Request::post('color'),

					'is_active' => Request::post('is_active'),
				]
			);

			$_SESSION['success'] = 'Jenis pelatihan berhasil diperbarui.';

			$this->redirect('/admin/training-fields');
		}

		public function delete(): void
		{
			(new TrainingField())->delete(
				(int) Request::post('id')
			);

			$_SESSION['success'] = 'Jenis pelatihan berhasil dihapus.';

			$this->redirect('/admin/training-fields');
		}
	}