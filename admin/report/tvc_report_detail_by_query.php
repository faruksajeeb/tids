<?php
include('../../classes/dbConfig/config.php');
 include_once('../../db/db_connect.php');
 if(isset($_POST['btn_submit'])){
  $client_id3=$_POST['client_name2'];
  $tvc_id3=$_POST['tvc_name2'];
  $start_date3=$_POST['from_date'];  
  $end_date3=$_POST['to_date'];
 if( empty($client_id3) && empty($tvc_id3) && empty($start_date3) && empty($end_date3)){
      echo "<div style='text-align:center;color:red'>No data available. Please enter query criteria</div>";
      exit;
  }else if( !empty($client_id3) && empty($tvc_id3) && empty($start_date3) && empty($end_date3)){
     $sql = "SELECT tpr.ip_address,tt.tvc_name,tc.client_name,tt.duration,tpr.playing_time FROM tbl_tvc_playing_report AS tpr,tbl_tvc_schedule AS tts,tbl_client AS  tc,tbl_tvc AS tt WHERE tpr.schedule_id=tts.schedule_id AND tts.client_id=tc.client_id AND tts.tvc_id=tt.tvc_id AND tts.client_id=$client_id3 ORDER BY tpr.playing_time ASC";
   }else if(!empty($client_id3) && !empty($tvc_id3) && empty($start_date3) && empty($end_date3)){      
     $sql = "SELECT tpr.ip_address,tt.tvc_name,tc.client_name,tt.duration,tpr.playing_time FROM tbl_tvc_playing_report AS tpr,tbl_tvc_schedule AS tts,tbl_client AS  tc,tbl_tvc AS tt WHERE tpr.schedule_id=tts.schedule_id AND tts.client_id=tc.client_id AND tts.tvc_id=tt.tvc_id AND tts.client_id=$client_id3 AND tts.tvc_id=$tvc_id3 ORDER BY tpr.playing_time ASC";
   }else if(!empty($client_id3) && empty($tvc_id3) && !empty($start_date3) && !empty($end_date3)){ 
    $sql = "SELECT tpr.ip_address,tt.tvc_name,tc.client_name,tt.duration,tpr.playing_time FROM tbl_tvc_playing_report AS tpr,tbl_tvc_schedule AS tts,tbl_client AS  tc,tbl_tvc AS tt WHERE tpr.schedule_id=tts.schedule_id AND tts.client_id=tc.client_id AND tts.tvc_id=tt.tvc_id AND tts.client_id=$client_id3 AND tpr.playing_time BETWEEN '$start_date3 00:00:00' AND '$end_date3 23:59:59' ORDER BY tt.tvc_name, tpr.playing_time ASC";
   }else if(empty($client_id3) && empty($tvc_id3) && !empty($start_date3) && !empty($end_date3)){ 
    $sql = "SELECT tpr.ip_address,tt.tvc_name,tc.client_name,tt.duration,tpr.playing_time FROM tbl_tvc_playing_report AS tpr,tbl_tvc_schedule AS tts,tbl_client AS  tc,tbl_tvc AS tt WHERE tpr.schedule_id=tts.schedule_id AND tts.client_id=tc.client_id AND tts.tvc_id=tt.tvc_id AND tpr.playing_time BETWEEN '$start_date3 00:00:00' AND '$end_date3 23:59:59' ORDER BY tc.client_name, tt.tvc_name,tpr.playing_time ASC";
   }else if(!empty($client_id3) && !empty($tvc_id3) && !empty($start_date3) && !empty($end_date3)){ 
    $sql = "SELECT tpr.ip_address,tt.tvc_name,tc.client_name,tt.duration,tpr.playing_time FROM tbl_tvc_playing_report AS tpr,tbl_tvc_schedule AS tts,tbl_client AS  tc,tbl_tvc AS tt WHERE tpr.schedule_id=tts.schedule_id AND tts.client_id=tc.client_id AND tts.tvc_id=tt.tvc_id AND tts.client_id=$client_id3  AND tts.tvc_id=$tvc_id3 AND tpr.playing_time BETWEEN '$start_date3 00:00:00' AND '$end_date3 23:59:59' ORDER BY tc.client_name, tt.tvc_name, tpr.playing_time ASC";
   }else{
       echo "Query didn't found";
   }
 }   
 ?>
  
<link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="<?php echo BASE_URL; ?>script/jquery-2.2.3.min.js"></script> 
<script type="text/javascript" src="<?php echo BASE_URL; ?>script/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>admin/exportData/jquery.table2excel.js"></script>

<style>
tr:nth-child(even) {background: #FFF8DC}
tr:nth-child(odd) {background: #FFF}
</style>
<div style="width:1300px; margin:0 auto;background-color:#F5F5DC">
<div style="width:1260px; margin:0 auto;text-align:center;background-color:#F5F5DC">
  <br/>
 <div class="pull-right">
<a href="#" class="btn btn-info " onclick="PrintDiv();"><i class="fa fa-print"></i> Print</a>
<a href="#" class="btn btn-info" onclick="excelExport();"><i class="fa fa-file-excel-o"></i>  Excel</a>

</div>

 <div  id="clientData"  class="clientExcel" style=""  >
 <img style=" height:100px; display:block;" src="<?php echo BASE_URL; ?>img/tv_logo_report.png" alt="ARTS TIDS(Logo)" >	
												

<span style="background:#A52A2A;color:white; padding:5px;border-radius:5px;font-size:20px;">TVC REPORT DETAILS</span>
<div   style="" >

<table width="100%" style="background-color:#F5F5DC">
     <tr style="background-color:#F5F5DC">
         <td colspan="2"><strong>Client name:</strong>
                <?php  
                 if(empty($client_id3)){
                     $_SESSION['client_name']='all';
                         echo 'All';
                    }  else{
                    $sql_client="SELECT c.client_name FROM tbl_client AS c WHERE c.client_id=$client_id3";
                    $client_res=$conn->query($sql_client);
                    $cli_row=$client_res->fetch_assoc();
                    $_SESSION['client_name']=$cli_row['client_name'];
                         echo $cli_row['client_name'];
                    }
                  ?>
            </td>
                <?php if(empty($client_id3)){ 
				?>
				<td></td>
				<?php
				}?>       
            <td colspan="2" style="text-align: right;"><strong>From date:</strong> <?php if(!empty($start_date3)){echo$start_date3;}else{ echo "____ __ __";}?> <strong>To date:</strong> <?php if(!empty($end_date3)){echo$end_date3;}else{ echo "____ __ __";}?> </td>
        </tr>
  
</table><br/>
<table   border="1" style="border-collapse: collapse;" width="100%"  class=" table table-bordered table-condensed table-hover example">
    <thead>
       
        <tr style="background-color:#F5DEB3;">
                <th>Sl No</th>
                
                <?php
                if(empty($client_id3)){
                ?>
                <th>Client Name</th> 
                <?php } ?>
                <th>TVC Name </th>     
                <th>TVC Dur(Sec)</th>    
                <th>Broadcasting Time</th>    
             
                
        </tr>
      
    </thead>
    <tbody >
    
	<?php
                            $i=1;
                            $total_duration=0;
                           $rst= $conn->query($sql);
                           
                       
                            while($row=$rst->fetch_assoc()){
                                
	?>
    <tr>
      <td><?php echo $i; ?></td>
      
        <?php
                if(empty($client_id3)){
                ?>
      <td><?php echo $row['client_name']?></td>
                <?php } ?>
      <td><?php echo $row['tvc_name']?></td>      
      <td><?php echo $row['duration']?></td>      
      <td><?php echo $row['playing_time']?></td>
    </tr>
	<?php
        $duration=$row['duration'];
        $total_duration=$total_duration+$duration;
        $i++;
                            }
	?>
	</tbody>
        <tfoot>
            <tr style="background-color:#F5DEB3;">
                <td></td>
                
                       <?php if(empty($client_id3)){
                                ?>
                      <td></td>
                                <?php } ?>
                <td style="text-align: right;font-weight: bold">Total Broadcasting Duration:</td>
                <td style="font-weight: bold"><?php echo  $total_duration.' seconds'; ?></td>
                <td></td>
            </tr>
        </tfoot>
  </table>
</div>
</div>




Powred by @ ARTS Railway Station Television
</div>
</div>
 
 
<script>
	function excelExport() {
                        $(".clientExcel").table2excel({
                                exclude: ".noExl",
                                name: "Excel Document Name",
                                filename: "<?php echo $_SESSION['client_name']; ?>_tvcBroadcastingReport",
                                fileext: ".xls",
                                exclude_img: true,
                                exclude_links: true,
                                exclude_inputs: true
                        });
                }
                function PrintDiv() {    
                        var divToPrint = document.getElementById('clientData');
                        var popupWin = window.open('', '_blank', 'width=1000,height=500');
                        popupWin.document.open();
                        popupWin.document.write('<html><head><title>ARTS Railway Station TV || TVC report</title><style> body{ text-align:center} tr:nth-child(even) {background: #FFF8DC }tr:nth-child(odd) {background: #FFF}</style></head><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                        popupWin.document.close();
                 }
</script>
<?php 
 session_cache_expire();
?>
 