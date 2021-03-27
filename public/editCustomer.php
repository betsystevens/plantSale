<?php
session_start();
if(!isset($_SESSION['login'])) { header('location: login.php'); }

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';
include __DIR__ . '/../classes/Template.php';
$title = '';
$output = '';
if (isset($_POST['id'])){
	updateCustomer($pdo, $_POST['id'], $_POST['lastname'], $_POST['firstname'],$_POST['email'], $_POST['address'],$_POST['telno']);
	header('location: customers.php');
}
else {
	$customer = findById($pdo, 'customer', 'custID', $_GET['id']);
	$data = array(
		'title' => 'Edit Customer',
		'customer' => $customer
	);
	$view = new Template('editCustomer.html.php', $data);
	echo $view->render();
}