<?php
include_once('pagesession.php');
include_once('dbconnect.php');
$xquery="SELECT * FROM tbl_setting where id='".$_GET['id']."'";
$result=mysql_query($xquery);
$rows=mysql_fetch_row($result);
if(isset($_POST['submit'])){
	
$username=$_SESSION['user_name'];
$ip_addr=$_SERVER['REMOTE_ADDR'];
$auditQry = "INSERT into auditor(username,ipaddr,description,train_no,action) 
  VALUES ('$username','$ip_addr','Edit tbl_setting time','".$_POST['hd']."','Edit')";
$audit_result=mysql_query($auditQry);

$x="UPDATE tbl_setting SET tids_refresh_duration='".$_POST['refresh_time']."' ,tids_alerm_duration='".$_POST['alerm_time']."'  WHERE id='".$_POST['hd']."' ";
$rst=mysql_query($x);
header("location:tids_settings.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Update tbl_setting Time</title>
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
<h1 class="">Update TIDS settings</h1>
<form name="form1" id="form1" method="post" action="">
<input type="hidden" name="hd" id="hd" value="<?php echo $rows[0]?>">
<table class="table-condensed table-hover ">

	<tr>
      <th>TIDS Display Refresh</th>
      <td>
	  <input name="refresh_time" type="text" id="refresh_time" class="form-control" value="<?php echo $rows[1];?>"  required>
	  
	  </td>
	  <td>Min (in english)</td>
    </tr>
	<tr>
      <th>TIDS Alarm </th>
      <td><input name="alerm_time" type="text" id="alerm_time" class="form-control" value="<?php echo $rows[2];?>"  required></td>
     <td>Min (in english)</td>
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