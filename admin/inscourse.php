<?php
include_once('pagesession.php');
include_once('../dbcon.php');
if(isset($_POST['submit'])){
	$courseName=$_POST['txtname'];

	
	$query="insert  into course(courseName) values('".$courseName."')";
	$rstt=$mysqli->query($query);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Insert City</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<script language="javascript" type="text/javascript" src="../script/jquery.js"></script>
<script language="javascript" type="text/javascript">
	
</script>


<style>
.rate{
    color:black;
    cursor:pointer;
}
.rate:hover{
    color:red;
}
.rate-item{
    cursor:pointer;
}
.rate-item:hover ~ .rate-item {
    color: black;
}
</style>
</head>
<body>

<h1 class="page-header">Insert course</h1>
<div style="width:100% ">

<form name="form1" id="form1" method="post" action="" enctype="multipart/form-data">
  <table class="table-condensed table-hover ">
    
    <tr>
      <th>CourseName</th>
      <td><input name="txtname" type="text" id="txtname" class="form-control" placeholder="Write The courseName Name" required></td>
    </tr>
    
    
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="Submit course" class="btn btn-success btn-sm" />
			<a href="discourse.php" class="btn btn-info btn-sm">Display course</a></td>
    </tr>
      </table>
</form>
</div>
</body>
</html>