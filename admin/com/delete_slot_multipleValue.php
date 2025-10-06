
<?php
include_once('../../db/db_connect.php'); 

$check=$_POST['selectedSchedule'];



$last_key=end(array_keys($check));
$schedule_id=array();
for($i=0;$i<=$last_key;$i++){
$peace=	explode('|',$check["$i"]);
$schedule_id[]=$peace['0'];
}

//var_dump($check);
for($i=0;$i<=$last_key;$i++){
$sql="UPDATE tbl_tvc_schedule SET publication_status=0 WHERE schedule_id=".$schedule_id[$i];
$result=$conn->query($sql);
//var_dump($result);
}
//header("location:insert_video_schedule.php");
?>
