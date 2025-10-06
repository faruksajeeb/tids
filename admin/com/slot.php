<?php
include('../../classes/dbConfig/config.php');
include_once('../../db/db_connect.php');
@$id = $_GET['mumber'];
global $id;
//echo $id;
$dt = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
$current_time = $dt->format('Y-m-d H:i:s ');
//echo $id;
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>jQuery UI Dialog functionality</title>
        <link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo BASE_URL; ?>admin/datetime/jquery.datetimepicker.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo BASE_URL; ?>script/jquery-2.2.3.min.js"></script>

        <script language="javascript" type="text/javascript" src="<?php echo BASE_URL; ?>script/bootstrap.min.js"></script>
        <link href="<?php echo BASE_URL; ?>css/jquery-ui.min.css" rel="stylesheet">
        <script src="<?php echo BASE_URL; ?>js/jquery-ui.min.js"></script>

        <style>
            .ui-widget-header,.ui-state-default, ui-button{
                background:#b9cd6d;
                border: 1px solid #b9cd6d;
                color: #FFFFFF;
                font-weight: bold;
            }
            .invalid { color: red; }
            textarea {
                display: inline-block;
                width: 100%;
                margin-bottom: 10px;
            }
            #page-header{
                text-align:center;
            }
            #delete {
                flot:right;
            }
            /* Sortable ******************/
            #sortable { 
                list-style: none; 
                text-align: left;
                //width:95%;
            }
            #sortable li { 
                margin: 0 0 5px 0;
                height: 44px; 
                background: #ccc;
                border: 1px solid #999999;
                border-radius: 5px;
                color: #333333;
                //cursor: move;
            }
            #sortable li span {
                background-color: #b4b3b3;
                background-image: url('../images/drag.png');
                background-repeat: no-repeat;
                background-position: center;
                border-left-radius:5px;
                width: 30px;
                height: 42px; 
                display: inline-block;
                float: left;
                cursor: move;
            }
            #sortable li img {
                height: 43px;
                width:70px;
                border: 5px solid #cccccc;
                display: inline-block;
                float: left;
            }
            #sortable li div {
                padding: 5px;
            }
            #sortable li h2 {    
                font-size: 16px;
                line-height: 20px;
            }

        </style>
        <!-- Javascript of dialog bix -->

        <script type="text/javascript">

            $(function () {
                $("#dialog-6").dialog({
                    autoOpen: false,
                    width: 500
                });
                $("#insert  ").click(function () {

                    $("#dialog-6").dialog("open");
                    var target = $("#page-header");
                    $("#dialog-6").dialog("widget").position({
                        my: 'top',
                        at: 'bottom',
                        of: target
                    });
                });
                //Value Submit

                $("#submit").click(function () {
                    var date = $("#insertTime").val();
                    //var slot_id= $( "#slot_id" ).val();
                    var selectedSchedule = new Array();

                    var n = jQuery(".cvalue:checked").length;
                    if (n > 0) {
                        jQuery(".cvalue:checked").each(function () {
                            selectedSchedule.push($(this).val());
                        });

                    }
                    $.ajax({
                        type: 'post',
                        url: 'add.slot_multipleValue.php',
                        data: {
                            date: date,
                            //slot_id:slot_id,
                            selectedSchedule: selectedSchedule
                        },
                        success: function (response) {
                            //alert("Your data is saved");
                            window.location.reload(true);

                        }
                    });
                    alert("Your data is saved");
                    window.location.reload(true);
                    //alert(date+'\n'+selectedSchedule);
                    $("#dialog-6").dialog("close");
                });


                //................................start sellect all....................................................

                $('#selecctall').click(function (event) {
                    if (this.checked) {
                        $('.checkb').each(function () {
                            this.checked = true;

                        });
                    } else {
                        $('.checkb').each(function () {
                            this.checked = false;
                        });
                    }
                });

                //.....................................end select all..................................................





                //.....................................Start Insert Schedule time calender.................
                $(".insertTime").datepicker({
                    dateFormat: 'yy-mm-dd',
                    beforeShow: function (input, inst) {
                        var rect = input.getBoundingClientRect();
                        setTimeout(function () {
                            inst.dpDiv.css({top: rect.top - 140, left: rect.left - 20});
                        }, 0);
                    }

                });
                //.....................................End Insert Schedule time calender.................


                //.....................................Start Show Schedule.................
                $("#showSchedule").datepicker({
                    dateFormat: 'yy-mm-dd',
                    beforeShow: function (input, inst) {
                        var rect = input.getBoundingClientRect();
                        setTimeout(function () {
                            inst.dpDiv.css({top: rect.top + 40, left: rect.left - 20});
                        }, 0);
                    }

                });
                //.....................................End Show Schedule.................


                //....................................Sortable...................................
                $('#sortable').sortable({
                    axis: 'y',
                    opacity: 0.7,
                    handle: 'span',
                    update: function (event, ui) {
                        var list_sortable = $(this).sortable('toArray').toString();
                        // change order in the database using Ajax
                        $.ajax({
                            url: 'set_tvc_order.php',
                            type: 'POST',
                            data: {list_order: list_sortable},
                            success: function (data) {
                                //finished
                            }
                        });
                    }
                }); // fin sortable


                //...................................delete schedule................................
                $('#delete').click(function () {
                    var selectedSchedule = new Array();

                    var n = jQuery(".cvalue:checked").length;
                    if (n > 0) {
                        jQuery(".cvalue:checked").each(function () {
                            selectedSchedule.push($(this).val());
                        });

                    }
                    $.ajax({
                        type: 'post',
                        url: 'delete_slot_multipleValue.php',
                        data: {
                            selectedSchedule: selectedSchedule

                        },
                        success: function (response) {
                            alert("Data is deleted!");
                            window.location.reload(true);

                        }
                    });
                    //alert(selectedSchedule);


                });






            });

        </script>
        <script>

//#allPlay show and hide

            $(document).ready(function () {
                if ($('.checkb').is(':checked')) {
                    $("#headerPage").show();
                } else {
                    $("#headerPage").hide();
                }

            });
            $(document).ready(function checkUncheck() {
                $('.checkb').click(function () {
                    if ($(".checkb:checked").length > 0) {
                        $("#headerPage").show();
                    } else {
                        $("#headerPage").hide();
                    }
                });
            });

        </script>

        <script>

            $(document).ready(function () {
                var id = <?php echo $id ?>;
                if (id == 12) {
                    $(".slotName").show();
                    $(".sort").css("pointer-events", "none");
                } else {
                    $(".slotName").hide();
                    $(".sort").show();
                }
            });
        </script>
    </head>
    <body>
        <div class="middle" >
            <?php
            $q = "SELECT * FROM tbl_tvc_slot WHERE slot_id=" . $id;
            $rest = $conn->query($q);
            $slot_row = $rest->fetch_assoc();
            ?>
            <div class="col-md-3 pull-right">
                <form action="" method="POST" name="timeForm">
   
                    <table width="100%" class="table-condensed table-hover ">
                        <tr>
                            <td>
                                <input type="text" name="showSchedule" id="showSchedule" class=" form-control pull-right">

                            </td>
                            <td>
                                <input type="submit" id="dateBunnon" name="dateBunnon"  class="btn btn-info form-control pull-right" value="Show Schedule"  >
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <h3 id="page-header" class="page-header"><?php echo $slot_row['slot_name'] ?>(<?php echo $slot_row['slot_start_time'] . "-" . $slot_row['slot_end_time'] ?>)</h3>

            <div id="headerPage">
                <button id="insert" class="btn-primary btn-md">Insert</button>
                <button id="delete" class="btn-danger btn-md">Delete</button>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <form  name="myform" method="POST" action="inset_slot_multipleValue.php" id="myform">
                        <div id="dialog-6">
                            <p>Update Schedule.</p>
                            <div>
                                <input type="text" name="date" id="insertTime" class="insertTime">

                            </div>
                            <div>
                                <input type="submit" id="submit" value="Submit">
                            </div>
                        </div>

                        <ul id="sortable">

                            <?php
                            if (isset($_POST['dateBunnon']) && $id == 12) {
                                $showSchedule = $_POST['showSchedule'];
                                $sql = "SELECT ts.*,c.client_name,s.slot_name,t.tvc_name,t.duration FROM tbl_tvc_schedule as ts,tbl_client as c,tbl_tvc_slot as s,tbl_tvc as t WHERE ts.client_id=c.client_id AND ts.slot_id=s.slot_id AND ts.tvc_id=t.tvc_id AND  DATE(ts.schedule_date)= '$showSchedule'     AND ts.publication_status=1 GROUP BY ts.schedule_id ORDER BY ts.tvc_order ASC";
                                $result = $conn->query($sql);
                            } elseif (isset($_POST['dateBunnon'])) {

                                $showSchedule = $_POST['showSchedule'];
                                $sql = "SELECT ts.*,c.client_name,s.slot_name,t.tvc_name,t.duration FROM tbl_tvc_schedule as ts,tbl_client as c,tbl_tvc_slot as s,tbl_tvc as t WHERE ts.client_id=c.client_id AND ts.slot_id=s.slot_id AND ts.tvc_id=t.tvc_id AND  DATE(ts.schedule_date)= '$showSchedule'    AND ts.slot_id = '$id'  AND ts.publication_status=1 GROUP BY ts.schedule_id ORDER BY ts.tvc_order ASC";
                                $result = $conn->query($sql);
                            } elseif ($id == 12) {

                                $sql = "SELECT ts.*,c.client_name,s.slot_name,t.tvc_name,t.duration FROM tbl_tvc_schedule as ts,tbl_client as c,tbl_tvc_slot as s,tbl_tvc as t WHERE ts.client_id=c.client_id AND ts.slot_id=s.slot_id AND ts.tvc_id=t.tvc_id AND  DATE(ts.schedule_date)= CURDATE()    AND  ts.publication_status=1 GROUP BY ts.schedule_id ORDER BY ts.tvc_order ASC";
                                $result = $conn->query($sql);
                            } else {
                                //echo $id;
                                $sql = "SELECT ts.*,c.client_name,s.slot_name,t.tvc_name,t.duration FROM tbl_tvc_schedule as ts,tbl_client as c,tbl_tvc_slot as s,tbl_tvc as t WHERE ts.client_id=c.client_id AND ts.slot_id=s.slot_id AND ts.tvc_id=t.tvc_id AND  DATE(ts.schedule_date)= CURDATE()    AND ts.slot_id = '$id'  AND ts.publication_status=1 GROUP BY ts.schedule_id ORDER BY ts.tvc_order ASC";
                                $result = $conn->query($sql);
                            }

                            $aql = "SELECT TIMEDIFF(slot_end_time,slot_start_time ) AS dif FROM tbl_tvc_slot WHERE slot_id =" . $id;
                            $results = $conn->query($aql);
                            $time_row = $results->fetch_assoc();

//var_dump($row);
                            function TimeToSec($time) {
                                $sec = 0;
                                foreach (array_reverse(explode(':', $time)) as $k => $v)
                                    $sec += pow(60, $k) * $v;
                                return $sec;
                            }
                            $time_diff = $time_row['dif'];
                            $second = TimeToSec($time_diff);
                            ?>
                            <table class=" table table-bordered table-condensed table-hover example" id="display_table">	

                                <thead>
                                    <tr>
                                        <th style="width:100px;"><input type="checkbox" class="checkb"  id="selecctall" />Select all</th>
                                        <th style="width:40px;">Sl no.</th>
                                        <th style="width:43%;">TVC Name</th>
                                        <th style="width:230px;">Claint Name</th>
                                        <th style="width:110px;">Schedule Date</th>                                      
                                        <th style="width:50px;" >Dur.</th>
                                           <th class="slotName" style="width:120px;" >Slot Name</th>
                                        <th>TVC Order</th>




                                    </tr>
                                </thead>
                            </table>
<?php
$sl_no = 1;
$video_sec = 0;
while ($roww = $result->fetch_assoc()) {
    $video_sec +=$roww['duration'];


    if (empty($roww)) {
        echo "<h4>" . " Playlist is empty ! " . "</h4>";
    } else {
        ?>
                                    <li id="<?php echo $roww['schedule_id']; ?>">
                                        <span class="sort" style=""></span>
                                        <img src="<?php echo BASE_URL ; ?>img/video-icon500px.png">
                                        <table  width="90%" style="border:1px solid #fff;" border="1">
                                            <tr align="left">
                                                <td style="width:40px;" ><?php echo $sl_no; ?></td>
                                                <td style="width:48%; height: 41px;"><input type="checkbox" class="checkb cvalue" name="selectedSchedule[]" value="<?php echo $roww['schedule_id']; ?>|<?php echo $roww['client_id']; ?>|<?php echo $roww['tvc_id']; ?>|<?php echo $roww['slot_id']; ?>|<?php echo $roww['tvc_order']; ?>">
        <?php echo $roww['tvc_name']; ?>
                                                </td>
                                                <td style="width:230px;"><?php echo $roww['client_name']; ?></td>
                                                <td style="width:110px;"><input type="hidden" id="slot_id" name="slot_id" value="<?php echo $roww['slot_id']; ?>">
        <?php echo $roww['schedule_date']; ?>
                                                </td>
                                                <td style="width:50px;" ><?php echo $roww['duration']; ?></td>
                                                  <td class="slotName" style="width:120px;"><?php echo $roww['slot_name'];?></td>  
                                                <td><?php echo $roww['tvc_order']; ?></td>
                                              
  
                                            </tr>
                                        </table> 

                                    </li>                  
        <?php
        $sl_no++;
    }
}
// echo $video_sec;
$remainingSec = $second - $video_sec;
$remainingMin = gmdate("H:i:s", $remainingSec);
echo "<h5 style='color:red;text-align:right;'>Remaining Time(অবশিষ্ট সময়):$remainingMin($remainingSec sec)</h5>";
?>
                        </ul>
                    </form>
                </div>
            </div>
        </div>


    </body>
</html>