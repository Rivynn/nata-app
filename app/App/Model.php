<?php

	namespace Natasya\NataApp\App;

	abstract class Model
	{
		protected \PDO $db;

		public function __construct()
		{
			$this->db = Database::connection();
		}

		/**
		 * Prepare query.
		 */
		protected function query(string $sql): \PDOStatement
		{
			return $this->db->prepare($sql);
		}

		/**
		 * Mengambil satu data.
		 */
		public function fetch(string $query, array $params = []): ?array
		{
			$stmt = $this->db->prepare($query);

			$stmt->execute($params);

			$result = $stmt->fetch(\PDO::FETCH_ASSOC);

			if ($result === false) {
				return null;
			}

			return $result;
		}

		/**
		 * Mengambil banyak data.
		 */
		protected function fetchAll(
			string $sql,
			array $params = []
		): array {

			$stmt = $this->query($sql);

			$stmt->execute($params);

			return $stmt->fetchAll();
		}

		/**
		 * Menjalankan INSERT / UPDATE / DELETE.
		 */
		protected function execute(
			string $sql,
			array $params = []
		): bool {

			return $this->query($sql)->execute($params);
		}

		/**
		 * ID terakhir yang diinsert.
		 */
		protected function lastInsertId(): string
		{
			return $this->db->lastInsertId();
		}
		/**
		 * Mengambil satu data pertama.
		 */
		protected function first(
			string $query,
			array $params = []
		): ?array
		{
			$statement = $this->prepare($query);

			$statement->execute($params);

			$result = $statement->fetch(\PDO::FETCH_ASSOC);

			return $result ?: null;
		}
		/**
		 * Prepare query.
		 */
		protected function prepare(string $query): \PDOStatement
		{
			return $this->db->prepare($query);
		}
	}