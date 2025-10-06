<?php
include('../../classes/dbConfig/config.php');
include_once('../../db/db_connect.php');
$query="SELECT * FROM tbl_tids_scroll";
$rst=$conn->query($query);

if(isset($_GET['status'])){
	if($_GET['status'] =='add') {
		$id=$_GET['id'];
		$username=$_SESSION['user_name'];
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		$auditQry = "INSERT INTO tbl_auditor(username,ipaddr,description,train_no,action) VALUES ('$username','$ip_addr','Add into scroll Bottom Display','".$id."','Add')";
		$conn->query($auditQry);
		$x="UPDATE tbl_tids_scroll SET status=1 WHERE id='".$id."'";
		$conn->query($x);
		header("location:view.tids_scroll.php");
	}else if($_GET['status'] =='cancel') {
		$id=$_GET['id'];
		$username=$_SESSION['user_name'];
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		$auditQry = "INSERT INTO tbl_auditor(username,ipaddr,description,train_no,action) VALUES('$username','$ip_addr','Cancel from Scroll Bottom Display','".$id."','cancel')";
		$conn->query($auditQry);
		$x="UPDATE tbl_tids_scroll SET status=0 WHERE id='".$id."' ";
		$conn->query($x);
		header("location:view.tids_scroll.php");
	}else if($_GET['status'] =='delete') {
		$id=$_GET['id'];
		$username=$_SESSION['user_name'];
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		$auditQry = "INSERT INTO tbl_auditor(username,ipaddr,description,train_no,action) VALUES ('$username','$ip_addr','Delete from Scroll Bottom Table','".$id."','delete')";
		$conn->query($auditQry);
		$q="DELETE FROM tbl_tids_scroll WHERE id='".$id."'";
		$conn->query($q);
		header("location:view.tids_scroll.php");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>TIDS-Scroll</title>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL; ?>css/jquery.dataTables.css" rel="stylesheet">
<script src="<?php echo BASE_URL; ?>script/jquery.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>script/main.js" type="text/javascript"></script>
<style>
tr:nth-child(odd){background-color:#D9EDF7;}
tr:nth-child(even){background-color:#FCF8E3;}

.activebutton{ margin:0 auto;background-color:#009900; height:20px; width:20px; border-radius:50%; text-align:center;}
.deactivebutton{ margin:0 auto;background-color:#FF0000; height:20px; width:20px; border-radius:50%;text-align:center;}
.fa-times{ color:#FFFFFF;}
.fa-check{ color:#FFFFFF;}
a{ margin-right:8px;}
h1{text-align:center}
</style>
</head>
<body>
<h1 class="page-header">TIDS Scroll</h1><hr/>
<form name="form1" method="post" action="">
	<a href="add.tids_scroll.php" class="btn btn-info btn-lg"><i class="fa fa-plus"></i> Add TIDS Scroll</a>
        <table class=" table table-bordered table-condensed table-hover example" >
  	<thead>
    <tr>
      <th>Sl no</th>
      <th>Description</th>      
      <th>Text color</th>      
      <th>Backgroung color</th>      
      <th>Client Name</th>
	    <th>Status</th>
 	  <th>Action</th>
	 
    </tr>
	</thead>
	<tbody>
	<?php
        $sl_no=1;
		while($row=$rst->fetch_assoc()){
	?>
    <tr>
      <td><?php echo $sl_no; ?></td>
      <td style=""><?php echo $row['description']?></td>
      <td style="background-color:<?php echo $row['text_color']?>;"></td>
      <td style="background-color:<?php echo $row['background_color']?>;"></td>
      <td><?php echo $row['client_name']?></td>
	   <td><?php if($row['status']==1) 
			{echo "<div class='activebutton'><i class='fa fa-check'></i></div>";
			}
			else{
				echo "<div class='deactivebutton'><i class='fa fa-times'></i></div>";
				}
				?>
	  </td>
 	  <td>
              <a href="edit_tids_scroll.php?id=<?php echo $row['id'];?>" class="btn btn-info btn-xs"><span class="fa fa-pencil-square-o"> edit</span></a>	
		<?php 
			if($row['status']==0){
		?>
			<a href="?status=add&id=<?php echo $row['id'];?>" class="btn btn-success  btn-sm" title="add Now"> <span class="fa fa-check" ></span></a>
		<?php 
			}else{
		?>
			<a href="?status=cancel&id=<?php echo $row['id'];?>" class="btn btn-warning  btn-sm" title="Cancel"><span class="fa fa-times" ></span></a>
		<?php
			}
		?>
		<a href="?status=delete&id=<?php echo $row['id'];?>" class="btn btn-danger  btn-sm" onclick="return check_detele(); "><span class="fa fa-trash-o"> Delete</span></a>
	<!--	<a href="copy_scroll_down_superadmin.php?id=<?php echo $row['id'];?>" class="btn btn-primary btn-xs"><span class="fa fa-pencil-square-o"> copy</span></a>
	-->
          </td>
    </tr>
	
	<?php
        $sl_no++;
	}
	?>
	</tbody>
  </table>
</form>
</body>
<script src="<?php echo BASE_URL; ?>script/jquery.dataTables.min.js" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		$('.example').dataTable();
			});
</script>
</html>
