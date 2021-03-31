<?php
class DatabaseTable {

	private $pdo;
	private $table;
	private $primaryKey;

	public function __construct(PDO $pdo, string $table, string $primaryKey) {
		$this->pdo = $pdo;
		$this->table = $table;
		$this->primaryKey = $primaryKey;
	}

	private function query($sql, $parameters = [])
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
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	public function oneScoutsOrders($pdo, $sid) {
		$sql = 
			'SELECT concat(c.lastname,", ", c.firstname) as "customer",
			o.oid as "order",
			qty, fname as "flower",
			fvariety as "variety", fcontainer as "container"
			FROM flower f
			INNER JOIN ordflowers of
					ON f.flowerid = of.flowerid
			INNER JOIN orders o 
				ON of.orderid = o.oid
			INNER JOIN customer c
				 ON o.cid = c.custid
			INNER JOIN scout s
				ON o.sid = s.scoutid AND
				s.scoutid = :sid 
			GROUP BY Customer, Container, Flower,Variety
			ORDER BY Customer, o.oid, Container DESC, Flower, Variety';
			$parameters = [ ':sid' => $sid ];				
			$result = $this->query($sql, $parameters);
			return $result->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_ASSOC);	
	}
}