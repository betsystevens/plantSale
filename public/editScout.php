<?php
session_start();
if(!isset($_SESSION['login'])) { header('location: login.php'); }

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';
include __DIR__ . '/../classes/Template.php';

$title = '';
$output = '';
if (isset($_POST['id'])) {
	updateScout($pdo, $_POST['id'], $_POST['lastname'], $_POST['firstname']);
	header('location: scouts.php');
}
else {
	$scout = findById($pdo, 'scout', 'scoutid', $_GET['id']);
	$data = array(
		'title' => 'Edit Scout',
		'scout' => $scout
	);
	$view = new Template('editScout.html.php', $data);
	echo $view->render();
}