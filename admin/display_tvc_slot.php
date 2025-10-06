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

  editSlotForm(); //Click event to populate form with selected defect

}); //Document Ready End

function editSlotForm(){    
  $('.edit-slot-information').click(function(){
      //var client_id=$(this).attr('client_id');
      $("#editSlot").dialog("open");
      $('#edit-slot_id').val( $(this).attr('slot_id'));      
    $('#edit-slot_name').val( $(this).attr('slot_name'));      
    $('#edit-slot_start_time').val( $(this).attr('slot_start_time'));      
    $('#edit-slot_end_time').val( $(this).attr('slot_end_time'));      
 
  });
} 
$(function () {
            
                $('#editSlotMessage').dialog({
                    autoOpen: false,
                   modal:true,
                    minHeight: 100,
                    minWidth: 400,
                    cache: false,
                    buttons:{
                        'Ok':function(){
                            $(this).dialog('close');
                            $('#editSlot').dialog('close');
                            $('#sloting_time').click(); 
                        }
                    }
               
                });
            });
 $(function () {
            
                $('#editSlot').dialog({
                    autoOpen: false,
                   modal:true,
                    minHeight: 200,
                    minWidth: 400,
                    cache: false,
                    buttons:{
                        'Save':function(){
                            var slot_id=$('#edit-slot_id').val();
                            var new_slot_name=$('#edit-slot_name').val();
                            var new_slot_start_time=$('#edit-slot_start_time').val();
                            var new_slot_end_time=$('#edit-slot_end_time').val();
                            $.ajax({                                                
                                    type:"POST",                                       
                                    url:"edit_tvc_slot.php",
                                     data:{
                                        slot_id:slot_id,
                                        slot_name:new_slot_name,
                                        start_time:new_slot_start_time,
                                        end_time:new_slot_end_time
                                    },
                                  dataType:"html",
                                    success: function(data){
                                        //some logic to show that the data was updated
                                        //then close the window
                                        $("#editSlotMessage").dialog("open");
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
		  <th>Slot Name</th>
		  <th>Slot Start Time</th>
		  <th>Slot End Time</th>
		  <th>Action</th>
		 
		</tr>
	</thead>
	<tbody>
		<?php
                $sl_no=1;
		$qq="SELECT * FROM tbl_tvc_slot  ORDER BY slot_id ASC";
		$res=$conn->query($qq);
		while($roww=$res->fetch_assoc()){
		?>
			<tr align="left" >
				
				<td><?php echo $sl_no;?></td>				
				<td><?php echo $roww['slot_name'];?></td>
				<td><?php echo $roww['slot_start_time'];?></td>
				<td><?php echo $roww['slot_end_time'];?></td>
    
				<td>
                                       <button class="edit-slot-information btn btn-primary <?php if($_SESSION['user_type']=='super_admin'){ echo '';}else{ echo 'disabled';}?> "                                               
                                               slot_id="<?php echo $roww['slot_id'];?>" 
                                               slot_name="<?php echo $roww['slot_name'];?>"
                                               slot_start_time="<?php echo $roww['slot_start_time'];?>"
                                               slot_end_time="<?php echo $roww['slot_end_time'];?>"
                                       >Edit
                                       </button>
					<?php 
			if($roww['publication_status']==0){
		?>
                        <a href="?status=publish&id=<?php echo $roww['slot_id'];?>" class="btn btn-success  btn-sm <?php if($_SESSION['user_type']=='super_admin'){ echo '';}else{ echo 'disabled';}?>" title="Publish"> <span class="fa fa-check" ></span> Publish</a>
		<?php 
			}else{
		?>
			<a href="?status=unpublish&id=<?php echo $roww['slot_id'];?>" class="btn btn-warning  btn-sm  <?php if($_SESSION['user_type']=='super_admin'){ echo '';}else{ echo 'disabled';}?>" title="Unpublish"><span class="fa fa-times" ></span> Unpublish</a>
		<?php
			}
		?>
                       
                <a href="?status=delete&id=<?php echo $roww['slot_id'];?>" class="btn btn-danger  btn-sm  <?php if($_SESSION['user_type']=='super_admin'){ echo '';}else{ echo 'disabled';}?>" onclick="return check_detele(); "><span class="fa fa-trash-o"> Delete</span></a>
	
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






    <div id="editSlot" align="center" title="EDIT SLOT">        
    <form name="form1" id="form1" method="post" action="" enctype="multipart/form-data">
      <table class="table-condensed table-hover " id="insert_table">	 
                    <tr>

                        <td>
                            <input name="edit-slot_id" id="edit-slot_id" value="" type="hidden"  class="form-control"  />
                                   </td>
                    </tr>
                     <tr>

                        <td><label>Slot Name:</label>
                            <input name="edit-slot_name" id="edit-slot_name" value="" type="text"   class="form-control"  size="40" required/>
                               </td>
                    </tr>
                       <tr>

                        <td><label>Slot Start Time:</label>
                            <input name="edit-slot_start_time" id="edit-slot_start_time" value="" type="text"   class="form-control"  size="40" required/>
                            Time 24hr format (00:00:00)
                               </td>
                    </tr>
                       <tr>

                        <td><label>Slot End Time:</label>
                            <input name="edit-slot_end_time" id="edit-slot_end_time" value="" type="text"   class="form-control"  size="40" required/>
                            Time 24hr format (00:00:00)
                        </td>
                    </tr>	 
                <!--    <tr>
                            <td><input type="submit" name="btn-upload"  id="btn-upload" value="ADD" class="btn btn-success btn-sm form-control"/></td>
                    </tr>  -->
      </table>
      </form>
         <div id="editSlotMessage">Succesfully Updated !</div>
    </div>
