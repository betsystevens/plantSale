<?php
try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';

	$flowers = flowerNames($pdo);

	echo json_encode($flowers);
}
catch (PDOException $e) {
	$title = 'An error occurred';
	$output = 'An error occured ' . $e->getMessage() . ' in ' .
				$e->getFile() . ':' . $e->getLine();
	include __DIR__ . '/../templates/output.html.php';			
}