<?php
include_once('pagesession.php');
include_once('dbconnect.php');
$idd=$_GET['id'];
$trainno=$_GET['train_no'];
$username=$_SESSION['user_name'];
$ip_addr=$_SERVER['REMOTE_ADDR'];
$auditQry = "INSERT into tbl_auditor(username,ipaddr,description,train_no,action) 
  VALUES ('$username','$ip_addr','Delete from tain list table','$trainno','Delete')";
$audit_result=mysql_query($auditQry);

$q="delete from tbl_train_list where id=".$_GET['id']."";
$r=mysql_query($q);
header("location:trainlist.php");
?>