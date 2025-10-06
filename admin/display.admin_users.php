<?php
include_once('pagesession.php'); 
include_once('dbconnect.php');
$query="select * from tbl_admin";
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
tr:nth-child(even){background-color:#E1E1E1;}
th{background-color:#E1E1E1;}
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

<a href="add.user.php" class="btn btn-danger  btn-md <?php if($_SESSION['user_type']=='super_admin'){ echo '';}else{ echo 'disabled';}?>">Create New User</a>

	<div class="table-responsive">
  <table id="myTable" class=" table table-bordered table-condensed table-hover tablesorter">
  <thead> 
    <tr>
      <th>Id</th>
      <th>User Name</th>     
	  <th>User Type</th>

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
	  <td><?php echo $row[3]?></td>

	 <td>
	  
	<a href="edit_users.php?id=<?php echo $row[0];?>" class="btn btn-info  btn-md <?php if($_SESSION['user_type']=='super_admin'){ echo '';}else{ echo 'disabled';}?>"><span class="fa fa-pencil"> edit</span></a>
	<a href="del_users.php?id=<?php echo $row[0];?>&user=<?php echo $row[1]?>" class="btn btn-danger  btn-md <?php if($_SESSION['user_type']=='super_admin'){ echo '';}else{ echo 'disabled';}?>"><span class="fa fa-times"> Delete</span></a>
	
	 </td>
	
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


























