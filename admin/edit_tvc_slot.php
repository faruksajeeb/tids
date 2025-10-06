<?php
include_once('pagesession.php');
include_once('../db/db_connect.php');
$slot_id=$_POST['slot_id'];
$slot_name=$_POST['slot_name'];
$start_time=$_POST['start_time'];
$end_time=$_POST['end_time'];
$sql="UPDATE  tbl_tvc_slot SET slot_name='$slot_name',slot_start_time='$start_time',slot_end_time='$end_time' WHERE slot_id=$slot_id";
$res=$conn->query($sql);

?>



            