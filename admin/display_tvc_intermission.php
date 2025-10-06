<?php
include_once('pagesession.php');
include_once('../db/db_connect.php');

?>
<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf8">
    <link href="../css/jquery-ui.min.css" rel="stylesheet">
<script src="../js/jquery-ui.min.js"></script>
</head>
<style>

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
  $('.edit-intermission-information').click(function(){
      //var client_id=$(this).attr('client_id');
      $("#editIntermission").dialog("open");
      $('#edit-intermission_id').val( $(this).attr('intermission_id'));      
    $('#edit-intermission_name').html( $(this).attr('intermission_name'));      
    $('#edit-intermission_message').val( $(this).attr('intermission_message'));      
    $('#edit-intermission_start_time').val( $(this).attr('intermission_start_time'));      
    $('#edit-intermission_end_time').val( $(this).attr('intermission_end_time'));      
 
  });
} 
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
                            $('#editIntermission').dialog('close');                            
                            $('#intermission_time').click();                            
                        }
                    }
               
                });
            });
 $(function () {
            
                $('#editIntermission').dialog({
                    autoOpen: false,
                   modal:true,
                    minHeight: 200,
                    minWidth: 400,
                    cache: false,
                    buttons:{
                        'Save Change':function(){
                            var intermission_id=$('#edit-intermission_id').val();
                            //var new_intermission_name=$('#edit-intermission_name').val();
                            var new_intermission_message=$('#edit-intermission_message').val();
                            var new_intermission_start_time=$('#edit-intermission_start_time').val();
                            var new_intermission_end_time=$('#edit-intermission_end_time').val();
                            $.ajax({                                                
                                    type:"POST",                                       
                                    url:"edit_tvc_intermission.php",
                                     data:{
                                        intermission_id:intermission_id,
                                       // intermission_name:new_intermission_name,
                                        intermission_message:new_intermission_message,
                                        start_time:new_intermission_start_time,
                                        end_time:new_intermission_end_time
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
 
 </script>
</head>
<body>

  <!--Start Display  -->
  <table class=" table table-bordered table-condensed table-hover " style="margin-top:30px;" >	
	<thead>
		<tr>
			
		  <th>Sl No.</th>
		  <th>Intermission Name</th>
		  <th>Intermission Message</th>
		  <th>Start_time</th>
		  <th>End_time</th>
		  <th>Action</th>
		 
		</tr>
	</thead>
	<tbody>
		<?php
                $sl_no=1;
		$qq="SELECT * FROM tbl_tvc_intermission_time  ORDER BY intermission_id ASC";
		$res=$conn->query($qq);
		while($roww=$res->fetch_assoc()){
		?>
			<tr align="left" >
				
				<td><?php echo $sl_no;?></td>				
				<td><?php echo $roww['intermission_name'];?></td>
				<td><?php echo $roww['description'];?></td>
				<td><?php echo $roww['start_time'];?></td>
				<td><?php echo $roww['end_time'];?></td>
    
				<td>
                                       <button class="edit-intermission-information btn btn-primary"                                               
                                               intermission_id="<?php echo $roww['intermission_id'];?>" 
                                               intermission_name="<?php echo $roww['intermission_name'];?>"
                                               intermission_message="<?php echo $roww['description'];?>"
                                               intermission_start_time="<?php echo $roww['start_time'];?>"
                                               intermission_end_time="<?php echo $roww['end_time'];?>"
                                       >Edit
                                       </button>			<?php 
			if($roww['publication_status']==0){
		?>
			<a href="?status=publish&id=<?php echo $roww['intermission_id'];?>" class="btn btn-success  btn-sm  <?php if($_SESSION['user_type']=='super_admin'){ echo '';}else{ echo 'disabled';}?>" title="Publish"> <span class="fa fa-check" ></span> Publish</a>
		<?php 
			}else{
		?>
			<a href="?status=unpublish&id=<?php echo $roww['intermission_id'];?>" class="btn btn-warning  btn-sm  <?php if($_SESSION['user_type']=='super_admin'){ echo '';}else{ echo 'disabled';}?>" title="Unpublish"><span class="fa fa-times" ></span> Unpublish</a>
		<?php
			}
		?>
                       
                <a href="?status=delete&id=<?php echo $roww['intermission_id'];?>" class="btn btn-danger  btn-sm  <?php if($_SESSION['user_type']=='super_admin'){ echo '';}else{ echo 'disabled';}?>" onclick="return check_detele(); "><span class="fa fa-trash-o"> Delete</span></a>
	
				</td>			 
			</tr>
		<?php
                $sl_no++;
		}
		?>
	</tbody>
  </table>

    
    
    
    


</body>
</html>
    <div id="editIntermission" align="center" title="Edit Intermission ">        
    <form name="form1" id="form1" method="post" action="" enctype="multipart/form-data">
      <table class="table-condensed table-hover " id="insert_table">	 
                    <tr>

                        <td>
                            <input name="edit-intermission_id" id="edit-intermission_id" value="" type="hidden"  class="form-control"  />
                                   </td>
                    </tr>
                     <tr>

                         <td style="text-align:center;"><label ><span id="edit-intermission_name"></span></label>
                            
                               </td>
                    </tr>
                      <tr>

                        <td><label>Message:</label>
                            <textarea name="edit-intermission_message" id="edit-intermission_message" value="" type="text"   class="form-control"  size="40" required> </textarea>
                          
                               </td>
                    </tr>
                       <tr>

                        <td><label>Start Time:</label>
                            <input name="edit-intermission_start_time" id="edit-intermission_start_time" value="" type="text"   class="form-control"  size="40" required/>
                            Time 24hr format (00:00:00)
                               </td>
                    </tr>
                       <tr>

                        <td><label>End Time:</label>
                            <input name="edit-intermission_end_time" id="edit-intermission_end_time" value="" type="text"   class="form-control"  size="40" required/>
                            Time 24hr format (00:00:00)
                        </td>
                    </tr>	 
                <!--    <tr>
                            <td><input type="submit" name="btn-upload"  id="btn-upload" value="ADD" class="btn btn-success btn-sm form-control"/></td>
                    </tr>  -->
      </table>
      </form>
         <div id="editMessage">Succesfully Updated !</div>
    </div>