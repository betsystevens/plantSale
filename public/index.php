<?php

session_start();

if(!isset($_SESSION['login']))
{
	header('location: login.php');
}

try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';

	$title = 'Boy Scout Plant Sale';

	ob_start();

	include __DIR__ . '/../templates/home.html.php';

	$output = ob_get_clean();


}
catch (PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Database error: ' . $e->getMessage() . ' in ' .
		$e->getFile() . ':' . $e->getLine();

}
include __DIR__ . '/../templates/layout.html.php';