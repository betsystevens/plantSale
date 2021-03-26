<?php
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';

	$varieties = fVarieties($pdo, $_POST['fname']);
	echo json_encode($varieties);