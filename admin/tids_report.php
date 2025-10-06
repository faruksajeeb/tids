<?php
include('../classes/dbConfig/config.php');
include_once('../db/db_connect.php');
if(isset($_SESSION['uid'])==false){
	header('location:index.php');
}
?>

<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/jquery.dataTables.css" rel="stylesheet">
<script type="text/javascript" src="../script/jquery-2.2.3.min.js"></script> 
<script type="text/javascript" src="../script/bootstrap.min.js"></script>
<script src="datetime/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="exportData/tableExport.js"></script>
<script type="text/javascript" src="exportData/jquery.base64.js"></script>
<script type="text/javascript" src="exportData/html2canvas.js"></script>
<script type="text/javascript" src="exportData/jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="exportData/jspdf/jspdf.js"></script>
<script type="text/javascript" src="exportData/jspdf/libs/base64.js"></script>
<script type="text/javascript" src="exportData/jquery.table2excel.js"></script>
<link href="datetime/jquery.datetimepicker.css" rel="stylesheet" type="text/css"/> 
<link href="../css/jquery-ui.min.css" rel="stylesheet">
<script src="../js/jquery-ui.min.js"></script>
<style>
    .ui-state-default .ui-icon{background-image:url("../img/ui-icons_ef8c08_256x240.png")}
</style>
<script>

    $(function(){
         $('#response_tids_all').dialog({
             autoOpen:false,
            modal:true,
            minHeight:700,
            minWidth:1200,
         });
    });
    
    $(document).ready(function() {
             $("#submit_tids_form").click(function(){
                // alert(0);
                  var  from_date = $('#datepicker_tids').val();                       
                   var  to_date = $('#datepicker_tids2').val();                       
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
                                url: "tids_report_all_by_query.php",             
                                dataType: "html",   //expect html to be returned 
                                cache: false,
                                data: {                                                        
                                    from_date: from_date ,                       
                                    to_date: to_date                        
                                },
                                success: function(response){                    
                                    $("#response_tids_all").html(response); 
                                    //alert(response);
                                }

                            });
                        $("#response_tids_all").dialog("open");
                    }
                    }
                
        });
        });
     
</script> 
<h2 class="page-header" style="text-align:center">TIDS REPORT</h2>
<div class="col-lg-7">
    <form method="POST">
        
        <table class=" table table-bordered table-condensed " ;" style="margin-top:15px;">

    <tr>
        <td>From Date:</td>
        <td>
           <input type="text" value="" id="datepicker_tids" name="" />
        </td>
        <td>To Date:</td>
        <td>
            <input type="text" value="" id="datepicker_tids2" name="" />
        </td>
        <td>
            <input type="button" class="" id="submit_tids_form" value="Show Report"/>
        </td>
    </tr>
</table>
    </form>
        
    </div>
<table class=" table table-bordered table-condensed table-hover example">
    <thead>
        <tr>
                <th>Sl No</th>
      <th>User Name</th>
      <th>IP Address</th>
      <th>Date Time</th>
        <th>Description</th>   
        <th>Action</th>
        </tr>
    </thead>
    <tbody>
	
	<?php
        $sl_no=1;
                            $stmt="SELECT * FROM tbl_tids_report ORDER BY id DESC LIMIT 10";
                            $rst=$conn->query($stmt);
		while($row =$rst->fetch_row()){
	?>
    <tr>
	  <td><?php echo $sl_no;?></td>
	  <td><?php echo $row[1]?></td>
	  <td><?php echo $row[2]?></td>
	  <td><?php echo $row[3]?></td>
	  <td><?php echo $row[4]?></td>
	  <td><?php echo $row[5]?></td>
	

    </tr>
	<?php
        $sl_no++;
	}
	?>
	</tbody>
  </table>
 <div id="response_tids_all" align="center" title="TIDS Report">

</div>
<script>
jQuery('#datepicker_tids').datetimepicker({
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
jQuery('#datepicker_tids2').datetimepicker({
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

<script src="../script/jquery.dataTables.min.js" type="text/javascript"></script>






























