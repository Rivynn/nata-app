<?php

	namespace Natasya\NataApp\Controller\Peserta;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\App\Session;
	use Natasya\NataApp\Model\Participant;
	use Natasya\NataApp\Model\ParticipantProfile;
	use Natasya\NataApp\Support\Upload;

	class ProfileController extends Controller
	{
		public function index(): void
		{
			$participantModel = new Participant();
			$profileModel     = new ParticipantProfile();

			$participant = $participantModel->findByUserId(
				auth()->id()
			);

			$profile = $profileModel->findByParticipantId(
				$participant['id']
			);

			$this->view(
				'Peserta/Profile/index',
				[
					'title'       => 'Biodata Peserta',
					'participant' => $participant,
					'profile'     => $profile,
				]
			);
		}

		public function update(): void
		{
			$participantModel = new Participant();

			$profileModel = new ParticipantProfile();

			$userId = auth()->id();

			$participant = $participantModel->findByUserId($userId);

			if (!$participant) {

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

				/*
				|--------------------------------------------------------------------------
				| Dipakai calculateCompleted()
				|--------------------------------------------------------------------------
				*/

				'address' => trim(Request::post('address')),
			];

			/*
			|--------------------------------------------------------------------------
			| Update Participants
			|--------------------------------------------------------------------------
			*/

			$participantModel->updateProfile(

				$userId,

				$participantData

			);

			/*
			|--------------------------------------------------------------------------
			| Create Profile Jika Belum Ada
			|--------------------------------------------------------------------------
			*/

			if (!$profileModel->exists($participant['id'])) {

				$profileModel->create(
					$participant['id']
				);
			}

			/*
			|--------------------------------------------------------------------------
			| Update Profile
			|--------------------------------------------------------------------------
			*/

			$profileModel->update(

				$participant['id'],

				$profileData

			);

			/*
			|--------------------------------------------------------------------------
			| Upload Dokumen
			|--------------------------------------------------------------------------
			*/

			$documents = [];

			if (!empty($_FILES['ktp_file']['name'])) {

				$documents['ktp_file'] = Upload::file(
					$_FILES['ktp_file'],
					'participants/ktp'
				);

			}

			if (!empty($_FILES['photo']['name'])) {

				$documents['photo'] = Upload::file(
					$_FILES['photo'],
					'participants/photos'
				);

			}

			if (!empty($_FILES['cv_file']['name'])) {

				$documents['cv_file'] = Upload::file(
					$_FILES['cv_file'],
					'participants/cv'
				);

			}
			if (!empty($_FILES['ijazah_file']['name'])) {

				$documents['ijazah_file'] = Upload::file(

					$_FILES['ijazah_file'],

					'participants/ijazah'

				);

			}

			if (!empty($documents)) {

				$documents = array_merge(
					[
						'ktp_file' => null,
						'photo' => null,
						'cv_file' => null,
						'ijazah_file' => null
					],
					$documents
				);

				$profileModel->updateDocuments(

					$participant['id'],

					$documents

				);
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
					'participant_id' => $participant['id'],
				]
			);

			success(
				'Biodata peserta berhasil diperbarui.'
			);

			redirect('/peserta/profile');
		}
	}
