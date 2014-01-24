<?php
class Article {
	private id; //int
	private title; //varchar
	private image; //varchar
	private altText; //varchar
	private attribution; //varchar
	private attributionLink; //varchar
	private user; //int (foreign key)
	private create_date; //datetime
	private published; //tinyint (boolean)
	private publish_date; //datetime
	private unpublishDate; //datetime
	private access; //int
	private article; //longtext (xml)
	
	
	function __CONSTRUCT($id) {
		$db = new Database();
		$id = $db->escapeString($id);
		$db->query("SELECT * FROM `#__articles` WHERE `ART_ID` = '$id'");
		$row = $db->fetchAssoc();
		$this->id-> = $row['ART_ID'];
		$this->title = $row['ART_TITLE'];
		$this->image = $row['ART_IMAGE'];
		$this->altText = $row['ART_IMAGE_ALT'];
		$this->attribution = $row['ART_ATTRIBUTION'];
		$this->attributionLink = $row['ART_ATTRIBUTION_LINK'];
		$this->user = $row['ART_USER'];
		$this->create_date = $row['ART_CREATE_DATE'];
		$this->article = new SimpleXMLElement($row['ART_CONTENT']);
	}
	
	function saveArticle($author, $content) {
		$db = new Database();
		$date = date("d-m-Y");
		$time = date("H:i:s");
		$author = $db->escapeString($author);
		$content = $db->escapeString($content);
		$entry = $this->article->addChild('entry');
		$entry->addChild("date",$date);
		$entry->addChild("time",$time);
		$entry->addChild("author",$author);
		$entry->addChild("content","<![CDATA[" . $content . "]]>");
		$xmlContent = $db->escapeString($this->article->asXML());
		$db->query("UPDATE #__articles SET `ART_CONTENT` = '$xmlContent' WHERE `ART_ID` = '" . $this->id . " LIMIT 1");
	}
	
	function getCurrent() {
		//gets the current article
		$returnContent = "";
		for($a = 0;$a < count($this->article->entry);$a++) {
			
		}
	}
}
?>