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
    $(document).ready(function () {
        $('select').change(getList);
        function getList()
        {
            var url, target;
            switch ($(this).attr('id'))
            {
                case 'client_name':
                    if ($(this).val() == '')
                        return false;
                    url = 'dependable_tvc_name.php?find=tvc_name&id=' + $(this).val();
                    target = '#tvc_name';
                    break;
            }
            $.get(url, {}, function (data)
            {
                $(target).html(data);
            }
            )
        }
    });
  /* 
    $(function () {
        $('#response_container').dialog({
            autoOpen: false,
            modal: true,
            minHeight: 700,
            minWidth: 1200,
        });
    });
    $("#submit").click(function () {
        var client_name = $('#client_name').val();
        var tvc_name = $('#tvc_name').val();
        var from_date = $('#datetimepicker').val();
        var to_date = $('#datetimepicker2').val();
 if (!client_name) {
                alert('please select Client Name');
            }else{
        if (from_date && !to_date) {
            alert('Please enter (To Date)');
        } else if (!from_date && to_date) {
            alert('Please enter (From Date)');
        } else if (from_date && to_date) {
            if (from_date > to_date) {
                alert('To date must be greater than or equal From date');
            }
           
            if ((client_name || tvc_name) && from_date <= to_date) {
                $.ajax({//create an ajax request to load_page.php
                    type: "POST",
                    url: "tvc_report_client_by_query.php",
                    dataType: "html", //expect html to be returned 
                    cache: false,
                    data: {
                        c_name: client_name,
                        tvc_name: tvc_name,
                        from_date: from_date,
                        to_date: to_date
                    },
                    success: function (response) {
                        $("#response_container").html(response);
                        //alert(response);
                    }
                });
                $("#response_container").dialog("open");
            }
        } else {
            $.ajax({//create an ajax request to load_page.php
                type: "POST",
                url: "tvc_report_client_by_query.php",
                dataType: "html", //expect html to be returned 
                cache: false,
                data: {
                    c_name: client_name,
                    tvc_name: tvc_name,
                    from_date: from_date,
                    to_date: to_date
                },
                success: function (response) {
                    $("#response_container").html(response);
                    //alert(response);
                }
            });
            $("#response_container").dialog("open");
        }
}
    });
    */
</script> 
<div class="col-lg-7">
<form method="POST" action="tvc_report_client_by_query.php" target="_blank">

        <table class=" table table-bordered table-condensed "  style="margin-top:15px;">
            <tr>
                <td>Client Name:</td>
                <td>
                    <select  name="client_name" id="client_name" style="width:250px;height: 25px;" required>
                        <option value="">Select client name</option>               
                            <?php
                            $q = "select * from tbl_client";
                            $rest =$conn->query($q);
                            while ($row = $rest->fetch_row()) {
                                ?>
                            <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                            <?php }
                        ?>
                    </select>
                </td>
                <td>TVC Name:</td>
                <td>
                    <select  name="tvc_name"  id="tvc_name"  class="" style="width:400px;height: 25px;">
                        <option value="">Select tvc name</option>
                    </select>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>From Date:</td>
                <td>
                    <input type="text" value="" id="datetimepicker" name="from_date" />
                </td>
                <td>To Date:</td>
                <td>
                    <input type="text" value="" id="datetimepicker2" name="to_date" />
                </td>
                <td>
                    <input type="submit" class="" id="submit" name="btn_submit" value="Show Report"/>
                </td>
            </tr>
        </table>
    </form>
</div>
<table class=" table table-bordered table-condensed table-hover example">
    <thead>
        <tr>
            <th>Sl No</th>
            <!--
			<?php if($_SESSION['user_type']=='super_admin'){?>  
            <th>IP Address</th>
			<?php } ?>
            -->
            <th>Broadcasting Date</th>
            <th>Clients Name</th>
            <th>TVC Name </th>     
            <th>TVC Dur(Sec)</th>     
            <th>Per Day Spot</th>
            <th>Total Dur(Sec)</th> 
            <th>Total Dur(Min)</th>
        </tr>
    </thead>
    <tbody>
<?php
$i = 1;

$sql = "SELECT "
                    . "tpr.ip_address," 
                    . "COUNT(tpr.schedule_id) AS pspot,"
                    . "tt.tvc_name,"
                    . "tc.client_name,"
                    . "tt.duration,"
                    . "SUM(tt.duration) AS total_duration,"
                    . "DATE(tpr.playing_time) AS date "
            . "FROM "
                    . "tbl_tvc_playing_report AS tpr,"
                    . "tbl_tvc_schedule AS tts,"
                    . "tbl_client AS  tc,"
                    . "tbl_tvc AS tt "
            . "WHERE "            
                    . "tpr.schedule_id=tts.schedule_id AND "
                    . "tts.client_id=tc.client_id AND "
                    . "tts.tvc_id=tt.tvc_id "
                    
            . "GROUP BY  "
                     . "tpr.ip_address,"
                    . "tts.tvc_id,"
                    . "tts.client_id,"
                    . "date "
            . "ORDER BY "
                     . "date DESC LIMIT 10";
$rst = $conn->query($sql) or die($conn->error);
while ($row = $rst->fetch_assoc())  {
    ?>
            <tr>
                <td><?php echo $i; ?></td>
                <!--
				<?php if($_SESSION['user_type']=='super_admin'){?>  
                <td><?php echo $row['ip_address'] ?></td>
				<?php } ?>
                -->
                <td><?php echo $row['date'] ?></td>
                <td><?php echo $row['client_name'] ?></td>
                <td><?php echo $row['tvc_name'] ?></td>      
                <td><?php echo $row['duration'] ?></td>      
                <td><?php echo $row['pspot'] ?></td>
                <td><?php echo $row['total_duration'] ?></td>
                <td>
    <?php
    $get_duration = $row['total_duration'];
    $get_du = gmdate("H:i:s", $get_duration);
    echo $get_du;
    ?>
                </td>
            </tr>
            <?php
            $i++;

}
        ?>
    </tbody>
</table>
<div id="response_container" align="center" title="TVC Broadcasting Report"> </div>
<script>
 jQuery('#datetimepicker').datetimepicker({
        i18n: {
            de: {
                months: [
                    'Januar', 'Februar', 'März', 'April',
                    'Mai', 'Juni', 'Juli', 'August',
                    'September', 'Oktober', 'November', 'Dezember',
                ],
                dayOfWeek: [
                    "So.", "Mo", "Di", "Mi",
                    "Do", "Fr", "Sa.",
                ]
            }
        },
        timepicker: false,
        format: 'Y-m-d'
    });
    jQuery('#datetimepicker2').datetimepicker({
        i18n: {
            de: {
                months: [
                    'Januar', 'Februar', 'März', 'April',
                    'Mai', 'Juni', 'Juli', 'August',
                    'September', 'Oktober', 'November', 'Dezember',
                ],
                dayOfWeek: [
                    "So.", "Mo", "Di", "Mi",
                    "Do", "Fr", "Sa.",
                ]
            }
        },
        timepicker: false,
        format: 'Y-m-d'
    });
</script>
<script>
    $(document).ready(function () {
        $('.example').dataTable();
    });
</script>
<script src="<?php echo BASE_URL; ?>admin/datetime/jquery.datetimepicker.js"></script>


