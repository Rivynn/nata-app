<?php

	namespace Natasya\NataApp\Controller\Admin;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Participant;

	class ParticipantController extends Controller
	{
		public function index(): void
		{
			$participant = new Participant();

			$this->view(
				'Admin/Participants/index',
				[
					'title' => 'Data Peserta',

					'participants' => $participant->all(),

					'total' => $participant->count(),
				]
			);
		}

		public function show(): void
		{
			$id = (int) Request::get('id');

			$participant = new Participant();

			$data = $participant->find($id);

			if (!$data) {

				$_SESSION['error'] = 'Peserta tidak ditemukan.';

				$this->redirect('/admin/participants');

			}

			$this->view(
				'Admin/Participants/show',
				[
					'title' => 'Detail Peserta',

					'participant' => $data,
				]
			);
		}

		public function delete(): void
		{
			$participant = new Participant();

			$id = (int) Request::post('id');

			$data = $participant->find($id);

			if (!$data) {

				$_SESSION['error'] = 'Peserta tidak ditemukan.';

				$this->redirect('/admin/participants');

			}

			$participant->delete($id);

			$_SESSION['success'] = 'Peserta berhasil dihapus.';

			$this->redirect('/admin/participants');
		}
	}