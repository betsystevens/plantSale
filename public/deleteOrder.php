<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

deleteById($pdo, 'ordflowers', 'orderid', $_POST['oid']);

deleteById($pdo, 'orders', 'oid', $_POST['oid']);

$title = '';
$output = '';

header('location: orders.php');
include __DIR__ . '/../templates/layout.html.php';