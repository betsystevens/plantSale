<?php
session_start();
if(!isset($_SESSION['login'])) { header('location: login.php'); }

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/helperFunctions.php';
include __DIR__ . '/../classes/DatabaseTable.php';
include __DIR__ . '/../classes/Template.php';

$db = new DatabaseTable($pdo, 'customer', 'custID');
$customers = $db->findAll('lastname');
$total = $db->total();

$data = array(
  'title' => 'All Customers',
  'customers' => $customers,
  'total' => $total
);

$view = new Template('customers.html.php', $data);
echo $view->render();