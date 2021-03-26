<?php
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';

	$flowers = flowerNames($pdo);

	echo json_encode($flowers);