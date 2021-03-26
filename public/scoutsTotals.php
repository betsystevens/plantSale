<?php
session_start();
if(!isset($_SESSION['login'])) { header('location: login.php'); }

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';
include __DIR__ . '/../classes/Template.php';

$totalsRecords = scoutTotals($pdo);

$data = array(
	'title' => 'Scouts Totals',
	'totalsRecords' => $totalsRecords 
);
$view = new Template('scoutTotals.html.php', $data);
echo $view->render();