<?php
try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';

	if (scoutsOrderCount($pdo, $_POST['id']) > 0 ){
		$message = 'There is an order for this scout' . '<br>' . '<br>';
		$message .= "Order(s) must be deleted before scout can be deleted";
		$message .= "<br>";

		$title = 'Alert';

		$link = 'scouts.php';
		ob_start();

		include __DIR__ . '/../templates/alert.html.php';

		$output = ob_get_clean();
	}
	else {
		$output = '';
		$title = '';
		// deleteScout($pdo, $_POST['id']);
		deleteById($pdo, 'scout', 'scoutid', $_POST['id']);
		header('location: scouts.php');
	}
}
catch (PDOEception $e) {
	$title = 'An error has occurred';

	$output = 'Database error: ' . $e->getMessage() . ' in ' .
				$e->getFile() . ':' . $e->getLine();
}
include __DIR__ . '/../templates/layout.html.php';
?>