<?php
	require_once('database.class.php');
	require_once('config.php');
	class Tags {
		private $tagList;
		
		function __CONSTRUCT() {
			$tagList = array();
		}
		
		function findTag($match) {
			$db = new Database();
			$match = $db->escapeString($match);
			$db->query("SELECT * FROM `#__tags` WHERE `TAG_CONTENT` LIKE '%$match%' LIMIT 5");
			while($row = $db->fetchAssoc()) {
				$tagList[$row['TAG_CONTENT']] = new Tag($row['TAG_CONTENT']);
			}
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
			
			function __CONSTRUCT($tag) {
				$db = new Database();
				$this->tagName = $tag;
				$db->query("SELECT count(*) as 'usage' FROM `#__tags_article` JOIN `#__tags` ON `TA_TAG` = `TAG_ID` WHERE `TAG_CONTENT` = '" . $db->escapeString($this->tagName) . "'");
				$row = $db->fetchAssoc();
				$this->usage = $row['usage'];
				unset($db); //closes connection
			}
			
			function getTagName() {
				return $this->tagName;
			}
			
			function getUsage() {
				return $this->usage;
			}
		}
?>