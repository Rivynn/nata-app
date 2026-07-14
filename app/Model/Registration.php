<?php

	namespace Natasya\NataApp\Model;

	use Natasya\NataApp\App\Model;

	class Registration extends Model
	{
		protected string $table = 'registrations';

		public function all(): \PDOStatement
		{
			return $this->query("
            SELECT
                r.*,
                u.name,
                u.email,
                t.name AS training_name,
                tf.name AS field_name
            FROM registrations r
            JOIN users u
                ON u.id = r.user_id
            JOIN trainings t
                ON t.id = r.training_id
            JOIN training_fields tf
                ON tf.id = t.training_field_id
            ORDER BY r.created_at DESC
        ");
		}

		/**
		 * Status pendaftaran milik peserta.
		 */
		public function byUser(int $userId): array
		{
			return $this->fetchAll("
        SELECT
            r.*,

            t.name AS training_name,

            tf.name AS field_name,

            t.location,

            t.duration

        FROM registrations r

        INNER JOIN trainings t
            ON t.id = r.training_id

        INNER JOIN training_fields tf
            ON tf.id = t.training_field_id

        WHERE r.user_id = ?

        ORDER BY r.created_at DESC
    ", [
				$userId
			]);
		}

		public function find(int $id): ?array
		{
			return $this->fetch("
        SELECT

            r.id AS registration_id,

            r.user_id,

            r.training_id,

            r.status,

            r.motivation,

            r.approved_by,

            r.rejected_by,

            r.completed_by,

            r.approved_at,

            r.rejected_at,

            r.completed_at,

            r.rejected_reason,

            r.created_at,

            r.updated_at,

            c.id AS certificate_id,

            c.certificate_number,

            c.verification_code,

            c.file,

            c.issued_at,

            u.id AS participant_id,

            u.name,

            u.email,

            u.avatar,

            p.phone,

            t.id AS training_id,

            t.name AS training_name,

            tf.name AS field_name,

            approver.name AS approved_by_name,

            rejector.name AS rejected_by_name,

            completer.name AS completed_by_name

        FROM registrations r

        INNER JOIN users u
            ON u.id = r.user_id

        INNER JOIN participants p
            ON p.user_id = u.id

        INNER JOIN trainings t
            ON t.id = r.training_id

        INNER JOIN training_fields tf
            ON tf.id = t.training_field_id

        LEFT JOIN certificates c
            ON c.registration_id = r.id

        LEFT JOIN users approver
            ON approver.id = r.approved_by

        LEFT JOIN users rejector
            ON rejector.id = r.rejected_by

        LEFT JOIN users completer
            ON completer.id = r.completed_by

        WHERE r.id = ?

        LIMIT 1
    ", [
				$id
			]);
		}

		public function exists(int $userId, int $trainingId): bool
		{
			return (bool) $this->first("
            SELECT id
            FROM registrations
            WHERE
                user_id = ?
            AND
                training_id = ?
            LIMIT 1
        ", [

				$userId,
				$trainingId,

			]);
		}

		public function create(array $data): int
		{
			$this->execute("
            INSERT INTO registrations
            (
                user_id,
                training_id,
                motivation,
                status
            )
            VALUES
            (
                ?,?,?,?
            )
        ", [

				$data['user_id'],
				$data['training_id'],
				$data['motivation'],
				'pending',

			]);

			return (int) $this->lastInsertId();
		}

		public function approve(
			int $id,
			int $approvedBy
		): bool
		{
			return $this->execute("
		UPDATE registrations
		SET

			status = 'approved',

			approved_by = ?,

			approved_at = CURRENT_TIMESTAMP,

			updated_at = CURRENT_TIMESTAMP

		WHERE id = ?
	", [

				$approvedBy,

				$id

			]);
		}

		public function reject(
			int $id,
			int $rejectedBy,
			string $reason
		): bool
		{
			return $this->execute("
		UPDATE registrations
		SET

			status = 'rejected',

			rejected_by = ?,

			rejected_at = CURRENT_TIMESTAMP,

			rejected_reason = ?,

			updated_at = CURRENT_TIMESTAMP

		WHERE id = ?
	", [

				$rejectedBy,

				$reason,

				$id

			]);
		}

		public function delete(int $id): bool
		{
			return $this->execute("
            DELETE FROM registrations
            WHERE id = ?
        ", [$id]);
		}

		/**
		 * Total berdasarkan status.
		 */
		public function countByStatus(string $status): int
		{
			$result = $this->fetch("
        SELECT COUNT(*) AS total
        FROM registrations
        WHERE status = ?
    ", [
				$status
			]);

			return (int) $result['total'];
		}

		/**
		 * Total hari ini berdasarkan status.
		 */
		public function countToday(string $status): int
		{
			$result = $this->fetch("
        SELECT COUNT(*) AS total
        FROM registrations
        WHERE status = ?
        AND DATE(updated_at) = CURDATE()
    ", [
				$status
			]);

			return (int) $result['total'];
		}

		public function pending(): array
		{
			return $this->fetchAll("
        SELECT

            r.*,

            u.name,

            u.email,

            p.phone,

            t.name AS training_name,

            tf.name AS field_name

        FROM registrations r

        INNER JOIN users u
            ON u.id = r.user_id

        INNER JOIN participants p
            ON p.user_id = u.id

        INNER JOIN trainings t
            ON t.id = r.training_id

        INNER JOIN training_fields tf
            ON tf.id = t.training_field_id

        WHERE r.status = 'pending'

        ORDER BY r.created_at DESC
    ");
		}

		public function updateStatus(
			int $id,
			string $status
		): bool
		{
			return $this->execute("
        UPDATE registrations
        SET
            status = ?,
            updated_at = CURRENT_TIMESTAMP
        WHERE id = ?
    ", [

				$status,

				$id

			]);
		}

		/**
		 * Seluruh peserta yang disetujui.
		 */
		public function approved(): array
		{
			return $this->fetchAll("
        SELECT

            r.id,

            r.user_id,

            r.status,

            r.created_at,

            r.approved_at,

            u.name,

            u.email,

            u.avatar,

            p.phone,

            t.name AS training_name,

            tf.name AS field_name,

            approver.name AS approved_by_name

        FROM registrations r

        INNER JOIN users u
            ON u.id = r.user_id

        INNER JOIN participants p
            ON p.user_id = u.id

        INNER JOIN trainings t
            ON t.id = r.training_id

        INNER JOIN training_fields tf
            ON tf.id = t.training_field_id

        LEFT JOIN users approver
            ON approver.id = r.approved_by

        WHERE r.status = 'approved'

        ORDER BY r.approved_at DESC
    ");
		}
	}