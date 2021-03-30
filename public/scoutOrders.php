<?php
	session_start();
	if(!isset($_SESSION['login'])) { header('location: login.php'); }

	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../classes/DatabaseTable.php';
	include __DIR__ . '/../classes/Template.php';

	
	$db = new DatabaseTable($pdo, 'scout', 'scoutid');
	$scouts = $db->findAll('lastname');
	$scoutId = $_POST['scoutid'] ?? $scouts[0]['scoutid'];

	$selected = $db->findById($scoutId);
	$orders = $db->oneScoutsOrders($pdo, $scoutId);
	$count = sizeof($orders);

	$title = $selected['firstname'].' '.$selected['lastname'];

	$data = array(
		'title' => $title, 
		'scouts' => $scouts,
		'selectedScout' => $selected['scoutid'],
		'orders' => $orders,
		'count' => $count
	);

	$view = new Template('scoutOrders.html.php', $data);
	echo $view->render();