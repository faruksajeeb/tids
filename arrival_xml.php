<?php
	$rss = new DOMDocument();
	$rss->load('http://localhost/tids/text.xml');
	$feed = array();
	foreach ($rss->getElementsByTagName('train_schedule') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('train_name')->item(0)->nodeValue,
			'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($feed, $item);
	}
	$limit = 5;
	for($x=0;$x<$limit;$x++) {
     
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
		$link = $feed[$x]['link'];
		$description = $feed[$x]['desc'];
		$date =$feed[$x]['date'];

		echo '<p><strong><a href="'.$link.'" title="'.$title.'" target="_blank">'.$title.'</a></strong><br />';
		echo '<small><em>Posted on '.$date.'</em></small></p>';
		echo '<p>'.$description.'</p>';
             
	}
?>