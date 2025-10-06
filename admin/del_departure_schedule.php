<?php
include_once('dbconnect.php');
$q="delete from departure_schedule where trainno='".$_GET['id']."'";
$r=mysql_query($q);
include_once('departure_schedule.php');
?>