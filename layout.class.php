<?php
class Layout {
	private $template;
	private $parsed;
	private $keys;
	
	function __CONSTRUCT() {
		global $conf;
		ob_start();
		include 'templates' . DS . $conf->getTemplate();
		$this->template = ob_get_contents();;
		ob_end_clean();
		$this->parsed = null;
		$this->keys = array();
	}
	
	function loadView($view) {
		ob_start();
		include 'views' . DS . $view . '.view.php';
		$content = ob_get_contents();
		ob_end_clean();
		$this->parsed = str_replace("[CONTENT]",$content, $this->template);
		$this->parsed = str_replace("[HEAD]",$this->generateHead(), $this->parsed);
		echo($this->parsed);
	}
	
	private function generateHead() {
		global $conf;
		$head = "<base href='" . $conf->getBaseUrl() . "' />";
		return $head;
	}
	
	function setKey($key,$value) {
		$this->keys[$key] = $value;
	}
	
	function getKey($key) {
		return $this->keys[$key];
	}
}
?>