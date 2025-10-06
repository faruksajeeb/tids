<?php
include_once('pagesession.php');
include_once('dbconnect.php');
$xquery="SELECT * FROM tbl_tvc_playing_time where id='".$_GET['id']."'";
$result=mysql_query($xquery);
$rows=mysql_fetch_row($result);
if(isset($_POST['submit'])){
	
$username=$_SESSION['user_name'];
$ip_addr=$_SERVER['REMOTE_ADDR'];
$auditQry = "INSERT into auditor(username,ipaddr,description,train_no,action) 
  VALUES ('$username','$ip_addr','Edit TVC playing time','".$_POST['hd']."','Edit')";
$audit_result=mysql_query($auditQry);

$x="UPDATE tbl_tvc_playing_time SET start_time='".$_POST['start_time']."' ,end_time='".$_POST['end_time']."'  WHERE id='".$_POST['hd']."' ";
$rst=mysql_query($x);
header("location:tvc_playing_time.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Update Intermission Time</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
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
<h1 class="">Update <?php echo $rows[1];?> Time</h1>
<form name="form1" id="form1" method="post" action="">
<input type="hidden" name="hd" id="hd" value="<?php echo $rows[0]?>">
<table class="table-condensed table-hover ">

	<tr>
      <th>Start Time</th>
      <td>
	  <input name="start_time" type="text" id="start_time" class="form-control" value="<?php echo $rows[2];?>"  required>
	  
	  </td>
	  <td>Time 24hr format (00:00:00)</td>
    </tr>
	<tr>
      <th>End Time</th>
      <td><input name="end_time" type="text" id="end_time" class="form-control" value="<?php echo $rows[3];?>"  required></td>
     <td>Time 24hr format (00:00:00)</td>
	</tr>
   	    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="Submit Updated" class="btn btn-success btn-sm" />
     <td></td>
	</tr>
      </table>
</form>
</div>
</body>
</html>