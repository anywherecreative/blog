<?php
	if(!isset($_GET['option'])) {
		$template->setKey("title","Tag Not Found");
		$template->setKey("Content","<p>The tag you requested could not be found</p>");
	}
	else {
		$db = new database();
		$tags = new Tags();
		$content = "";
		$tag = str_replace("_"," ",$_GET['option']);
		$tags->findExactTag($tag);
		if($tags->hasResult()) {
			$template->setKey("title","" . $tag . "\n");
			$item = $tags->getNextMatch();
			if($item->getUsage() > 0) {
				$articles = $item->getArticles();
				for($a = 0;$a< count($articles);$a++) {
					$db->query("SELECT * FROM `#__articles` WHERE `ART_ID` = '" . $articles[$a] . "'");
					$detail = $db->fetchAssoc();
					$content .= "
						<div class=\"tile pdspan5 pdrow3\">
							<div class=\"story\">
								<div class='story-image'>
									<img src='" . $detail['ART_IMAGE'] . "' alt='" . $detail['ART_IMAGE_ALT'] . "' />
									<span class='attribution'>";
						if($detail['ART_ATTRIBUTION_LINK'])
							$content.= "<a href='" . $detail['ART_ATTRIBUTION_LINK'] . "'>'" . $detail['ART_ATTRIBUTION'] . "</a>";
						else
							$content.= $detail['ART_ATTRIBUTION'];
						$content.= "	
								</div>
								<div class='story-content'>
									" . substr($detail['ART_CONTENT'],0, stripos ($detail['ART_CONTENT'],"[READMORE]")) . "
								</div>
							</div>
						</div>
					";
				}
			}
			else {
				$template->setKey("title","" . $tag . "\n");
				$content = "<p>No articles match that tag</p>";
			}
		}
		else {
			$template->setKey("title","" . $tag . "\n");
			$content = "<p>No articles match that tag</p>";
		}
		$template->setKey("content",$content);
	}
?>