<?php
session_start();

if(!isset($_SESSION['login'])) { header('location: login.php'); }
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';
include __DIR__ . '/../classes/Template.php';

// customer form has been filled in
if (isset($_POST['lastname'])) {
	$title = '';
	$output = '';

	$custId = insertCustomer($pdo, $_POST['lastname'], $_POST['firstname'],
					$_POST['email'], $_POST['telno'], $_POST['address']);

	// usually, after adding a customer an order needs to be added
	header('location: addOrder.php?cid='.$custId[0]);
} 
else {
	// display form to add customer data
	$data = array(
		'title' => 'Add Customer'
	);
	$view = new Template('addCustomer.html.php', $data);
	echo $view->render();
}
