<?php

	namespace Natasya\NataApp\Model;

	use Natasya\NataApp\App\Model;

	class Participant extends Model
	{
		/**
		 * Semua peserta.
		 */
		public function all(): array
		{
			return $this->fetchAll("
		SELECT

			p.*,

			u.id AS user_id,

			u.name,

			u.username,

			u.email,

			u.avatar,

			u.status,

			u.created_at

		FROM participants p

		INNER JOIN users u
			ON u.id = p.user_id

		ORDER BY u.name ASC
	");
		}

		/**
		 * Cari berdasarkan ID Participant.
		 */
		public function find(int $id): ?array
		{
			return $this->fetch("
		SELECT

			p.*,

			u.id AS user_id,

			u.name,

			u.username,

			u.email,

			u.avatar,

			u.status,

			u.created_at

		FROM participants p

		INNER JOIN users u
			ON u.id = p.user_id

		WHERE p.id = ?

		LIMIT 1
	", [
				$id
			]);
		}

		/**
		 * Cari berdasarkan User.
		 */
		public function findByUserId(int $userId): ?array
		{
			return $this->fetch("
            SELECT
                p.*,
                u.name,
                u.username,
                u.email,
                u.avatar
            FROM participants p
            INNER JOIN users u
                ON u.id = p.user_id
            WHERE p.user_id = ?
            LIMIT 1
        ", [
				$userId
			]);
		}

		/**
		 * Tambah peserta.
		 */
		public function create(array $data): bool
		{
			return $this->execute("
            INSERT INTO participants
            (
                user_id,
                phone
            )
            VALUES
            (
                ?,
                ?
            )
        ", [
				$data['user_id'],
				$data['phone']
			]);
		}

		/**
		 * Update profil peserta.
		 */
		public function updateProfile(
			int $userId,
			array $data
		): bool
		{
			return $this->execute("
            UPDATE participants
            SET
                phone = ?
            WHERE user_id = ?
        ", [
				$data['phone'],
				$userId
			]);
		}

		/**
		 * Jumlah peserta.
		 */
		public function count(): int
		{
			$result = $this->fetch("
            SELECT COUNT(*) AS total
            FROM participants
        ");

			return (int) $result['total'];
		}

		/**
		 * Apakah user merupakan peserta.
		 */
		public function exists(int $userId): bool
		{
			return $this->fetch("
            SELECT id
            FROM participants
            WHERE user_id = ?
            LIMIT 1
        ", [
					$userId
				]) !== null;
		}

		/**
		 * Hapus peserta.
		 */
		public function delete(int $userId): bool
		{
			return $this->execute("
            DELETE
            FROM participants
            WHERE user_id = ?
        ", [
				$userId
			]);
		}
		public function report(array $filters = []): array
		{
			$sql = "
		SELECT
			p.id,
			u.name,
			u.email,
			u.status AS account_status,
			p.phone,
			tf.name AS field_name,
			t.name AS training_name,
			r.status,
			r.created_at
		FROM participants p
		INNER JOIN users u
			ON u.id = p.user_id
		LEFT JOIN registrations r
			ON r.user_id = u.id
		LEFT JOIN trainings t
			ON t.id = r.training_id
		LEFT JOIN training_fields tf
			ON tf.id = t.training_field_id
		WHERE 1 = 1
	";

			$params = [];

			if (!empty($filters['keyword'])) {

				$sql .= " AND (
			u.name LIKE ?
			OR u.email LIKE ?
		)";

				$params[] = "%{$filters['keyword']}%";
				$params[] = "%{$filters['keyword']}%";
			}

			if (!empty($filters['field'])) {

				$sql .= " AND tf.id = ?";

				$params[] = $filters['field'];
			}

			if (!empty($filters['training'])) {

				$sql .= " AND t.id = ?";

				$params[] = $filters['training'];
			}

			if (!empty($filters['status'])) {

				$sql .= " AND r.status = ?";

				$params[] = $filters['status'];
			}

			if (!empty($filters['start_date'])) {

				$sql .= " AND DATE(r.created_at) >= ?";

				$params[] = $filters['start_date'];
			}

			if (!empty($filters['end_date'])) {

				$sql .= " AND DATE(r.created_at) <= ?";

				$params[] = $filters['end_date'];
			}

			$sql .= "
		ORDER BY
			r.created_at DESC,
			u.name ASC
	";

			return $this->fetchAll($sql, $params);
		}
		/**
		 * Profile peserta.
		 */
		/**
		 * Profile peserta.
		 */
		public function profile(
			int $userId
		): ?array
		{
			return $this->fetch("
		SELECT

			pp.*

		FROM participant_profiles pp

		INNER JOIN participants p
			ON p.id = pp.participant_id

		WHERE p.user_id = ?

		LIMIT 1
	", [

				$userId

			]);
		}

		/**
		 * Apakah profile sudah lengkap.
		 */
		public function profileCompleted(
			int $userId
		): bool
		{
			$profile = $this->profile($userId);

			return $profile !== null
				&& (bool) $profile['is_completed'];
		}

		/**
		 * Apakah profile sudah lengkap.
		 */
	}
