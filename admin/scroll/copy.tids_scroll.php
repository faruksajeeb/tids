<?php
include_once('pagesession.php');
include_once('dbconnect.php');
$xquery="select * from tbl_scroll_down where id='".$_GET['id']."'";
$result=mysql_query($xquery);
$rows=mysql_fetch_row($result);

if(isset($_POST['submit'])){
	
	$username=$_SESSION['user_name'];
	$ip_addr=$_SERVER['REMOTE_ADDR'];
	$auditQry = "INSERT into tbl_auditor(username,ipaddr,description,train_no,action) 
	  VALUES ('$username','$ip_addr','Copy from Scroll Bottom table','".$_POST['hd']."','copy')";
	$audit_result=mysql_query($auditQry);

	$description=$_POST['txtdescription'];
	$company=$_POST['cname'];
	$status=$_POST['txtstatus'];
	$query="INSERT  INTO tbl_scroll_down(description,company_name,status) VALUES('$description','$company',$status)";
	$rstt=mysql_query($query);
	header("location:display_tids_scroll.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Update Scroll Up</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<style>
body{width:100%;}
#snow{height:200px;width:300px;margin:0 auto;padding:5px; text-align:center; margin-top:100px;
border-radius:10px;
box-shadow:10px 10px 40px #000;
box-shadow:-10px 10px 180px #666}
//input[type=submit]{ box-shadow:5px 5px 40px #000; }
</style>
</head>
<body>
<div id="snow">
<h5 style="margin-top:50px">Are you sure you want to Copy into bottom Scroll?</h5><br><br>
<form name="form1" id="form1" method="post" action="">
	<input type="hidden" name="hd" id="hd" value="<?php echo $rows[0]?>">
	<input name="txtdescription" type="hidden" id="txtdescription" class="form-control" value="<?php echo $rows[1];?>"  required>
	<input name="cname" type="hidden" id="cname" class="form-control" value="<?php echo $rows[2];?>"  required>
	<input name="txtupdate_by" type="hidden" id="txtupdate_by" class="form-control" value="<?php echo $_SESSION['user'];?>" required>
	<input name="txtstatus" type="hidden" id="txtstatus" class="form-control" value="<?php echo $rows[5];?>"  required>
	<input type="submit" name="submit" value="Copy" class="btn btn-success btn-lg" />
</form>
</div>
</body>
</html>