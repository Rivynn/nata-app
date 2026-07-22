<?php

	namespace Natasya\NataApp\Controller\Admin;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Participant;

	class ParticipantController extends Controller
	{
		public function index(): void
		{
			$participants = Participant::query()
				->with([
					'user',
					'profile',
				])
				->latest()
				->get();

			$this->view(
				'Admin/Participants/index',
				[
					'title' => 'Data Peserta',

					'participants' => $participants,

					'total' => $participants->count(),
				]
			);
		}

		public function show(): void
		{
			try {

				$participant = Participant::query()
					->with([
						'user',
						'profile',
						'registrations',
					])
					->findOrFail(
						(int) Request::get('id')
					);

				$this->view(
					'Admin/Participants/show',
					[
						'title' => 'Detail Peserta',

						'participant' => $participant,
					]
				);

			} catch (\Exception) {

				error('Peserta tidak ditemukan.');

				redirect('/admin/participants');

			}
		}

		public function delete(): void
		{
			try {

				$participant = Participant::query()->findOrFail(
					(int) Request::post('id')
				);

				$participant->delete();

				success('Peserta berhasil dihapus.');

			} catch (Exception) {

				error('Peserta tidak ditemukan.');

			}

			redirect('/admin/participants');
		}
	}
