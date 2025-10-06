<?php
include('../../classes/dbConfig/config.php');
include_once('../../db/db_connect.php');
$query="SELECT tnt.*,c.client_name FROM tbl_tvc_news_ticker AS tnt,tbl_client AS c WHERE tnt.client_id=c.client_id AND tnt.deletion_status=0";
$rst=$conn->query($query);

if(isset($_GET['status'])){
	if($_GET['status'] =='add'){
		$id=$_GET['id'];
		$username=$_SESSION['user_name'];
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		$auditQry = "INSERT INTO tbl_auditor(username,ipaddr,description,train_no,action) VALUES ('$username','$ip_addr','Add into TVC scroll Display','".$id."','Add')";
		$audit_result=$conn->query($auditQry);
		$x="UPDATE tbl_tvc_news_ticker SET publication_status=1 WHERE 	ticker_id='".$id."'";
		$rst=$conn->query($x);
		header("location:view.tvc_scroll.php");
	}else if($_GET['status'] =='cancel') {
		$id=$_GET['id'];
		$username=$_SESSION['user_name'];
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		$auditQry = "INSERT INTO tbl_auditor(username,ipaddr,description,train_no,action) VALUES('$username','$ip_addr','Cancel from TVC scroll Display','".$id."','cancel')";
		$audit_result=$conn->query($auditQry);
		$x="UPDATE tbl_tvc_news_ticker SET publication_status=0 WHERE 	ticker_id='".$id."' ";
		$rst=$conn->query($x);
		header("location:view.tvc_scroll.php");
	}else if($_GET['status'] =='delete'){
		$id=$_GET['id'];
		$username=$_SESSION['user_name'];
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		$auditQry = "INSERT INTO tbl_auditor(username,ipaddr,description,train_no,action) VALUES ('$username','$ip_addr','Delete from TVC scroll Table','".$id."','delete')";
		$audit_result=$conn->query($auditQry);
		$q="UPDATE tbl_tvc_news_ticker SET deletion_status=1 WHERE ticker_id='".$id."' ";
		$r=$conn->query($q);
		header("location:view.tvc_scroll.php");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>TVC-Scroll</title>
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
<h1 class="page-header">TVC Scroll</h1><hr/>
<form name="form1" method="post" action="">
	<a href="add.tvc_scroll.php" class="btn btn-info btn-lg"><i class="fa fa-plus"></i> Add TVC Scroll</a>
  <table class=" table table-bordered table-condensed table-hover example">
  	<thead>
    <tr>
      <th>SLNo</th>
      <th>Ticker Name</th>
      <th>Ticker Description</th>
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
		while($row=$rst->fetch_row()){
			//var_dump($row);
	?>
    <tr>
      <td><?php echo $sl_no; ?></td>
      <td><?php echo $row[1]?></td>
      <td><?php echo $row[2]?></td>
	   <td style="background-color:<?php echo $row[3]?>;"></td>
      <td style="background-color:<?php echo $row[4]?>;"></td>
      <td><?php echo $row[8]?></td>
	   <td><?php if($row[6]==1) 
			{
				echo "<div class='activebutton'><i class='fa fa-check'></i></div>";
			}
			else{
				echo "<div class='deactivebutton'><i class='fa fa-times'></i></div>";
				}
				?>
	  </td>
 	  <td>
	 <a href="edit_tvc_scroll.php?id=<?php echo $row[0];?>" class="btn btn-info btn-sm"><span class="fa fa-pencil-square-o"> edit</span></a>	
		<?php 
			if($row[6]==0){
		?>
			<a href="?status=add&id=<?php echo $row[0];?>" class="btn btn-success  btn-sm" title="add Now"> <span class="fa fa-check" ></span></a>
		<?php 
			}else{
		?>
			<a href="?status=cancel&id=<?php echo $row[0];?>" class="btn btn-warning  btn-sm" title="Cancel"><span class="fa fa-times" ></span></a>
		<?php
			}
		?>
		<a href="?status=delete&id=<?php echo $row[0];?>" class="btn btn-danger  btn-sm" onclick="return check_detele(); "><span class="fa fa-trash-o"> Delete</span></a>
		<a href="copy_tvc_scroll.php?id=<?php echo $row[0];?>" class="btn btn-primary btn-sm disabled"><span class="fa fa-pencil-square-o"> copy</span></a>
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
