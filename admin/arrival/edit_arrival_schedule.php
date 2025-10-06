<?php
require_once '../parmitted.php';
include_once('../../db/db_connect.php');
$class='Arrival';
require_once("../../classes/class.".$class.".php");
foreach($avl_obj->showData("tbl_setting") as $value):
    extract($value);
$xquery="SELECT * FROM tbl_arrival_schedule WHERE arrival_schedule_id='".$_GET['id']."'";
$result=$conn->query($xquery);
$rows=$result->fetch_assoc();
if(isset($_POST['submit'])){
        $id=$_GET['id'];
        $train_no=$_GET['train_no'];
        $train_name=$_GET['train_name'];
        $platform_no=$_GET['platform_no'];
                           if(!empty($platform_no)){
                               $plt_no=$platform_no;
                           }else{
                               $plt_no="__";
                           }
        $coming_from=$_GET['coming_from'];
        $schedule_time=$_GET['schedule_time'];
        $probable_time=$_GET['probable_time'];
                            if(!empty($probable_time)){
                                   $pb_time=$probable_time;
                           }else{
                               $pb_time="__:__";
                           }
        $username=$_SESSION['user_name'];
        $ip_addr=$_SERVER['REMOTE_ADDR'];
        
        $e_arrival_train=$_POST['arrival_train_id'];
        $e_platform_no=$_POST['txt_platform_no'];
        $e_coming_from=$_POST['txt_coming_from'];
        $e_schedule_time=$_POST['txt_schedule_time'];
        $e_possible_time=$_POST['txt_probable_time'];
        $auditQry = "INSERT INTO tbl_auditor(username,ipaddr,description,train_no,action) 
          VALUES ('$username','$ip_addr','Update Arrival Schedule table','".$_POST['hd']."','Edit')";
        $conn->query($auditQry);
        $tidsQry = "INSERT INTO tbl_tids_report(user_name,ip_address,description,action) VALUES ('$username','$ip_addr','$train_name($train_no)  $coming_from স্টেশন থেকে  নির্ধারিত সময়  $e_schedule_time(Ex-$schedule_time) টা সম্ভাব্য সময় $e_possible_time(Ex-$pb_time) টায় $e_platform_no(Ex-$plt_no) নং প্লাটফর্ম   এ পৌঁছাবে ।',' edit')";
        $conn->query($tidsQry);	
        $x="UPDATE tbl_arrival_schedule SET arrival_train_id=$e_arrival_train,platform_no='$e_platform_no',coming_from='$e_coming_from',schedule_time='$e_schedule_time',probable_time= '$e_possible_time' WHERE arrival_schedule_id='".$_POST['hd']."' ";
        $rst=$conn->query($x);
        header("location:display.arrival_schedule.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Update Arrival Train Schedule</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<script language="javascript" type="text/javascript" src="../../script/jquery.js"></script>
<!--<script language="javascript" type="text/javascript" src="../../jQueryy/jquery-1.6.4.min.js"></script>-->
<script src="../../script/main.js" type="text/javascript"></script>

<style>
body{}
.middle{height:auto;width:30%;margin:0 auto;border-radius:10px;
text-align:center;padding:20px;margin-top:50px;
box-shadow:-2px 2px 15px #ccc,2px 2px 15px #ccc,2px -2px 15px #ccc,-2px -2px 15px #ccc;
}
.middle h1{margin-top:0;font-size:22px;text-transform: uppercase;} 
</style>
</head>
<body>
<div class="middle" style="">
<h1 class="">Update Arrival Train Schedule</h1>
<form name="form1" id="form1" method="post" action="">
<input type="hidden" name="hd" id="hd" value="<?php echo $rows['arrival_schedule_id']?>">

<table class="table-condensed table-hover ">
    
     <tr>
      <th><?php echo $train_name; ?></th>
      <td>
	  <select name="arrival_train_id"  id="arrival_train_id"class="form-control">
		
		<?php 
		 $q="select * from tbl_train_list_arrival";
		 $rest=$conn->query($q);
		 while($train_list=$rest->fetch_assoc()){
		?>
				<option <?php if ($train_list['arrival_train_id']==$rows['arrival_train_id'])  echo 'selected="selected"' ?> value="<?php echo $train_list['arrival_train_id']?>">
					<?php echo $train_list['train_name'].'('.$train_list['train_no'].')'; ?>
				</option>
		<?php 
				}
			?>
        </select>
	  </td>
    </tr> 
	
	<tr>
      <th><?php echo $platform; ?></th>
      <td><input name="txt_platform_no" type="text" id="txt_platform_no" class="form-control" value="<?php echo $rows['platform_no'];?>" ></td>
    </tr>	
	<tr>
      <th><?php echo $initial_station; ?></th>
      <td><input name="txt_coming_from" type="text" id="txt_coming_from" class="form-control" value="<?php echo $rows['coming_from'];?>"  required></td>
    </tr>
	<tr>
      <th><?php echo $arr_schedule_time; ?></th>
      <td><input name="txt_schedule_time" type="text" id="txt_schedule_time" class="form-control" value="<?php echo $rows['schedule_time'];?>"  required></td>
    </tr>
	<tr>
      <th><?php echo $arrival_probable_time; ?></th>
      <td><input name="txt_probable_time" type="text" id="txt_probable_time" class="form-control" value="<?php echo $rows['probable_time'];?>" ></td>
    </tr>
   <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="Submit Updated" class="btn btn-success btn-sm" />
    </tr>
      </table>
</form>
</div>
</body>
</html>
<?php
endforeach;
?>
