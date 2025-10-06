<?php
include_once('../db/db_connect.php');

$query="select * from tbl_auditor ORDER BY id DESC";
$rst=$conn->query($query);
?>
<!DOCTYPE html>
<html  lang="bn" >
<head>
<title>auditor</title>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/jquery.dataTables.css" rel="stylesheet">
<script src="../script/jquery.js" type="text/javascript"></script>
<script src="../script/main.js" type="text/javascript"></script>

<style>

.activebutton{ margin:0 auto;background-color:#009900; height:20px; width:20px; border-radius:50%; text-align:center;}
.deactivebutton{ margin:0 auto;background-color:#FF0000; height:20px; width:20px; border-radius:50%;text-align:center;}
.fa-times{ color:#FFFFFF;}
.fa-check{ color:#FFFFFF;}
table{ text-align:center}
th{ text-align:center}
</style>
</head>
<body>
<h2 class="page-header" style="text-align:center">AUDIT TRIAL</h2>
<form name="form1" method="post" action=""  >
	<div class="table-responsive">
  <table id="myTable" class=" table table-bordered table-hover tablesorter example">
  <thead> 
    <tr>
      <th>Id</th>
      <th>User Name</th>
	  <th>IP Address</th>
      <th>Date Time</th>
	  <th>Description</th>
      <th>Train No /Scroll Id</th>
	  <th>Action</th>
	  
	 </tr>
</thead>
<tbody>
	<?php
		while($row = $rst->fetch_row()){
	?>
    <tr>
	  <td><?php echo $row[0]?></td>
	  <td><?php echo $row[1]?></td>
	  <td><?php echo $row[2]?></td>
	  <td><?php echo $row[3]?></td>
	  <td><?php echo $row[4]?></td>
	  <td><?php echo $row[5]?></td>
	  <td><?php echo $row[6]?></td>

    </tr>
	<?php
	}
	?>
</tbody>
  </table>
  </div>
</form>

</body>
<script src="../script/jquery.dataTables.min.js" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		$('.example').dataTable();
			});
</script>
</html>


























