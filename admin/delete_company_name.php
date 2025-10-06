<?php
include_once('pagesession.php');
include_once('dbconnect.php');

	$company_name=$_GET['company_name'];
	$username=$_SESSION['user_name'];
	$ip_addr=$_SERVER['REMOTE_ADDR'];
	$auditQry = "INSERT into tbl_auditor(username,ipaddr,description,train_no,action) 
	  VALUES ('$username','$ip_addr','Add into company list table','$company_name','Add')";
	$audit_result=mysql_query($auditQry);

$q="DELETE FROM tbl_company WHERE company_id=".$_GET['company_id'];
$r=mysql_query($q);
header("location:insert_new_company.php");
?>