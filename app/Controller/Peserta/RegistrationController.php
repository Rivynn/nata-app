<?php

	namespace Natasya\NataApp\Controller\Peserta;

	use Carbon\Carbon;
	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Participant;
	use Natasya\NataApp\Model\ParticipantProfile;
	use Natasya\NataApp\Model\Registration;
	use Natasya\NataApp\Model\Training;
	use Natasya\NataApp\Model\TrainingField;

	class RegistrationController extends Controller
	{
		public function index(): void
		{
			$participant = Participant::with('profile')
				->where('user_id', auth()->id())
				->firstOrFail();

			$filters = [
				'keyword' => trim((string) Request::get('keyword')),
				'field' => Request::get('field'),
				'sort' => Request::get('sort') ?: 'latest',
			];
			$activeRegistration = Registration::with([
				'training.trainingField',
			])
				->where('participant_id', $participant->id)
				->whereIn('status', [
					'pending',
					'approved',
					'running',
				])
				->first();

			$trainings = Training::with([
				'trainingField',
				'trainer.user',
			])
				->when($filters['keyword'], function ($query) use ($filters) {
					$query->where('name', 'like', '%' . $filters['keyword'] . '%');
				})
				->when($filters['field'], function ($query) use ($filters) {
					$query->where('training_field_id', $filters['field']);
				})
				->where('status', 'open');

			switch ($filters['sort']) {
				case 'oldest':
					$trainings->oldest();
					break;

				case 'name':
					$trainings->orderBy('name');
					break;

				case 'quota':
					$trainings->orderByDesc('quota');
					break;

				default:
					$trainings->latest();
					break;
			}

			$this->view('Peserta/Registrations/index', [
				'title' => 'Daftar Pelatihan',
				'filters' => $filters,
				'fields' => TrainingField::where('is_active', true)
					->orderBy('name')
					->get(),
				'trainings' => $trainings->get(),
				'activeRegistration' => $activeRegistration,
				'profileCompleted' => $participant->profile?->isCompleted() ?? false,
			]);
		}
		/**
		 * Status pendaftaran.
		 */
		public function status(): void
		{
			$participant = Participant::where(
				'user_id',
				auth()->id()
			)->firstOrFail();

			$registrations = Registration::with([
				'training.trainingField',
				'training.trainer.user',
				'training.schedules',
				'certificate',
				'score',
			])
				->where('participant_id', $participant->id)
				->latest()
				->get();

			$this->view(
				'Peserta/Registrations/status',
				[
					'title' => 'Status Pendaftaran',
					'registrations' => $registrations,
				]
			);
		}

		public function create(): void
		{
			$training = Training::with([
				'trainingField',
				'trainer.user',
			])->find(Request::get('id'));

			if (! $training) {

				error('Pelatihan tidak ditemukan.');

				redirect('/peserta/registrations');
			}

			$participant = Participant::with([
				'user',
				'profile',
			])
				->where('user_id', auth()->id())
				->first();

			if (! $participant) {

				error('Data peserta tidak ditemukan.');

				redirect('/peserta');
			}

			if (! ($participant->profile?->isCompleted() ?? false)) {

				error(
					'Silakan lengkapi profil peserta terlebih dahulu sebelum mendaftar pelatihan.'
				);

				redirect('/peserta/profile');
			}

			$alreadyRegistered = Registration::where(
				'participant_id',
				$participant->id
			)
				->where(
					'training_id',
					$training->id
				)
				->exists();

			if ($alreadyRegistered) {

				error(
					'Anda sudah terdaftar pada pelatihan ini.'
				);

				redirect('/peserta/registrations');
			}

			$this->view(
				'Peserta/Registrations/create',
				[

					'title'       => 'Daftar Pelatihan',

					'training'    => $training,

					'participant' => $participant,

					'profile'     => $participant->profile,

				]
			);
		}

		/**
		 * Simpan pendaftaran.
		 */
		public function store(): void
		{
			$training = Training::find(
				(int) Request::post('training_id')
			);

			if (! $training) {

				error('Pelatihan tidak ditemukan.');

				redirect('/peserta/registrations');
			}

			$participant = Participant::with('profile')
				->where(
					'user_id',
					auth()->id()
				)
				->firstOrFail();

			/*
			|--------------------------------------------------------------------------
			| Agreement
			|--------------------------------------------------------------------------
			*/

			if (! Request::post('agreement')) {

				error(
					'Anda harus menyetujui pernyataan sebelum mendaftar.'
				);

				redirect(
					'/peserta/registrations/create?id=' . $training->id
				);
			}

			/*
			|--------------------------------------------------------------------------
			| Registration Period
			|--------------------------------------------------------------------------
			*/

			$today = Carbon::today();

			if (
				$today->lt($training->registration_open)
				|| $today->gt($training->registration_close)
			) {

				error(
					'Periode pendaftaran pelatihan telah ditutup.'
				);


				redirect(
					'/peserta/registrations/create?id=' . $training->id
				);
			}

			/*
			|--------------------------------------------------------------------------
			| Training Status
			|--------------------------------------------------------------------------
			*/

			if (! $training->isOpen()) {

				error(
					'Pelatihan tidak sedang membuka pendaftaran.'
				);

				redirect('/peserta/registrations');
			}

			/*
			|--------------------------------------------------------------------------
			| Training Quota
			|--------------------------------------------------------------------------
			*/

			$registered = Registration::where(
				'training_id',
				$training->id
			)
				->whereNotIn('status', [
					'rejected',
					'cancelled',
				])
				->count();

			if ($registered >= $training->quota) {

				error(
					'Maaf, kuota pelatihan telah penuh.'
				);

				redirect('/peserta/registrations');
			}

			/*
			|--------------------------------------------------------------------------
			| Duplicate Registration
			|--------------------------------------------------------------------------
			*/

			$exists = Registration::where(
				'participant_id',
				$participant->id
			)
				->where(
					'training_id',
					$training->id
				)
				->exists();

			if ($exists) {

				error(
					'Anda sudah pernah mendaftar pelatihan tersebut.'
				);

				redirect('/peserta/registrations');
			}

			/*
			|--------------------------------------------------------------------------
			| Store Registration
			|--------------------------------------------------------------------------
			*/

			Registration::create([
				'registration_number' => Registration::generateRegistrationNumber(),
				'participant_id' => $participant->id,

				'training_id' => $training->id,

				'motivation' => trim(
					Request::post('motivation')
				),

				'status' => 'pending',

			]);

			success(
				'Pendaftaran pelatihan berhasil dikirim.'
			);

			redirect('/peserta/status');
		}
	}
