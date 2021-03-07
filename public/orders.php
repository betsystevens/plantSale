<?php
session_start();

if(!isset($_SESSION['login']))
{
	header('location: login.php');
}
try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';
	include __DIR__ . '/../includes/helperFunctions.php';

	// get all the orders
	$title = 'All Orders';
	$orders = allOrders($pdo);
	// ksort($orders);
	$total = countRecords($pdo, 'orders');
	
	foreach ($orders as $orderId => $order) {
		$orderTotal = orderPrice($pdo, $orderId);
		foreach ($order as $key => $orderData) {
			$orders[$orderId][$key]['total'] = $orderTotal[0]['total'];
			$isPaid = isAmountEqualTotal($order[0]['amount'], $orderTotal[0]['total']);
			$orders[$orderId][$key]['alert'] = ($isPaid) ? '' : 'alert'; 
		}
	}
	ob_start();
	include __DIR__ . '/../templates/orders.html.php';
	$output = ob_get_clean();
}
catch (PDOException $e) {
	$title = 'An error occurred';
	$output = 'Error occurred: ' . $e->getMessage() . ' in ' .
				$e->getFile() . ':' . $e->getLine();
}
include __DIR__ . '/../templates/layout.html.php';
?>