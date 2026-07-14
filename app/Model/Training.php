<?php

	namespace Natasya\NataApp\Model;

	use Natasya\NataApp\App\Model;

	class Training extends Model
	{
		public function count(): int
		{
			$result = $this->fetch("
		SELECT COUNT(*) AS total
		FROM trainings
	");

			return (int) $result['total'];
		}
		public function all(): array
		{
			return $this->fetchAll("
            SELECT
                t.*,
                tf.name AS field_name,
                tf.icon,
                tf.color
            FROM trainings t
            INNER JOIN training_fields tf
                ON tf.id = t.training_field_id
            ORDER BY t.created_at DESC
        ");
		}

		public function opened(): array
		{
			return $this->fetchAll("
            SELECT
                t.*,
                tf.name AS field_name,
                tf.icon,
                tf.color
            FROM trainings t
            INNER JOIN training_fields tf
                ON tf.id = t.training_field_id
            WHERE t.status = 'open'
            ORDER BY t.registration_open DESC
        ");
		}

		public function find(int $id): ?array
		{
			return $this->fetch("
            SELECT
                t.*,
                tf.name AS field_name,
                tf.icon,
                tf.color
            FROM trainings t
            INNER JOIN training_fields tf
                ON tf.id = t.training_field_id
            WHERE t.id = ?
            LIMIT 1
        ", [
				$id
			]);
		}

		public function create(array $data): int
		{
			$this->execute("
            INSERT INTO trainings
            (
                training_field_id,
                name,
                description,
                quota,
                duration,
                location,
                registration_open,
                registration_close,
                status
            )
            VALUES
            (
                ?,?,?,?,?,?,?,?,?
            )
        ", [

				$data['training_field_id'],
				$data['name'],
				$data['description'],
				$data['quota'],
				$data['duration'],
				$data['location'],
				$data['registration_open'],
				$data['registration_close'],
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
            UPDATE trainings
            SET
                training_field_id = ?,
                name = ?,
                description = ?,
                quota = ?,
                duration = ?,
                location = ?,
                registration_open = ?,
                registration_close = ?,
                status = ?
            WHERE id = ?
        ", [

				$data['training_field_id'],
				$data['name'],
				$data['description'],
				$data['quota'],
				$data['duration'],
				$data['location'],
				$data['registration_open'],
				$data['registration_close'],
				$data['status'],
				$id

			]);
		}

		public function delete(int $id): bool
		{
			return $this->execute("
            DELETE
            FROM trainings
            WHERE id = ?
        ", [
				$id
			]);
		}
	}