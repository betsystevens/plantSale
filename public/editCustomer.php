<?php
session_start();

if(!isset($_SESSION['login'])) { header('location: login.php'); }
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';
$title = '';
$output = '';
if (isset($_POST['id'])){
	updateCustomer($pdo, $_POST['id'], $_POST['lastname'], $_POST['firstname'],$_POST['email'], $_POST['address'],$_POST['telno']);
	header('location: customers.php');
}
else {
	$customer = findById($pdo, 'customer', 'custID', $_GET['id']);

	$title = 'Edit Customer';

	ob_start();

	include __DIR__ . '/../templates/editCustomer.html.php';

	$output = ob_get_clean();	
}
	
include __DIR__ . '/../templates/layout.html.php';