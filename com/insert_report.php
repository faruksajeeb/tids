<?php
 include_once('../db/db_connect.php');
 $s=$_POST['n1'];
 //$pt=$_POST['n2'];
 $ip_addr=$_SERVER['REMOTE_ADDR'];
 
 if($s != ''){
 //$video_title=str_replace("videos/","",$q);
  /* Modify id for the system  */
 $sql= "INSERT INTO  tbl_tvc_playing_report(schedule_id,ip_address) VALUES ($s, '$ip_addr')";
 $query=$conn->query($sql);
 }
 

 ?>