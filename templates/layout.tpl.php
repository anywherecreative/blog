<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	[HEAD]
	<link rel="stylesheet" href="css/main.css" />
	<script type="text/javascript">
		window.onload = function() {
			var stories = document.getElementsByClassName('story');
			var shade = new Array('#ccccff','#aaccff','#ccffcc');
			var num = 0;
			for(var a = 0;a < stories.length;a++) {
				num++;
				if(num >= shade.length)
					num = 0;
				stories[a].style.background = shade[num];
			}
			window.setInterval(toggleComments,5000);
		}
		function toggleComments() {
			var comment1 = document.getElementById('comment1');
			var comment2 = document.getElementById('comment2');
			if(comment1.className == 'show') {
				comment1.className = 'hide';
				comment2.className = 'show';
			}
			else {
				comment1.className = 'show';
				comment2.className = 'hide';
			}
		}
	</script>
</head>

<body>
	<header>
		<div class='title'>Pyro Design</div>
		<nav class="tags">
			<?php 
			$tags = new Tags();
			$tags->findPopularTags();
			if($tags->hasResult()) {
				echo('<ul>');
				while($item = $tags->getNextMatch()) {
					echo('<li><a href="/' . $item->getTagName() . '">' . $item->getTagName() . '</a></li>');
				}
				echo('</ul>');
			}
			?>
		</nav>
		<nav class="main">
			<ul>
				<li><a href="/profile">Profile</a></li>
				<li><a href="/contact">Contact</a></li>
			</ul>
		</nav>
	</header>
	<div class="content">
		[CONTENT]
	</div>
	<footer>
	</footer>
</body>
</html>