<?php

	namespace Natasya\NataApp\Controller\Admin;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\TrainingField;

	class TrainingFieldController extends Controller
	{
		public function index(): void
		{
			$fields = TrainingField::query()
				->latest()
				->get();

			$this->view('Admin/TrainingFields/index', [
				'title'  => 'Jenis Pelatihan',
				'fields' => $fields,
				'total'  => $fields->count(),
			]);
		}

		public function show(): void
		{
			try {

				$field = TrainingField::query()->findOrFail(
					(int) Request::get('id')
				);

				$this->view('Admin/TrainingFields/show', [
					'title' => 'Detail Jenis Pelatihan',
					'field' => $field,
				]);

			} catch (Exception) {

				error(
					'Jenis pelatihan yang diminta tidak ditemukan.'
				);

				redirect('/admin/training-fields');
			}
		}

		public function create(): void
		{
			$this->view('Admin/TrainingFields/create', [
				'title' => 'Tambah Jenis Pelatihan',
			]);
		}

		public function store(): void
		{
			try {

				$name = trim(Request::post('name'));

				if ($name === '') {

					error(

						'Nama jenis pelatihan wajib diisi.'
					);

					redirect('/admin/training-fields/create');
				}

				$exists = TrainingField::query()
					->where('name', $name)
					->exists();

				if ($exists) {

					error(

						'Nama jenis pelatihan sudah digunakan.'
					);

					redirect('/admin/training-fields/create');
				}

				TrainingField::query()->create([

					'name' => $name,

					'description' => trim(Request::post('description')),

					'icon' => trim(Request::post('icon')),

					'color' => Request::post('color'),

					'is_active' => Request::post('is_active') ?? 1,

				]);

				success(
					'Jenis pelatihan berhasil ditambahkan.'
				);

			} catch (Exception) {

				error(
					'Terjadi kesalahan saat menambahkan jenis pelatihan.'
				);
			}

			redirect('/admin/training-fields');
		}

		public function edit(): void
		{
			try {

				$field = TrainingField::query()->findOrFail(
					(int) Request::get('id')
				);

				$this->view('Admin/TrainingFields/edit', [
					'title' => 'Edit Jenis Pelatihan',
					'field' => $field,
				]);

			} catch (Exception) {

				error(

					'Jenis pelatihan yang diminta tidak ditemukan.'
				);

				redirect('/admin/training-fields');
			}
		}

		public function update(): void
		{
			try {

				$field = TrainingField::query()->findOrFail(
					(int) Request::post('id')
				);

				$name = trim(Request::post('name'));

				if ($name === '') {

					error(

						'Nama jenis pelatihan wajib diisi.'
					);

					redirect('/admin/training-fields/edit?id=' . $field->id);
				}

				$exists = TrainingField::query()
					->where('name', $name)
					->where('id', '!=', $field->id)
					->exists();

				if ($exists) {

					error(

						'Nama jenis pelatihan sudah digunakan.'
					);

					redirect('/admin/training-fields/edit?id=' . $field->id);
				}

				$field->update([

					'name' => $name,

					'description' => trim(Request::post('description')),

					'icon' => trim(Request::post('icon')),

					'color' => Request::post('color'),

					'is_active' => Request::post('is_active'),

				]);

				success(
					'Jenis pelatihan berhasil diperbarui.'
				);

			} catch (Exception) {

				error(

					'Terjadi kesalahan saat memperbarui jenis pelatihan.'
				);
			}

			redirect('/admin/training-fields');
		}

		public function delete(): void
		{
			try {

				$field = TrainingField::query()->findOrFail(
					(int) Request::post('id')
				);

				$field->delete();

				success(
					'Jenis pelatihan berhasil dihapus.'
				);

			} catch (Exception) {

				error(
					'Terjadi kesalahan saat menghapus jenis pelatihan.'
				);
			}

			redirect('/admin/training-fields');
		}
	}
