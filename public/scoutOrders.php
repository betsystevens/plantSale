<?php
	session_start();
	if(!isset($_SESSION['login'])) { header('location: login.php'); }

	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';
	include __DIR__ . '/../classes/Template.php';

  $scout = findById($pdo, 'scout', 'scoutid', 24);
	$orders = oneScoutsOrders($pdo, 24);

	$title = $scout['firstname'].' '.$scout['lastname'].' Orders';
	$data = array(
		'title' => $title, 
		'scout' => $scout,
		'orders' => $orders
	);

	$view = new Template('scoutOrders.html.php', $data);
	echo $view->render();