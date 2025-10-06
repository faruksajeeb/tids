<?php
require_once '../parmitted.php';
include_once('../../db/db_connect.php');
$class='Arrival';
require_once("../../classes/class.".$class.".php");
foreach($avl_obj->showData("tbl_setting") as $value):
    extract($value);
if(isset($_POST['submit']))
{
	$username=$_SESSION['user_name'];
	$ip_addr=$_SERVER['REMOTE_ADDR'];
	$auditQry = "INSERT into tbl_auditor(username,ipaddr,description,train_no,action) 
	VALUES ('$username','$ip_addr','Add into Arrival Schedule Table','".$_POST['arrival_train_id']."','Add')";
	$conn->query($auditQry);	
	
	$arrival_train_id=$_POST['arrival_train_id'];
	$platform=$_POST['txt_platform'];
	$destination=$_POST['txt_destination'];
	$schedule_time=$_POST['txt_schedule_time'];
	$probable_time=$_POST['txt_late'];
	$query="insert  into tbl_arrival_schedule(arrival_train_id,platform_no,coming_from,schedule_time,probable_time,status) 
	values($arrival_train_id,'$platform','$destination','$schedule_time','$probable_time',0)";
	$conn->query($query);
	header('Location:display.arrival_schedule.php');
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Insert Arrival Train Schedule</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<script language="javascript" type="text/javascript" src="../../script/jquery.js"></script>
<script type="text/javascript">

</script>
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
<h1 class="page-header">Add Arrival Train Schedule</h1>
<div style="width:100% ">

<form name="form1" id="form1" method="post" action="" enctype="">
  <table class="table-condensed table-hover ">
    <tr>
       <th><?php echo $train_name; ?></th>
      <td>
	  <select name="arrival_train_id"  id="arrival_train_id"class="form-control">
			<option>select train name</option>
		<?php 
		 $q="SELECT * FROM tbl_train_list_arrival";
		 $rest=$conn->query($q);
		 while($row=$rest->fetch_assoc()){
		?>
				<option value="<?php echo $row['arrival_train_id']?>">
					<?php echo $row['train_name'].'('.$row['train_no'].')'; ?>
				</option>
		<?php }?>
        </select>
	  </td>
    </tr>
    <tr>
      <th><?php echo $platform; ?></th>
      <td> <input name="txt_platform" type="text"   class="form-control" /></td>
    </tr>
	   <tr>
      <th><?php echo $initial_station; ?></th>
      <td> <input name="txt_destination" type="text"   class="form-control" /></td>
    </tr>
	   <tr>
     <th><?php echo $arr_schedule_time; ?></th>
      <td> <input name="txt_schedule_time" type="text"   class="form-control" /></td>
    </tr>
	   <tr>
      <th><?php echo $arrival_probable_time; ?></th>
      <td> <input name="txt_late" type="text" id="txt_late"  class="form-control" /></td>
    </tr>
    <tr>	
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="Submit Schedule" class="btn btn-success btn-sm" />
			<a href="display.arrival_schedule.php" class="btn btn-info btn-sm">Display Train Schedule</a></td>
    </tr>
      </table>
</form>
</div>
</div>
</body>
</html>
<?php
endforeach;
?>
