<?php
session_start();

if(!isset($_SESSION['login']))
{
	header('location: login.php');
}
try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';

	$title = '';
	$output = '';

	// form is filled out, submitted, insert order
	if (isset($_POST['flower'])) {

		$oid = insertOrder($pdo, $_POST['customer'],$_POST['scout'], 
						$_POST['paytype'],$_POST['amount'],$_POST['flower']);

		if ($oid)
			header('location: oneOrder.php?id='.$oid);
		else
			header('location: orders.php');
	}
	
	// get data for add order form
	$scouts = getAllOrderBy($pdo, 'scout', 'lastname');
	$customers = getAllOrderBy($pdo, 'customer', 'lastname');
	$flowerNames = flowerNames($pdo);
	// get the first flower's variety & container
	$where['fname'] = $flowerNames[0][0];
	$varieties = getColumnsWhere($pdo, ['fvariety'], ['flower'], $where);
	$where['fvariety'] = $varieties[0][0];

	$containers = getColumnsWhere($pdo, ['fcontainer'], ['flower'], $where);

	$title = 'Add Flower Order';

	$custId = $_GET['cid'] ?? '';

	$scoutId = $_GET['sid'] ?? '';

	ob_start();

	include __DIR__ . '/../templates/addOrder.html.php';

	$output = ob_get_clean();
}
catch (PDOException $e) {
	$title = 'An error occurred';

	$output = 'A database error occured ' . $e->getMessage() . ' in ' .
				$e->getFile() . ':' . $e->getLine();
}
include __DIR__ . '/../templates/layout.html.php';