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

	$customers = allCustomers($pdo);

	$total = countRecords($pdo, 'customer');

	$title = 'All Customers';

	ob_start();

	include __DIR__ . '/../templates/customers.html.php';

	$output = ob_get_clean();
}

catch (PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Database error:' . $e->getMessage() . ' in ' . 
				$e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';