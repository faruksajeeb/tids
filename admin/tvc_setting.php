<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/jquery.dataTables.css" rel="stylesheet">
<script type="text/javascript" src="../script/jquery-2.2.3.min.js"></script> 
<script type="text/javascript" src="../script/bootstrap.min.js"></script>
<style>

body{}

.middle{height:auto;margin:0 auto;border-radius:10px;
text-align:center;padding:20px;margin-top:20px;
}
.middle h1{margin-top:0;font-size:22px;text-transform: uppercase;} 
</style>

     <script type="text/javascript">
         

            function slotSetting(){
                  $.ajax({    //create an ajax request to load_page.php
                    type: "GET",
                    url: "display_tvc_slot.php",           
                    dataType: "html",   //expect html to be returned                
                    success: function(response){                    
                        $("#slot").html(response); 
                        //alert(response);
                    }
                });
            }
             function intermissionSetting(){
                  $.ajax({    //create an ajax request to load_page.php
                    type: "GET",
                    url: "display_tvc_intermission.php",           
                    dataType: "html",   //expect html to be returned                
                    success: function(response){                    
                        $("#intermission").html(response); 
                        //alert(response);
                    }
                });
            }

</script>
</head>
<body onload="slotSetting();" >
<div class="middle" >

        <h1 class="page-header">TVC Settings</h1>

  <ul class="nav nav-tabs">
       <li  class="active" ><a  href="#home" id="sloting_time" onclick="slotSetting();">Slot</a></li>
      <li ><a href="#menu1" id="intermission_time" onclick="intermissionSetting();">intermission</a></li>
  </ul>

  <div class="tab-content" >
   
      <div id="home" class="tab-pane fade in active">
            <div id="slot" align="center" >
        </div>
    </div>
       <div id="menu1" class="tab-pane fade in active">     
        
        <div id="intermission" align="center">        </div>       
    </div>



<script>
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
});

</script>
<script>/*
window.onerror = function(errorMsg) {
	$('#console').html($('#console').html()+'<br>'+errorMsg)
}*/
$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
format: 'yyyy-mm-dd',
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:'Date.now()'
});
//$('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});
</script>
</div>
</div>


<script src="datetime/jquery.datetimepicker.js"></script>
<script src="../script/jquery.dataTables.min.js" type="text/javascript"></script>

</body>
</html>
