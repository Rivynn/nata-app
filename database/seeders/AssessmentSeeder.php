<?php

	use Natasya\NataApp\App\Database;

	$db = Database::connection();

	$registrations = $db->query("
    SELECT
        r.id,
        tb.trainer_id
    FROM registrations r
    INNER JOIN training_batches tb
        ON tb.id = r.training_batch_id
")->fetchAll(PDO::FETCH_ASSOC);

	$stmt = $db->prepare("
INSERT INTO assessments
(
    registration_id,
    trainer_id,
    attendance_score,
    discipline_score,
    theory_score,
    practice_score,
    final_score,
    grade,
    notes,
    passed,
    assessed_at
)
VALUES
(
    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
)
");

	foreach ($registrations as $registration) {

		$attendance = rand(85, 100);
		$discipline = rand(80, 100);
		$theory     = rand(70, 100);
		$practice   = rand(75, 100);

		$final = round(
			($attendance * 0.10)
			+ ($discipline * 0.15)
			+ ($theory * 0.30)
			+ ($practice * 0.45),
			2
		);

		$grade = match (true) {
			$final >= 90 => 'A',
			$final >= 80 => 'B',
			$final >= 70 => 'C',
			$final >= 60 => 'D',
			default => 'E',
		};

		$passed = $final >= 70;

		$stmt->execute([

			$registration['id'],

			$registration['trainer_id'],

			$attendance,

			$discipline,

			$theory,

			$practice,

			$final,

			$grade,

			$passed
				? 'Peserta dinyatakan lulus.'
				: 'Peserta belum memenuhi standar kelulusan.',

			$passed,

			date('Y-m-d H:i:s'),

		]);

	}

	echo "Assessment Seeder Success." . PHP_EOL;
