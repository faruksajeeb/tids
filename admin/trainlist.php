<?php
include_once('pagesession.php');
if(isset($_SESSION['id'])==false){
	header('location:index.php');
}
include_once('dbconnect.php');
$query="select * from tbl_arrival_train_list";
$rst=mysql_query($query);
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin-Trains </title>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<script src="../script/jquery.js" type="text/javascript"></script>
<link href="../css/jquery.dataTables.css" rel="stylesheet">
<script src="../script/bootstrap.min.js" type="text/javascript"></script>
<script src="../script/main.js" type="text/javascript"></script>
<style>
tr:nth-child(odd){background-color:#E1E1E1;}
th{background-color:#E1E1E1;}
.activebutton{ margin:0 auto;background-color:#009900; height:20px; width:20px; border-radius:50%; text-align:center;}
.deactivebutton{ margin:0 auto;background-color:#FF0000; height:20px; width:20px; border-radius:50%;text-align:center;}
.fa-times{ color:#FFFFFF;}
.fa-check{ color:#FFFFFF;}
h1{text-align:center}


</style>
 <script>
	function check_detele() {
		var check=confirm('Are you sure to delete this !!');
		if(check) {
			return true;
		} else {
			return false;
		}
	}
 </script>
</head>
<body>
<h1 class="page-header">Trains</h1><hr/>
<form name="form1" method="post" action="">
	<a href="insert_new_train.php" class="btn btn-info btn-lg"><i class="fa fa-plus"></i> Add Train</a><br/>
  <table id="myTable" class=" table table-bordered table-condensed table-hover tablesorter example">
     <thead> 
	<tr>
      <th>SLNo</th>
      <th>Train No</th>
      <th>Train Name</th>
	  <th>Action</th>	 
    </tr>
	</thead>
<tbody>
	<?php
		while($row=mysql_fetch_row($rst)){
	?>
    <tr>
      <td><?php echo $row[0]?></td>
      <td><?php echo $row[1]?></td>
      <td><?php echo $row[2]?></td>
		<td>
		<a href="edit_trai_list.php?id=<?php echo $row[0];?>" class="btn btn-info btn-xs"><span class="fa fa-pencil-square-o"> edit</span></a>	
		<a href="del_train.php?id=<?php echo $row[0];?> & train_no=<?php echo $row[1]?>" class="btn btn-danger  btn-xs" onclick="return check_detele();"><span class="fa fa-times"> Delete</span></a>
		</td>
    </tr>
	<?php
	}
	?>
	</tbody>
  </table>
</form>
</body>
<script src="../script/jquery.dataTables.min.js" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		$('.example').dataTable();
			});
</script>
</html>
