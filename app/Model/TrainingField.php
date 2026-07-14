<?php

	namespace Natasya\NataApp\Model;

	use Natasya\NataApp\App\Model;

	class TrainingField extends Model
	{
		public function all(): array
		{
			return $this->fetchAll("
            SELECT *
            FROM training_fields
            WHERE is_active = 1
            ORDER BY name ASC
        ");
		}

		public function find(int $id): ?array
		{
			return $this->fetch("
            SELECT *
            FROM training_fields
            WHERE id = ?
            LIMIT 1
        ", [
				$id
			]);
		}

		public function create(array $data): int
		{
			$this->execute("
            INSERT INTO training_fields
            (
                name,
                description,
                icon,
                color,
                is_active
            )
            VALUES
            (
                ?,?,?,?,?
            )
        ", [

				$data['name'],

				$data['description'],

				$data['icon'],

				$data['color'],

				$data['is_active'] ?? 1,

			]);

			return (int) $this->db->lastInsertId();
		}

		public function update(
			int $id,
			array $data
		): bool
		{
			return $this->execute("
            UPDATE training_fields
            SET

                name = ?,

                description = ?,

                icon = ?,

                color = ?,

                is_active = ?

            WHERE id = ?
        ", [

				$data['name'],

				$data['description'],

				$data['icon'],

				$data['color'],

				$data['is_active'],

				$id

			]);
		}

		public function delete(int $id): bool
		{
			return $this->execute("
            DELETE
            FROM training_fields
            WHERE id = ?
        ", [
				$id
			]);
		}

		public function count(): int
		{
			$result = $this->fetch("
            SELECT COUNT(*) AS total
            FROM training_fields
        ");

			return (int) $result['total'];
		}

		public function active(): array
		{
			return $this->fetchAll("
            SELECT *
            FROM training_fields
            WHERE is_active = 1
            ORDER BY name ASC
        ");
		}

		public function inactive(): array
		{
			return $this->fetchAll("
            SELECT *
            FROM training_fields
            WHERE is_active = 0
            ORDER BY name ASC
        ");
		}

		public function exists(int $id): bool
		{
			return $this->fetch("
            SELECT id
            FROM training_fields
            WHERE id = ?
            LIMIT 1
        ", [
					$id
				]) !== null;
		}
	}