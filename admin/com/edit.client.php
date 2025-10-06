<?php
include('../../classes/dbConfig/config.php');
include_once('../../db/db_connect.php');
$client_id=$_POST['client_id'];
$client_name=$_POST['client_name'];
$sql="UPDATE  tbl_client SET client_name='$client_name' WHERE client_id=$client_id";
$res=$conn->query($sql);

?>



            