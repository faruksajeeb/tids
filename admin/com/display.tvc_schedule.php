<?php
include('../../classes/dbConfig/config.php');
include_once('../../db/db_connect.php');
include("../../getDur/getid3/getid3.php");
$dt = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
$current_time = $dt->format('Y-m-d H:i:s ');

if (isset($_POST['btn-upload'])) {
    $company_id = $_POST['cname'];
    $tvc_id = $_POST['viedos'];
    // var_dump($tvc_id);
    $schedule_time = $_POST['datetimepicker'];
    $scheduled_time = explode(' ', $schedule_time);
    $slot_id = $_POST['slot_id'];
	$arr_key=array_keys($slot_id);
    $last_key = end($arr_key);
    //echo $last_key;
    //var_dump($slot_id);
//print_r($_POST);
    for ($i = 0; $i <= $last_key; $i++) {

        $sql = "INSERT INTO tbl_tvc_schedule(client_id,tvc_id,schedule_date,slot_id) VALUES($company_id,'$tvc_id','$scheduled_time[0]','" . $slot_id[$i] . "')";
        $query = $conn->query($sql);
    }
    //var_dump($query);

    $username = $_SESSION['user_name'];
    $ip_addr = $_SERVER['REMOTE_ADDR'];
    $auditQry = "INSERT into tbl_auditor(username,ipaddr,date_time,description,train_no,action)
	VALUES ('$username','$ip_addr','$current_time','Add into Commercial Schedule Display','$tvc_id','Add')";
    $audit_result = $conn->query($auditQry);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Insert videos</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8">
        <link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo BASE_URL; ?>admin/datetime/jquery.datetimepicker.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo BASE_URL; ?>css/jquery.dataTables.css" rel="stylesheet">
        <script language="javascript" type="text/javascript" src="<?php echo BASE_URL; ?>script/jquery-1.9.1.min.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo BASE_URL; ?>script/bootstrap.min.js"></script>
        <script type="text/javascript">

            $(document).ready(function () {
                $('select').change(getList);
                function getList() {
                    var url, target;
                    switch ($(this).attr('id'))
                    {
                        case 'cname':
                            if ($(this).val() == '')
                                return false;
                            url = 'dependable_tvc_list.php?find=videos&id=' + $(this).val();
                            target = '#viedos';
                            break;
                    }
                    $.get(url, {}, function (data)
                    {
                        $(target).html(data);
                    }
                    )
                }
            });



        </script>
        <script>
            $(document).ready(function () {
                $('#selectAll').click(function (event) {
                    if (this.checked) {
                        $('.insertCheck').each(function () {
                            this.checked = true;

                        });
                    } else {
                        $('.insertCheck').each(function () {
                            this.checked = false;
                        });
                    }
                });


            });
        </script>
        <script>
            $(document).ready(function () {
                $('#links ul li').click(function (e) {

                    $('#links ul li').removeClass('active');

                    var $this = $(this);
                    if (!$this.hasClass('active')) {
                        $this.addClass('active');
                    }
                    //e.preventDefault();
                });
            });
        </script>


        <style>
            body{}
            .middle{width:98%;height:auto;margin:0 auto;border-radius:10px;margin-top: 10px;
            }
            .middle h1{margin-top:0;font-size:22px;text-align:center;text-transform: uppercase;} 
            #insert_table{float:left;}
            thead{background-color:#ccc;}
            @media print {
                a:after { content:''; }
                a[href]:after { content: none !important; }

            }
            #latest {
                margin-right: 1cm;
            }
            #divSlot{
                width:100%;
                min-height:1200px;
                
            }
            iframe 
{
  overflow-x:hidden;
 overflow-Y:hidden;
}
        </style>

    </head>
    <body>

        <div class="middle" >
            <a href="display.tvc.php" class="btn btn-info btn-xs"><i class="fa fa-backward"></i> BACK</a>

            <a href="display.running_tvc_schedule.php" class="btn btn-success btn-sm pull-right" style="margin-right:20px;"><img src="<?php echo BASE_URL; ?>img/ajax-loader.gif" width="30px" height="20px" />Running Slot / Schedule</a>

            <h1 class="page-header">TVC Schedule</h1>
            <hr/>
            <div class="row">
                <div class="col-md-3" style="background-color: #cccccc; border-radius: 5px; border: 3px inset #000000">
                    <h1 style="font-weight:bold; margin-top: 10px;">Add Schedule</h1>
                    <form name="form1" id="form1" method="post" action=""  enctype="multipart/form-data">
                        <table width="100%" class="table-condensed table-hover " id="insert_table">
                            <tr>

                                <td>
                                    <select name="cname"  id="cname" class="form-control" required>
                                        <option value="">Select client name</option>
                                        <?php
                                        $q = "select * from tbl_client WHERE publication_status=1";
                                        $rest = $conn->query($q);
                                        while ($row = $rest->fetch_row()) {
                                            ?>
                                            <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                        <?php }
                                        ?>
                                    </select>

                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <select name="viedos"  id="viedos" class="form-control">
                                        <option value="">Select tvc</option>			
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    $qqq = "select * from tbl_tvc_schedule ORDER BY schedule_id DESC LIMIT 1";
                                    $resst = $conn->query($qqq);
                                    $rowww = $resst->fetch_assoc();
                                    ?>
                                    <input type="text" value="<?php echo $rowww['schedule_date']; ?>" id="datetimepicker" name="datetimepicker"  class="form-control"/>

                                </td>
                            </tr>
                            <!--slot-->
                            <tr><td><input type="checkbox" name="selectAll" class="selectAll" id="selectAll"><b>Select All Slot</b></td></tr>
                            <tr>
                                <td>
                                    <?php
                                    $q = "select * from tbl_tvc_slot";
                                    $rest = $conn->query($q);
                                    $rows = $rest->fetch_all();
									$arry_key=array_keys($rows);
                                    $last_key = end($arry_key);
                                    for ($i = 0; $i < $last_key; $i++) {
                                        ?>
                                        <div class="checkbox"><label> <input  type="checkbox" id="slot_id" name="slot_id[]" value="<?php echo $rows["$i"][0] ?>"  class="checkbox insertCheck" /><?php echo $rows["$i"][1] ?>(<?php echo $rows["$i"][2] . "-" . $rows["$i"][3] ?>)</label></div>

                                    <?php }
                                    ?>


                                </td>
                            </tr>

                            <tr>     

                                <td><input type="submit" name="btn-upload"  id="btn-upload" value="ADD" class="btn btn-success btn-sm form-control"/></td>
                            </tr>

                        </table>


                    </form>
                </div>
                <?php
                $q = "SELECT * FROM tbl_tvc_slot";
                $rest = $conn->query($q);
                $row = $rest->fetch_all();
                $arry_key=array_keys($rows);
                $last_keys = end($arry_key);
                $last_key = $last_keys + 1;
                //var_dump($last_key);
                ?>

                <div id="links" class="col-md-9" style="//background-color: #FFFAFA;">
                    <ul class="nav nav-tabs">


<?php for ($i = 1; $i <= $last_key; $i++) { ?>

                            <li  id='<?php echo "list" . $i ?>'><a id='<?php echo "slot" . $i ?>'   href='<?php echo "slot" . "." . "php" ?>?mumber=<?php echo $i ?>' data-toggle="tab" target="divSlot"><?php echo "Slot-" . $i ?></a></li>
                            <script>            $(document).ready(function () {
                                    $(window).load(function () {
                                        var url = $('#slot1').attr('href');
                                        window.open(url, 'divSlot');
                                        $('#list1').addClass("active");
                                    });

                                    var sl = '<?php echo "slot" . $i ?>';
    //var li='<?php echo "list" . $i ?>';


                                    $('#' + sl).click(function () {
                                        var url = $(this).attr('href');
                                        window.open(url, 'divSlot');
                                        $(this).tab('show');
                                        //alert(li);
                                        //$('#'+li).removeClass("active");
                                        //$('#'+li).addClass("active");


                                    });




                                });</script>
<?php } ?>
                    </ul>

                    <div class="tab-content" style="">
                        <iframe id="divSlot" name="divSlot"  frameborder="0"  ></iframe>

                    </div>

                </div>
            </div>
        </div>
        <script src="<?php echo BASE_URL; ?>admin/datetime/jquery.js"></script>
        <script src="<?php echo BASE_URL; ?>admin/datetime/jquery.datetimepicker.js"></script>
        <script src="<?php echo BASE_URL; ?>script/jquery.dataTables.min.js" type="text/javascript"></script>
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
        </script>
        <script>
            $(document).ready(function () {
                $('.example').dataTable();
            });
        </script>
    </body>
</html>
