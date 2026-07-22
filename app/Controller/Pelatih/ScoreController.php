<?php

	namespace Natasya\NataApp\Controller\Pelatih;

	use Natasya\NataApp\App\Controller;
	use Natasya\NataApp\App\Request;
	use Natasya\NataApp\Model\Registration;
	use Natasya\NataApp\Model\Trainer;
	use Natasya\NataApp\Model\Training;
	use Natasya\NataApp\Model\TrainingScore;

	class ScoreController extends Controller
	{
		public function index(): void
		{
			$trainer = Trainer::query()
				->where('user_id', auth()->id())
				->firstOrFail();

			$trainings = Training::query()
				->with([
					'trainingField',
					'registrations.score',
				])
				->where('trainer_id', $trainer->id)
				->latest()
				->get();

			$totalTrainings = $trainings->count();

			$totalParticipants = $trainings->sum(function ($training) {
				return $training->registrations->count();
			});

			$scoredParticipants = $trainings->sum(function ($training) {
				return $training->registrations
					->filter(fn ($registration) => $registration->score)
					->count();
			});

			$pendingParticipants = $totalParticipants - $scoredParticipants;

			$averageScore = round(
				$trainings
					->flatMap(fn ($training) => $training->registrations)
					->filter(fn ($registration) => $registration->score)
					->avg(fn ($registration) => $registration->score->final_score) ?? 0,
				2
			);

			$this->view('Pelatih/Scores/index', [
				'title' => 'Nilai Peserta',

				'trainings' => $trainings,

				'totalTrainings' => $totalTrainings,

				'totalParticipants' => $totalParticipants,

				'scoredParticipants' => $scoredParticipants,

				'pendingParticipants' => $pendingParticipants,

				'averageScore' => $averageScore,
			]);
		}

		public function show(): void
		{
			$id = Request::get('id');

			$trainer = Trainer::query()
				->where('user_id', auth()->id())
				->firstOrFail();

			$training = Training::query()
				->with([
					'trainingField',
					'registrations.participant.user',
					'registrations.score',
				])
				->whereKey($id)
				->where('trainer_id', $trainer->id)
				->firstOrFail();

			$totalParticipants = $training->registrations->count();

			$scoredParticipants = $training->registrations
				->filter(fn ($registration) => $registration->score)
				->count();

			$pendingParticipants = $totalParticipants - $scoredParticipants;

			$this->view('Pelatih/Scores/show', [
				'title' => 'Kelola Nilai',

				'training' => $training,

				'registrations' => $training->registrations,

				'totalParticipants' => $totalParticipants,

				'scoredParticipants' => $scoredParticipants,

				'pendingParticipants' => $pendingParticipants,
			]);
		}
		public function detail(): void
		{
			$id = Request::get('id');

			$trainer = Trainer::query()
				->where('user_id', auth()->id())
				->firstOrFail();

			$score = TrainingScore::query()
				->with([
					'trainer.user',
					'registration.training.trainingField',
					'registration.participant.user',
				])
				->whereKey($id)
				->where('trainer_id', $trainer->id)
				->firstOrFail();

			$registration = $score->registration;

			$participant = $registration->participant;

			$training = $registration->training;

			$this->view('Pelatih/Scores/detail', [
				'title' => 'Detail Nilai',

				'score' => $score,

				'registration' => $registration,

				'participant' => $participant,

				'training' => $training,

				'trainer' => $trainer,

				'averageScore' => round(
					(
						$score->knowledge_score +
						$score->skill_score +
						$score->attitude_score
					) / 3,
					2
				),

				'passStatus' => $score->is_passed
					? 'Lulus'
					: 'Tidak Lulus',
			]);
		}

		public function create(): void
		{
			$id = (int) Request::get('id');

			$trainer = Trainer::query()
				->where('user_id', auth()->id())
				->with('user')
				->firstOrFail();

			$registration = Registration::query()
				->with([
					'participant.user',
					'training.trainingField',
					'score',
					'attendances',
				])
				->whereKey($id)
				->whereHas('training', function ($query) use ($trainer) {
					$query->where('trainer_id', $trainer->id);
				})
				->firstOrFail();

			// Sudah pernah dinilai
			if ($registration->score) {

				error('Peserta sudah memiliki nilai.');

				redirect('/pelatih/scores/show?id=' . $registration->training_id);
			}

			/*
			|--------------------------------------------------------------------------
			| Attendance Percentage
			|--------------------------------------------------------------------------
			*/

			$totalAttendance = $registration->attendances->count();

			$presentAttendance = $registration->attendances
				->where('status', 'present')
				->count();

			$attendancePercentage = $totalAttendance > 0
				? round(($presentAttendance / $totalAttendance) * 100, 2)
				: 0;

			$this->view('Pelatih/Scores/create', [
				'title' => 'Input Nilai',

				'registration' => $registration,
				'participant' => $registration->participant,
				'training' => $registration->training,
				'trainer' => $trainer,
				'attendancePercentage' => $attendancePercentage,
			]);
		}

		public function store(): void
		{
			$registrationId = (int) Request::post('registration_id');

			$knowledgeScore = (float) Request::post('knowledge_score');
			$skillScore = (float) Request::post('skill_score');
			$attitudeScore = (float) Request::post('attitude_score');
			$attendancePercentage = (float) Request::post('attendance_percentage');

			$notes = trim((string) Request::post('notes'));

			if (
				$knowledgeScore < 0 || $knowledgeScore > 100 ||
				$skillScore < 0 || $skillScore > 100 ||
				$attitudeScore < 0 || $attitudeScore > 100 ||
				$attendancePercentage < 0 || $attendancePercentage > 100
			) {
				error('Nilai harus berada pada rentang 0 - 100.');

				redirect('/pelatih/scores/create?id=' . $registrationId);
			}

			$trainer = Trainer::query()
				->where('user_id', auth()->id())
				->firstOrFail();

			$registration = Registration::query()
				->with([
					'training',
				])
				->whereKey($registrationId)
				->firstOrFail();

			if ($registration->training->trainer_id !== $trainer->id) {

				error('Anda tidak memiliki akses untuk memberikan nilai pada pelatihan ini.');

				redirect('/pelatih/scores');
			}

			$exists = TrainingScore::query()
				->where('registration_id', $registration->id)
				->exists();

			if ($exists) {

				error('Peserta sudah memiliki nilai.');

				redirect('/pelatih/scores/show?id=' . $registration->training_id);
			}

			$finalScore = round(
				($knowledgeScore + $skillScore + $attitudeScore) / 3,
				2
			);

			if ($finalScore >= 90) {

				$predicate = 'A';

			} elseif ($finalScore >= 80) {

				$predicate = 'B';

			} elseif ($finalScore >= 70) {

				$predicate = 'C';

			} elseif ($finalScore >= 60) {

				$predicate = 'D';

			} else {

				$predicate = 'E';

			}

			$isPassed = $finalScore >= 70;

			TrainingScore::query()->create([
				'registration_id' => $registration->id,
				'trainer_id' => $trainer->id,

				'knowledge_score' => $knowledgeScore,
				'skill_score' => $skillScore,
				'attitude_score' => $attitudeScore,
				'attendance_percentage' => $attendancePercentage,

				'final_score' => $finalScore,
				'predicate' => $predicate,
				'is_passed' => $isPassed,

				'notes' => $notes,
				'published_at' => null,
			]);

			success('Nilai peserta berhasil disimpan.');

			redirect('/pelatih/scores/show?id=' . $registration->training_id);
		}

		public function edit(): void
		{
			$id = Request::get('id');

			$trainer = Trainer::query()
				->where('user_id', auth()->id())
				->with('user')
				->firstOrFail();

			$score = TrainingScore::query()
				->with([
					'trainer.user',
					'registration.participant.user',
					'registration.training.trainingField',
				])
				->whereKey($id)
				->whereHas('registration.training', function ($query) use ($trainer) {
					$query->where('trainer_id', $trainer->id);
				})
				->firstOrFail();

			$registration = $score->registration;
			$participant  = $registration->participant;
			$training     = $registration->training;

			$this->view('Pelatih/Scores/edit', [
				'title'        => 'Edit Nilai',

				'score'        => $score,
				'registration' => $registration,
				'participant'  => $participant,
				'training'     => $training,
				'trainer'      => $trainer,
			]);
		}

		public function update(): void
		{
			$id = (int) Request::post('id');

			$trainer = Trainer::query()
				->where('user_id', auth()->id())
				->firstOrFail();

			$score = TrainingScore::query()
				->with([
					'registration.training',
				])
				->whereKey($id)
				->where('trainer_id', $trainer->id)
				->firstOrFail();

			$knowledgeScore = (float) Request::post('knowledge_score');
			$skillScore = (float) Request::post('skill_score');
			$attitudeScore = (float) Request::post('attitude_score');
			$notes = trim((string) Request::post('notes'));

			if (
				$knowledgeScore < 0 || $knowledgeScore > 100 ||
				$skillScore < 0 || $skillScore > 100 ||
				$attitudeScore < 0 || $attitudeScore > 100
			) {
				error('Nilai harus berada pada rentang 0 - 100.');

				redirect('/pelatih/scores/edit?id=' . $score->id);
			}

			$attendancePercentage = (float) $score->attendance_percentage;

			$finalScore = round(
				($knowledgeScore * 0.30) +
				($skillScore * 0.40) +
				($attitudeScore * 0.20) +
				($attendancePercentage * 0.10),
				2
			);

			$predicate = match (true) {
				$finalScore >= 90 => 'A',
				$finalScore >= 80 => 'B',
				$finalScore >= 70 => 'C',
				$finalScore >= 60 => 'D',
				default => 'E',
			};

			$score->update([
				'knowledge_score' => $knowledgeScore,
				'skill_score' => $skillScore,
				'attitude_score' => $attitudeScore,

				'final_score' => $finalScore,
				'predicate' => $predicate,
				'is_passed' => $finalScore >= 70,

				'notes' => $notes,
			]);

			success('Nilai peserta berhasil diperbarui.');

			redirect('/pelatih/scores/show?id=' . $score->registration->training_id);
		}

		public function destroy(): void
		{
			$id = Request::get('id');

			$trainer = Trainer::query()
				->where('user_id', auth()->id())
				->firstOrFail();

			$score = TrainingScore::query()
				->whereKey($id)
				->where('trainer_id', $trainer->id)
				->firstOrFail();

			$registrationId = $score->registration_id;

			$score->delete();

			success('Nilai peserta berhasil dihapus.');

			redirect('/pelatih/scores/show?id=' . $registrationId);
		}
	}
