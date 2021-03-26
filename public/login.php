<?php
session_start();

	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';

	if ( (isset($_POST['login'])) &&
			 (findById($pdo, 'user', 'email', $_POST['login'])) ) {
		$_SESSION['login'] = $_POST['login'];

		$result = findById($pdo, 'user', 'email', $_POST['login']);

		header ('location: index.php');
	}
	else {
		$title = 'Login';

		ob_start();

		include __DIR__ . '/../templates/login.html.php';

		$output = ob_get_clean();

	}
include __DIR__ . '/../templates/loginLayout.html.php';