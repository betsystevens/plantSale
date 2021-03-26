<?php
session_start();

if(!isset($_SESSION['login'])) { header('location: login.php'); }
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';
// get the order
$title = 'One Order';

$orderId = $_GET['id'];
$scout = getScoutForOrder($pdo, $_GET['id']);
$customer = getCustForOrder($pdo, $_GET['id']);

$order = findById($pdo, 'orders','oid', $_GET['id']);
$orderFlowers = orderById($pdo, $_GET['id']);

$orderTotal = orderPrice($pdo, $_GET['id']);

// display order
ob_start();
include __DIR__ . '/../templates/oneOrder.html.php';
$output = ob_get_clean();
	
include __DIR__ . '/../templates/layout.html.php';