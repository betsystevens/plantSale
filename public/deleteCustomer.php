<?php
$title = '';
$output = '';
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

if (recordFound($pdo, 'orders', 'cid', $_POST['id'])) {
	$title = 'Alert';

	$message = 'There is an order for this customer' . '<br>' . '<br>';
	$message .= 'Orders must be deleted before the customer can be deleted';
	$message .= '<br>';

	$link = 'customers.php';
	ob_start();
	include __DIR__ . '/../templates/alert.html.php';
	$output = ob_get_clean();
}
else {
	$title = '';
	$output = '';
	deleteById($pdo, 'customer', 'custID', $_POST['id']);
	header('location: customers.php');
}
include __DIR__ .'/../templates/layout.html.php';