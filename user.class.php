<?php
/**
* This file creates a user object, and allows for authenticating and adding users to the database
* To authenticate a user simply make a new user object with this syntax $user = new User($user,$pass)
* To create a new user, set the optional third parameter to true $user = new User($user,$pass, true)
* @author Jeff Manning
* @copyright Jeff Manning 2014 
* @date January 17, 2014
* @version 1.1.0
**/
require_once('database.class.php');
const SALT = 'Oear6+-H/1D?'; //this is the global salt for all passwords
class User {
	private $user; // the system username
	private $level; //admin etc..
	private $first;
	private $groups;
	private $keys;
	/**
	* Constructor generates the user object, inits authentication
	* and also inits user creation
	* @param $user STRING the username
	* @param $pass STRING the password
	* @param $add BOOLEAN optional set to true to add the user, false to authenticate
	**/
	function __construct($user, $pass, $mode = "authenticate") {
		$pass = SALT . $pass; //add the salt
		$pass = MD5($pass);

		if($mode == "add" || $mode === true) {
			$this->addUser($user, $pass);
		}
		elseif($mode == "edit") {
			$this->editPass($user, $pass);
		}
		elseif($mode == "load") {
			//load the user for modification, or fetching credentials
		}
		else {
			$this->authenticate($user,$pass);
		}
	}
	/**
	* function to create a random salt different for each user.
	* @return STRING the salt
	**/
	private function generateSalt() {
		$salt = ""; //salt holder
		$items = array('a','b','c','d','e','f','g','h','i','j','k','l','m',
		'n','o','p','q','r','s','t','u','v','w','x','y','z','1','2','3','4',
		'5','7','8','9','!','@','#','$','%','^','&','*','(',')','[',']','<','>');
		shuffle($items); //shuffle the array, adds random layer
		for($a = 0;$a < 15;$a++) {
			$salt .= $items[rand (0,count($items) - 1)]; //chose random items from array
		}
		return $salt;
	}
	/**
	* encrypts the password and adds a user to the database 
	* @param $user STRING the username
	* @param $pass STRING the MD5 salted password
	* @throws user already found exception
	**/
	private function addUser($user, $pass) {
		$db = new Database();
		$salt = $this->generateSalt();
		$pass = crypt($pass,$salt);
		$user = $db->escapeString($user);
		$pass = $db->escapeString($pass);
		$result = $db->query("SELECT * FROM `#__users` WHERE `USER_USERNAME` = '$user' LIMIT 1");
		if($db->getNumRows() > 0) 
			throw new Exception('User already exsists!');
		else {
			//add the user
			$db->query("INSERT INTO `#__users`(`USER_USERNAME`, `USER_PASSWORD`,`USER_JOINED`) VALUES('$user','$pass','" . date("Y-m-d H:i:s") . "')");
			//add the salt to a seperate table, slows down hackers
			$db->query("INSERT INTO `#__salt` VALUES('$user','$salt')");
		}
	}
	/**
	* Authenticate a user from the database
	* @param $user STRING the username
	* @param $pass STRING the MD5 salted pass
	* @throws user and pass not found exception
	**/
	private function authenticate($user, $pass) {
		$db = new Database();
		$user =$db->escapeString($user);
		$result = $db->query("SELECT * FROM `#__users` WHERE `USER_USERNAME` = '$user'");
		if($db->getNumRows() < 1) //user does not exsist
			throw new Exception('User and Password combination not correct!'); //don't give hackers any information
		else {
			//fetch the salt
			$result = $db->query("SELECT `SALT_KEY` FROM `#__salt` WHERE `SALT_USER` = '$user'");
			$row = $db->fetchAssoc(); 
			$pass = crypt($pass, $row['SALT_KEY']);
			//unset the variables with the salt as quickly as possible
			unset($result);
			unset($row);
			$result = $db->query("SELECT * FROM `#__users` WHERE `USER_USERNAME` = '$user' AND `USER_PASSWORD` = '$pass' LIMIT 1");
			if($db->getNumRows() < 1)  //user and pass combo not correct
				throw new Exception('User and Password combination not correct!'); //don't give hackers any information
			else 
				$_SESSION['user'] = $user;
		}
	}
	
	private function editPass($user, $pass) {
		$db = new Database();
		$salt = $this->generateSalt();
		$pass = crypt($pass,$salt);
		$pass = $db->escapeString($pass);
		//add the user
		$db->query("UPDATE `users` SET `USER_PASSWORD` = '$pass' WHERE `USER_USERNAME` = '$user'");
		//add the salt to a seperate table, slows down hackers
		$db->query("UPDATE `salt` SET `SALT_KEY` = '$salt' WHERE `SALT_USER` = '$user'");
	}
	
	function forgotPassword(){
		
	}
	
	private function loadUser() {
		$db = new Database();
	}
}
?>