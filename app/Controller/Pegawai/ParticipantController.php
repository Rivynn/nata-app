<?php

	namespace Natasya\NataApp\Controller\Pegawai;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Registration;

	class ParticipantController extends Controller
	{
		public function index(): void
		{
			$registration = new Registration();

			$this->view(
				'Pegawai/Participants/index',
				[
					'title' => 'Data Peserta',

					'participants' => $registration->approved(),
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