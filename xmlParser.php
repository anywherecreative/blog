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
for($a = 0;$a < count($article->entry);$a++) {
	if(($a%2))
		echo("<tr class='light'>");
	else
		echo("<tr class='dark'>");
	?>
		<td><?=$a;?></td>
		<td><?=$article->entry[$a]->author;?></td>
		<td><?=$article->entry[$a]->date;?></td>
		<td><?=$article->entry[$a]->time;?></td>
		<td><?=$article->entry[$a]->content;?></td>
	</tr>
	<?php
}
?>
</tbody>
</table>
</body>
</html>