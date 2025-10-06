<?php
include('../classes/dbConfig/config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo BASE_URL; ?>script/jquery-2.2.3.min.js"></script>
        <link href="<?php echo BASE_URL; ?>css/jquery-ui.min.css" rel="stylesheet">
        <script src="<?php echo BASE_URL; ?>js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>script/jquery.form.min.js"></script>
<style>
body{overflow-x:hidden;overflow-y:hidden;width:100%;margin:0 auto}
.box{
	width:12.6%;height:170px;border:1px solid #ccc;margin:.5%;padding:10px;border-radius:5px;
	transition:all 1s;
	
}
.ui-dialog-titlebar{ 
                background-color:#31B0D5;
                text-align: center;
            }
.box:hover{box-shadow:-2px 2px 15px #ccc,2px 2px 15px #ccc,2px -2px 15px #ccc,-2px -2px 15px #ccc; background-color:#66CCCC}
</style>
        <script>
                  $(document).ready(function(){

  settings(); //Click event to populate form with selected defect
  reports(); //Click event to populate form with selected defect
$('#tvc').click(function(){
      location="tvc_setting.php";

  });
  $('#tids').click(function(){
      location="tids_settings.php";

  });
  $('#tvc_report').click(function(){
      location="report/display.tvc_report.php";

  });
  $('#tids_report').click(function(){
      location="tids_report.php";

  });
  
}); //Document Ready End
function settings(){    
  $('#settings-button').click(function(){
      $("#settings").dialog("open");

  });
} 
function reports(){    
  $('#reports-button').click(function(){
      $("#reports").dialog("open");

  });
} 

         $(function () {
               
                $('#settings').dialog({
                    autoOpen: false,
                  // modal:true,
                    minHeight: 200,
                    minWidth: 300,
                    cache: false,
                     buttons: {
                    
                    "Discard & Exit": function () {
                        $(this).dialog("close");
                        location='admin_welcome.php';
                    }
                }
                });
            });
            $(function () {
               
                $('#reports').dialog({
                    autoOpen: false,
                  // modal:true,
                    minHeight: 200,
                    minWidth: 300,
                    cache: false,
                     buttons: {
                    
                    "Discard & Exit": function () {
                        $(this).dialog("close");
                        location='admin_welcome.php';
                    }
                }
                });
            });
        
        </script>
</head>

<body>
<div class="row" style="margin:0 auto;text-align:center;margin-top:30px;font-size:20px;">
    <div class="box_div" style="margin:0 auto;">
<a href="schedule/index.php" target="divId" ><div class="col-sm-2 box" ><img src="<?php echo BASE_URL; ?>images/schedule.png" height=100px /><br>Schedule</div></a>

<a href="com/display.tvc.php" target="divId" ><div class="col-sm-2 box" ><img src="<?php echo BASE_URL; ?>img/arts_tv_logo.png" height=100px /><br>ARTS tv</div></a>
<a href="#" id="reports-button"><div class="col-sm-2 box" ><img src="<?php echo BASE_URL; ?>images/report.png" height=100px /><br>Reports</div></a>
<a href="design.php" target="divId" ><div class="col-sm-2 box" ><img src="<?php echo BASE_URL; ?>images/design.png" height=100px /><br>Design</div></a>
<a href="layout.php" target="divId" ><div class="col-sm-2 box" ><img src="<?php echo BASE_URL; ?>images/layout.png" height=100px /></i><br>Layouts</div></a>
<a href="display.admin_users.php" target="divId" ><div class="col-sm-2 box" ><img src="<?php echo BASE_URL; ?>images/User.png" height=100px /><br>Users</div></a>

<a href="#" id="settings-button"><div class="col-sm-2 box" ><img src="<?php echo BASE_URL; ?>images/settings.png" height=100px /><br>Settings</div></a>
<!--<div><i class="fa fa-codepen"></i></div>
<div><i class="fa fa-film"></i></i></div>
<div><i class="fa fa-wrench"></i></div>-->

</div>
</div>
    <div id="settings" align="center" title="Settings" >
        <br/>
        <button  target="divId"  id="tids" class="btn btn-warning " style="width:250px;margin-bottom: 10px;">TIDS</button>
        <button  target="divId"  id="tvc" class="btn btn-warning " style="width:250px;">TVC</button>
    </div>
    
    <div id="reports" align="center" title="Reports" >
        <br/>
        <button  target="divId"  id="tids_report" class="btn btn-warning " style="width:250px;margin-bottom: 10px;">TIDS</button>
        <button  target="divId"  id="tvc_report" class="btn btn-warning " style="width:250px;">TVC</button>
    </div>
</body>
</html>
