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

	if (isset($_POST['flower'])) {

		$title = '';
		$output = '';

		$id = $_POST['oid'];

		// print_r($_POST['paytype']);
		// print_r($_POST['amount']);
		$oid = updateOrder($pdo,$_POST['oid'],$_POST['paytype'],
						 $_POST['amount'],$_POST['flower']);

		if ($oid)
			header('location: oneOrder.php?id='.$oid);
		else
			header('location: orders.php');
	}
	else {
		if(isset($_GET['id'])) {

			// edit order
			$title = 'Edit Flower Order';
			$orderId = $_GET['id'];
			$scouts = getScoutForOrder($pdo, $_GET['id']);
			$customers = getCustForOrder($pdo, $_GET['id']);

			$order = findById($pdo, 'orders','oid', $_GET['id']);

			$orderFlowers = orderById($pdo, $_GET['id']);

			$orderTotal = orderPrice($pdo, $_GET['id']);

			ob_start();

			include __DIR__ . '/../templates/editOrder.html.php';

			$output = ob_get_clean();
		}

	}
}	
catch (PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Database error: ' . $e->getMessage() . ' in ' .
				$e->getFile() . ':' . $e->getLine();
}
include __DIR__ . '/../templates/layout.html.php';