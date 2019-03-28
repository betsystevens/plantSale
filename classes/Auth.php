<?php

class Auth {
	
	private $userTable;

	public function __construct(DatabaseTable $userTable) {
	
		$this->userTable = $userTable;
	
	}

	public function login($user) {

		if ($this->userTable->findById($user)) {
		
			$_SESSION['logged_in'] = true;
		
			return true;
		}

		return false;

	}

	public function logout() {
		
		if (!empty($_SESSION['logged_in'])) {
		
			unset($_SESSION['logged_in']);
		}
	}


	public function checklogin() {

		return (isset($_SESSION['logged_in']);
	}
}