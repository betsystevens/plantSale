<?php
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';

	$where['fname'] = $_POST['fname'];

	$containers = fContainers($pdo, $_POST['fname'], $_POST['fvariety']);

	echo json_encode($containers);