<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<!-- Website Design By: www.happyworm.com -->
<title>Demo : jPlayer as a video playlist player</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/jplayer.blue.monday.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="js/jplayer.playlist.min.js"></script>
		<?php
				include_once('../admin/dbconnect.php');
				$dt = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
				$current_time=$dt->format('Y-m-d H:i');
				$sql=mysql_query("SELECT * FROM tbl_ads_schedule where time>='$current_time' AND category_id=2 ORDER BY time ASC LIMIT 1 ");    
				$associativeArray = array();
				while($row = mysql_fetch_array($sql))
					{
						 $associativeArray[] = "videos/".$row['video_title'];
						 //echo json_encode($associativeArray);
						
					}
					
				
		?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
	new jPlayerPlaylist({
		jPlayer: "#jquery_jplayer_1",
		cssSelectorAncestor: "#jp_container_1"
	}, [
		{
			//title:<?php echo json_encode($associativeArray)?>,
			//artist:"sajeeb",
			//free:true,
			m4v: "videos/Neem Face Wash TVC Nipun (HD).mp4",
		},
		{
			title:"Big Buck Bunny Trailer",
			artist:"sajeeb",
			free:true,
			m4v: "http://www.jplayer.org/video/m4v/Big_Buck_Bunny_Trailer.m4v",
		},
		
	], {
		swfPath: "jplayer",
		supplied: "webmv, ogv, m4v",
		useStateClassSkin: true,
		autoBlur: true,
		smoothPlayBar: true,
		keyEnabled: true,
		autoRepeat:1
	});
	
});

//]]>
</script>
</head>
<body>
<div id="jp_container_1" class="jp-video jp-video-270p" role="application" aria-label="media player">
	<div class="jp-type-playlist">
		<div id="jquery_jplayer_1" class="jp-jplayer"></div>
		<div class="jp-playlist">
			<ul>
				<!-- The method Playlist.displayPlaylist() uses this unordered list -->
				<li>&nbsp;</li>
			</ul>
		</div>		
	</div>
</div>
</body>

</html>
