<?php

function query($pdo, $sql, $parameters = []) {
	$query = $pdo->prepare($sql);
	$query->execute($parameters);
	return $query;
}
function findById($pdo, $table, $primaryKey, $value) {
	$sql = 'SELECT * FROM `'
							. $table . '` WHERE `'
							. $primaryKey . '` = :value';
	$parameters = [ ':value' => $value ];

	$result = query($pdo, $sql, $parameters);
	mylog("in findById");
	mylog("table: ${table} id: ${value}");
	return $result->fetch(); 
}

function deleteById($pdo, $table, $key, $value){
	$sql = 'DELETE FROM `'
					 . $table . '` WHERE `' 
					 . $key . '` = :value';
	$parameters = [ ':value' => $value];
	$result = query($pdo, $sql, $parameters);

	mylog("in deleteById");
	mylog("table: ${table} id: ${value}");
}
function countRecords($pdo, $table){
	mylog("in countRecords");
	$sql = 'SELECT COUNT(*) FROM `'	. $table . '`';
	$result = query($pdo, $sql);
	$row = $result->fetch();
	return $row[0];
}
function orderById($pdo, $oid) {

	$sql =	'SELECT 	of.orderid, of.qty, 
										f.fname, f.fvariety, f.fcontainer
					FROM ordflowers of
					INNER JOIN 	flower f 
							ON	of.flowerid = f.flowerid
					WHERE 	of.orderid = :oid
					ORDER BY fcontainer, fname, fvariety';
	$parameters = [ ':oid' => $oid ];				
	$result = query($pdo, $sql, $parameters);
	// fetchAll() returns an array of all records retrieved
	return $result->fetchAll();				
}

// replace with class::findAll($pdo, $table, $orderBy)
function allScouts($pdo) {
	$sql = 'SELECT * FROM `scout` ORDER BY `lastname`';
	$result = query($pdo, $sql);
	// fetchAll() returns an array of all records retrieved
	return $result->fetchAll();
}
// replace with class::findAll($pdo, $table, orderBy)
function allCustomers($pdo) {
	$sql = 'SELECT * FROM `customer` ORDER BY `lastname`';
	$result = query($pdo, $sql);
	return $result->fetchAll();
}

function flowerNames($pdo) {
	$sql = 'SELECT DISTINCT `fname` FROM `flower` ORDER BY `fname`';
	$result = query($pdo, $sql);
	return $result->fetchAll();
}
// replace with class::findAllWhere
function fVarieties($pdo, $fname) {
	$sql = 'SELECT `fvariety` FROM `flower` 
			WHERE `fname` = :fname';
	$parameters = [':fname' => $fname];
	$result = query($pdo, $sql, $parameters);
	return $result->fetchAll();		
}
// replace with class::findAllWhere
function fContainers($pdo, $fname, $variety) {
	$sql = 'SELECT `fcontainer` FROM `flower`
			WHERE `fname` = :fname 
			AND `fvariety` = :fvariety';
	$parameters = [':fname' => $fname, ':fvariety' => $variety];
	$result = query($pdo, $sql, $parameters);
	return $result->fetchAll();		
}

function scoutsOrderCount($pdo, $scoutid) {
	$sql = 'SELECT 1 FROM `orders` 
			WHERE `sid` = :scoutid';
	$parameters = [':scoutid' => $scoutid];
	$result = query($pdo, $sql, $parameters);
	return $result->rowCount();		
}

function customersOrderCount($pdo, $custid) {
	$sql = 'SELECT 1 FROM `orders`
			WHERE `cid` = :custID';
	$parameters = [':custID' => $custid];
	$result = query($pdo, $sql, $parameters);
	return $result->rowCount();		
}

function insertCustomer($pdo, $lname, $fname, $email, $telno, $addr) {
	$sql = 'INSERT INTO `customer` 
			(`lastname`,`firstname`,`email`,`telno`,`address`)
			VALUES (:lastname, :firstname,
					:email, :telno, :address)';
	$parameters = [':lastname' => $lname, ':firstname' => $fname,
					':email' => $email, ':telno' => $telno, 
					':address' => $addr];
	$result = query($pdo, $sql, $parameters);

	$sql = 'SELECT LAST_INSERT_ID() FROM `customer`';
	$result = query($pdo, $sql);
	$cid = $result->fetch();

	return $cid; 	
}
function updateCustomer ($pdo, $id, $lname, $fname, $email, $addr, $telno) {
	$sql = 'UPDATE `customer` 
			SET	`lastname` = :lastname,
				`firstname` = :firstname,
				`email` = :email,
				`address` = :address,
				`telno` = :telno
			WHERE `custid` = :custid';
	$parameters = [	':custid' => $id,
					':lastname' => $lname,
					':firstname' => $fname,
					':email' => $email,
					':address' => $addr,
					':telno' => $telno ];
	$result = query($pdo, $sql, $parameters);						
}
function insertScout($pdo, $lname, $fname) {
	$sql = 'INSERT INTO `scout` (`lastname`,`firstname`)
			VALUES (:lastname, :firstname)';
	$parameters = [':lastname' => $lname, ':firstname' => $fname];
	$result = query($pdo, $sql, $parameters);		
}
function updateScout($pdo, $id, $lname, $fname) {
	$sql = 'UPDATE `scout`
			SET `lastname` = :lastname,
				`firstname` = :firstname
			WHERE `scoutid` = :scoutid';
	$parameters = [	':scoutid' => $id,
					':lastname' => $lname,
					':firstname' => $fname ];
	$result = query($pdo, $sql, $parameters);						
}
function anyFlowerOrdered($pdo, $oid) {
	$sql = 'SELECT 1 FROM `ordflowers`
			WHERE  `orderid` = :orderid';
	$parameters = [':orderid' => $oid];
	$result = query($pdo, $sql, $parameters);
	return $result->rowCount();		
}
function getScoutForOrder($pdo, $oid) {
	$sql = 'SELECT `scoutid`, `lastname` , `firstname` 
    			FROM `scout`, `orders`
    			WHERE `oid` = :orderid AND
    			`scoutid` = `sid`';
  $parameters = [':orderid' => $oid];
  $result = query($pdo, $sql, $parameters);
  $row = $result->fetchAll();
	return $row;			
}
function getCustForOrder($pdo, $oid) {
	$sql = 'SELECT `custid`, `lastname` , `firstname` 
    			FROM `customer`, `orders`
    			WHERE `oid` = :orderid AND
    			`custid` = `cid`';
  $parameters = [':orderid' => $oid];
  $result = query($pdo, $sql, $parameters);
  $row = $result->fetchAll();
	return $row;			
}
function insertOrder($pdo, $cid, $sid, $paytype, $amount, $flowers) {
	$sql = 'INSERT INTO `orders` 
				(`cid`,`sid`,`paytype`,`amount`,`year`)
			VALUES 
				(:cid,:sid,:paytype,:amount,:year)';

	$parameters = [	':cid' => $cid, 
					':sid' => $sid, 
					':paytype' => $paytype,
					':amount' => $amount,
					':year' => 2019 ];
	$result = query($pdo, $sql, $parameters);

	$sql = 'SELECT LAST_INSERT_ID() FROM `orders`';
	$result = query($pdo, $sql);
	$oid = $result->fetch();

	foreach ($flowers as $key => $value) {
		if ($value['qty'] > 0) {

			$flowerID = flowerID (
						  $pdo, 
						  $value['fname'],
						  $value['variety'],
						  $value['container'] );

			$sql = 'INSERT INTO `ordflowers` (orderid, flowerid, qty)
					VALUES (LAST_INSERT_ID(), :flowerid, :qty)';
			$parameters = [	':flowerid' => $flowerID, 
							':qty' => $value['qty']];
			$result = query($pdo, $sql, $parameters);
		}
	}

	$orderId = $oid[0];
	if (anyFlowerOrdered($pdo, $oid[0]) == 0) {
		// no flowers were ordered, all zero quantity
		deleteById($pdo, 'orders', 'oid', $oid[0]);
		$orderId = 0;
	}
	return $orderId;
}
function updateOrder($pdo, $oid, $ptype, $amount, $flowers) {

	$sql = 'UPDATE `orders`
					SET `paytype` = :paytype,
							`amount` = :amount
					WHERE `oid` = :oid';
	$parameters = [':paytype' => $ptype,
								 ':amount' => $amount,
								 ':oid' => $oid ];
	query($pdo, $sql, $parameters);							 

	deleteById($pdo, 'ordflowers', 'orderid', $oid);

	foreach ($flowers as $key => $value) {
		if ($value['qty'] > 0) {

			$flowerID = flowerID (
						  $pdo, 
						  $value['fname'],
						  $value['variety'],
						  $value['container'] );

			$sql = 'INSERT INTO `ordflowers` (orderid, flowerid, qty)
					VALUES (:oid, :flowerid, :qty)';
			$parameters = [	':oid' => $oid,
							':flowerid' => $flowerID, 
							':qty' => $value['qty']];
			$result = query($pdo, $sql, $parameters);
		}
	}

	$orderId = $oid;
	if (anyFlowerOrdered($pdo, $oid) == 0) {
		// no flowers were ordered, all zero quantity
		deleteById($pdo, 'orders', 'oid', $oid);
		$orderId = 0;
	}
	return $orderId;
}
function saveEditOrder($pdo, $oid, $flowers) {
	// for testing purposes right now
	mylog("In save Order");
	mylog("orderId: " . $oid);
	mylog("flowers: " . $flowers[0]);
	foreach ($flowers as $key => $value) {
		foreach ($value as $key2 => $value2) {
		mylog($key2.":".$value2);
		}
	}
}
function flowerID($pdo, $fname, $variety, $container) {
	$sql = 'SELECT 	`flowerid` 
			FROM 	`flower`
			WHERE 	`fname` = :fname AND
					`fvariety` = :fvariety AND
					`fcontainer` = :fcontainer';

	$parameters = [	':fname' => $fname,
					':fvariety' => $variety,
					':fcontainer' => $container ];
	$result = query($pdo, $sql, $parameters);
	$row = $result->fetch();
	return $row[0];
}
function allOrders($pdo) {
	$sql = 'SELECT 
			oid,
			c.lastname as custLast, c.firstname as custFirst,
			s.lastname as scoutLast, s.firstname as scoutFirst,
			paytype, amount,
			qty, fname, fvariety, fcontainer
			-- new line
			-- sum(of.qty * p.retail) as total
			FROM
			customer c, scout s, 
			orders, flower f, ordflowers of
			-- new line
			-- price p
			WHERE
			f.flowerid = of.flowerid AND
			of.orderid = oid AND
			c.custid = cid AND
			s.scoutid = sid
			-- new line
			-- AND f.fcontainer = p.container

			-- GROUP BY oid;
			ORDER BY fcontainer, fname, fvariety';
			
	$result = query($pdo, $sql);
	return $result->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_ASSOC);		
}
function orderPrice($pdo, $oid) {
	$sql =	'SELECT 	of.orderid, sum(of.qty * p.retail) as total
					FROM	ordflowers of 
					INNER JOIN flower f 
							ON	of.flowerid = f.flowerid
					INNER JOIN price p 
							ON 	f.fcontainer = p.container
					WHERE of.orderid = :oid'; 
	$parameters = [ ':oid' => $oid ];				
	$result = query($pdo, $sql, $parameters);
	return $result->fetchAll();
}

function mylog($message)
	{
		ob_start();
		echo "\n";
		print_r($message);
		echo "\n";
		$output = ob_get_clean();
		error_log($output, 3, __DIR__ . '/logFile');
	}

