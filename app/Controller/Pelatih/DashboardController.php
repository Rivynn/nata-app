<?php

	namespace Natasya\NataApp\Controller\Pelatih;

	use Carbon\Carbon;
	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\Model\Trainer;
	use Natasya\NataApp\Model\Training;
	use Natasya\NataApp\Model\TrainingAttendanceSession;
	use Natasya\NataApp\Model\TrainingSchedule;

	class DashboardController extends Controller
	{
		public function index(): void
		{
			$trainer = Trainer::query()
				->where('user_id', auth()->id())
				->firstOrFail();

			$todaySchedules = TrainingSchedule::query()
				->whereHas('training', function ($query) use ($trainer) {
					$query->where('trainer_id', $trainer->id);
				})
				->whereDate('schedule_date', Carbon::today())
				->count();

			$totalTrainings = Training::query()
				->where('trainer_id', $trainer->id)
				->count();

			$activeAttendance = TrainingAttendanceSession::query()
				->whereHas('trainingSchedule.training', function ($query) use ($trainer) {
					$query->where('trainer_id', $trainer->id);
				})
				->whereNotNull('opened_at')
				->whereNull('closed_at')
				->where(function ($query) {
					$query->whereNull('expired_at')
						->orWhere('expired_at', '>', Carbon::now());
				})
				->count();

			$nextSchedules = TrainingSchedule::query()
				->with('training')
				->whereHas('training', function ($query) use ($trainer) {
					$query->where('trainer_id', $trainer->id);
				})
				->whereDate('schedule_date', '>=', Carbon::today())
				->orderBy('schedule_date')
				->limit(5)
				->get();

			$this->view('Dashboard/pelatih', [
				'title' => 'Dashboard',
				'trainer' => $trainer,

				'todaySchedules' => $todaySchedules,
				'totalTrainings' => $totalTrainings,
				'activeAttendance' => $activeAttendance,
				'nextSchedules' => $nextSchedules,
			]);
		}
	}
