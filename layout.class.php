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
	}
	
	function loadView($view) {
		ob_start();
		include 'views' . DS . $view . '.view.php';
		$content = ob_get_contents();
		ob_end_clean();
		$this->parsed = str_replace("[CONTENT]",$content, $this->template);
		echo($this->parsed);
	}
}
?>