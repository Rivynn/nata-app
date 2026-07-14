<?php

	namespace Natasya\NataApp\Model;

	use Natasya\NataApp\App\Model;

	class Trainer extends Model
	{
		public function all(): array
		{
			return $this->fetchAll("
			SELECT

				t.*,

				tf.name AS field_name,

				tf.icon,

				tf.color

			FROM trainers t

			INNER JOIN training_fields tf
				ON tf.id = t.training_field_id

			ORDER BY t.name ASC
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

			FROM trainers t

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
			INSERT INTO trainers
			(
				training_field_id,
				name,
				phone,
				email,
				institution,
				expertise,
				certificate,
				biography,
				avatar,
				status
			)
			VALUES
			(
				?,?,?,?,?,?,?,?,?,?
			)
		", [

				$data['training_field_id'],
				$data['name'],
				$data['phone'],
				$data['email'],
				$data['institution'],
				$data['expertise'],
				$data['certificate'],
				$data['biography'],
				$data['avatar'] ?? null,
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
			UPDATE trainers
			SET

				training_field_id = ?,

				name = ?,

				phone = ?,

				email = ?,

				institution = ?,

				expertise = ?,

				certificate = ?,

				biography = ?,

				avatar = ?,

				status = ?

			WHERE id = ?
		", [

				$data['training_field_id'],
				$data['name'],
				$data['phone'],
				$data['email'],
				$data['institution'],
				$data['expertise'],
				$data['certificate'],
				$data['biography'],
				$data['avatar'] ?? null,
				$data['status'],
				$id,

			]);
		}

		public function delete(int $id): bool
		{
			return $this->execute("
			DELETE
			FROM trainers
			WHERE id = ?
		", [
				$id
			]);
		}

		public function count(): int
		{
			$result = $this->fetch("
			SELECT COUNT(*) AS total
			FROM trainers
		");

			return (int) $result['total'];
		}

		public function active(): int
		{
			$result = $this->fetch("
			SELECT COUNT(*) AS total
			FROM trainers
			WHERE status = 'active'
		");

			return (int) $result['total'];
		}

		public function inactive(): int
		{
			$result = $this->fetch("
			SELECT COUNT(*) AS total
			FROM trainers
			WHERE status = 'inactive'
		");

			return (int) $result['total'];
		}

		public function countByField(): array
		{
			return $this->fetchAll("
			SELECT

				tf.id,

				tf.name,

				tf.icon,

				tf.color,

				COUNT(t.id) AS total

			FROM training_fields tf

			LEFT JOIN trainers t
				ON t.training_field_id = tf.id

			GROUP BY tf.id

			ORDER BY tf.name
		");
		}
		public function activeList(): array
		{
			return $this->fetchAll("
		SELECT

			id,

			name,

			expertise

		FROM trainers

		WHERE status = 'active'

		ORDER BY name
	");
		}
	}