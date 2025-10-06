<?php
include_once('pagesession.php'); 
include_once('dbconnect.php');
$xquery="SELECT * FROM tbl_admin where id='".$_GET['id']."'";
$result=mysql_query($xquery);
$rows=mysql_fetch_row($result);

if(isset($_POST['submit'])){	
	
	$username=$_SESSION['user_name'];
	$ip_addr=$_SERVER['REMOTE_ADDR'];
	$auditQry = "INSERT into tbl_auditor(username,ipaddr,description,train_no,action)
	  VALUES ('$username','$ip_addr','Edit user into admin table','".$_POST['hd']."','Edit')";
	$audit_result=mysql_query($auditQry);
	
	$password=md5($_POST['txtpass']);
	$x="UPDATE tbl_admin SET username='".$_POST['txtuser']."',password='$password',usertype='".$_POST['txtusertype']."' WHERE id='".$_POST['hd']."' ";
	$rst=mysql_query($x);
	header("location:admin_users.php");
	
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit User</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<style>
body{}
.middle{height:auto;width:30%;margin:0 auto;border-radius:10px;
text-align:center;padding:20px;margin-top:50px;
box-shadow:-2px 2px 15px #ccc,2px 2px 15px #ccc,2px -2px 15px #ccc,-2px -2px 15px #ccc;
}
</style>
</head>
<body>
<div class="middle" style="">
<h1 class="">Edit User</h1>
<form name="form1" id="form1" method="post" action="">
<input type="hidden" name="hd" id="hd" value="<?php echo $rows[0]?>">
<table class="table-condensed table-hover ">
	  <tr>
    <td>Username</td>
    <td><input name="txtuser" type="text"  class="form-control" id="txtuser" size="40" value="<?php echo $rows[1];?>"  required/></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><input name="txtpass" type="password"  class="form-control" id="txtpass" size="40" value="<?php echo $rows[2];?>"  required/></td>
  </tr>  
     <tr>
      <th>Usertype</th>
      <td>
	  <select name="txtusertype"  id="txtusertype"class="form-control">
		
		<?php 
		 $q="select * from tbl_user_type";
		 $rest=mysql_query($q);
		 while($row=mysql_fetch_row($rest)){
		?>
				<option <?php if ($row[1]==$rows[3])  echo 'selected="selected"' ?> value="<?php echo $row[1];?>"><a href="#"><?php echo $row[1];?></a></option>
		<?php }?>
        </select>
	  </td>
    </tr> 
      <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="Submit" class="btn btn-success btn-sm" />
    </tr>
      </table>
</form>
</div>
</body>
</html>