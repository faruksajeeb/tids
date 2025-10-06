<?php
include_once('../../db/db_connect.php');
$client_name=$_POST['clientName'];	
 $sql="SELECT * FROM tbl_client WHERE client_name='$client_name' ";
 $res=$conn->query($sql);
 $row=$res->fetch_assoc();
 if($row){
     echo 'Already Exists. Please enter a new client';
 }else{
     //echo "Avalable";
 }