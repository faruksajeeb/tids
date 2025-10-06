<?php
include('../../classes/dbConfig/config.php');
include_once('../../db/db_connect.php');
if(isset($_GET['status'])) {
	if($_GET['status'] =='publish') {
		$id=$_GET['id'];
		$username=$_SESSION['user_name'];
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		$auditQry = "INSERT INTO tbl_auditor(username,ipaddr,description,train_no,action) VALUES ('$username','$ip_addr','ibl_client','".$id."','Publish')";
		$conn->query($auditQry);
		$x="UPDATE tbl_client SET publication_status=1 WHERE client_id='".$id."'";
		$conn->query($x);
		header("location:display.clients.php");
	}else if($_GET['status'] =='unpublish') {
		$id=$_GET['id'];
		$username=$_SESSION['user_name'];
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		$auditQry = "INSERT INTO tbl_auditor(username,ipaddr,description,train_no,action) VALUES ('$username','$ip_addr','ibl_client','".$id."','unpublish')";
		$conn->query($auditQry);
		$x="UPDATE tbl_client SET publication_status=0 WHERE client_id='".$id."' ";
		$conn->query($x);
		header("location:display.clients.php");
	}else if($_GET['status'] =='delete') {
		$id=$_GET['id'];
		$username=$_SESSION['user_name'];
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		$auditQry = "INSERT INTO tbl_auditor(username,ipaddr,description,train_no,action) VALUES ('$username','$ip_addr','ibl_client','".$id."','delete')";
		$conn->query($auditQry); 
		$sql="UPDATE  tbl_client SET deletion_status=1,publication_status=0 WHERE client_id=$id ";
                                   $conn->query($sql);
		header("location:display.clients.php");
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
 <script>
          $(document).ready(function(){

  editForm(); //Click event to populate form with selected defect

  
}); //Document Ready End


  
function editForm(){    
  $('.edit-information').button().click(function(){
      //var client_id=$(this).attr('client_id');
      $("#editClient").dialog("open");
      $('#edit-client_id').val( $(this).attr('client_id'));      
      $('#edit-client_name').val( $(this).attr('client_name'));      
 
  });
} 

  
	function check_detele() {
		var check=confirm('Are you sure to delete this !!');
		if(check) {
			return true;
		} else {
			return false;
		}
	}
         $(function () {            
                $('#insertClient').dialog({
                        autoOpen: false,
                        modal:true,
                        minHeight: 200,
                        minWidth: 400,
                                           
                    show: {
    effect: "scale",
    direction: "left",
    duration: 500
    },
    hide: {
        effect: "scale",
        direction: "left",
        duration: 500
    },
                        cache: false,
                        buttons:{
                        'Save':function(){  
                            
                                     var cname=$("#client_name").val();
                                     if(cname==''){
                                         alert('Please enter client name');
                                     }else{                                         
                                            $.ajax({                                                
                                                type:"POST",                                       
                                                url:"add.client.php",
                                                 data:{
                                                    clientName:cname
                                                },
                                               // dataType:"html",
                                                success: function(data){
                                                    //some logic to show that the data was updated
                                                    //then close the window
                                                    $("#insertMessage").html(data);
                                                    $(this).dialog('close');
                                                  }
                                            });
                                             $("#insertMessage").dialog("open");
                                            }
                        },
                        'Discard & Exit' : function(){
                            $(this).dialog('close');
                          }
                    }
               
                });
            });
            $(function () {
            
                $('#insertMessage').dialog({
                    autoOpen: false,
                   modal:true,
                    minHeight: 100,
                    minWidth: 400,
                    cache: false,
                    buttons:{
                        'Ok':function(){
                            $(this).dialog('close');
                            location="display.clients.php";
                        }
                    }
               
                });
            });
            $(function () {
            
                $('#editMessage').dialog({
                    autoOpen: false,
                   modal:true,
                    minHeight: 100,
                    minWidth: 400,
                    cache: false,
                    buttons:{
                        'Ok':function(){
                            $(this).dialog('close');
                            location="display.clients.php";
                        }
                    }
               
                });
            });
            $(function () {
            
                $('#editClient').dialog({
                    autoOpen: false,
                   modal:true,
                    minHeight: 200,
                    minWidth: 400,
                                        show: {
    effect: "scale",
    direction: "left",
    duration: 500
    },
    hide: {
        effect: "scale",
        direction: "left",
        duration: 500
    },
                    cache: false,
                    buttons:{
                        'Save Change':function(){
                            var client_id=$('#edit-client_id').val();
                            var new_client_name=$('#edit-client_name').val();
                            $.ajax({                                                
                                    type:"POST",                                       
                                    url:"edit.client.php",
                                     data:{
                                        client_id:client_id,
                                        client_name:new_client_name
                                    },
                                  dataType:"html",
                                    success: function(data){
                                        //some logic to show that the data was updated
                                        //then close the window
                                        $("#editMessage").dialog("open");
                                      }
                                });                                 
                        },
                         'Discard & Exit' : function(){
                            $(this).dialog('close');
                          }
                    }
               
                });
            });
            function insertClient() {

                $("#insertClient").dialog("open");
                  var addToRequestListBtn = getDialogButton('insertClient','Save'); 
                 addToRequestListBtn.attr('disabled', true).addClass( 'ui-state-disabled');
            }
         /* function editClient() {
                //$("#editClient").dialog("open");
                //get closest book div  
             $('#form-errorid').val( $(this).attr('id'));
                alert(client_id);
                $.ajax({                                                
                    type:"POST",                                       
                    url:"edit_client.php",
                     data:{
                        client_id:client_id
                    },
                  dataType:"html",
                    success: function(){
                        //some logic to show that the data was updated
                        //then close the window
                        $('#editClient').html(data);
                      }
                });
            } */

function checkClient(){
    //alert(0);
    var cname=$("#client_name").val();
    $.ajax({                                                
            type:"POST",                                       
            url:"check_client.php",
             data:{
                clientName:cname
            },
           // dataType:"html",
            success: function(response){
                //some logic to show that the data was updated
                //then close the window
   
                 $("#check_client_message").html(response);
              }
        });
}
                     

      
 
 </script>
</head>
<body>




<a href="display.tvc.php" class="btn btn-info btn-sm pull-left"><i class="fa fa-backward"></i> BACK</a>

    <a href="#"  onclick="insertClient();" class="btn btn-info btn-lg pull-right"><i class="fa fa-plus"></i> Client</a>
<h1 class="page-header middle" >Clients</h1>
   <a href="display.client_trash.php"  class="btn btn-info btn-lg pull-left"><span class="fa fa-trash-o"> Trash</span></a>

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
		$qq="SELECT * FROM tbl_client WHERE deletion_status=0 ORDER BY client_id ASC";
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
                                    <?php
                                    
                                    ?>
                                       <button class="edit-information btn btn-primary <?php if($_SESSION['user_type']=='super_admin'){ echo '';}else{ echo 'disabled';}?>" client_id="<?php echo $roww['client_id'];?>" client_name="<?php echo $roww['client_name'];?>" >Edit</button>
					<?php 
                                   
			if($roww['publication_status']==0){
		?>
			<a href="?status=publish&id=<?php echo $roww['client_id'];?>" class="btn btn-success  btn-sm" title="Publish"> <span class="fa fa-check" ></span> Publish</a>
		<?php 
			}else{
		?>
			<a href="?status=unpublish&id=<?php echo $roww['client_id'];?>" class="btn btn-warning  btn-sm" title="Unpublish"><span class="fa fa-times" ></span> Unpublish</a>
		<?php
			}
                    
		?>
                       
                <a href="?status=delete&id=<?php echo $roww['client_id'];?>" class="btn btn-danger  btn-sm  <?php //
                // if($_SESSION['user_type']=='super_admin'){ echo '';}else{ echo 'disabled';}?>" onclick="return check_detele(); "><span class="fa fa-trash-o"> Delete</span></a>
                        
				</td>			 
			</tr>
		<?php
                $sl_no++;
		}
		?>
	</tbody>
  </table>
</div>

    
    
    
    
<div id="insertClient" align="center" title="INSERT CLIENT" >
    <form name="form1" id="form1" method="post" action="" enctype="multipart/form-data">
      <table class="table-condensed table-hover " id="insert_table">	 
                    <tr>

                        <td><input name="client_name" type="text" placeholder="Enter Client name" onkeyup="checkClient();"   class="form-control" id="client_name" size="40" required/></td>
                    <br/><span id="check_client_message" style="color:red;"></span>
                    </tr>	 
                <!--    <tr>
                            <td><input type="submit" name="btn-upload"  id="btn-upload" value="ADD" class="btn btn-success btn-sm form-control"/></td>
                    </tr>  -->
      </table>
      </form>
  </div>
    <div id="insertMessage"></div>
    
    <div id="editClient" align="center" title="EDIT CLIENT">        
    <form name="form1" id="form1" method="post" action="" enctype="multipart/form-data">
      <table class="table-condensed table-hover " id="insert_table">	 
                    <tr>

                        <td>
                            <input name="edit-client_id" id="edit-client_id" value="" type="hidden"  class="form-control"  />
                            <input name="edit-client_name" id="edit-client_name" value="" type="text"   class="form-control"  size="40" required/>
                        </td>
                    </tr>	 
                <!--    <tr>
                            <td><input type="submit" name="btn-upload"  id="btn-upload" value="ADD" class="btn btn-success btn-sm form-control"/></td>
                    </tr>  -->
      </table>
      </form>
         <div id="editMessage">Succesfully Updated !</div>
    </div>
    
    
    
    
    


  
  
  
  
  
  
  
  
  
<script src="../../script/jquery.dataTables.min.js" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		$('.example').dataTable();
			});
</script>
</body>
</html>