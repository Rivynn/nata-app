<?php

	namespace Natasya\NataApp\Controller\Peserta;


	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\Model\Participant;
	use Natasya\NataApp\Model\Registration;


	class HistoryController extends Controller
	{
		public function index(): void
		{
			$participant = Participant::where(
				'user_id',
				auth()->id()
			)->firstOrFail();

			$histories = Registration::with([
				'training.trainingField',
				'training.trainer.user',
				'certificate',
				'score',
			])
				->where('participant_id', $participant->id)
				->whereIn('status', [
					'completed',
					'rejected',
				])
				->latest()
				->get();

			$this->view(
				'Peserta/History/index',
				[
					'title' => 'Riwayat Pelatihan',
					'histories' => $histories,
				]
			);
		}
	}
