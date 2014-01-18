<?php
require('config.php');
require('tags.class.php');
$conf = new Configuration();
$tags = new Tags();
$tags->findPopularTags();
if($tags->hasResult()) {
	echo('<ol>');
	while($item = $tags->getNextMatch()) {
		echo('<li>' . $item->getTagName() . "</li>");
	}
	echo('</ol>');
}
else {
	echo("None Found");
}
?>