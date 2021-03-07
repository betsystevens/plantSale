<?php
try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';

	$where['fname'] = $_POST['fname'];

	$containers = fContainers($pdo, $_POST['fname'], $_POST['fvariety']);

	echo json_encode($containers);
}
catch (PDOException $e) {
	$title = 'An error occurred';
	$output = 'An error occured ' . $e->getMessage() . ' in ' .
				$e->getFile() . ':' . $e->getLine();
	include __DIR__ . '/../tempates/output.html.php';			
}