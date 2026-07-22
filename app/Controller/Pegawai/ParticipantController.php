<?php

	namespace Natasya\NataApp\Controller\Pegawai;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Registration;
	use Natasya\NataApp\Model\Training;
	use Natasya\NataApp\Model\TrainingField;

	class ParticipantController extends Controller
	{
		public function index(): void
		{
			/*
			|--------------------------------------------------------------------------
			| Filters
			|--------------------------------------------------------------------------
			*/

			$selectedTraining = (int) Request::get('training');

			$selectedField = (int) Request::get('field');

			$sort = Request::get('sort') ?: 'latest';

			/*
			|--------------------------------------------------------------------------
			| Participants
			|--------------------------------------------------------------------------
			*/

			$query = Registration::with([
				'participant.user',
				'participant.profile',
				'training.trainingField',
				'training.trainer.user',
				'approver',
			])->where(
				'status',
				'approved'
			);

			if ($selectedTraining > 0) {

				$query->where(
					'training_id',
					$selectedTraining
				);

			}

			if ($selectedField > 0) {

				$query->whereHas(
					'training',
					function ($query) use ($selectedField) {

						$query->where(
							'training_field_id',
							$selectedField
						);

					}
				);

			}

			switch ($sort) {

				case 'oldest':

					$query->oldest();

					break;

				default:

					$query->latest();

					break;

			}

			$participants = $query->get();

			/*
			|--------------------------------------------------------------------------
			| Statistics
			|--------------------------------------------------------------------------
			*/

			$totalParticipants = $participants->count();

			$thisMonthParticipants = $participants
				->filter(fn ($participant) => $participant->approved_at?->format('Y-m') === date('Y-m'))
				->count();

			$totalTrainings = Training::has('registrations')->count();

			/*
			|--------------------------------------------------------------------------
			| Filters
			|--------------------------------------------------------------------------
			*/

			$trainings = Training::withCount([
				'registrations as approved_count' => function ($query) {

					$query->where(
						'status',
						'approved'
					);

				},
			])
				->having('approved_count', '>', 0)
				->orderByDesc('approved_count')
				->get();

			$trainingFields = TrainingField::orderBy('name')->get();

			/*
			|--------------------------------------------------------------------------
			| View
			|--------------------------------------------------------------------------
			*/

			$this->view(
				'Pegawai/Participants/index',
				[
					'title' => 'Data Peserta',

					'participants' => $participants,

					'totalParticipants' => $totalParticipants,

					'totalTrainings' => $totalTrainings,

					'thisMonthParticipants' => $thisMonthParticipants,

					'trainings' => $trainings,

					'trainingFields' => $trainingFields,

					'selectedTraining' => $selectedTraining,

					'selectedField' => $selectedField,

					'sort' => $sort,
				]
			);
		}

		public function show(): void
		{
			$id = (int) Request::get('id');

			$registration = new Registration();

			$participant = $registration->find($id);

			if (!$participant) {

				$_SESSION['error'] = 'Data peserta tidak ditemukan.';

				$this->redirect('/pegawai/participants');
			}

			$this->view(
				'Pegawai/Participants/show',
				[
					'title' => 'Detail Peserta',

					'participant' => $participant,
				]
			);
		}
	}
