<?php
include_once('pagesession.php');
include_once('dbconnect.php');
if(isset($_POST['submit']))
{
	$trainno=$_POST['txttrainno'];
	$trainname=$_POST['trainname'];
	$username=$_SESSION['user_name'];
	$ip_addr=$_SERVER['REMOTE_ADDR'];
	$auditQry = "INSERT into tbl_auditor(username,ipaddr,description,train_no,action) 
	  VALUES ('$username','$ip_addr','Add new train into tain list table','$trainno','Add')";
	$audit_result=mysql_query($auditQry);
	$query="INSERT  INTO tbl_train_list(train_no,train_name) VALUES('$trainno','$trainname')";
	$rstt=mysql_query($query);	
	header("location:trainlist.php");
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Admin-train</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
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
<div class="middle" >
<h1 class="page-header">Add New Train</h1>
<div style="width:100% ">

<form name="form1" id="form1" method="post" action="" enctype="">
  <table class="table-condensed table-hover ">
  <tr>
    <td>Train No</td>
    <td>
     <input name="txttrainno" cols="40" rows="5" class="form-control" id="txttrainno" required/>
    </td>
  </tr>
  <tr>
    <td>Train Name </td>
    <td><input name="trainname" type="text"  class="form-control" id="trainname" size="40" required/></td>
  </tr>
  <input name="txtupdate_by" type="hidden" id="txtupdate_by" class="form-control" value="<?php echo $_SESSION['user'];?>">
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" id="submit" value="Submit Scroll" class="btn btn-success btn-sm" />   </tr>
      </table>
</form>
</div>
</div>
</body>
</html>