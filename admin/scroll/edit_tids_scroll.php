<?php
include('../../classes/dbConfig/config.php');
include_once('../../db/db_connect.php');
$xquery="select * from tbl_tids_scroll where id='".$_GET['id']."'";
$result=$conn->query($xquery);
$rows=$result->fetch_row();

if(isset($_POST['submit'])){	
$username=$_SESSION['user_name'];
$ip_addr=$_SERVER['REMOTE_ADDR'];
$auditQry = "INSERT into tbl_auditor(username,ipaddr,description,train_no,action) 
  VALUES ('$username','$ip_addr','Update from tbl_tids_scroll table','".$_POST['hd']."','edit')";
$conn->query($auditQry);

$x="UPDATE tbl_tids_scroll SET description='".$_POST['txtdescription']."' ,text_color='".$_POST['tcolor']."',background_color='".$_POST['bcolor']."',client_name='".$_POST['cname']."',update_by='".$_POST['txtupdate_by']."',	update_date=NOW()  WHERE id='".$_POST['hd']."' ";
$conn->query($x);
header("location:view.tids_scroll.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Update Scroll Down</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<style>
body{}
.middle{height:auto;width:30%;margin:0 auto;border-radius:10px;
text-align:center;padding:20px;margin-top:50px;
box-shadow:-2px 2px 15px #ccc,2px 2px 15px #ccc,2px -2px 15px #ccc,-2px -2px 15px #ccc;
}
.middle h1{margin-top:0;font-size:22px;text-transform: uppercase;} 
</style>
<script>
function myFunction() {
    var x = document.getElementById("txtcolor").value;
    document.getElementById("tcolor").value = x;
}
function myFunction2() {
    var x = document.getElementById("bgcolor").value;
    document.getElementById("bcolor").value = x;
}
</script>
</head>
<body>
<div class="middle" style="">
<h1 class="">Edit  tids scroll</h1>
<form name="form1" id="form1" method="post" action="">
<input type="hidden" name="hd" id="hd" value="<?php echo $rows[0]?>">
<table class="table-condensed table-hover ">
	<tr>
      <th>Description</th>
      <td><textarea name="txtdescription" cols="40" rows="5" class="form-control" id="txtdescription" required><?php echo $rows[1];?></textarea>
	  </td>
    </tr>
    <tr>
      <th>Text color</th>
      <td><input name="txtcolor" type="color" id="txtcolor" onchange="myFunction()"  value="<?php echo $rows[2];?>"  >
        <input name="tcolor" type="text" id="tcolor"  value="<?php echo $rows[2];?>" ></td>
    </tr>
    <tr>
      <th>Background color</th>
      <td><input name="bgcolor" type="color" id="bgcolor" onchange="myFunction2()"  value="<?php echo $rows[3];?>"  >
      <input name="bcolor" type="text" id="bcolor"   value="<?php echo $rows[3];?>"></td>
    </tr>
	<tr>
      <th>Client name</th>
      <td><input name="cname" type="text" id="cname" class="form-control" value="<?php echo $rows[4];?>"  required></td>
    </tr>
    
   <input name="txtupdate_by" type="hidden" id="txtupdate_by" class="form-control" value="<?php echo $_SESSION['user'];?>" required>
	    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="Submit Updated" class="btn btn-success btn-sm" />
    </tr>
      </table>
</form>
</div>
</body>
</html>