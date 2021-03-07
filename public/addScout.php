<?php
session_start();

if(!isset($_SESSION['login']))
{
	header('location: login.php');
}

try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';
	// scout form has been fille out
	if (isset($_POST['lastname'])) {
		$title = '';
		$output = '';
		insertScout($pdo, $_POST['lastname'], $_POST['firstname']);

		header('location: scouts.php');	
	}

	// display form for adding scout data
	$title = 'Add a scout';
	ob_start();

	include __DIR__ . '/../templates/addScout.html.php';

	$output = ob_get_clean();	
}
catch (PDOException $e) {
	$title = 'An error occured';

	$output = 'Database error: ' . $e->getMessage() . ' in ' .
				$e->getFile() . ':' . $e->getLine();
}
include __DIR__ . '/../templates/layout.html.php';