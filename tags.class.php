<?php
	require_once('database.class.php');
	class Tags {
		private $tagList;
		
		function __CONSTRUCT() {
			$tagList = array();
		}
		
		function findTag($match) {
			$db = new Database();
			$match = $db->realEscapeString($match);
			$db->query("SELECT * FROM `#__tags` WHERE `TAG_CONTENT` LIKE '%$match%' LIMIT 5");
			while($row = $db->fetchAssoc()) {
				$tagList[$row['TAG_CONTENT'] = new Tag($row['TAG_CONTENT']);
			}
		}
		
		function getNextMatch() {
			$item = each($this->tagList);
			return $item['value'];
		}
		
		class Tag {
			private $tagName;
			private $usage;
			
			function __CONSTRUCT($tag) {
				$db = new Database();
				$this->tagName = $tag;
				$db->query("SELECT count(*) as 'usage' FROM `#__tags_article` WHERE `TAG_NAME` = '" . $db->realEscapeString($this->tag) . " JOIN `#__tags` ON `TA_TAG` = `TAG_ID`");
				$row = $db->fetch_assoc();
				$this->usage = $row['usage'];
				unset($db) //closes connection
			}
			
			function getTagName() {
				return $this->tagName;
			}
			
			function getUsage() {
				return $this->usage;
			}
		}
	}
?>