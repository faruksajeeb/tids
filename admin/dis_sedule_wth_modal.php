<?php
mysql_connect('localhost','root','');
mysql_select_db('artdb');
mysql_query('SET CHARACTER SET utf8');
mysql_query("SET SESSION collation_connection ='utf8_general_ci'"); 
$query="select * from schedule";
$rst=mysql_query($query);
?>
<!DOCTYPE html>
<html  lang="bn" >
<head>
<title>Display course</title>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<script src="../script/jquery.js" type="text/javascript"></script>
<script src="../script/bootstrap.min.js" type="text/javascript"></script>
<script src="../script/main.js" type="text/javascript"></script>
<script>
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})
</script>
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
<h1 class="page-header" style="text-align:center">ট্রেন ছাড়ার সময়সূচি</h1>
<form name="form1" method="post" action=""  >
	<a href="insert_schedule.php" class="btn btn-info btn-sm">Insert Train Schedule</a>
	
	<div class="table-responsive">
  <table id="myTable" class=" table table-bordered table-condensed table-hover tablesorter">
  <thead> 
    <tr>
      <th>Train No</th>
      <th>Trai Name</th>
	  <th>Platform No</th>
      <th>Deatination</th>
	  <th>Schedule Time</th>
      <th>Late</th>
	  <th>Action</th>	
    </tr>
</thead>
<tbody>
	<?php
		while($row = mysql_fetch_row($rst)){
	?>
    <tr>
     <td><?php echo $row[0]?></td>
	  <td><?php echo $row[1]?></td>
	  <td><?php echo $row[2]?></td>
	  <td><?php echo $row[3]?></td>
	  <td><?php echo $row[4]?></td>
	  <td><?php echo $row[5]?></td>
  <td>
	<a href="edit_schedule.php?id=<?php echo $row[0];?>" class="btn btn-info btn-xs"><span class="fa fa-pencil-square-o">Update</span></a>
	<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
	<a href="dis_sedule.php#myModal?tid=<?php echo $row[0];?>" class="btn btn-success  btn-xs">Schedule Now</a>
	</button>
	<a href="cancel.php?tid=<?php echo $row[0];?>" class="btn btn-danger  btn-xs"><span class="fa fa-times">Cancel</span></a>
	</td>
    </tr>
	<?php
	}
	?>
<tbody>
  </table>
  </div>
</form>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
		  <?php
//$mysqli=new mysqli('localhost','root','','artdb');
mysql_connect('localhost','root','');
mysql_select_db('artdb');
$xquery="select * from schedule WHERE trainno='".$_GET['tid']."'";
$result=mysql_query($xquery);
$rows=mysql_fetch_row($result);
if(isset($_POST['submit'])){
$x="UPDATE schedule SET status=1 WHERE trainno='".$_POST['hd']."' ";
$rst=mysql_query($x);
header("location:dis_sedule.php");
}
?>
<form name="form1" id="form1" method="post" action="">
<input type="hidden" name="hd" id="hd" value="<?php echo $rows[0]?>">
<?php echo $rows[0]?>
<input type="submit" name="submit" value="Submit Updated" class="btn btn-success btn-sm" />
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>


























