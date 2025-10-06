<?php
include_once('pagesession.php');
include_once('dbconnect.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Insert tvc</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<script language="javascript" type="text/javascript" src="../script/jquery-1.9.1.min.js"></script>
<style>
body{}
.middle{height:auto;width:40%;margin:0 auto;border-radius:10px;
padding:20px;margin-top:50px;
box-shadow:-2px 2px 15px #ccc,2px 2px 15px #ccc,2px -2px 15px #ccc,-2px -2px 15px #ccc;
}
.middle h1{margin-top:0;text-align:center;font-size:22px;text-transform: uppercase;} 
#uploadForm {border-top:#F0F0F0 2px solid;background:#FAF8F8;padding:10px;}
#uploadForm label {margin:2px; font-size:1em; font-weight:bold;}
.demoInputBox{padding:5px; border:#F0F0F0 1px solid; border-radius:4px; background-color:#FFF;}
#progress-bar {background-color: #12CC1A;height:20px;color: #FFFFFF;width:0%;-webkit-transition: width .3s;-moz-transition: width .3s;transition: width .3s;}
.btnSubmit{background-color:#09f;border:0;padding:10px 40px;color:#FFF;border:#F0F0F0 1px solid; border-radius:4px;}
#progress-div {border:#0FA015 1px solid;padding: 5px 0px;margin:30px 0px;border-radius:4px;text-align:center;}
#targetLayer{width:100%;text-align:center;}

.filenameupload {
	width:100%;	
}

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
</style>
<script type="text/javascript" src="../script/jquery.form.min.js"></script>
<script type="text/javascript"> 
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
				},
				resetForm: true 
			}); 
			return false; 
		}
                                else{
                                    e.preventDefault();
			$('#loader-icon').show();
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

<a href="display_tvc.php" class="btn btn-info pull-left"><i class="fa fa-backward"></i> BACK</a>
<a href="insert_client.php" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Clients</a>

<h1 class="page-header"> INSERT TVC </h1>
<hr/>
<div id="loader-icon" style="display:none;width:100%; text-align: center;"><img src="../img/LoaderIcon.gif" width="50" /></div>
  <div id="targetLayer" style="font-weight: bold;font-size:18px;"></div>
    <div id="progress-div" style="display:none;"><div id="progress-bar"></div></div>

<form name="uploadForm" id="uploadForm" method="post" action="tvc_upload.php" enctype="multipart/form-data">
  
  <table width="100%" class="table-condensed table-hover ">
    <tr>
      <th>Client Name</th>
      <td>
	    <select name="cname"  id="cname"class="form-control"  required>
			<option value="">select client name</option>
		<?php 
		 $q="SELECT * FROM tbl_client";
		 $rest=mysql_query($q);
		 while($row=mysql_fetch_assoc($rest)){
		?>
				<option value="<?php echo $row['client_id']?>"><?php echo $row['client_name']?></option>
		<?php }?>
        </select>
	  </td>
    </tr>
	<tr>
      <th>Choose a file to upload</th>
      <td> 
          <input type="hidden" id="uploadFile" placeholder="Add files from My Computer"/>
          <img src="../img/upload_button.png" id="upfile1" style="cursor:pointer" width="150" />          
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
          
    </tr>
    <tr>
      <th colspan="2"></th>
    </tr>
  </table>
</form>
</div>
    <script>

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
    var files = $('#file1')[0].files;
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
