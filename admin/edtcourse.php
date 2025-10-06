<?php
include_once('pagesession.php');
include_once('dbconnect.php');
$xquery="select * from tbl_train where train_id=".$_GET['id']."";
$result=$mysqli->query($xquery);
$rows=$result->fetch_row();
if(isset($_POST['submit'])){
$x="update tbl_train set TrainName='".$_POST['txtname']."' where CourseID=".$_POST['hd']."";
$rst=$mysqli->query($x);
header("location:discourse.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Update Course</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
<h1 class="">Update Train Schedule</h1>
<form name="form1" id="form1" method="post" action="">
<input type="hidden" name="hd" id="hd" value="<?php echo $rows[0]?>">
<!--<table class="table-condensed table-hover ">
    <tr>
    <th>Course Name</th>
    <td>
	<input name="txtname" type="text" id="txtname" class="form-control" value="<?php echo $rows[1];?>">    </td>
    <td>
	<input type="submit" name="submit" value="insert course"  class="btn btn-success btn-sm" />
	 <a href="discourse.php" class="btn btn-info btn-sm">Display Course</a>
	</td>
    </tr>
</table>-->
<table class="table-condensed table-hover ">
    
    <tr>
      <th>Train Name</th>
      <td><label>
        <select name="txttrain_name"  id="txttrain_name"class="form-control">
			<option selected="selected">select train no</option>
		<?php 
		 $q="select * from train";
		 $rest=$mysqli->query($q);
		 while($row=$rest->fetch_row()){
		?>
				<option value="<?php echo $row[2]?>"><?php echo $row[2]?></option>
		<?php }?>
        </select>
      </label></td>
    </tr>
	<tr>
      <th>Train No</th>
      <td>
       <span id="txttrain_no"><input name="txttrain_no" type="text" id="txttrain_no"  class="form-control" required disabled="disabled"/></span>   
      </td>
    </tr>
	<tr>
      <th>Platform No</th>
      <td><input name="txtplatform_no" type="text" id="txtplatform_no" class="form-control" value="<?php echo $rows[2];?>" required></td>
    </tr>	
	<tr>
      <th>Destination</th>
      <td><input name="txtdestination" type="text" id="txtdestination" class="form-control" value="<?php echo $rows[3];?>"  required></td>
    </tr>
	<tr>
      <th>Schedule Time</th>
      <td><input name="txtschedule_time" type="time" id="txtschedule_time" class="form-control" value="<?php echo $rows[4];?>"  required></td>
    </tr>
	<tr>
      <th>Late</th>
      <td><input name="txtlate" type="text" id="txtlate" class="form-control" value="<?php echo $rows[5];?>"  required></td>
    </tr>
	<tr>
      <th>Weekend</th>
      <td><input name="txtweekend" type="text" id="txtweekend" class="form-control" value="<?php echo $rows[6];?>"  required></td>
    </tr>
	<tr>
      <th>Update By</th>
      <td><input name="txtupdate_by" type="text" id="txtupdate_by" class="form-control" value="<?php echo $_SESSION['user'];?>" required></td>
    </tr>
	    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="Submit Updated" class="btn btn-success btn-sm" />
    </tr>
      </table>
</form>
</body>
</html>