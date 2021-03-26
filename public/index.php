<?php

session_start();

// index.php page is protected by login.php
if(!isset($_SESSION['login'])) { header('location: login.php'); }

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

$title = 'Boy Scout Plant Sale';

ob_start();

include __DIR__ . '/../templates/home.html.php';

$output = ob_get_clean();

include __DIR__ . '/../templates/layout.html.php';