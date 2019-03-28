<?php
session_start();

unset($_SESSION['login']);

$_SESSION = array();

session_destroy();

header ('location: index.php');