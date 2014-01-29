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
		if(!file_exists ('controllers' . DS . $this->option . '.ctl.php'))
			$this->option = "404"; //produce a 404 error if a view is not found
	
		echo('controllers' . DS . $this->option . '.ctl.php');
	}
	
	function getOption() {
		return $this->option;
	}
}