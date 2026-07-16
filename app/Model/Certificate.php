<?php

	namespace Natasya\NataApp\Model;

	use Natasya\NataApp\App\Model;

	class Certificate extends Model
	{
		public function create(array $data): int
		{
			$this->execute("
        INSERT INTO certificates
        (
            registration_id,
            certificate_number,
            verification_code,
            file,
            issued_at
        )
        VALUES
        (
            ?,?,?,?,?
        )
    ", [

				$data['registration_id'],
				$data['certificate_number'],
				$data['verification_code'],
				$data['file'],
				$data['issued_at'],

			]);

			return (int) $this->lastInsertId();
		}
		public function byUser(int $userId): array
		{
			return $this->fetchAll("
        SELECT

            c.id,

            c.registration_id,

            c.certificate_number,

            c.verification_code,

            c.file,

            c.issued_at,

            t.name AS training_name,

            tf.name AS field_name

        FROM certificates c

        INNER JOIN registrations r
            ON r.id = c.registration_id

        INNER JOIN trainings t
            ON t.id = r.training_id

        INNER JOIN training_fields tf
            ON tf.id = t.training_field_id

        WHERE r.user_id = ?

        ORDER BY c.issued_at DESC
    ", [
				$userId
			]);
		}

		public function find(int $id): ?array
		{
			return $this->fetch("
        SELECT

            c.id,

            c.registration_id,

            c.certificate_number,

            c.verification_code,

            c.file,

            c.issued_at,

            c.created_at,

            c.updated_at,

            r.user_id,

            r.training_id,

            u.name,

            u.email,

            u.avatar,

            t.name AS training_name,

            tf.name AS field_name

        FROM certificates c

        INNER JOIN registrations r
            ON r.id = c.registration_id

        INNER JOIN users u
            ON u.id = r.user_id

        INNER JOIN trainings t
            ON t.id = r.training_id

        INNER JOIN training_fields tf
            ON tf.id = t.training_field_id

        WHERE c.id = ?

        LIMIT 1
    ", [
				$id
			]);
		}

		public function exists(int $registrationId): bool
		{
			return $this->fetch("
		SELECT id
		FROM certificates
		WHERE registration_id = ?
		LIMIT 1
	", [
					$registrationId
				]) !== null;
		}

		public function existsByNumber(string $number): bool
		{
			$result = $this->fetch("
            SELECT id
            FROM certificates
            WHERE certificate_number = ?
            LIMIT 1
        ", [$number]);

			return !empty($result);
		}
		public function existsByRegistration(int $registrationId): bool
		{
			$result = $this->fetch("
        SELECT id
        FROM certificates
        WHERE registration_id = ?
        LIMIT 1
    ", [$registrationId]);

			return !empty($result);
		}

		public function findByRegistration(int $registrationId): ?array
		{
			return $this->fetch("
		SELECT *
		FROM certificates
		WHERE registration_id = ?
		LIMIT 1
	", [
				$registrationId
			]);
		}
	}
