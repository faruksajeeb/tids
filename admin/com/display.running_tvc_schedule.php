<?php
include('../../classes/dbConfig/config.php');
include_once('../../db/db_connect.php');

?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../datetime/jquery.datetimepicker.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL; ?>css/jquery.dataTables.css" rel="stylesheet">
<script language="javascript" type="text/javascript" src="<?php echo BASE_URL; ?>script/jquery-1.9.1.min.js"></script>

 <script type="text/javascript">
    
function dispalySchedule() {             

      $.ajax({    //create an ajax request to load_page.php
        type: "GET",
        url: "display.playing_tvc.php",             
        dataType: "html",   //expect html to be returned                
        success: function(response){                    
            $("#responsecontainer").html(response); 
            //alert(response);
        }

    });
}

</script>
</head>
<style>

.middle h1{margin-top:10px;;font-size:22px;text-align:center;} 
#insert_table{float:left;}
thead{background-color:#ccc;}
@media print {
   a:after { content:''; }
   a[href]:after { content: none !important; }

}

</style>
</head>
<body onload="setInterval('dispalySchedule()',1000);">

<div class="middle" >
<a href="display.tvc_schedule.php" class="btn btn-info btn-xs"><i class="fa fa-backward"></i> BACK</a>
<h1 class=""><img src="<?php echo BASE_URL; ?>img/ajax-loader.gif" width="70px" />Running Schedule</h1>
<hr/>

 <div class="" id="responsecontainer">



</div>
</div>
<script src="../datetime/jquery.js"></script>
<script src="../datetime/jquery.datetimepicker.js"></script>
<script src="<?php echo BASE_URL; ?>script/jquery.dataTables.min.js" type="text/javascript"></script>
<script>/*
window.onerror = function(errorMsg) {
	$('#console').html($('#console').html()+'<br>'+errorMsg)
}
$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
format: 'yyyy-mm-dd',
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:'Date.now()'
});
//$('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});
*/
jQuery('#datetimepicker').datetimepicker({
 i18n:{
  de:{
   months:[
    'Januar','Februar','März','April',
    'Mai','Juni','Juli','August',
    'September','Oktober','November','Dezember',
   ],
   dayOfWeek:[
    "So.", "Mo", "Di", "Mi", 
    "Do", "Fr", "Sa.",
   ]
  }
 },
 timepicker:false,
 format:'Y-m-d'
});
</script>
<script>
	$(document).ready(function() {
		$('.example').dataTable();
			});
</script>
</body>
</html>
