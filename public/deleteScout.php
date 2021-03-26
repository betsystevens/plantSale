<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

if (recordFound($pdo, 'orders', 'sid', $_POST['id'])) {	
	$message = 'There is an order for this scout' . '<br>' . '<br>';
	$message .= "Order(s) must be deleted before scout can be deleted";
	$message .= "<br>";

	$title = 'Alert';

	$link = 'scouts.php';
	ob_start();

	include __DIR__ . '/../templates/alert.html.php';

	$output = ob_get_clean();
}
else {
	$output = '';
	$title = '';
	deleteById($pdo, 'scout', 'scoutid', $_POST['id']);
	header('location: scouts.php');
}
include __DIR__ . '/../templates/layout.html.php';