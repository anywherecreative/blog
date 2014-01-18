<?php
	class Configuration {
		private $title;
		private $db_type;
		private $db_host;
		private $db_user;
		private $db_pass;
		private $db_database;
		private $db_prefix;
		private $admin_param = "pd"; //a short paramater to include on the admin url to harden security
		//multiple versions for production, testing?
		function __CONSTRUCT() {
			$this->title = "Pyro Design";
			$this->db_type = "mysql";
			$this->db_host = "localhost";
			$this->db_user = "";
			$this->db_pass = "";
			$this->db_database = "blog";
			$this->db_prefix = "pd_";
			$admin_param = "pd"; //a short paramater to include on the admin url to harden security
			date_default_timezone_set ('America/Toronto');
		}
		
		function getTitle() {
			return $this->title;
		}
		
		function getDBType() {
			return $this->db_type;
		}
		
		function getDBHost() {
			return $this->db_host;
		}
		
		function getDBuser() {
			return $this->db_user;
		}
		
		function getDBPass() {
			return $this->db_pass;
		}
		
		function getDBDatabase() {
			return $this->db_database;
		}
		
		function getDBPrefix() {
			return $this->db_prefix;
		}
		/**
		sets the time zone used in PHP, alias of date_default_timezone_set()
		@param $zone String the time zone 
		**/
		function setTimeZone($zone) {
			date_default_timezone_set ($zone);
		}
		function validAdminParam($param) {
			if($this->admin_param == $param)
				return true;
			else
				return false;
		}
	}
?>