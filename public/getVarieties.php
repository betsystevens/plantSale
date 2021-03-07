<?php
try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';

	// replace two line
	// $where = ['fname' => $_POST['fname']];
	// $varieties = getColumnsWhere($pdo, ['fvariety'], ['flower'], $where);
	// with this line
	$varieties = fVarieties($pdo, $_POST['fname']);
	echo json_encode($varieties);
}
catch (PDOException $e) {
	$title = 'An error occurred';
	$output = 'An error occured ' . $e->getMessage() . ' in ' .
				$e->getFile() . ':' . $e->getLine();
	include __DIR__ . '/../templates/output.html.php';			
}