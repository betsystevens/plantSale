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
		// data from has been submitted
		$title = '';
		$output = '';

		$id = $_POST['oid'];
		/*
			? new updateOrder
		*/
		$oid = updateOrder($pdo,$_POST['oid'],$_POST['scout'],$_POST['customer'],
							$_POST['paytype'], $_POST['amount'],$_POST['flower']);

		if ($oid)  // non-empty flower order
			header('location: oneOrder.php?id='.$oid);
		else // 0 flowers ordered, nothing to show
			header('location: orders.php');
	}
	else {
		// why this test?
		if(isset($_GET['id'])) {

			// edit order
			$title = 'Edit Flower Order';
			$orderId = $_GET['id'];
			/*  
				? new code
			 **/
			$scout = getScoutForOrder($pdo, $_GET['id']);
			$scoutId = $scout[0]['scoutid'];
			$customer = getCustForOrder($pdo, $_GET['id']);
			$custId = $customer[0]['custid'];
			$scouts = getAllOrderBy($pdo, 'scout', 'lastname');
			$customers = getAllOrderBy($pdo, 'customer', 'lastname');
			/*
				? end new code 
			**/

			$order = findById($pdo, 'orders','oid', $_GET['id']);

			$orderFlowers = orderById($pdo, $_GET['id']);

			$orderTotal = orderPrice($pdo, $_GET['id']);

			ob_start();

			include __DIR__ . '/../templates/editOrder.html.php';

			$output = ob_get_clean();
		} else {
		  throw new Exception('Order id not set');
		}
	}
}	
catch (PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Database error: ' . $e->getMessage() . ' in ' .
				$e->getFile() . ':' . $e->getLine();
}
catch (Exception $e) {
	$title = 'Caught exception';

	$output = 'Error: ' . $e->getMessage() . ' in ' .
				$e->getFile() . ':' . $e->getLine();
}
include __DIR__ . '/../templates/layout.html.php';