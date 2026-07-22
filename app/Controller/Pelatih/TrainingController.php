<?php

	namespace Natasya\NataApp\Controller\Pelatih;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Trainer;

	class TrainingController extends Controller
	{
		public function index(): void
		{
			$trainer = Trainer::query()
				->where('user_id', auth()->id())
				->firstOrFail();

			$status = Request::get('status', 'running');

			$query = $trainer
				->trainings()
				->with([
					'trainingField',
					'schedules',
					'registrations',
				]);

			if ($status !== 'all') {
				$query->where('status', $status);
			}

			$trainings = $query
				->latest()
				->get();

			$this->view('Pelatih/Trainings/index', [
				'title' => 'Pelatihan Saya',
				'trainings' => $trainings,
				'status' => $status,
			]);
		}

		public function show(): void
		{
			$trainer = Trainer::query()
				->where('user_id', auth()->id())
				->firstOrFail();

			$training = $trainer
				->trainings()
				->with([
					'trainingField',
					'schedules.attendanceSessions',
					'registrations.participant.user',
					'registrations.score',
					'announcements',
				])
				->findOrFail(Request::get('id'));

			$participantCount = $training->registrations->count();

			$meetingCount = $training->schedules->count();

			$completedMeeting = $training->schedules
				->filter(function ($schedule) {
					return $schedule->attendanceSessions->isNotEmpty()
						&& !$schedule->attendanceSessions->first()->isActive();
				})
				->count();

			$scores = $training->registrations
				->pluck('score')
				->filter();

			$averageScore = $scores->isNotEmpty()
				? round($scores->avg('final_score'), 2)
				: null;

			$passedParticipant = $scores
				->where('is_passed', true)
				->count();

			$failedParticipant = $scores
				->where('is_passed', false)
				->count();

			$this->view('Pelatih/Trainings/show', [
				'title' => 'Detail Pelatihan',

				'training' => $training,

				'participantCount' => $participantCount,

				'meetingCount' => $meetingCount,

				'completedMeeting' => $completedMeeting,

				'averageScore' => $averageScore,

				'passedParticipant' => $passedParticipant,

				'failedParticipant' => $failedParticipant,
			]);
		}
	}
