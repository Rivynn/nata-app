<?php

	namespace Natasya\NataApp\Model;

	use Natasya\NataApp\App\Model;

	class User extends Model
	{
		public function findByUsername(string $username): ?array
		{
			return $this->fetch(
				"
            SELECT *
            FROM users
            WHERE username = ?
            LIMIT 1
            ",
				[$username]
			);
		}
		public function findById(int $id): ?array
		{
			return $this->fetch(
				"
        SELECT *
        FROM users
        WHERE id = ?
        LIMIT 1
        ",
				[
					$id
				]
			);
		}
		public function emailExists(string $email, ?int $exceptId = null): bool
		{
			$sql = "
        SELECT id
        FROM users
        WHERE email = ?
    ";

			$params = [$email];

			if ($exceptId !== null) {

				$sql .= " AND id != ?";

				$params[] = $exceptId;
			}

			return $this->fetch($sql, $params) !== null;
		}

		public function usernameExists(string $username, ?int $exceptId = null): bool
		{
			$sql = "
        SELECT id
        FROM users
        WHERE username = ?
    ";

			$params = [$username];

			if ($exceptId !== null) {

				$sql .= " AND id != ?";

				$params[] = $exceptId;
			}

			return $this->fetch($sql, $params) !== null;
		}
		public function findByEmail(string $email): ?array
		{
			return $this->fetch(
				"
        SELECT *
        FROM users
        WHERE email = ?
        LIMIT 1
        ",
				[$email]
			);
		}

		public function create(array $data): int
		{
			$this->execute(
				"
        INSERT INTO users
        (
            name,
            username,
            email,
            password,
            role
        )
        VALUES
        (
            ?,
            ?,
            ?,
            ?,
            ?
        )
        ",
				[
					$data['name'],
					$data['username'],
					$data['email'],
					$data['password'],
					$data['role']
				]
			);

			return (int)$this->db->lastInsertId();
		}

		public function findByLogin(string $login): ?array
		{
			return $this->fetch(
				"
        SELECT *
        FROM users
        WHERE username = ?
           OR email = ?
        LIMIT 1
        ",
				[
					$login,
					$login
				]
			);
		}

		public function updateLastLogin(int $id): bool
		{
			return $this->execute(
				"
            UPDATE users
            SET last_login_at = NOW()
            WHERE id = ?
            ",
				[$id]
			);
		}

		public function updatePassword(
			int $id,
			string $password
		): bool
		{
			return $this->execute(
				"UPDATE users
         SET password = ?
         WHERE id = ?",
				[
					$password,
					$id
				]
			);
		}

		public function count(): int
		{
			$result = $this->fetch("
        SELECT COUNT(*) AS total
        FROM users
    ");

			return (int) $result['total'];
		}
		public function updateProfile(
			int $id,
			array $data
		): bool
		{
			return $this->execute(
				"
        UPDATE users
        SET
            name = ?,
            email = ?
        WHERE id = ?
        ",
				[
					$data['name'],
					$data['email'],
					$id
				]
			);
		}

		public function countByRole(string $role): int
		{
			$result = $this->fetch("
        SELECT COUNT(*) AS total
        FROM users
        WHERE role = ?
    ", [
				$role
			]);

			return (int) $result['total'];
		}

		/**
		 * Update avatar user.
		 */
		public function updateAvatar(
			int $id,
			string $avatar
		): bool
		{
			return $this->execute(
				"
        UPDATE users
        SET
            avatar = ?,
            updated_at = CURRENT_TIMESTAMP
        WHERE id = ?
        ",
				[
					$avatar,
					$id
				]
			);
		}

		/**
		 * Avatar user.
		 */
		public function avatar(
			int $id
		): ?string
		{
			$user = $this->fetch(
				"
        SELECT avatar
        FROM users
        WHERE id = ?
        LIMIT 1
        ",
				[$id]
			);

			return $user['avatar'] ?? null;
		}

		/**
		 * Ambil avatar user.
		 */
		public function findAvatar(
			int $id
		): ?array
		{
			return $this->fetch(
				"
        SELECT
            id,
            avatar
        FROM users
        WHERE id = ?
        LIMIT 1
        ",
				[$id]
			);
		}
		public function all(): array
		{
			return $this->fetchAll("
        SELECT *
        FROM users
        ORDER BY created_at DESC
    ");
		}
		public function delete(int $id): bool
		{
			return $this->execute("
        DELETE FROM users
        WHERE id = ?
    ", [
				$id
			]);
		}
		public function update(
			int $id,
			array $data
		): bool
		{
			return $this->execute("
        UPDATE users
        SET
            name = ?,
            username = ?,
            email = ?,
            role = ?
        WHERE id = ?
    ", [

				$data['name'],

				$data['username'],

				$data['email'],

				$data['role'],

				$id

			]);
		}

		public function updateStatus(
			int $id,
			string $status
		): bool
		{
			return $this->execute("
        UPDATE users
        SET
            status = ?
        WHERE id = ?
    ", [

				$status,

				$id

			]);
		}
		public function latest(
			int $limit = 10
		): array
		{
			return $this->fetchAll("
        SELECT *
        FROM users
        ORDER BY created_at DESC
        LIMIT {$limit}
    ");
		}
		public function search(
			string $keyword
		): array
		{
			return $this->fetchAll("
        SELECT *
        FROM users
        WHERE

            name LIKE ?

            OR username LIKE ?

            OR email LIKE ?

        ORDER BY name
    ", [

				"%{$keyword}%",

				"%{$keyword}%",

				"%{$keyword}%"

			]);
		}
		public function exists(
			int $id
		): bool
		{
			return $this->fetch("
        SELECT id
        FROM users
        WHERE id = ?
    ", [

					$id

				]) !== null;
		}

		public function employees(): array
		{
			return $this->fetchAll("
        SELECT *
        FROM users
        WHERE role = 'pegawai'
        ORDER BY name ASC
    ");
		}
		public function findEmployee(
			int $id
		): ?array
		{
			return $this->fetch("
        SELECT *
        FROM users
        WHERE
            role = 'pegawai'
        AND
            id = ?
        LIMIT 1
    ", [

				$id

			]);
		}
		public function countEmployeeByField(): array
		{
			return $this->fetchAll("
        SELECT

            tf.id,

            tf.name,

            COUNT(u.id) AS total_employee

        FROM training_fields tf

        LEFT JOIN participants p
            ON p.training_field_id = tf.id

        LEFT JOIN users u
            ON u.id = p.user_id
           AND u.role = 'pegawai'

        GROUP BY tf.id

        ORDER BY tf.name
    ");
		}
		public function updateEmployee(
			int $id,
			array $data
		): bool
		{
			$this->execute("
        UPDATE users
        SET

            name = ?,

            username = ?,

            email = ?

        WHERE id = ?
    ", [

				$data['name'],

				$data['username'],

				$data['email'],

				$id

			]);

			return $this->execute("
        UPDATE participants
        SET

            phone = ?,

            training_field_id = ?

        WHERE user_id = ?
    ", [

				$data['phone'],

				$data['training_field_id'],

				$id

			]);
		}
	}