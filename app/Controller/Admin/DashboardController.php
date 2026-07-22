<?php

	namespace Natasya\NataApp\Controller\Admin;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\Model\Participant;
	use Natasya\NataApp\Model\Trainer;
	use Natasya\NataApp\Model\Training;
	use Natasya\NataApp\Model\User;

	class DashboardController extends Controller
	{
		public function index(): void
		{
			$totalUsers = User::count();

			$totalEmployees = User::where('role', 'pegawai')->count();

			$totalParticipants = Participant::count();

			$totalTrainers = Trainer::count();

			$totalTrainings = Training::count();

			$activeTrainings = Training::where('status', 'active')->count();

			$completedTrainings = Training::where('status', 'completed')->count();

			$recentTrainings = Training::query()
				->with([
					'trainingField',
					'trainer.user',
				])
				->latest()
				->take(5)
				->get();

			$this->view('Dashboard/admin', [
				'title' => 'Dashboard',

				'totalUsers' => $totalUsers,

				'totalEmployees' => $totalEmployees,

				'totalParticipants' => $totalParticipants,

				'totalTrainers' => $totalTrainers,

				'totalTrainings' => $totalTrainings,

				'activeTrainings' => $activeTrainings,

				'completedTrainings' => $completedTrainings,

				'recentTrainings' => $recentTrainings,
			]);
		}
	}
