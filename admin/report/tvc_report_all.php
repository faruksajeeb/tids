<?php
include('../../classes/dbConfig/config.php');
include_once('../../db/db_connect.php');
?>
<link href="<?php echo BASE_URL; ?>admin/datetime/jquery.datetimepicker.css" rel="stylesheet" type="text/css"/> 
<link href="<?php echo BASE_URL; ?>css/jquery-ui.min.css" rel="stylesheet">
<script src="<?php echo BASE_URL; ?>js/jquery-ui.min.js"></script>
<style>
    .ui-state-default .ui-icon{background-image:url("<?php echo BASE_URL; ?>img/ui-icons_ef8c08_256x240.png")}
</style>
<script>
/*
             $("#submit_form").click(function(){
                   var  from_date = $('#datepicker').val();                       
                   var  to_date = $('#datepicker2').val();                       
                    if(from_date && !to_date){
                        alert('Please enter (To Date)');
                    }else if(!from_date && to_date){
                        alert('Please enter (From Date)');
                    }else if(from_date && to_date){
                        if(from_date > to_date){
                        alert('To date must be greater than or equal From date');
                        }else{
                        $.ajax({    //create an ajax request to load_page.php
                                type: "POST",
                                url: "tvc_report_all_by_query.php",             
                                dataType: "html",   //expect html to be returned 
                                cache: false,
                                data: {                                                        
                                    from_date: from_date ,                       
                                    to_date: to_date                        
                                },
                                success: function(response){								
									$("#response_container_all").html(response);
									//window.open(response.url,'_blank');
                                }

                            });
                        //$("#response_container_all").dialog("open");
                    }
                    }
                
        });
        */
</script> 
<div class="row">
<div class="col-lg-7">
<form method="POST" action="tvc_report_all_by_query.php" target="_blank">
        
        <table class=" table table-bordered table-condensed " ;" style="margin-top:15px;">

    <tr>
        <td>From Date:</td>
        <td>
           <input type="text" value="" id="datepicker" name="from_date" />
        </td>
        <td>To Date:</td>
        <td>
            <input type="text" value="" id="datepicker2" name="to_date" />
        </td>
        <td>
            <input type="submit" class="" name="submit_form" id="submit_form" value="Show Report"/>
        </td>
    </tr>
</table>
    </form>
        
</div>
</div>
<br/>

  <div class="row">
 <div class="col-md-12" id="response_container_all" align="center" title="TVC Broadcasting Report">

</div>
</div>
<script>
jQuery('#datepicker').datetimepicker({
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
jQuery('#datepicker2').datetimepicker({
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

<script src="<?php echo BASE_URL; ?>admin/datetime/jquery.datetimepicker.js"></script>

