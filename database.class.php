<?php
	define("PRE","#__");
	class Database {
		private $type;
		private $connection; //database connection
		private $result;  //result object;
		private $error; //error strings;
		private $prefix;
		
		function __CONSTRUCT() {
			$conf = new Configuration();
			$this->type = $conf->getDBType();
			$this->perfix = $conf->getDBPrefix();
			if($this->type == "mysql") {
				$this->connection = new mysqli($conf->getDBHost(),$conf->getDBuser(),$conf->getDBPass(),$conf->getDBDatabase());
				if ($this->connection->connect_error) {
					 throw new Exception('Connect Error (' . $this->connection->connect_errno . ') ' . $this->connection->connect_error);
				}
			}
			if($this->type == "postgresql") {
				$this->connection = pg_connect("host=" . $conf->getDBHost . " dbname=" . $conf->getDBDatabase() . " user=" . $ocnf->getDBuser() . " password=" . $conf->getDBPass());
			}
			$this->prefix = $conf->getDBPrefix();
		}
		
		function __DESTRUCT() {
			$this->connection->close();
		}
		
		/**
		gives a copy of the connection object
		@returns Object connection object
		**/
		public function getConnection() {
			return $this->connection;
		}
		
		/**
		return a copy of the result variable
		@return Object result object 
		**/
		public function getResult() {
			return $this->result;
		}
		
		public function escapeString($item) {
			if($this->type == "mysql") {
				return $this->connection->real_escape_string($item);
			}
			if($this->type == "postgresql") {
				pg_escape_string ($this->connection,$item);
			}
		}
		
		/**
		perform a standard SQL query
		@param $sql String the query to be run
		@param $pre String a generic prefix to be replaced with proper prefix.  Defaults to #__
		**/
		public function query($sql) {
			//replace the generic prefix with proper table prefix
			$sql = str_replace (PRE, $this->prefix, $sql); 
			if($this->type == "mysql") {
				$this->result = $this->connection->query($sql);
				echo($this->connection->error);
			}
			if($this->type == "postgresql") {
				$this->result = pg_query($sql);
			}
		}		
		/**
		return an associative array from the result set
		@return array an array of fields
		**/
		public function fetchAssoc() {
			if($this->type == "mysql") {
				return $this->result->fetch_assoc();
			}
			if($this->type == "postgresql") {
				return pg_fetch_assoc($this->result);
			}
		}
		public function getNumRows() {
			if($this->type == "mysql") {
				return $this->result->num_rows;
			}
			if($this->type == "postgresql") {
				return pg_num_rows ($this->result);
			}
		}
		
		
	}
	