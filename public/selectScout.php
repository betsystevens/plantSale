<?php
  session_start();
	if(!isset($_SESSION['login'])) { header('location: login.php'); }

	include __DIR__ . '/../includes/DatabaseConnection.php';
  include __DIR__ . '/../classes/DatabaseTable.php';
	include __DIR__ . '/../classes/Template.php';

  $db = new DatabaseTable($pdo, 'scout', 'scoutid');
  $scouts = $db->findAll('lastname');
  $data = array(
    'title' => 'Scout Reports',
    'scouts' => $scouts
  );
  $view = new Template('selectScout.html.php', $data);
	echo $view->render();