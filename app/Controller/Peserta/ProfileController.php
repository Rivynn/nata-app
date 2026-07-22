<?php

	namespace Natasya\NataApp\Controller\Peserta;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\App\Session;
	use Natasya\NataApp\Model\Participant;
	use Natasya\NataApp\Model\ParticipantProfile;
	use Natasya\NataApp\Support\Upload;
	use function Illuminate\Support\now;

	class ProfileController extends Controller
	{
		public function index(): void
		{
			$participant = Participant::where('user_id', auth()->id())
				->with('profile')
				->firstOrFail();

			$this->view('Peserta/Profile/index', [
				'title'       => 'Biodata Peserta',
				'participant' => $participant,
				'profile'     => $participant->profile,
			]);
		}

		public function update(): void
		{
			$userId = auth()->id();

			$participant = Participant::where('user_id', $userId)->first();

			if (! $participant) {

				error('Data peserta tidak ditemukan.');

				redirect('/peserta/profile');
			}

			/*
			|--------------------------------------------------------------------------
			| Participants
			|--------------------------------------------------------------------------
			*/

			$participantData = [

				'phone' => trim(Request::post('phone')),

				'gender' => Request::post('gender'),

				'birth_date' => Request::post('birth_date'),

				'address' => trim(Request::post('address')),

				'education' => Request::post('education'),

				'institution' => trim(Request::post('institution')),

			];

			/*
			|--------------------------------------------------------------------------
			| Participant Profile
			|--------------------------------------------------------------------------
			*/

			$profileData = [

				'nik' => trim(Request::post('nik')),

				'birth_place' => trim(Request::post('birth_place')),

				'religion' => Request::post('religion'),

				'marital_status' => trim(Request::post('marital_status')) !== ''
					? trim(Request::post('marital_status'))
					: null,

				'province' => trim(Request::post('province')),

				'city' => trim(Request::post('city')),

				'district' => trim(Request::post('district')),

				'village' => trim(Request::post('village')),

				'postal_code' => trim(Request::post('postal_code')),

				'major' => trim(Request::post('major')),

				'graduation_year' => Request::post('graduation_year'),

				'employment_status' => trim(Request::post('employment_status')) !== ''
					? trim(Request::post('employment_status'))
					: null,

				'occupation' => trim(Request::post('occupation')),

				'company_name' => trim(Request::post('company_name')),

				'training_goal' => trim(Request::post('training_goal')),

				'skill' => trim(Request::post('skill')),

				'emergency_contact_name' => trim(
					Request::post('emergency_contact_name')
				),

				'emergency_contact_phone' => trim(
					Request::post('emergency_contact_phone')
				),

				'address' => trim(Request::post('address')),
			];

			/*
			|--------------------------------------------------------------------------
			| Update Participant
			|--------------------------------------------------------------------------
			*/

			$participant->update($participantData);

			/*
			|--------------------------------------------------------------------------
			| Ambil / Buat Profile
			|--------------------------------------------------------------------------
			*/

			$profile = ParticipantProfile::firstOrCreate(
				[
					'participant_id' => $participant->id,
				]
			);

			/*
			|--------------------------------------------------------------------------
			| Update Profile
			|--------------------------------------------------------------------------
			*/

			$profile->update($profileData);
			$profile->refresh();

			$profile->update([
				'is_completed' => $profile->calculateCompleted(),
				'completed_at' => $profile->calculateCompleted()
					? now()
					: null,
			]);

			/*
			|--------------------------------------------------------------------------
			| Upload Dokumen
			|--------------------------------------------------------------------------
			*/

			$documents = [];

			if (! empty($_FILES['ktp_file']['name'])) {

				$documents['ktp_file'] = Upload::file(
					$_FILES['ktp_file'],
					'participants/ktp'
				);
			}

			if (! empty($_FILES['photo']['name'])) {

				$documents['photo'] = Upload::file(
					$_FILES['photo'],
					'participants/photos'
				);
			}

			if (! empty($_FILES['cv_file']['name'])) {

				$documents['cv_file'] = Upload::file(
					$_FILES['cv_file'],
					'participants/cv'
				);
			}

			if (! empty($_FILES['ijazah_file']['name'])) {

				$documents['ijazah_file'] = Upload::file(
					$_FILES['ijazah_file'],
					'participants/ijazah'
				);
			}

			if (! empty($documents)) {

				$profile->update($documents);
			}

			/*
			|--------------------------------------------------------------------------
			| Logging
			|--------------------------------------------------------------------------
			*/

			logger(
				'info',
				'Peserta memperbarui biodata.',
				[
					'user_id' => $userId,
					'participant_id' => $participant->id,
				]
			);

			success(
				'Biodata peserta berhasil diperbarui.'
			);

			redirect('/peserta/profile');
		}
	}
