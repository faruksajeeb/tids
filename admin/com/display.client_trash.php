<?php
include('../../classes/dbConfig/config.php');
include_once('../../db/db_connect.php');
if(isset($_GET['status'])) {
	 if($_GET['status'] =='restore') {
		$id=$_GET['id'];
		$username=$_SESSION['user_name'];
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		$auditQry = "INSERT INTO tbl_auditor(username,ipaddr,description,train_no,action) VALUES ('$username','$ip_addr','ibl_client','".$id."','restore')";
		$conn->query($auditQry); 
		$sql="UPDATE  tbl_client SET deletion_status=0,publication_status=0 WHERE client_id=$id ";
                                   $conn->query($sql);
		header("location:display.client_trash.php");
	}if($_GET['status'] =='delete') {
		$id=$_GET['id'];
		$username=$_SESSION['user_name'];
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		$auditQry = "INSERT INTO tbl_auditor(username,ipaddr,description,train_no,action) VALUES ('$username','$ip_addr','ibl_client','".$id."','delete')";
		$conn->query($auditQry); 
		$sql="DELETE FROM tbl_client WHERE client_id=$id ";
                                   $conn->query($sql);
		header("location:display.client_trash.php");
	}
}
?>
<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo BASE_URL; ?>css/jquery.dataTables.css" rel="stylesheet">
        <script src="<?php echo BASE_URL; ?>script/jquery-2.2.3.min.js"></script>
        <link href="<?php echo BASE_URL; ?>css/jquery-ui.min.css" rel="stylesheet">
        <script src="<?php echo BASE_URL; ?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>script/jquery.form.min.js"></script>
        
</head>
<style>
body{}
  .middle{height:auto;margin:0 auto;border-radius:10px;
                    text-align:center;padding:20px;margin-top:20px;
            }
.middle h1{margin-top:0;font-size:22px;text-align:center;text-transform: uppercase;} 
thead{background-color:#ccc;}
.ui-dialog-titlebar{ 
                background-color:#31B0D5;
                text-align: center;
            }
            
     

</style>

</head>
<body>
<a href="display.clients.php" class="btn btn-info btn-sm pull-left"><i class="fa fa-backward"></i> BACK</a>
<h1 class="page-header middle" ><span class="fa fa-trash-o"> Trash (Clients)</span></h1>

  <!--Start Display  -->
  <table class=" table table-bordered table-condensed table-hover example" id="display_table" >	
	<thead>
		<tr>
			
		  <th>Sl No.</th>
		  <th>Client Name</th>
		  <th>Publication Status</th>
		  <th>Action</th>
		 
		</tr>
	</thead>
	<tbody>
		<?php
                $sl_no=1;
		$qq="SELECT * FROM tbl_client WHERE deletion_status=1 ORDER BY client_id ASC";
		$res=$conn->query($qq);
		while($roww=$res->fetch_assoc()){
		?>
			<tr align="left" >
				
				<td><?php echo $sl_no;?></td>				
				<td><?php echo $roww['client_name'];?></td>
                                 <td>
		  <?php 
			if($roww['publication_status']==1){
			 echo "<div class='activebutton' style='color:green;'><i class='fa fa-check'></i> Published</div>";
			}else{
			 echo "<div class='deactivebutton' style='color:red;'><i class='fa fa-times'></i> Unpublished</div>";
			}
		  ?>
	  </td>
        
				<td>
                            
                       
                <a href="?status=restore&id=<?php echo $roww['client_id'];?>" class="btn btn-success btn-sm" ><span class="fa fa-retweet">  Restore</span></a>
                <?php if($_SESSION['user_type']=='super_admin'){?> 
                <a href="?status=delete&id=<?php echo $roww['client_id'];?>" class="btn btn-danger btn-sm" ><span class="fa fa-remove">  Delete</span></a>
                <?php } ?>
				</td>			 
			</tr>
		<?php
                $sl_no++;
		}
		?>
	</tbody>
  </table>
</div> 
<script src="../../script/jquery.dataTables.min.js" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		$('.example').dataTable();
			});
</script>
</body>
</html>