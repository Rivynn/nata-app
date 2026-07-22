<?php

	namespace Natasya\NataApp\Controller\Admin;


	use Illuminate\Support\Str;
	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Trainer;
	use Natasya\NataApp\Model\Training;
	use Natasya\NataApp\Model\TrainingField;
	use Natasya\NataApp\Model\TrainingSchedule;

	class TrainingController extends Controller
	{
		public function index(): void
		{
			$trainings = Training::query()
				->with([
					'trainingField',
					'trainer.user',
				])
				->latest()
				->get();


			$this->view(
				'Admin/Trainings/index',
				[
					'title' => 'Data Pelatihan',

					'trainings' => $trainings,

					'total' => $trainings->count(),
				]
			);
		}
		public function status(): void
		{
			$training = $this->findTraining(
				(int) Request::post('id')
			);


			if (! $training) {

				error('Pelatihan tidak ditemukan.');

				redirect('/admin/trainings');

			}


			$newStatus = Request::post('status');


			if (! $this->canChangeStatus(
				$training,
				$newStatus
			)) {

				error(
					'Perubahan status tidak diperbolehkan.'
				);

				redirect('/admin/trainings');

			}



			$training->update([

				'status' => $newStatus,

				'updated_by' => auth()->id(),

			]);



			success(
				$this->statusMessage($newStatus)
			);


			redirect('/admin/trainings');

		}


		public function show(): void
		{
			$training = Training::query()
				->with([
					'trainingField',
					'trainer.user',
					'creator',
					'updater',
					'schedules',
					'registrations.participant.user',
				])
				->find(
					(int) Request::get('id')
				);


			if (! $training) {

				error('Pelatihan tidak ditemukan.');

				redirect('/admin/trainings');

			}


			$this->view(
				'Admin/Trainings/show',
				[
					'title' => 'Detail Pelatihan',

					'training' => $training,
				]
			);
		}



		public function create(): void
		{

			$this->view(
				'Admin/Trainings/create',
				[
					'title' => 'Tambah Pelatihan',

					'fields' => TrainingField::query()
						->where('is_active', true)
						->get(),

					'trainers' => Trainer::query()
						->with('user')
						->where('status', 'active')
						->get(),
				]
			);

		}



		public function store(): void
		{

				$training = Training::create([

					'training_field_id' => Request::post('training_field_id'),

					'trainer_id' => Request::post('trainer_id'),


					'code' => 'TRN-' . strtoupper(Str::random(6)),


					'name' => Request::post('name'),

					'slug' => Str::slug(
						Request::post('name')
					),


					'description' => Request::post('description'),

					'objective' => Request::post('objective'),

					'requirement' => Request::post('requirement'),

					'benefit' => Request::post('benefit'),


					'quota' => Request::post('quota'),

					'duration' => Request::post('duration'),


					'location' => Request::post('location'),


					'registration_open' => Request::post('registration_open'),

					'registration_close' => Request::post('registration_close'),


					'training_start' => Request::post('training_start'),

					'training_end' => Request::post('training_end'),


					'status' => Request::post('status'),


					'created_by' => auth()->id(),

				]);



				/*
				|--------------------------------------------------------------------------
				| Generate Training Schedule Otomatis
				|--------------------------------------------------------------------------
				*/


				$duration = (int) Request::post('duration');


				$startDate = \Carbon\Carbon::parse(
					Request::post('training_start')
				);



				for ($i = 1; $i <= $duration; $i++) {


					TrainingSchedule::create([

						'training_id' => $training->id,


						'meeting_number' => $i,


						'topic' => 'Pertemuan ' . $i,


						'description' => null,


						'schedule_date' => $startDate
							->copy()
							->addDays($i - 1),


						'start_time' => Request::post('start_time'),


						'end_time' => Request::post('end_time'),


						'room' => Request::post('room'),

					]);


				}






			success(
				'Pelatihan berhasil ditambahkan beserta jadwal pertemuan.'
			);


			redirect('/admin/trainings');

		}



		public function edit(): void
		{

			$training = Training::query()
				->find(
					(int) Request::get('id')
				);


			if (! $training) {

				error('Pelatihan tidak ditemukan.');

				redirect('/admin/trainings');

			}


			$this->view(
				'Admin/Trainings/edit',
				[
					'title' => 'Edit Pelatihan',

					'training' => $training,

					'fields' => TrainingField::query()
						->where('is_active', true)
						->get(),

					'trainers' => Trainer::query()
						->with('user')
						->where('status','active')
						->get(),
				]
			);

		}



		public function update(): void
		{

			$training = Training::query()
				->find(
					(int) Request::post('id')
				);


			if (! $training) {

				error('Pelatihan tidak ditemukan.');

				redirect('/admin/trainings');

			}


			$training->update([

				'training_field_id' => Request::post('training_field_id'),

				'trainer_id' => Request::post('trainer_id'),

				'name' => Request::post('name'),

				'slug' => Str::slug(
					Request::post('name')
				),

				'description' => Request::post('description'),

				'objective' => Request::post('objective'),

				'requirement' => Request::post('requirement'),

				'benefit' => Request::post('benefit'),

				'quota' => Request::post('quota'),

				'duration' => Request::post('duration'),

				'location' => Request::post('location'),

				'registration_open' => Request::post('registration_open'),

				'registration_close' => Request::post('registration_close'),

				'training_start' => Request::post('training_start'),

				'training_end' => Request::post('training_end'),

				'status' => Request::post('status'),

				'updated_by' => auth()->id(),

			]);


			success('Pelatihan berhasil diperbarui.');

			redirect('/admin/trainings');

		}



		public function delete(): void
		{

			$training = Training::query()
				->find(
					(int) Request::post('id')
				);


			if (! $training) {

				error('Pelatihan tidak ditemukan.');

				redirect('/admin/trainings');

			}


			$training->delete();


			success('Pelatihan berhasil dihapus.');

			redirect('/admin/trainings');

		}
		private function findTraining(int $id): ?Training
		{
			return Training::query()
				->find($id);
		}
		private function canChangeStatus(
			Training $training,
			string $status
		): bool
		{

			$allowed = match(true) {


				$training->isDraft() => [

					'open',

					'cancelled',

				],



				$training->isOpen() => [

					'closed',

					'running',

					'cancelled',

				],



				$training->isClosed() => [

					'running',

					'cancelled',

				],



				$training->isRunning() => [

					'completed',

				],



				default => [],

			};



			return in_array(
				$status,
				$allowed
			);

		}
		private function statusMessage(string $status): string
		{
			return match($status) {

				'open' =>
				'Pendaftaran pelatihan berhasil dibuka.',


				'closed' =>
				'Pendaftaran pelatihan berhasil ditutup.',


				'running' =>
				'Pelatihan berhasil dimulai.',


				'completed' =>
				'Pelatihan berhasil diselesaikan.',


				'cancelled' =>
				'Pelatihan berhasil dibatalkan.',


				default =>
				'Status pelatihan berhasil diperbarui.',

			};
		}
	}
