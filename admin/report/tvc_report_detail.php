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
  
    $(document).ready(function(){
	$('select').change(getTvcList);
	function getTvcList()
	{            
		var url, target;
		switch ($(this).attr('id'))
		{
			case 'client_name2':
                                                    var client_id=$(this).val();
                                                    //alert(client_id);
			if( client_id=='') 
				return false;			
			url = 'dependable_tvc_name.php?find=tvc_name&id='+ $(this).val(); 			
			target = '#tvc_name2';
			break;						
					
		}
		$.get(url, { }, function(data)
		{
				$(target).html(data);
			}
		)
	}
        
});
/*
    $(function () {
       $('#tvc_broadcasting_report').dialog({
           autoOpen: false,
           modal: true,
           minHeight: 700,
           minWidth: 1200,
     
       });
   });
    $("#submit3").click(function () { 
        var client_name3 = $('#client_name2').val();
        var tvc_name3 = $('#tvc_name2').val();
        var from_date3 = $('#datetimepicker3').val();
        var to_date3 = $('#datetimepicker4').val();
        if(!client_name3 && !tvc_name3 && !from_date3 && !to_date3){
            alert('Please enter query criteria');
        }else{
        if (from_date3 && !to_date3) {
            alert('Please enter (To Date)');
        } else if (!from_date3 && to_date3) {
            alert('Please enter (From Date)');
        } else if (from_date3 && to_date3) {
            if (from_date3 > to_date3) {
                alert('To date must be greater than or equal From date');
            }            
            if (from_date3 <= to_date3) {
                $.ajax({//create an ajax request to load_page.php
                    type: "POST",
                    url: "tvc_report_detail_by_query.php",
                    dataType: "html", //expect html to be returned 
                    cache: false,
                    data: {
                        c_name3: client_name3,
                        tvc_name3: tvc_name3,
                        from_date3: from_date3,
                        to_date3: to_date3
                    },
                    success: function (response) {
                        $("#tvc_broadcasting_report").html(response);
                        //alert(response);
                    }
                });
                $("#tvc_broadcasting_report").dialog("open");
            }
        } else {
            $.ajax({//create an ajax request to load_page.php
                type: "POST",
                url: "tvc_report_detail_by_query.php",
                dataType: "html", //expect html to be returned 
                cache: false,
                data: {
                    c_name3: client_name3,
                    tvc_name3: tvc_name3,
                    from_date3: from_date3,
                    to_date3: to_date3
                },
                success: function (response) {
                    $("#tvc_broadcasting_report").html(response);
                    //alert(response);
                }
            }); 
            $("#tvc_broadcasting_report").dialog("open");
        }
        }
    });
    */
</script> 
<div class="col-lg-7">
 <form method="POST" action="tvc_report_detail_by_query.php" target="_blank">
        
        <table class=" table table-bordered table-condensed " ;" style="margin-top:15px;">
    <tr>
        <td>Client Name:</td>
        <td>
            <select class="" name="client_name2" id="client_name2" style="width:250px;height: 25px;">
                <option value="">Select client name</option>               
                <?php 
		 $q="select * from tbl_client";
		 $rest=$conn->query($q);
		 while($row= $rest->fetch_row()){
		?>
				<option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
		<?php
			}?>
            </select>
        </td>
        <td>TVC Name:</td>
        <td>
            <select  name="tvc_name2"  id="tvc_name2"  class="" style="width:400px;height: 25px;">
                <option value="">Select tvc name</option>
               
            </select>
        </td>
        <td></td>
    </tr>
    <tr>
        <td>From Date:</td>
        <td>
           <input type="text" value="" id="datetimepicker3" name="from_date" />
        </td>
        <td>To Date:</td>
        <td>
            <input type="text" value="" id="datetimepicker4" name="to_date" />
        </td>
        <td>
            <input type="submit" class="" name="btn_submit" id="submit3" value="Show Report"/>
        </td>
    </tr>
</table>
    </form>
</div>  
<table class=" table table-bordered table-condensed table-hover example">
    <thead>
        <tr>
            <th>Sl No</th>
			<?php if($_SESSION['user_type']=='super_admin'){?>  
            <th>IP Address</th>
			<?php } ?>
            <th>Clients Name</th>
            <th>TVC Title </th>     
            <th>Broadcasting Time (Start)</th>
            <th>Duration (Sec)</th> 
        </tr>
    </thead>
    <tbody>
        <?php
            $i = 1;
            $sql = "SELECT "
                            . "tpr.ip_address," 
                            . "tpr.playing_time,"
                            . "tt.tvc_name,"
                            . "tc.client_name,"
                            . "tt.duration "
                    . "FROM "
                            . "tbl_tvc_playing_report AS tpr,"
                            . "tbl_tvc_schedule AS tts,"
                            . "tbl_client AS tc,"
                            . "tbl_tvc AS tt "
                    . "WHERE "
                            . "tpr.schedule_id=tts.schedule_id AND "
                            . "tts.tvc_id=tt.tvc_id AND "
                            . "tts.client_id=tc.client_id "
                    . "ORDER BY"
                            . " tpr.playing_report_id DESC LIMIT 10 ";
            //$sql="SELECT * FROM tbl_tvc_report ORDER BY id DESC LIMIT 50";
            $rst = $conn->query($sql);
            while ($row = $rst->fetch_assoc()) {
           ?>
            <tr>
                <td><?php echo $i; ?></td>
				<?php if($_SESSION['user_type']=='super_admin'){?>  
                <td><?php echo $row['ip_address'] ?></td>
				<?php } ?>
                <td><?php echo $row['client_name'] ?></td>
                <td><?php echo $row['tvc_name'] ?></td>      
                <td><?php echo $row['playing_time'] ?></td>
                <td><?php echo $row['duration'] ?></td>
            </tr>
            <?php
            $i++;
            }
        ?>
    </tbody>
</table>
<div id="tvc_broadcasting_report" align="center" title="TVC Broadcasting Report"> </div>
<script>

jQuery('#datetimepicker3').datetimepicker({
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
jQuery('#datetimepicker4').datetimepicker({
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
