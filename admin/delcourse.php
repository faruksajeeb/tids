<?php
include_once('dbconnect.php');
$idd=$_GET['id'];
$q="delete from auditor where ID=".$_GET['id']."";
$r=$mysqli->query($q);
include_once('auditor.php');
?>