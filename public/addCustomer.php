<?php
session_start();

if(!isset($_SESSION['login']))
{
	header('location: login.php');
}
try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';

		// customer form is filled out
	if (isset($_POST['lastname'])) {
		$title = '';
		$output = '';

		$custId = insertCustomer($pdo, $_POST['lastname'], $_POST['firstname'],
						$_POST['email'], $_POST['telno'], $_POST['address']);

		header('location: addOrder.php?cid='.$custId[0]);
	} 
	else {
		// display form to add customer data
		$title = 'Add a customer';

		ob_start();

		include __DIR__ . '/../templates/addCustomer.html.php';

		$output = ob_get_clean();

	}
}
catch (PDOException $e) {
	$title = 'An error occured';

	$output = 'Database error: ' . $e->getMessage() . ' in ' .
				$e->getFile() . ':' . $e->getLine();
}
include __DIR__ . '/../templates/layout.html.php';
?>