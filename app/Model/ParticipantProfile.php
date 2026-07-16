<?php

	namespace Natasya\NataApp\Model;

	use Natasya\NataApp\App\Model;

	class ParticipantProfile extends Model
	{

		/**
		 * Cari profile berdasarkan participant.
		 */
		public function findByParticipantId(
			int $participantId
		): ?array
		{
			return $this->fetch("
			SELECT *
			FROM participant_profiles
			WHERE participant_id = ?
			LIMIT 1
		", [
				$participantId
			]);
		}

		/**
		 * Cari profile berdasarkan user.
		 */
		public function findByUserId(
			int $userId
		): ?array
		{
			return $this->fetch("
			SELECT

				pp.*,

				p.user_id

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
		 * Apakah profile sudah ada.
		 */
		public function exists(
			int $participantId
		): bool
		{
			return $this->fetch("
			SELECT id
			FROM participant_profiles
			WHERE participant_id = ?
			LIMIT 1
		", [
					$participantId
				]) !== null;
		}

		/**
		 * Buat profile baru.
		 */
		public function create(
			int $participantId
		): bool
		{
			return $this->execute("
			INSERT INTO participant_profiles
			(
				participant_id
			)
			VALUES
			(
				?
			)
		", [
				$participantId
			]);
		}

		/**
		 * Update biodata.
		 */
		public function update(
			int $participantId,
			array $data
		): bool
		{
			$isCompleted = (int) $this->calculateCompleted($data);

			return $this->execute("
		UPDATE participant_profiles
		SET

			nik = ?,
			birth_place = ?,
			religion = ?,
			marital_status = ?,

			province = ?,
			city = ?,
			district = ?,
			village = ?,
			postal_code = ?,

			major = ?,
			graduation_year = ?,

			employment_status = ?,
			occupation = ?,
			company_name = ?,

			training_goal = ?,
			skill = ?,

			emergency_contact_name = ?,
			emergency_contact_phone = ?,

			is_completed = ?,

			updated_at = CURRENT_TIMESTAMP

		WHERE participant_id = ?
	", [

				$data['nik'] ?? null,

				$data['birth_place'] ?? null,

				$data['religion'] ?? null,

				$data['marital_status'] ?? null,

				$data['province'] ?? null,

				$data['city'] ?? null,

				$data['district'] ?? null,

				$data['village'] ?? null,

				$data['postal_code'] ?? null,

				$data['major'] ?? null,

				$data['graduation_year'] ?? null,

				$data['employment_status'] ?? null,

				$data['occupation'] ?? null,

				$data['company_name'] ?? null,

				$data['training_goal'] ?? null,

				$data['skill'] ?? null,

				$data['emergency_contact_name'] ?? null,

				$data['emergency_contact_phone'] ?? null,

				$isCompleted,

				$participantId

			]);
		}

		/**
		 * Upload dokumen.
		 */
		public function updateDocuments(
			int $participantId,
			array $documents
		): bool
		{
			return $this->execute("
		UPDATE participant_profiles
		SET

			ktp_file = COALESCE(?, ktp_file),

			photo = COALESCE(?, photo),

			ijazah_file = COALESCE(?, ijazah_file),

			cv_file = COALESCE(?, cv_file),

			updated_at = CURRENT_TIMESTAMP

		WHERE participant_id = ?
	", [

				$documents['ktp_file'],

				$documents['photo'],

				$documents['ijazah_file'],

				$documents['cv_file'],

				$participantId

			]);
		}

		/**
		 * Apakah biodata sudah lengkap.
		 */
		public function completed(
			int $participantId
		): bool
		{
			$profile = $this->findByParticipantId(
				$participantId
			);

			return $profile !== null
				&& (bool) $profile['is_completed'];
		}

		/**
		 * Hapus profile.
		 */
		public function delete(
			int $participantId
		): bool
		{
			return $this->execute("
			DELETE
			FROM participant_profiles
			WHERE participant_id = ?
		", [
				$participantId
			]);
		}
		private function calculateCompleted(array $data): bool
		{
			$required = [
				'nik',
				'birth_place',
				'province',
				'city',

			];

			foreach ($required as $field) {

				if (empty($data[$field])) {
					return false;
				}

			}

			return true;
		}
	}

