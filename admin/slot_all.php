<?php
include_once('pagesession.php');
include_once('dbconnect.php');
include("../getDur/getid3/getid3.php");
if(isset($_POST['btn-upload']))
{    
	 $client_id=$_POST['client_name'];
	 $tvc_id=$_POST['tvc_name'];
	 $scheduled_time=$_POST['datetimepicker'];
	 //$duration=$_POST['video_duration'];
	// $get_due=$duration."second";	 
	 //$get_due=gmdate("H:i:s",$duration);
	 //$newtimestamp = strtotime("$scheduled_time +$get_due");
	 //$next_time=date('Y-m-d H:i:s', $newtimestamp);	 
	 //$next_time=$end_time + $duration;
                   $slot=$_POST['slot'];
	 $sql="INSERT INTO tbl_tvc_schedule(client_id,tvc_id,schedule_date,slot_id) VALUES($client_id,$tvc_id,'$scheduled_time',$slot)";
	 mysql_query($sql);

	$username=$_SESSION['user_name'];
	$ip_addr=$_SERVER['REMOTE_ADDR'];
	$auditQry = "INSERT into tbl_auditor(username,ipaddr,description,train_no,action)
	VALUES ('$username','$ip_addr','Add into Commercial Schedule Display',$tvc_id,'Add')";
	$audit_result=mysql_query($auditQry);
	 
}

?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="datetime/jquery.datetimepicker.css" rel="stylesheet" type="text/css"/>
<link href="../css/jquery.dataTables.css" rel="stylesheet">
<script language="javascript" type="text/javascript" src="../script/jquery-1.9.1.min.js"></script>


</head>
<style>

.middle h1{margin-top:10px;;font-size:22px;text-align:center;text-transform: uppercase;} 
#insert_table{float:left;}
thead{background-color:#ccc;}


</style>
</head>
<body >

<?php

 $dt = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
$current_date=$dt->format('Y-m-d ');
$current_time=$dt->format('H:i:s');
//echo $current_time;
 
 ?>
<table class=" table table-bordered table-condensed table-hover" >	
	
	<thead>
    <tr>
		<th>Sl No.</th>
                <th>TVC Name </th>                
      <th>Client Name</th>      
      <th>Schedule Date</th>     
	  <th>Duration</th>
	  <th>Slot Name</th>
	  <th>Slot Start Time</th>
	  <th>Slot End Time</th>
	<!--  <th>Action</th> -->
	 
    </tr>
	</thead>
	<tbody>
	<?php
        $sl_no=1;
        $sql="SELECT * "
                . "FROM "
                    . "tbl_tvc_playing_report "
                . "ORDER BY "
                    . "playing_report_id "
                . "DESC LIMIT 1";
         $presult=mysql_query($sql);         
         $playing_result=mysql_fetch_assoc($presult);         
        //echo $playing_result['schedule_id'];
	//$qqq="select * from tbl_tvc_schedule ORDER BY schedule_id DESC LIMIT 1";
	$schedule_sql="SELECT "
                                                . "tts.*,"
                                                . "c.client_name,"
                                                . "tt.tvc_name,"
                                                . "tt.duration,"
                                                . "ts.slot_name,"
                                                . "ts.slot_start_time,"
                                                . "ts.slot_end_time "
                                        . "FROM "
                                                . "tbl_tvc_schedule AS tts,"
                                                . "tbl_client AS c,"
                                                . "tbl_tvc AS tt, "
                                                . "tbl_tvc_slot AS ts "
                                        . "WHERE "
                                                . "tts.client_id = c.client_id AND "
                                                . "tts.tvc_id = tt.tvc_id AND "
                                                . "tts.slot_id = ts.slot_id AND tts.schedule_date='$current_date' AND "
                                                . "tts.publication_status = 1 "
                                        ;
                                                
	$result=mysql_query($schedule_sql);
                // echo $result;
	while($roww=mysql_fetch_assoc($result)){
                        $get_duration=$roww['duration'];
                         $get_du=gmdate("H:i:s",$get_duration);         
	?>

            <tr align="left" style="background-color:#fff">
       <td ><?php echo $sl_no;?></td>
       <td><?php echo $roww['tvc_name'];?></td>
      <td><?php echo $roww['client_name']; ?></td>      
      <td><?php echo $roww['schedule_date'];?></td>      
      <td><?php echo $get_du; ?></td>
      <td><?php echo $roww['slot_name'];?></td>
      <td><?php echo $roww['slot_start_time'];?></td>
      <td><?php echo $roww['slot_end_time'];?></td>
	<!--  <td>
		<a href="delete_video_schedule.php?id=<?php echo $roww['schedule_id'];?>" class="btn btn-danger  btn-xs" onclick="return check_detele();"><span class="fa fa-times"> Delete</span></a>
	  </td>
                 -->    
     
    </tr>
	<?php
        $sl_no++;
	}
	?>
	</tbody>
	

  </table>

<script src="datetime/jquery.js"></script>
<script src="datetime/jquery.datetimepicker.js"></script>
<script src="../script/jquery.dataTables.min.js" type="text/javascript"></script>
<script>
    /*
window.onerror = function(errorMsg) {
	$('#console').html($('#console').html()+'<br>'+errorMsg)
}
$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
format: 'yyyy-mm-dd',
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:'Date.now()'
});
//$('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});
*/
jQuery('#datetimepicker').datetimepicker({
 i18n:{
  de:{
   months:[
    'Januar','Februar','März','April',
    'Mai','Juni','Juli','August',
    'September','Oktober','November','Dezember',
   ],
   dayOfWeek:[
    "So.", "Mo", "Di", "Mi", 
    "Do", "Fr", "Sa.",
   ]
  }
 },
 timepicker:false,
 format:'Y-m-d'
});
</script>

</body>
</html>
