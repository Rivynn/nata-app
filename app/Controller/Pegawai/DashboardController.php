<?php

	namespace Natasya\NataApp\Controller\Pegawai;

	use Carbon\Carbon;
	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\Model\Participant;
	use Natasya\NataApp\Model\Registration;
	use Natasya\NataApp\Model\Training;

	class DashboardController extends Controller
	{
		public function index(): void
		{
			$today = Carbon::today();

			/*
			|--------------------------------------------------------------------------
			| Statistics
			|--------------------------------------------------------------------------
			*/

			$totalRegistrations = Registration::count();

			$pending = Registration::where(
				'status',
				'pending'
			)->count();

			$approved = Registration::where(
				'status',
				'approved'
			)->count();

			$running = Registration::where(
				'status',
				'running'
			)->count();

			$completed = Registration::where(
				'status',
				'completed'
			)->count();

			$rejected = Registration::where(
				'status',
				'rejected'
			)->count();

			$participants = Participant::count();

			$trainings = Training::count();

			/*
			|--------------------------------------------------------------------------
			| Progress
			|--------------------------------------------------------------------------
			*/

			$approvedPercent = $totalRegistrations
				? round($approved / $totalRegistrations * 100)
				: 0;

			$pendingPercent = $totalRegistrations
				? round($pending / $totalRegistrations * 100)
				: 0;

			$rejectedPercent = $totalRegistrations
				? round($rejected / $totalRegistrations * 100)
				: 0;

			/*
			|--------------------------------------------------------------------------
			| Today Activity
			|--------------------------------------------------------------------------
			*/

			$pendingToday = Registration::whereDate(
				'created_at',
				$today
			)
				->where(
					'status',
					'pending'
				)
				->count();

			$approvedToday = Registration::where(
				'status',
				'approved'
			)
				->whereDate(
					'updated_at',
					$today
				)
				->count();

			$rejectedToday = Registration::where(
				'status',
				'rejected'
			)
				->whereDate(
					'updated_at',
					$today
				)
				->count();

			/*
			|--------------------------------------------------------------------------
			| Latest Registrations
			|--------------------------------------------------------------------------
			*/

			$latestRegistrations = Registration::with([
				'participant.profile',
				'training.trainingField',
			])
				->latest()
				->take(5)
				->get();

			/*
			|--------------------------------------------------------------------------
			| Pending Priority
			|--------------------------------------------------------------------------
			*/

			$priorityRegistrations = Registration::with([
				'participant.user',
				'training.trainingField',
			])
				->where(
					'status',
					'pending'
				)
				->oldest('created_at')
				->take(5)
				->get();

			/*
			|--------------------------------------------------------------------------
			| View
			|--------------------------------------------------------------------------
			*/

			$this->view(
				'Dashboard/pegawai',
				[

					'title' => 'Dashboard Pegawai',

					/*
					|--------------------------------------------------------------------------
					| Statistics
					|--------------------------------------------------------------------------
					*/

					'totalRegistrations' => $totalRegistrations,

					'pending' => $pending,

					'approved' => $approved,

					'running' => $running,

					'completed' => $completed,

					'rejected' => $rejected,

					'participants' => $participants,

					'trainings' => $trainings,

					/*
					|--------------------------------------------------------------------------
					| Progress
					|--------------------------------------------------------------------------
					*/

					'approvedPercent' => $approvedPercent,

					'pendingPercent' => $pendingPercent,

					'rejectedPercent' => $rejectedPercent,

					/*
					|--------------------------------------------------------------------------
					| Today
					|--------------------------------------------------------------------------
					*/

					'pendingToday' => $pendingToday,

					'approvedToday' => $approvedToday,

					'rejectedToday' => $rejectedToday,

					/*
					|--------------------------------------------------------------------------
					| Tables
					|--------------------------------------------------------------------------
					*/

					'latestRegistrations' => $latestRegistrations,

					'priorityRegistrations' => $priorityRegistrations,

				]
			);
		}
	}
