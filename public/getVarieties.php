<?php
try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';

	$varieties = fVarieties($pdo, $_POST['fname']);

	echo json_encode($varieties);
}
catch (PDOException $e) {
	$title = 'An error occurred';
	$output = 'An error occured ' . $e->getMessage() . ' in ' .
				$e->getFile() . ':' . $e->getLine();
	include __DIR__ . '/../templates/output.html.php';			
}