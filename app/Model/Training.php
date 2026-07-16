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
		public function fields(): array
		{
			return $this->fetchAll("
        SELECT
            id,
            name,
            icon,
            color
        FROM training_fields
        WHERE is_active = 1
        ORDER BY name
    ");
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

		public function opened(array $filters = []): array
		{
			$sql = "
		SELECT

			t.*,

			tf.name AS field_name,
			tf.icon,
			tf.color,

			tb.id AS batch_id,
			tb.batch_name,
			tb.code AS batch_code,
			tb.room,
			tb.start_date,
			tb.end_date,
			tb.max_participants,
			tb.status AS batch_status,

			tr.id AS trainer_id,
			tr.avatar AS trainer_avatar,
			tr.institution,
			tr.expertise,

			u.name AS trainer_name

		FROM trainings t

		INNER JOIN training_fields tf
			ON tf.id = t.training_field_id

		LEFT JOIN training_batches tb
			ON tb.id = (
				SELECT id
				FROM training_batches
				WHERE
					training_id = t.id
				AND
					status = 'registration'
				ORDER BY start_date ASC
				LIMIT 1
			)

		LEFT JOIN trainers tr
			ON tr.id = tb.trainer_id

		LEFT JOIN users u
			ON u.id = tr.user_id

		WHERE

			t.status = 'open'

		AND CURDATE() BETWEEN
			t.registration_open
		AND
			t.registration_close
	";

			$params = [];

			/*
			|--------------------------------------------------------------------------
			| Search
			|--------------------------------------------------------------------------
			*/

			if (!empty($filters['keyword'])) {

				$sql .= "
			AND
			(
				t.name LIKE ?
				OR
				t.description LIKE ?
			)
		";

				$params[] = '%' . $filters['keyword'] . '%';
				$params[] = '%' . $filters['keyword'] . '%';
			}

			/*
			|--------------------------------------------------------------------------
			| Bidang
			|--------------------------------------------------------------------------
			*/

			if (!empty($filters['field'])) {

				$sql .= " AND tf.id = ?";

				$params[] = $filters['field'];
			}

			/*
			|--------------------------------------------------------------------------
			| Sorting
			|--------------------------------------------------------------------------
			*/

			switch ($filters['sort'] ?? 'latest') {

				case 'name':

					$sql .= " ORDER BY t.name ASC";

					break;

				case 'quota':

					$sql .= " ORDER BY t.quota DESC";

					break;

				case 'duration':

					$sql .= " ORDER BY t.duration ASC";

					break;

				default:

					$sql .= " ORDER BY t.registration_open DESC";

					break;
			}

			return $this->fetchAll($sql, $params);
		}

		public function find(int $id): ?array
		{
			return $this->fetch("
        SELECT

            t.*,

            tf.name AS field_name,
            tf.icon,
            tf.color,

            tb.id AS batch_id,
            tb.batch_name,
            tb.code,
            tb.room,
            tb.start_date,
            tb.end_date,
            tb.max_participants,
            tb.status AS batch_status,

            tr.id AS trainer_id,
            tr.institution,
            tr.expertise,
            tr.avatar AS trainer_avatar,
            tr.biography,

            u.name AS trainer_name,
            u.email AS trainer_email

        FROM trainings t

        INNER JOIN training_fields tf
            ON tf.id = t.training_field_id

        LEFT JOIN training_batches tb
            ON tb.training_id = t.id
            AND tb.status IN ('registration','running')

        LEFT JOIN trainers tr
            ON tr.id = tb.trainer_id

        LEFT JOIN users u
            ON u.id = tr.user_id

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
		public function myTrainings(int $userId): array
		{
			return $this->fetchAll("
        SELECT

            r.id AS registration_id,
            r.status AS registration_status,

            t.id,
            t.name,
            t.description,
            t.duration,
            t.location,

            tf.name AS field_name,
            tf.icon,
            tf.color,

            tb.id AS batch_id,
            tb.code,
            tb.batch_name,
            tb.room,
            tb.start_date,
            tb.end_date,
            tb.status AS batch_status,

            tr.id AS trainer_id,
            tr.institution,
            tr.expertise,
            tr.avatar AS trainer_avatar,

            u.name AS trainer_name,
            u.avatar AS trainer_user_avatar

        FROM registrations r

        INNER JOIN trainings t
            ON t.id = r.training_id

        INNER JOIN training_fields tf
            ON tf.id = t.training_field_id

        LEFT JOIN training_batches tb
            ON tb.training_id = t.id

        LEFT JOIN trainers tr
            ON tr.id = tb.trainer_id

        LEFT JOIN users u
            ON u.id = tr.user_id

        WHERE

            r.user_id = ?

        AND

            r.status IN
            (
                'approved',
                'completed'
            )

        ORDER BY

            tb.start_date DESC,

            t.name ASC
    ", [
				$userId
			]);
		}
	}
