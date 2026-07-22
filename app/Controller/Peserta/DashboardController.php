<?php

	namespace Natasya\NataApp\Controller\Peserta;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\Model\Certificate;
	use Natasya\NataApp\Model\Participant;
	use Natasya\NataApp\Model\Registration;
	use Natasya\NataApp\Model\Training;
	use Natasya\NataApp\Model\TrainingField;

	class DashboardController extends Controller
	{
		public function index(): void
		{
			$user = auth()->user();
			$participant = Participant::with([ 'user', ])->where('user_id', $user->id)->first();
			$fields = TrainingField::where('is_active', true) ->orderBy('name') ->get();
			$registrations = Registration::with([ 'training', ]) ->where('participant_id', $participant?->id) ->latest() ->get();
			$certificates = Certificate::with([ 'registration.training', ])
				->whereHas('registration', function ($query) use ($participant) {
					$query->where('participant_id', $participant?->id);
				}) ->latest()->get();
			$profile = $participant?->profile;

			$profileCompleted = $profile?->isCompleted() ?? false;

			$this->view('Dashboard/peserta', [
				'title' => 'Dashboard',
				'fields' => $fields,
				'participant' => $participant,
				'profile' => $participant,
				'profileCompleted' => $profileCompleted,
				'registrations' => $registrations,
				'certificates' => $certificates,
				]);
		}
	}
