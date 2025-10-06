<?php
include_once('dbconnect.php');
$idd=$_GET['id'];
$q="UPDATE tbl_tvc_schedule SET publication_status=0 WHERE schedule_id=".$_GET['id']."";
$r=mysql_query($q);
header("location:display_video_schedule_all.php");
?>