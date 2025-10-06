<?php
include_once('pagesession.php');
include_once('../dbcon.php');
$query="select * from course";
$rst=$mysqli->query($query);
?>
<!DOCTYPE html>
<html>
<head>
<title>Display course</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<script src="../script/jquery.js" type="text/javascript"></script>
<script src="../script/main.js" type="text/javascript"></script>
<style>
tr:nth-child(odd){background-color:#D9EDF7;}
tr:nth-child(even){background-color:#FCF8E3;}
th{background-color:#DFF0D8;}

/*Desigh for hovering images*/
#screenshot{
	position:absolute;
	border:1px solid #ccc;
	background:#333;
	padding:5px;
	display:none;
	color:#fff;
	}
</style>
</head>
<body>
<h1 class="page-header">Display course</h1>
<form name="form1" method="post" action="" >
	<a href="inscourse.php" class="btn btn-info btn-sm">Insert New course</a>
	
	<div class="table-responsive">
  <table id="myTable" class=" table table-bordered table-condensed table-hover tablesorter">
  <thead> 
    <tr>
      <th>CourseID</th>
      <th>CourseName</th>
	  <th>Delete</th>
	  <th>Edit</th>
    </tr>
</thead>
<tbody>
	<?php
		while($row=$rst->fetch_row()){
	?>
    <tr>
     <td><?php echo $row[0]?></td>
	  <td><?php echo $row[1]?></td>
	  
	  <td><a href="delcourse.php?id=<?php echo $row[0];?>" class="btn btn-danger  btn-sm"><span class="fa fa-times"></span></a></td>
	  <td><a href="edtcourse.php?id=<?php echo $row[0];?>" class="btn btn-info btn-sm"><span class="fa fa-pencil-square-o"></span></a></td>
    </tr>
	<?php
	}
	?>
<tbody>
  </table>
  </div>
</form>
</body>
</html>


























