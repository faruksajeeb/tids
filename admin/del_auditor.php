<?php
include_once('dbconnect.php');
$idd=$_GET['id'];
$q="delete from auditor where ID=".$_GET['id']."";
$r=mysql_query($q);
include_once('audit_trial.php');
?>