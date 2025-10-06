<?php
include_once('dbconnect.php');
$query="select * from user";
$rst=mysql_query($query);
?>
<!DOCTYPE html>
<html  lang="bn" >
<head>
<title>auditor</title>
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
.activebutton{ margin:0 auto;background-color:#009900; height:20px; width:20px; border-radius:50%; text-align:center;}
.deactivebutton{ margin:0 auto;background-color:#FF0000; height:20px; width:20px; border-radius:50%;text-align:center;}
.fa-times{ color:#FFFFFF;}
.fa-check{ color:#FFFFFF;}
table{ text-align:center}
th{ text-align:center}
</style>
</head>
<body>
<h2 class="page-header" style="text-align:center">Users</h2>
<form name="form1" method="post" action=""  >
	<div class="table-responsive">
  <table id="myTable" class=" table table-bordered table-condensed table-hover tablesorter">
  <thead> 
    <tr>
      <th>Id</th>
      <th>User Name</th>
	  <th>usertype</th>
	 
	 </tr>
</thead>
<tbody>
	<?php
		while($row = mysql_fetch_row($rst)){
	?>
    <tr>
	  <td><?php echo $row[0]?></td>
	  <td><?php echo md5($row[1]);?></td>
	  <td><?php echo $row[3]?></td>
    </tr>
	<?php
	}
	?>
</tbody>
  </table>
  </div>
</form>

</body>
</html>


























