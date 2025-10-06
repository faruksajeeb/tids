<?php
include('../../classes/dbConfig/config.php');
include_once('../../db/db_connect.php');
if(isset($_GET['status'])) {
	if($_GET['status'] =='publish') {
		$id=$_GET['id'];
		$username=$_SESSION['user_name'];
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		$auditQry = "INSERT INTO tbl_auditor(username,ipaddr,description,train_no,action) VALUES ('$username','$ip_addr','tbl_tvc','".$id."','Publish')";
		$audit_result=$conn->query($auditQry);
		$x="UPDATE tbl_tvc SET publication_status=1 WHERE tvc_id='".$id."'";
		$rst=$conn->query($x);
		header("location:display.tvc.php");
	}else if($_GET['status'] =='unpublish') {
		$id=$_GET['id'];
		$username=$_SESSION['user_name'];
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		$auditQry = "INSERT INTO tbl_auditor(username,ipaddr,description,train_no,action) VALUES ('$username','$ip_addr','tbl_tvc','".$id."','unpublish')";
		$audit_result=$conn->query($auditQry);
		$x="UPDATE tbl_tvc SET publication_status=0 WHERE tvc_id='".$id."' ";
		$rst=$conn->query($x);
		header("location:display.tvc.php");
	}else if($_GET['status'] =='delete') {
		$id=$_GET['id'];
		$tvc=$_GET['tvc'];
		$username=$_SESSION['user_name'];
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		$auditQry = "INSERT INTO tbl_auditor(username,ipaddr,description,train_no,action) VALUES ('$username','$ip_addr','tbl_tvc','".$id."','delete')";
		$audit_result=$conn->query($auditQry);
		$sql="UPDATE  tbl_tvc SET deletion_status=1,publication_status=0 WHERE tvc_id=$id ";
		   $res=$conn->query($sql);
		   unlink("../../com/videos/".$tvc);
		header("location:display.tvc.php");
	}
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Display tvc</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo BASE_URL; ?>css/jquery.dataTables.css" rel="stylesheet">
        <script src="<?php echo BASE_URL; ?>script/jquery-2.2.3.min.js"></script>
        <link href="<?php echo BASE_URL; ?>css/jquery-ui.min.css" rel="stylesheet">
        <script src="<?php echo BASE_URL; ?>js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>script/jquery.form.min.js"></script>
        <style>
            body{
                
            }
            .ui-dialog-titlebar{ 
                background-color:#31B0D5;
                text-align: center;
            }
            .middle{height:auto;margin:0 auto;border-radius:10px;
                    text-align:center;padding:20px;margin-top:20px;
            }
            .middle h1{margin-top:0;font-size:22px;text-transform: uppercase;} 
            #uploadForm {border-top:#F0F0F0 2px solid;background:#FAF8F8;padding:10px;}
        #uploadForm label {margin:2px; font-size:1em; font-weight:bold;}
        .demoInputBox{padding:5px; border:#F0F0F0 1px solid; border-radius:4px; background-color:#FFF;}
        #progress-bar {background-color: #12CC1A;height:20px;color: #FFFFFF;width:0%;-webkit-transition: width .3s;-moz-transition: width .3s;transition: width .3s;}
        .btnSubmit{background-color:#09f;border:0;padding:10px 40px;color:#FFF;border:#F0F0F0 1px solid; border-radius:4px;}
        #progress-div {border:#0FA015 1px solid;padding: 5px 0px;margin:30px 0px;border-radius:4px;text-align:center;}
        #targetLayer{width:100%;text-align:center;}
        .filenameupload {width:100%;}
        #upload_prev {
                border:thin dotted #ccc;
                width: 100%;
                background-color: #FFF;
                padding:0.5em 1em 1.5em 1em;
        }
        #upload_prev span {
                         display: flex;
                padding: 5px 2px;
                font-size:12px;
                         border-bottom:thin dotted #ccc;
        }
#upload_prev span:last-child{
    border-bottom:0;
}

p.close {
    margin: 0 5px 0 5px;
    cursor: pointer;
	padding-bottom:0;
}
.ui-widget-content #insertTvc{
    background-image: url('../../img/tvc_bg.jpg');
                background-size: cover;    
                opacity:0.9;
}
        </style>
        <script>
            function check_detele() {
                var check = confirm('Are you sure to delete this !!');
                if (check) {
                    return true;
                } else {
                    return false;
                }
            }
            $(function () {
               
                $('#insertTvc').dialog({
                    autoOpen: false,
                   modal:true,
                    minHeight: 500,
                    minWidth: 600,
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
                     buttons: {
                    
                    "Cancel": function () {
                        $(this).dialog("close");
                       // location='display_tvc.php';
                    }
                }
                });
 
                $('#QuickViewTvc').dialog({
                    modal:true,
                    autoOpen: false,                                         
                    minHeight: 400,
                    minWidth: 700,
                    
                    show: {
    effect: "scale",
    direction: "left",
    duration: 300
    },
    hide: {
        effect: "scale",
        direction: "left",
        duration: 700
    },
                    cache: false,
                    
                     buttons: {
                    
                    "Cancel": function () {
                        $(this).dialog("close");
                       // location='display_tvc.php';
                    }
                }
                });
                 $(".playTvc").click(function () {
                var tvc_name=$(this).attr("tvc_name");
                   // alert(tvc_name);
                 $.ajax({                                                
                                    type:"POST",                                       
                                    url:"quick_tvc_view.php",
                                     data:{
                                        tvc_name:tvc_name                                        
                                    },
                                  dataType:"html",
                                    success: function(data){
                                        //some logic to show that the data was updated
                                        //then close the window
                                        $("#QuickViewTvc").html(data);
                                      }
                                }); 
           });
            });
            $(function () {
                $('#targetLayer').dialog({
                    autoOpen: false,
                    modal:true,
                    minHeight: 200,
                    minWidth: 400,
                    buttons: {
                    "Ok": function () {
                        $(this).dialog("close");
                        location='display.tvc.php';
                       // $("#insertTvc").trigger( "reset" );                        
                        
                }},
                    cache: false,
                    
                });
                
            });
            function insertTvc() {

                $("#insertTvc").dialog("open");
            }
            function QuickTvcView() {

                $("#QuickViewTvc").dialog("open");
                
            }
                $(document).ready(function(){
            $("#upfile1").click(function () {
     // alert(0);
  $("#file1").trigger('click');
});

 $('#uploadForm').submit(function(e) {
                                   
		if($('#file1').val()) {
			e.preventDefault();
			$('#loader-icon').show();
			$('#progress-div').show();
			$(this).ajaxSubmit({ 
                                                                   
				target: '#targetLayer', 
				beforeSubmit: function() {
				  $("#progress-bar").width('0%');
				},
				uploadProgress: function (event, position, total, percentComplete){	
					$("#progress-bar").width(percentComplete + '%');
					$("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
				},                                                                     
				success:function (){
					$('#loader-icon').hide();
                                                                                $('#progress-div').hide();
                                                                                 $("#targetLayer").dialog("open");
                                                                                // $('#upload_prev').remove();
                                                                                
				},
				resetForm: true
			});
                                                   
			return false; 
		}
                                else{
                                    e.preventDefault();
			$('#loader-icon').show();
                                                     $('#upload_prev').show();                                                    
			$(this).ajaxSubmit({ 
				target: '#targetLayer', 
				beforeSubmit: function() {
				  $("#progress-bar").width('0%');
				},
				uploadProgress: function (event, position, total, percentComplete){	
					$("#progress-bar").width(percentComplete + '%');
					$("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
				},
				success:function (){
					$('#loader-icon').hide();
                                                                                      $("#targetLayer").dialog("open");
				},
				resetForm: true 
			}); 
			return false; 
                                 }
	});


    });

   
        </script>
    </head>
    <body>
        <div class="middle" >

            <h1 class="page-header"><img src="<?php echo BASE_URL; ?>img/video-icon500px.png" width="50">TVC Library</h1>
       
                <a href="display.clients.php" class="btn btn-info ">Clients</a>
               <!-- <a href="insert_tvc.php"  class="btn btn-info btn-default ">Insert new TVC</a> -->
                <a href="#"  onclick="insertTvc();" class="btn btn-info btn-default ">Insert new TVC</a>
                <!--<a href="insert_tvc_schedule.php" class="btn btn-info btn-default">TVC Schedule</a>-->
                <a href="display.tvc_schedule.php" class="btn btn-info btn-default">TVC Schedule</a>
                <a href="../report/display.tvc_report.php" class="btn btn-info btn-default">TVC Report</a>
                <!-- <a href="insert_multiple_video_schedule.php" class="btn btn-info btn-default">Multiple video Schedule</a> -->
                <br/>
                <hr/>
                <table style="text-align: left;" class=" table table-bordered table-condensed table-hover example">
                    <thead>
                        <tr>
                            <th>Sl No</th>     
                            <th>TVC Name </th>  
                            <th>Client Name</th>
                            <th>Uploaded Time</th>
                            <th>Duration (Sec)</th>
                            <th>Type</th>
                            <th>Size </th>	  
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sl_no = 1;
                        $query = "SELECT tt.*,tc.client_name FROM tbl_tvc AS tt,tbl_client AS tc WHERE tt.client_id=tc.client_id AND tt.deletion_status=0";
                        $rst_tvc = $conn->query($query);                        
                        while ($row_tvc = $rst_tvc->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $sl_no; ?></td>     
                                <td>
                                    <span class="glyphicon glyphicon-film"> </span>
                                    <a href="#" class="playTvc" onClick="QuickTvcView();" tvc_name="<?php echo $row_tvc['tvc_name'] ?>"> <?php echo $row_tvc['tvc_name'] ?> </a>
                                </td>
                                <td><?php echo $row_tvc['client_name'] ?></td>      
                                <td><?php echo $row_tvc['uploaded_time'] ?></td>
                                <td><?php echo $row_tvc['duration'] ?></td>
                                <td><?php echo $row_tvc['type'] ?></td>
                                <td>
                                    <?php 
                                          $bytes=$row_tvc['size'];
                                          $kbyte=$bytes/1024;
                                          $megabyte=$kbyte/1024;
                                          echo round($megabyte,2). ' MB ';
                                    ?>
                                </td>         
                                <td>
                                    				<?php 
			if($row_tvc['publication_status']==0){
		?>
			<a href="?status=publish&id=<?php echo $row_tvc['tvc_id'];?>" class="btn btn-success  btn-sm" title="Publish"> <span class="fa fa-check" ></span> Publish</a>
		<?php 
			}else{
		?>
			<a href="?status=unpublish&id=<?php echo $row_tvc['tvc_id'];?>" class="btn btn-warning  btn-sm" title="Unpublish"><span class="fa fa-times" ></span> Unpublish</a>
		<?php
			}
                     
		?>
                       
                                     <a href="?status=delete&id=<?php echo $row_tvc['tvc_id'];?>&tvc=<?php echo $row_tvc['tvc_name'];?>" class="btn btn-danger  btn-sm " onclick="return check_detele(); "><span class="fa fa-trash-o"> Delete</span></a>
                    
                                </td>
                            </tr>
                            <?php
                            $sl_no++;
                        }
                        ?>
                    </tbody>
                </table>
           
        </div>
        
        
        
        
        
        
        
        
        
        
        
         <div id="targetLayer" style="font-weight: bold;font-size:15px;"></div>
         <div id="insertTvc" align="center" title="INSERT TVC" >
          
                <hr/>
                <div id="loader-icon" style="display:none;width:100%; text-align: center;"><img src="<?php echo BASE_URL; ?>img/LoaderIcon.gif" width="50" /></div>
               
                <div id="progress-div" style="display:none;"><div id="progress-bar"></div></div>

                <form style="opacity:0.9;border-radius: 5px;" name="uploadForm" id="uploadForm" method="post" action="tvc_upload.php" enctype="multipart/form-data">

                    <table width="100%" class="table-condensed table-hover ">
                        <tr>
                            <th>Client Name</th>
                            <td>
                                <select name="cname"  id="cname"class="form-control"  required>
                                    <option value="">select client name</option>
                                    <?php
                                    $sql_tvc_ins = "SELECT * FROM tbl_client WHERE publication_status=1";
                                    $rest_ins = $conn->query($sql_tvc_ins);
                                    while ($row = $rest_ins->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $row['client_id'] ?>"><?php echo $row['client_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Choose a file to upload</th>
                            <td> 
                                <input type="hidden" id="uploadFile" placeholder="Add files from My Computer"/>
                                <img src="<?php echo BASE_URL; ?>img/upload_button.png" id="upfile1" style="cursor:pointer" width="150" />          
                                <input type="file" id="file1"  name="txtfile[]" style="display:none" multiple/> <br/>          
                                <div id="upload_prev" >
                                    <div id="no_file">No file choosen</div>

                                </div>   

                                <div style="clear:both;"></div>

                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" name="btn-upload"  id="btn-upload" value="Save File" class="btn btn-success btn-lg"/>
                                
 </td>
                        </tr>
                        <tr>
                            <th colspan="2"></th>
                        </tr>
                    </table>
                </form>
            </div>
           <div id="QuickViewTvc" align="center" title="Quick TVC View" >
            
            </div>

        <script src="<?php echo BASE_URL; ?>script/jquery.dataTables.min.js" height="300" width="700" type="text/javascript"></script>
        <script>
                                $(document).ready(function () {
                                    $('.example').dataTable();
                                });
                                
document.getElementById('file1').onchange = uploadOnChange;

function uploadOnChange() {   
    $('#no_file').hide();
    $('#add_more').show();
    document.getElementById("uploadFile").value = this.value;
    var filename = this.value;
    var lastIndex = filename.lastIndexOf("\\");
    if (lastIndex >= 0) {
        filename = filename.substring(lastIndex + 1);
    }
    files = $('#file1')[0].files;
    var slno='';
    for (var i = 0; i < files.length; i++) {
     //$("#upload_prev").append('<span>'+'<div class="filenameupload">'+(i+1)+'. '+files[i].name+'</div>'+'<p class="close" >X</p></span>');
     $("#upload_prev").append('<span>'+'<div class="filenameupload">'+(i+1)+'. '+files[i].name+'</div></span>');
    }
    function removeFile(e) {
 }
    document.getElementById('filename').value = filename;
}

/*
 $('#upload_prev').on('click','.close',function(){
	$(this).parents('span').remove();
})
*/
    
        </script>
    </body>
</html>
