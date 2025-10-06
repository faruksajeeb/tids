<?php
include('../../classes/dbConfig/config.php');
include_once('../../db/db_connect.php');
	$client_name=$_POST['clientName'];	
	$username=$_SESSION['user_name'];
	$ip_addr=$_SERVER['REMOTE_ADDR'];
        $sql="SELECT * FROM tbl_client WHERE client_name='$client_name' ";
 $res=$conn->query($sql);
 $row=$res->fetch_assoc();
 if($row){
     echo 'Already Exists. Please enter a new client';
 }else{
     $auditQry = "INSERT into tbl_auditor(username,ipaddr,description,train_no,action) 
	  VALUES ('$username','$ip_addr','Add into client list table','$client_name','Add')";
	$audit_result=$conn->query($auditQry);

	 
	 $sql="INSERT INTO tbl_client(client_name) VALUES('$client_name')";
	 $res=$conn->query($sql);
     echo "Inserted Successfully !";
 }
	
