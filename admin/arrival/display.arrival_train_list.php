<?php
include('../../classes/dbConfig/config.php');
include_once('../../db/db_connect.php');
$query="SELECT * FROM tbl_train_list_arrival";
$rst=$conn->query($query);
 if (isset($_GET['status'])) {
        if ($_GET['status'] == 'delete') {
            $idd=$_GET['id'];
            $trainno=$_GET['train_no'];
            $username=$_SESSION['user_name'];
            $ip_addr=$_SERVER['REMOTE_ADDR'];
            $auditQry = "INSERT into tbl_auditor(username,ipaddr,description,train_no,action) 
              VALUES ('$username','$ip_addr','Delete from tain list table','$trainno','Delete')";
            $audit_result=$conn->query($auditQry);

            $q="DELETE FROM tbl_train_list_arrival WHERE arrival_train_id=".$_GET['id']."";
            $r=$conn->query($q);
            header("location:display.arrival_train_list.php");
        }
   }
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin-Trains </title>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo BASE_URL; ?>script/jquery.js" type="text/javascript"></script>
<link href="<?php echo BASE_URL; ?>css/jquery.dataTables.css" rel="stylesheet">
<script src="<?php echo BASE_URL; ?>script/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>script/main.js" type="text/javascript"></script>
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
    <div class="middle" style="">
<h1 class="page-header">Train arrivals</h1><hr/>
<form name="form1" method="post" action="">
	<a href="add.arrival_train.php" class="btn btn-info btn-lg"><i class="fa fa-plus"></i> Add Train</a><br/>
  <table id="myTable" class=" table table-bordered table-condensed table-hover tablesorter example">
     <thead> 
	<tr>
      <th>Sl no</th>
      <th>ট্রেন নং</th>
      <th> ট্রেনের নাম </th>
	  <th>Action</th>	 
    </tr>
	</thead>
<tbody>
	<?php
		while($row=$rst->fetch_row()){
	?>
    <tr>
      <td><?php echo $row[0]?></td>
      <td><?php echo $row[1]?></td>
      <td><?php echo $row[2]?></td>
		<td>
		<a href="edit_arrival_train_list.php?id=<?php echo $row[0];?>" class="btn btn-info btn-xs"><span class="fa fa-pencil-square-o"> edit</span></a>	
		<a href="?status=delete&id=<?php echo $row[0];?> & train_no=<?php echo $row[1]?>" class="btn btn-danger  btn-xs" onclick="return check_detele();"><span class="fa fa-times"> Delete</span></a>
		</td>
    </tr>
	<?php
	}
	?>
	</tbody>
  </table>
</form>
</div>
</body>
<script src="<?php echo BASE_URL; ?>script/jquery.dataTables.min.js" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		$('.example').dataTable();
			});
</script>
</html>
