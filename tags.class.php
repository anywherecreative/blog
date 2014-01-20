<?php
	class Tags {
		private $tagList;
		
		function __CONSTRUCT() {
			$tagList = array();
		}
		
		function findTag($match,$number=5) {
			$db = new Database();
			$match = $db->escapeString($match);
			$number = (int)$number;
			$db->query("SELECT * FROM `#__tags` WHERE `TAG_CONTENT` LIKE '%$match%' LIMIT $number");
			while($row = $db->fetchAssoc()) {
				$this->tagList[$row['TAG_CONTENT']] = new Tag($row['TAG_CONTENT']);
			}
		}
		
		function findExactTag($match) {
			$db = new Database();
			$match = $db->escapeString($match);
			$db->query("SELECT * FROM `#__tags` WHERE `TAG_CONTENT` = '$match' LIMIT 1");
			$row = $db->fetchAssoc();
			$this->tagList[$row['TAG_CONTENT']] = new Tag($row['TAG_CONTENT']);
		}
		
		function findPopularTags($number = false) {
			$conf = new Configuration();
			$db = new Database();
			if(!$number)
				$number = (int)$conf->getTagMenuSize();
			$number = (int)$number;	
			$db = new Database();
			$db->query("SELECT *,count(`TAG_ID`) as 'count' FROM `#__tags` JOIN `#__tags_article` ON `TAG_ID` = `TA_TAG` GROUP BY `TAG_ID` ORDER BY count(`TAG_ID`) DESC LIMIT $number");
			while($row = $db->fetchAssoc()) {
				$this->tagList[$row['TAG_CONTENT']] = new Tag($row['TAG_CONTENT']);
			}
		}
		
		function getNextMatch() {
			$item = each($this->tagList);
			if($item !== false)
				return $item['value'];
			else
				return false;
		}
		
		function hasResult() {
			if(count($this->tagList) > 0)
				return true;
			else
				return false;
		}
	}
	class Tag {
			private $tagName;
			private $usage;
			private $items;
			function __CONSTRUCT($tag) {
				$db = new Database();
				$this->tagName = $tag;
				$db->query("SELECT `TA_ARTICLE` FROM `#__tags_article` JOIN `#__tags` ON `TA_TAG` = `TAG_ID` WHERE `TAG_CONTENT` = '" . $db->escapeString($this->tagName) . "'");
				$this->usage = $db->getNumRows();
				$this->items = array();
				while($row = $db->fetchAssoc()) {
					$this->items[] = $row['TA_ARTICLE'];
				}
				unset($db); //closes connection
			}
			
			function getTagName() {
				return $this->tagName;
			}
			
			function getUsage() {
				return $this->usage;
			}
			
			function getArticles() {
				return $this->items;
			}
		}
?>