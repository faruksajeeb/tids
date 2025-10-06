<?php
include_once('../../db/db_connect.php');
$date= $_POST['date'];
$check=$_POST['selectedSchedule'];
//$slot_id= $_POST['slot_id'];
//var_dump($check);

$last_key=end(array_keys($check));
$schedule_id=array();
$company_id=array();
$video_title=array();
$slot_id=array();
for($i=0;$i<=$last_key;$i++){
$peace=	explode('|',$check["$i"]);
$schedule_id[]=$peace['0'];
$company_id[]=$peace['1'];
$video_title[]=$peace['2'];
$slot_id[]=$peace['3'];
$tvc_order[]=$peace['4'];
}
//$conn=mysqli_connect("localhost","root","","db_tids"); 
//var_dump($check);
for($i=0;$i<=$last_key;$i++){
$sql="INSERT INTO tbl_tvc_schedule(client_id,tvc_id,schedule_date,slot_id,tvc_order) VALUES('".$company_id[$i]."','".$video_title[$i]."','".$date."','".$slot_id[$i]."',$tvc_order[$i])";
$result=$conn->query($sql);
//var_dump($result);
}
header("location:insert_video_schedule.php");
?>
