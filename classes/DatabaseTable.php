<?php
class DatabaseTable {

	private $pdo;
	private $table;
	private $primaryKey;

	public function __construct(PDO $pdo, string $table, string $primaryKey) {
		$this->pdo = $pdo;
		$this->$table = $table;
		$this->$primayKey = $primaryKey;
	}

	private function query($sql, $paramerters = [])
	{
		$query = $this->pdo->prepare($sql);
		$query->execute($parameters);
		return $query;
	}

	public function total() {
		$query = $this->query('SELECT COUNT(*) FROM `' . $this->table . '`');
		$row = $query->fetch();
		return $row[0];
	}

	public function findById($value) {

		$sql = 'SELECT * FROM `' . $this->table . 
						'` WHERE `' . $this->primaryKey . '` = :value';

		$parameters = [ 'value' => $value];
		
		$query = $this->query($sql, $parameters);
		
		return $query->fetch();
	}

	public function findAll($orderBy) {

		$sql = 'SELECT * FROM `' . $this->table .
					 '` ORDER BY `' . $orderBy . '`';

		$query = $this->query($sql);

		return $query->fetchAll();

	}
}