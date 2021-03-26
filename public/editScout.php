<?php
session_start();

if(!isset($_SESSION['login'])) { header('location: login.php'); }

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

$title = '';
$output = '';
if (isset($_POST['id'])) {
	updateScout($pdo, $_POST['id'], $_POST['lastname'], $_POST['firstname']);
	header('location: scouts.php');
}
else {
	$scout = findById($pdo, 'scout', 'scoutid', $_GET['id']);

	$title = 'Edit Scout';

	ob_start();

	include __DIR__ . '/../templates/editScout.html.php';

	$output = ob_get_clean();
}
include __DIR__ . '/../templates/layout.html.php';