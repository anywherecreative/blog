<!DOCTYPE html>

<html>
<head>
    <title>Article</title>
</head>

<body>
<table>
<thead>
	<tr>
		<th>Number</th>
		<th>By</th>
		<th>Date</th>
		<th>time</th>
		<th>content</th>
</thead>
<tbody>
<?php
$article = simplexml_load_file ("article.xml");
$lastest = 0;
$latestTime = 0;
$currentTime;
for($a = 0;$a < count($article->entry);$a++) {
	$currentTime = strtotime($article->entry[$a]->date . " " . $article->entry[$a]->time);
	if($currentTime > $latestTime) {
			$latestTime = $currentTime;
			$latest = $a;
	}
	if(($a%2))
		echo("<tr class='light'>");
	else
		echo("<tr class='dark'>");
	?>
		<td><?=$a;?></td>
		<td><?=$article->entry[$a]->author;?></td>
		<td><?=date("d-m-Y",$currentTime);?></td>
		<td><?=$article->entry[$a]->time;?></td>
		<td><?php echo(substr($article->entry[$a]->content,0,300));?></td>
	</tr>
	<?php
}
?>
</tbody>
</table>
<h2>Latest Version: <?php echo($latest);?>
<?php
$date = date("d-m-Y");
$time = date("H:i:s");
$author = 02;
$content = $_GET['kf_content'];
$entry = $article->addChild('entry');
$entry->addChild("date",$date);
$entry->addChild("time",$time);
$entry->addChild("author",$author);
$entry->addChild("content","<![CDATA[" . $content . "]]>");
$article->asXML("article.xml");
?>
</body>
</html>