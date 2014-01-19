<?php
class Router {
	private $option;
	function __CONSTRUCT() {
		if(!isset($_GET['view'])) {
			$this->option = 'home';
		}
		else {
			$this->option = $_GET['view'];
		}
	}
	
	function getOption() {
		return $this->option;
	}
}