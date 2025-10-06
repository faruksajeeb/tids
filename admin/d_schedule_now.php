<?php
include_once('pagesession.php');
include_once('dbconnect.php'); 
$xquery="select * from departure_schedule where trainno='".$_GET['id']."'";
$result=mysql_query($xquery);
$rows=mysql_fetch_row($result);

if(isset($_POST['submit'])){
	
$username=$_SESSION['user'];
$ip_addr=$_SERVER['REMOTE_ADDR'];
$auditQry = "INSERT into auditor(username,ipaddr,date_time,table_name,train_no,action) 
  VALUES ('$username','$ip_addr',now(),'departure_schedule','".$_POST['hd']."','Add')";
$audit_result=mysql_query($auditQry);

$x="UPDATE departure_schedule SET status=1 WHERE trainno='".$_POST['hd']."' ";
$rst=mysql_query($x);
header("location:departure_schedule.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Departure Schedule</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<script language="javascript" type="text/javascript" src="../script/jquery.js"></script>
<!--<script language="javascript" type="text/javascript" src="../../jQueryy/jquery-1.6.4.min.js"></script>-->
<script src="../script/main.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
</script>
<style>
.fa-star:hover{color:red;
cursor:pointer;
}
body{width:100%;}
#snow{height:200px;width:300px;margin:0 auto;padding:5px; text-align:center; margin-top:100px;
border-radius:10px;
box-shadow:10px 10px 40px #000;
box-shadow:-10px 10px 180px #666}
//input[type=submit]{ box-shadow:5px 5px 40px #000; }
</style>


</head>
<body >
<div id="snow">
<h5 style="margin-top:50px">Are you sure you want to add into Schedule?</h5><br><br>
<form name="form1" id="form1" method="post" action="">
<input type="hidden" name="hd" id="hd" value="<?php echo $rows[0]?>">
<input type="submit" name="submit" value="Add into Schedule" class="btn btn-success btn-lg" />
</form>
</div>
</body>
</html>