<?php
include('../../classes/dbConfig/config.php');
include_once('../../db/db_connect.php');
if(isset($_POST['submit']))
{	
	$username=$_SESSION['user_name'];
	$ip_addr=$_SERVER['REMOTE_ADDR'];
	$auditQry = "INSERT into auditor(username,ipaddr,date_time,table_name,action) 
	VALUES ('$username','$ip_addr',now(),'tbl_tids_scroll','Insert')";
	$conn->query($auditQry);
	
	$description=$_POST['txtdescription'];
	$txtcolor=$_POST['tcolor'];
	$bgcolor=$_POST['bcolor'];
	$company=$_POST['cname'];
	$query="INSERT  INTO tbl_tids_scroll(description,text_color,background_color,client_name) VALUES('$description','$txtcolor','$bgcolor','$company')";
	$conn->query($query);
        header("location:view.tids_scroll.php");
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Insert Scroll down</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
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
<h1 class="page-header">Add tids scroll</h1>
<div style="width:100% ">

<form name="form1" id="form1" method="post" action="" enctype="">
    
  <table class="table-condensed table-hover ">
  <tr>
    <td>Description</td>
    <td><label>
      <textarea name="txtdescription" cols="40" rows="5" class="form-control" id="txtdescription"></textarea>
    </label></td>
  </tr>
   <tr>
      <th>Text color</th>
      <td><input name="txtcolor" type="color" id="txtcolor" onchange="myFunction()"  value="#ffffff"  >
      <input name="tcolor" type="text" id="tcolor"   >
      </td>
    </tr>
    <tr>
      <th>Background color</th>
      <td><input name="bgcolor" type="color" onchange="myFunction2()" id="bgcolor"  value="#000000"  >
      <input name="bcolor" type="text" id="bcolor"   >
      </td>
    </tr>
  <tr>
    <td>Client Name </td>
    <td><input name="cname" type="text"  class="form-control" id="cname" size="40"/></td>
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