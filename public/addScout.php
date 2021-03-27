<?php
session_start();
if(!isset($_SESSION['login'])) { header('location: login.php'); }

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';
include __DIR__ . '/../classes/Template.php';
// scout form has been filled in
if (isset($_POST['lastname'])) {
	$title = '';
	$output = '';
	insertScout($pdo, $_POST['lastname'], $_POST['firstname']);
	header('location: scouts.php');	
}

// display form for adding scout data
$data = array(
	'title' => 'Add Scout'
);
$view = new Template('addScout.html.php', $data);
echo $view->render();