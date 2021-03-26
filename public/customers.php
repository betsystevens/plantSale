<?php
session_start();

if(!isset($_SESSION['login'])) { header('location: login.php'); }
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';
include __DIR__ . '/../includes/helperFunctions.php';

$customers = getAllOrderBy($pdo, 'customer', 'lastname');

$total = countRecords($pdo, 'customer');

$title = 'All Customers';

ob_start();

include __DIR__ . '/../templates/customers.html.php';

$output = ob_get_clean();

include __DIR__ . '/../templates/layout.html.php';