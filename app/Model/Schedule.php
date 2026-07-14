<?php

	namespace Natasya\NataApp\Model;

	use Natasya\NataApp\App\Model;

	class Schedule extends Model
	{
		public function all(): array
		{
			return $this->fetchAll("
			SELECT

				s.*,

				t.name AS training_name,

				tr.name AS trainer_name

			FROM schedules s

			INNER JOIN trainings t
				ON t.id = s.training_id

			INNER JOIN trainers tr
				ON tr.id = s.trainer_id

			ORDER BY
				s.start_date DESC,
				s.start_time ASC
		");
		}

		public function find(int $id): ?array
		{
			return $this->fetch("
			SELECT

				s.*,

				t.name AS training_name,

				tr.name AS trainer_name

			FROM schedules s

			INNER JOIN trainings t
				ON t.id = s.training_id

			INNER JOIN trainers tr
				ON tr.id = s.trainer_id

			WHERE s.id = ?

			LIMIT 1
		", [
				$id
			]);
		}

		public function create(array $data): int
		{
			$this->execute("
			INSERT INTO schedules
			(
				training_id,
				trainer_id,
				title,
				location,
				room,
				start_date,
				end_date,
				start_time,
				end_time,
				max_participants,
				notes,
				status
			)
			VALUES
			(
				?,?,?,?,?,?,?,?,?,?,?,?
			)
		", [

				$data['training_id'],
				$data['trainer_id'],
				$data['title'],
				$data['location'],
				$data['room'],
				$data['start_date'],
				$data['end_date'],
				$data['start_time'],
				$data['end_time'],
				$data['max_participants'],
				$data['notes'],
				$data['status'],

			]);

			return (int) $this->db->lastInsertId();
		}

		public function update(
			int $id,
			array $data
		): bool
		{
			return $this->execute("
			UPDATE schedules
			SET

				training_id = ?,

				trainer_id = ?,

				title = ?,

				location = ?,

				room = ?,

				start_date = ?,

				end_date = ?,

				start_time = ?,

				end_time = ?,

				max_participants = ?,

				notes = ?,

				status = ?

			WHERE id = ?
		", [

				$data['training_id'],
				$data['trainer_id'],
				$data['title'],
				$data['location'],
				$data['room'],
				$data['start_date'],
				$data['end_date'],
				$data['start_time'],
				$data['end_time'],
				$data['max_participants'],
				$data['notes'],
				$data['status'],
				$id,

			]);
		}

		public function delete(int $id): bool
		{
			return $this->execute("
			DELETE
			FROM schedules
			WHERE id = ?
		", [
				$id
			]);
		}

		public function count(): int
		{
			$result = $this->fetch("
			SELECT COUNT(*) AS total
			FROM schedules
		");

			return (int) $result['total'];
		}

		public function draft(): int
		{
			$result = $this->fetch("
			SELECT COUNT(*) AS total
			FROM schedules
			WHERE status = 'draft'
		");

			return (int) $result['total'];
		}

		public function ongoing(): int
		{
			$result = $this->fetch("
			SELECT COUNT(*) AS total
			FROM schedules
			WHERE status = 'ongoing'
		");

			return (int) $result['total'];
		}

		public function completed(): int
		{
			$result = $this->fetch("
			SELECT COUNT(*) AS total
			FROM schedules
			WHERE status = 'completed'
		");

			return (int) $result['total'];
		}
	}