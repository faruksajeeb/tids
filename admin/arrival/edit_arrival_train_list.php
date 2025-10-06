<?php
include('../../classes/dbConfig/config.php');
include_once('../../db/db_connect.php');
$xquery="SELECT * FROM tbl_train_list_arrival WHERE arrival_train_id='".$_GET['id']."'";
$result=$conn->query($xquery);
$rows=$result->fetch_row();
if(isset($_POST['submit'])){
$username=$_SESSION['user_name'];
$ip_addr=$_SERVER['REMOTE_ADDR'];
$auditQry = "INSERT into tbl_auditor(username,ipaddr,description,train_no,action) 
  VALUES ('$username','$ip_addr','Edit from tain list table','".$_POST['train_hd']."','Add')";
$audit_result=$conn->query($auditQry);
$x="UPDATE tbl_train_list_arrival SET train_no='".$_POST['txtdescription']."' ,train_name='".$_POST['cname']."' WHERE arrival_train_id='".$_POST['hd']."' ";
$rst=$conn->query($x);
header("location:display.arrival_train_list.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Update arrival train</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<style>
.middle{
	height:auto;width:30%;margin:0 auto;border-radius:10px;
	text-align:center;padding:20px;margin-top:50px;
	box-shadow:-2px 2px 15px #ccc,2px 2px 15px #ccc,2px -2px 15px #ccc,-2px -2px 15px #ccc;
}
.middle h1{margin-top:0;font-size:22px;text-transform: uppercase;} 
</style>
</head>
<body>
<div class="middle" style="">
<h1 class="">Update arrival train</h1>
<form name="form1" id="form1" method="post" action="">
<input type="hidden" name="hd" id="hd" value="<?php echo $rows[0]?>">
<input type="hidden" name="train_hd" id="train_hd" value="<?php echo $rows[1]?>">
<table class="table-condensed table-hover ">
	<tr>
      <th>ট্রেন নং</th>
      <td><input name="txtdescription" cols="40" rows="5" class="form-control" value="<?php echo $rows[1];?>" id="txtdescription" required/>
	  </td>
    </tr>
	<tr>
      <th>ট্রেনের নাম</th>
      <td><input name="cname" type="text" id="cname" class="form-control" value="<?php echo $rows[2];?>"  required></td>
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
