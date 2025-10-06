<?php

include_once('../db/db_connect.php');
$query = "SELECT * FROM tbl_video_duration";
$rst = $conn->query($query);
$row = $rst->fetch_row();

echo $row[2];
?>
				
