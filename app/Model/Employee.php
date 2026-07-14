<?php

	namespace Natasya\NataApp\Model;

	use Natasya\NataApp\App\Model;

	class Employee extends Model
	{
		public function all(): array
		{
			return $this->fetchAll("
            SELECT

                e.*,

                u.name,

                u.username,

                u.email,

                u.avatar,

                u.status,

                tf.name AS field_name

            FROM employees e

            INNER JOIN users u
                ON u.id = e.user_id

            INNER JOIN training_fields tf
                ON tf.id = e.training_field_id

            ORDER BY u.name ASC
        ");
		}

		public function find(int $id): ?array
		{
			return $this->fetch("
            SELECT

                e.*,

                u.name,

                u.username,

                u.email,

                u.avatar,

                u.status,

                tf.name AS field_name

            FROM employees e

            INNER JOIN users u
                ON u.id = e.user_id

            INNER JOIN training_fields tf
                ON tf.id = e.training_field_id

            WHERE e.id = ?

            LIMIT 1
        ", [
				$id
			]);
		}

		public function create(array $data): int
		{
			$this->execute("
            INSERT INTO employees
            (
                user_id,
                training_field_id,
                phone,
                position,
                address
            )
            VALUES
            (
                ?,?,?,?,?
            )
        ", [

				$data['user_id'],
				$data['training_field_id'],
				$data['phone'],
				$data['position'],
				$data['address'],

			]);

			return (int) $this->db->lastInsertId();
		}

		public function update(
			int $id,
			array $data
		): bool
		{
			return $this->execute("
            UPDATE employees
            SET

                training_field_id = ?,

                phone = ?,

                position = ?,

                address = ?

            WHERE id = ?
        ", [

				$data['training_field_id'],
				$data['phone'],
				$data['position'],
				$data['address'],
				$id

			]);
		}

		public function delete(int $id): bool
		{
			return $this->execute("
            DELETE
            FROM employees
            WHERE id = ?
        ", [
				$id
			]);
		}

		public function count(): int
		{
			$result = $this->fetch("
            SELECT COUNT(*) AS total
            FROM employees
        ");

			return (int) $result['total'];
		}

		public function countByField(): array
		{
			return $this->fetchAll("
            SELECT

                tf.id,

                tf.name,

                COUNT(e.id) AS total

            FROM training_fields tf

            LEFT JOIN employees e
                ON e.training_field_id = tf.id

            GROUP BY tf.id

            ORDER BY tf.name
        ");
		}

		public function findByUser(
			int $userId
		): ?array
		{
			return $this->fetch("
            SELECT *

            FROM employees

            WHERE user_id = ?

            LIMIT 1
        ", [
				$userId
			]);
		}

		public function exists(
			int $userId
		): bool
		{
			return (bool) $this->fetch("
            SELECT id

            FROM employees

            WHERE user_id = ?

            LIMIT 1
        ", [
				$userId
			]);
		}
	}