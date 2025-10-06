<?php
 include_once('../../db/db_connect.php'); 
 $dt = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
$current_date=$dt->format('Y-m-d ');
$current_time=$dt->format('H:i:s');
//echo $current_time;
 
 ?>
<table class=" table table-bordered table-condensed table-hover example" >	
	
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
         $presult=$conn->query($sql);         
         $playing_result=$presult->fetch_assoc();         
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
                                                . "tts.slot_id = ts.slot_id AND tts.schedule_date='$current_date' AND ts.slot_end_time>'$current_time' AND ts.slot_start_time< '$current_time' AND "
                                                . "tts.publication_status = 1 "
                                        . "ORDER BY "
                                                 . "tts.tvc_order";
                                                
	$result=$conn->query($schedule_sql);
                // echo $result;
	while($roww=$result->fetch_assoc()){
                        $get_duration=$roww['duration'];
                         $get_du=gmdate("H:i:s",$get_duration);         
	?>

            <tr align="left" style="background-color:<?php if($roww['schedule_id']==$playing_result['schedule_id']){ echo "#ffcccc";} ?>">
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
