<?php
try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';
	deleteOrderedFlowers($pdo, $_POST['oid']);

	deleteById($pdo, 'orders', 'oid', $_POST['oid']);

	$title = '';
	$output = '';

	header('location: orders.php');
}
catch (PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Database error: ' . $e->getMessage() . ' in ' .
				$e->getFile() . ':' . $e->getLine();
}
include __DIR__ . '/../templates/layout.html.php';