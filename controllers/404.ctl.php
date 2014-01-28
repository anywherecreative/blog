<?php
	header("HTTP/1.1 404 Not Found");
	$db = new DataBase();
	$suggest = "";
	if(isset($_GET['view'])) {
		$tags = new Tags();
		$tags->findTag($_GET['view']);
		if($tags->hasResult()) {
			$suggest = "<h2>Similar Tags</h2>\n<ul>";
			while($item = $tags->getNextMatch()) {
				$suggest .= "<li><a href='tags/" . $item->getTagName() . "'>" . $item->getTagName() . "</a></li>";
			}
			$suggest .= "</ul>";
		}
	}
	$template->setKey("suggestions",$suggest);
	$template->setTitle("404 Page not Found");
?>