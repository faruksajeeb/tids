<?php
include_once('pagesession.php');
include_once('dbconnect.php');
$xquery="select * from tbl_train_list where id='".$_GET['id']."'";
$result=mysql_query($xquery);
$rows=mysql_fetch_row($result);
if(isset($_POST['submit'])){
$username=$_SESSION['user_name'];
$ip_addr=$_SERVER['REMOTE_ADDR'];
$auditQry = "INSERT into tbl_auditor(username,ipaddr,description,train_no,action) 
  VALUES ('$username','$ip_addr','Edit from tain list table','".$_POST['train_hd']."','Add')";
$audit_result=mysql_query($auditQry);
$x="UPDATE tbl_train_list SET train_no='".$_POST['txtdescription']."' ,train_name='".$_POST['cname']."' WHERE id='".$_POST['hd']."' ";
$rst=mysql_query($x);
header("location:trainlist.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Update Train List</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<style>
.middle{height:auto;width:30%;margin:0 auto;border-radius:10px;
text-align:center;padding:20px;margin-top:50px;
box-shadow:-2px 2px 15px #ccc,2px 2px 15px #ccc,2px -2px 15px #ccc,-2px -2px 15px #ccc;
}
.middle h1{margin-top:0;font-size:22px;text-transform: uppercase;} 
</style>
</head>
<body>
<div class="middle" style="">
<h1 class="">Update Train List</h1>
<form name="form1" id="form1" method="post" action="">
<input type="hidden" name="hd" id="hd" value="<?php echo $rows[0]?>">
<input type="hidden" name="train_hd" id="train_hd" value="<?php echo $rows[1]?>">
<table class="table-condensed table-hover ">
	<tr>
      <th>Train No</th>
      <td><input name="txtdescription" cols="40" rows="5" class="form-control" value="<?php echo $rows[1];?>" id="txtdescription" required/>
	  </td>
    </tr>
	<tr>
      <th>Train name</th>
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