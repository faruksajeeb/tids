<?php
include_once('pagesession.php');
include_once('../db/db_connect.php');
$intermission_id=$_POST['intermission_id'];
//$intermission_name=$_POST['intermission_name'];
$intermission_message=$_POST['intermission_message'];
$start_time=$_POST['start_time'];
$end_time=$_POST['end_time'];
$sql="UPDATE  tbl_tvc_intermission_time SET description='$intermission_message',start_time='$start_time',end_time='$end_time' WHERE intermission_id=$intermission_id";
$res=$conn->query($sql);


$username=$_SESSION['user_name'];
$ip_addr=$_SERVER['REMOTE_ADDR'];
$auditQry = "INSERT into tbl_auditor(username,ipaddr,description,train_no,action) 
  VALUES ('$username','$ip_addr','Edit intermission time','$intermission_id','Edit')";
$conn->query($auditQry);


?>



            