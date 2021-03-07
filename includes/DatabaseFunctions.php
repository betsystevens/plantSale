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
	mylog("findById: table: ${table} id: ${value}");
	return $result->fetch(); 
}
function deleteById($pdo, $table, $key, $value){
	$sql = 'DELETE FROM `'
					 . $table . '` WHERE `' 
					 . $key . '` = :value';
	$parameters = [ ':value' => $value];
	$result = query($pdo, $sql, $parameters);
	mylog("deleteById: table: ${table} id: ${value}");
}
function countRecords($pdo, $table){
	$sql = 'SELECT COUNT(*) FROM `'	. $table . '`';
	$result = query($pdo, $sql);
	$row = $result->fetch();
	return $row[0];
}
// return true if record found
function recordFound($pdo, $table, $key, $value) {
	$sql = 'SELECT 1 FROM `' . $table .
					'` WHERE `' . $key . '` = :value';
	$parameters = [':value' => $value];
	$result = query($pdo, $sql, $parameters);
	$count = $result->rowCount();

	$found = ($count == 0) ? false : true;
	return $found;
}

function getAllOrderBy($pdo, $table, $orderBy){
	$sql = 'SELECT * FROM `' .$table.
						'` ORDER BY `' .$orderBy. '`';
	$result = query($pdo, $sql);
	// fetchAll() returns an array of all records retrieved
	return $result->fetchAll();	
}
function flowerNames($pdo) {
	$sql = 'SELECT DISTINCT `fname` FROM `flower` ORDER BY `fname`';
	$result = query($pdo, $sql);
	return $result->fetchAll();
}
function fVarieties($pdo, $fname) {
	$sql = 'SELECT `fvariety` FROM `flower` 
			WHERE `fname` = :fname';
	$parameters = [':fname' => $fname];
	$result = query($pdo, $sql, $parameters);
	return $result->fetchAll();		
}

function fContainers($pdo, $fname, $variety) {
	$sql = 'SELECT `fcontainer` FROM `flower`
			WHERE `fname` = :fname 
			AND `fvariety` = :fvariety';
	$parameters = [':fname' => $fname, ':fvariety' => $variety];
	$result = query($pdo, $sql, $parameters);
	return $result->fetchAll();		
}

function getScoutForOrder($pdo, $oid) {
	$sql = 'SELECT 	`scoutid`,
									`lastname`,
									`firstname` 
					FROM 		`scout`
					INNER JOIN 	`orders`
								ON		`scoutid` = `sid`
								AND		`oid` = :orderid';

  $parameters = [':orderid' => $oid];
  $result = query($pdo, $sql, $parameters);
  $row = $result->fetchAll();
	return $row;			
}
function getCustForOrder($pdo, $oid) {
	$sql = 'SELECT 	`custid`,
									`lastname`,
									`firstname`
    			FROM 		`customer`
  	  		INNER JOIN	`orders`
  	  					ON		`custid` = `cid`	
    						AND 	`oid` = :orderid'; 

  $parameters = [':orderid' => $oid];
  $result = query($pdo, $sql, $parameters);
  $row = $result->fetchAll();
	return $row;			
}

function orderById($pdo, $oid) {

	$sql =	'SELECT of.orderid,
									of.qty, 
									f.fname, 
									f.fvariety,
									f.fcontainer
					FROM 		ordflowers of
					INNER JOIN 	flower f 
								ON		of.flowerid = f.flowerid
								AND 	of.orderid = :oid
					ORDER BY 		fcontainer,
											fname,
											fvariety';

	$parameters = [ ':oid' => $oid ];				
	$result = query($pdo, $sql, $parameters);
	// fetchAll() returns an array of all records retrieved
	return $result->fetchAll();				
}
function insertCustomer($pdo, $lname, $fname, $email, $telno, $addr) {
	$sql = 'INSERT INTO	`customer` 
										(	`lastname`,
											`firstname`,
											`email`,
											`telno`,
											`address`)
					VALUES 		(	:lastname, 
											:firstname,
											:email,
											:telno,
											:address)';
			
	$parameters = [	':lastname' => $lname, 
									':firstname' => $fname,
									':email' => $email,
									':telno' => $telno, 
									':address' => $addr];
	$result = query($pdo, $sql, $parameters);

	$sql = 'SELECT LAST_INSERT_ID() FROM `customer`';
	$result = query($pdo, $sql);
	$cid = $result->fetch();

	return $cid; 	
}
function updateCustomer ($pdo, $id, $lname, $fname, $email, $addr, $telno) {
	$sql = 'UPDATE `customer` 
					SET    `lastname` = :lastname, 
					       `firstname` = :firstname, 
					       `email` = :email, 
					       `address` = :address, 
					       `telno` = :telno 
					WHERE  `custid` = :custid'; 
	$parameters = 
				[	':custid' => $id,
					':lastname' => $lname,
					':firstname' => $fname,
					':email' => $email,
					':address' => $addr,
					':telno' => $telno ];
	$result = query($pdo, $sql, $parameters);						
}

function insertScout($pdo, $lname, $fname) {
	$sql = 'INSERT INTO	`scout` 
										(	`lastname`,
											`firstname`)
					VALUES 		(	:lastname, 
											:firstname)';
	$parameters = 
				[	':lastname' => $lname,
					':firstname' => $fname];
	$result = query($pdo, $sql, $parameters);		
}

function updateScout($pdo, $id, $lname, $fname) {
	$sql = 'UPDATE	`scout`
					SET 		`lastname` = :lastname,
									`firstname` = :firstname
					WHERE 	`scoutid` = :scoutid';
	$parameters = 
				[	':scoutid' => $id,
					':lastname' => $lname,
					':firstname' => $fname ];
	$result = query($pdo, $sql, $parameters);						
}

function insertOrder($pdo, $cid, $sid, $paytype, $amount, $flowers) {
	$sql = 	'INSERT INTO	`orders` 
											(	`cid`, `sid`,
												`paytype`, `amount`, `year`)
					VALUES 
											(	:cid, :sid,
												:paytype, :amount, :year)';

	$parameters = [	':cid' => $cid, 
					':sid' => $sid, 
					':paytype' => $paytype,
					':amount' => $amount,
					':year' => 2021 ];
	$result = query($pdo, $sql, $parameters);


	$sql = 'SELECT LAST_INSERT_ID() FROM `orders`';
	$result = query($pdo, $sql);
	$oid = $result->fetch();

	foreach ($flowers as $key => $value) {
		if ($value['qty'] > 0) {
			$flowerID = getFlowerID(
				$pdo, 
				$value['fname'],
				$value['variety'],
				$value['container'] );

			$sql = 'INSERT INTO	`ordflowers` 
												(	`orderid`,
													`flowerid`,
													`qty`	)
							VALUES 		(	LAST_INSERT_ID(),
													:flowerid,
													:qty	)';
			$parameters = [	':flowerid' => $flowerID, 
											':qty' => $value['qty']	];
			$result = query($pdo, $sql, $parameters);
		}
	}

	$orderId = $oid[0];
	if (!recordFound($pdo, 'ordflowers', 'orderid', $oid[0])) {
		// all quantities were 0, no flowers were ordered, delete order
		deleteById($pdo, 'orders', 'oid', $oid[0]);
		$orderId = 0;
	}
	return $orderId;
}

function updateOrder($pdo, $oid, $sid, $cid, $ptype, $amount, $flowers) {

	$sql = 'UPDATE 	`orders`
					SET 		`sid` = :sid,
									`cid` = :cid,
									`paytype` = :paytype,
									`amount` = :amount
					WHERE 	`oid` = :oid';
	$parameters = [	':sid' => $sid,
									':cid' => $cid,
									':paytype' => $ptype,
								 	':amount' => $amount,
								 	':oid' => $oid ];
	query($pdo, $sql, $parameters);							 

	deleteById($pdo, 'ordflowers', 'orderid', $oid);

	foreach ($flowers as $key => $value) {
		if ($value['qty'] > 0) {
			$flowerID = getFlowerID (
				$pdo, 
				$value['fname'],
				$value['variety'],
				$value['container'] );

			$sql = 'INSERT INTO `ordflowers` 
												(	`orderid`, 
													`flowerid`,
													`qty`	)
							VALUES (		:oid, 
													:flowerid,
													:qty	)';
			$parameters = [	':oid' => $oid,
											':flowerid' => $flowerID, 
											':qty' => $value['qty']];
			$result = query($pdo, $sql, $parameters);
		}
	}

	$orderId = $oid;

	// delete order if all quantity's were 0
	if (!recordFound($pdo, 'ordflowers', 'orderid', $oid)) {
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
function getFlowerID($pdo, $fname, $variety, $container) {
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
	$sql = 'SELECT 	oid,
									c.lastname as custLast,
									c.firstname as custFirst,
									s.lastname as scoutLast,
									s.firstname as scoutFirst,
									paytype, 
									amount,
									qty, 
									fname, 
									fvariety, 
									fcontainer
					FROM
									customer c, scout s, 
									orders, flower f, ordflowers of
					WHERE		f.flowerid = of.flowerid
					AND			of.orderid = oid
					AND			c.custid = cid
					AND			s.scoutid = sid
					ORDER BY 	fcontainer,
										fname, 
										fvariety';
	$result = query($pdo, $sql);
	return $result->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_ASSOC);		
}
function orderPrice($pdo, $oid) {
	$sql =	'SELECT 	of.orderid,
										sum(of.qty * p.retail) as total
					FROM			ordflowers of 
					INNER JOIN 	flower f 
								ON		of.flowerid = f.flowerid
								INNER JOIN 	price p 
											ON 		f.fcontainer = p.container
											AND 	of.orderid = :oid'; 
	$parameters = [ ':oid' => $oid ];				
	$result = query($pdo, $sql, $parameters);
	return $result->fetchAll();
}

function flowersOrdered($pdo) {
	$sql =	'SELECT 
						sum(qty),
						fname, fvariety, fcontainer,
						retail, sum(qty * retail),
						wholesale, sum(qty * wholesale)
					FROM		
						flower f
					INNER JOIN
						ordflowers o
					ON
						o.flowerid = f.flowerid
					INNER JOIN 
						price p 
					ON
						f.fcontainer = p.container
					GROUP BY
						f.flowerid            
					ORDER BY
						f.flowerid';
	$result = query($pdo, $sql);
	mylog($result);
	// fetchAll() returns an array of all records retrieved
	return $result->fetchAll(PDO::FETCH_ASSOC);	
}
function everyThing($pdo) {
		$sql = 'SELECT 
						oid,
						c.lastname as custLast, c.firstname as custFirst,
						s.lastname as scoutLast, s.firstname as scoutFirst,
						paytype, amount,
						qty, fname, fvariety, fcontainer
						
						FROM  orders INNER JOIN 
									customer c ON cid = c.custID INNER JOIN
									scout s ON sid = s.scoutid INNER JOIN
									ordflowers of ON of.orderid = oid INNER JOIN
									flower f ON f.flowerid = of.flowerid

						GROUP BY oid,fcontainer, fname, fvariety
						ORDER BY oid';
		$result = query($pdo, $sql);
		mylog($result);
		// fetchAll() returns an array of all records retrieved
		return $result->fetchAll(PDO::FETCH_ASSOC);	
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

