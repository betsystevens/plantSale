<?php
	session_start();
	if(!isset($_SESSION['login'])) { header('location: login.php'); }

	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';
	include __DIR__ . '/../classes/Template.php';

	$scouts = getAllOrderBy($pdo, 'scout', 'lastname');
	$total = countRecords($pdo, 'scout');

	$data = array(
		'title' => 'All Scouts',
		'scouts' => $scouts,
		'total' => $total
	);

	$view = new Template('scouts.html.php', $data);
	echo $view->render();