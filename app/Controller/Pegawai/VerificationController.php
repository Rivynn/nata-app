<?php

	namespace Natasya\NataApp\Controller\Pegawai;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Registration;
	use Natasya\NataApp\Model\Training;
	use Natasya\NataApp\Model\TrainingField;
	use function Illuminate\Support\now;

	class VerificationController extends Controller
	{
		/**
		 * Daftar verifikasi.
		 */
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
			| Statistics
			|--------------------------------------------------------------------------
			*/

			$pending = Registration::where('status', 'pending')->count();

			$approved = Registration::where('status', 'approved')->count();

			$rejected = Registration::where('status', 'rejected')->count();

			$total = $pending + $approved + $rejected;

			/*
			|--------------------------------------------------------------------------
			| Progress
			|--------------------------------------------------------------------------
			*/

			$pendingPercent = $total
				? round(($pending / $total) * 100)
				: 0;

			$approvedPercent = $total
				? round(($approved / $total) * 100)
				: 0;

			$rejectedPercent = $total
				? round(($rejected / $total) * 100)
				: 0;

			/*
			|--------------------------------------------------------------------------
			| Registrations
			|--------------------------------------------------------------------------
			*/

			$registrationQuery = Registration::with([
				'participant.user',
				'participant.profile',
				'training.trainingField',
				'training.trainer.user',
			])->where(
				'status',
				'pending'
			);

			if ($selectedTraining > 0) {

				$registrationQuery->where(
					'training_id',
					$selectedTraining
				);

			}

			if ($selectedField > 0) {

				$registrationQuery->whereHas(
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

					$registrationQuery->oldest('created_at');

					break;

				case 'name':

					$registrationQuery->join(
						'participants',
						'participants.id',
						'=',
						'registrations.participant_id'
					)
						->join(
							'user_profiles',
							'user_profiles.user_id',
							'=',
							'participants.user_id'
						)
						->orderBy(
							'user_profiles.full_name'
						)
						->select('registrations.*');

					break;

				default:

					$registrationQuery->latest();

					break;

			}

			$registrations = $registrationQuery->get();

			/*
			|--------------------------------------------------------------------------
			| Priority Queue
			|--------------------------------------------------------------------------
			*/

			$priorityRegistrations = Registration::with([
				'participant.user',
				'participant.profile',
				'training.trainingField',
			])
				->where('status', 'pending')
				->oldest('created_at')
				->take(5)
				->get();

			/*
			|--------------------------------------------------------------------------
			| Training Filters
			|--------------------------------------------------------------------------
			*/

			$trainings = Training::withCount([
				'registrations as pending_count' => function ($query) {

					$query->where(
						'status',
						'pending'
					);

				},
			])
				->having('pending_count', '>', 0)
				->orderByDesc('pending_count')
				->orderBy('name')
				->get();

			/*
			|--------------------------------------------------------------------------
			| Training Fields
			|--------------------------------------------------------------------------
			*/

			$trainingFields = TrainingField::orderBy('name')->get();

			/*
			|--------------------------------------------------------------------------
			| View
			|--------------------------------------------------------------------------
			*/

			$this->view(
				'Pegawai/Verifications/index',
				[

					'title' => 'Verifikasi Peserta',

					/*
					|--------------------------------------------------------------------------
					| Statistics
					|--------------------------------------------------------------------------
					*/

					'pending' => $pending,

					'approved' => $approved,

					'rejected' => $rejected,

					'total' => $total,

					/*
					|--------------------------------------------------------------------------
					| Progress
					|--------------------------------------------------------------------------
					*/

					'pendingPercent' => $pendingPercent,

					'approvedPercent' => $approvedPercent,

					'rejectedPercent' => $rejectedPercent,

					/*
					|--------------------------------------------------------------------------
					| Filters
					|--------------------------------------------------------------------------
					*/

					'trainings' => $trainings,

					'trainingFields' => $trainingFields,

					'selectedTraining' => $selectedTraining,

					'selectedField' => $selectedField,

					'sort' => $sort,

					/*
					|--------------------------------------------------------------------------
					| Data
					|--------------------------------------------------------------------------
					*/

					'registrations' => $registrations,

					'priorityRegistrations' => $priorityRegistrations,

				]
			);
		}

		/**
		 * Detail pendaftaran.
		 */
		public function show(): void
		{
			$id = (int) Request::get('id');

			$registration = Registration::with([

				/*
				|--------------------------------------------------------------------------
				| Participant
				|--------------------------------------------------------------------------
				*/

				'participant.user',
				'participant.profile',

				/*
				|--------------------------------------------------------------------------
				| Training
				|--------------------------------------------------------------------------
				*/

				'training.trainingField',
				'training.trainer.user',

				/*
				|--------------------------------------------------------------------------
				| Optional
				|--------------------------------------------------------------------------
				*/

				'certificate',
				'score',
				'attendances',

			])->find($id);

			if (! $registration) {

				error('Data tidak ditemukan.');

				$this->redirect('/pegawai/verifications');
			}

			$this->view(
				'Pegawai/Verifications/show',
				[

					'title' => 'Detail Verifikasi',

					'registration' => $registration,

				]
			);
		}

		/**
		 * Setujui pendaftaran.
		 */
		public function approve(): void
		{
			$id = (int) Request::post('id');

			$registration = Registration::find($id);

			if (! $registration) {

				error('Data tidak ditemukan.');

				$this->redirect('/pegawai/verifications');
			}

			$registration->update([
				'status' => 'approved',
				'approved_by' => auth()->id(),
				'approved_at' => now(),
				'updated_by' => auth()->id(),
			]);

			success('Peserta berhasil disetujui.');

			$this->redirect('/pegawai/verifications');
		}

		/**
		 * Tolak pendaftaran.
		 */
		public function reject(): void
		{
			$id = (int) Request::post('id');

			$reason = trim(
				Request::post('reason')
			);

			$registration = Registration::find($id);

			if (! $registration) {

				error('Data tidak ditemukan.');

				$this->redirect('/pegawai/verifications');
			}

			$registration->update([
				'status' => 'rejected',
				'rejected_reason' => $reason,
				'rejected_by' => auth()->id(),
				'rejected_at' => now(),
				'updated_by' => auth()->id(),
			]);

			success('Pendaftaran berhasil ditolak.');

			$this->redirect('/pegawai/verifications');
		}
	}
