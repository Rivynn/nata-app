<?php

	namespace Natasya\NataApp\Controller\Admin;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Schedule;
	use Natasya\NataApp\Model\Trainer;
	use Natasya\NataApp\Model\Training;
	use Natasya\NataApp\Model\TrainingSchedule;

	class ScheduleController extends Controller
	{
		public function index(): void
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
				'Admin/Schedules/index',
				[
					'title' => 'Jadwal Pelatihan',

					'schedules' => $schedules
				]
			);


		}





		public function training(): void
		{


			$training = Training::query()

				->with([
					'schedules'
				])

				->find(
					(int) Request::get('id')
				);



			if(!$training){


				error(
					'Pelatihan tidak ditemukan.'
				);


				redirect(
					'/admin/trainings'
				);

			}




			$this->view(
				'Admin/Schedules/training',
				[
					'title'=>'Jadwal '.$training->name,

					'training'=>$training
				]
			);


		}





		public function edit():void
		{


			$schedule = TrainingSchedule::find(
				(int) Request::get('id')
			);



			if(!$schedule){


				error(
					'Jadwal tidak ditemukan.'
				);


				redirect(
					'/admin/schedules'
				);


			}




			$this->view(
				'Admin/Schedules/edit',
				[
					'title'=>'Edit Jadwal',

					'schedule'=>$schedule
				]
			);


		}





		public function update():void
		{


			$schedule = TrainingSchedule::find(
				(int) Request::post('id')
			);



			if(!$schedule){


				error(
					'Jadwal tidak ditemukan.'
				);


				redirect(
					'/admin/schedules'
				);


			}



			$schedule->update([


				'topic'=>Request::post('topic'),


				'description'=>Request::post('description'),


				'schedule_date'=>Request::post('schedule_date'),


				'start_time'=>Request::post('start_time'),


				'end_time'=>Request::post('end_time'),


				'room'=>Request::post('room'),


			]);



			success(
				'Jadwal berhasil diperbarui.'
			);



			redirect(
				'/admin/schedules'
			);


		}





		public function delete():void
		{


			$schedule = TrainingSchedule::find(
				(int) Request::post('id')
			);



			if(!$schedule){


				error(
					'Jadwal tidak ditemukan.'
				);


				redirect(
					'/admin/schedules'
				);


			}




			$schedule->delete();



			success(
				'Jadwal berhasil dihapus.'
			);



			redirect(
				'/admin/schedules'
			);



		}
	}
