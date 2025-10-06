<?php
$title="ছাড়ার সময়সূচী";
$class='Departure';
require_once("../../classes/class.".$class.".php");
foreach($dep_obj->showData("tbl_setting") as $value):
    extract($value);
require_once '../parmitted.php';
include_once('../../db/db_connect.php');
if (isset($_SESSION['uid']) == false) {
    header('location:index.php');
}
$query = "SELECT d_s.*,d_t.train_no,d_t.train_name FROM tbl_departure_schedule AS d_s,tbl_train_list_departure AS d_t WHERE d_s.departure_train_id=d_t.departure_train_id ORDER BY schedule_time ASC";
$rst =$conn->query($query);
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'schedule') {
        $id = $_GET['id'];
        $train_no = $_GET['train_no'];
        $train_name = $_GET['train_name'];
        $platform_no = $_GET['platform_no'];
        if (!empty($platform_no)) {
            $plt_no = $platform_no;
        } else {
            $plt_no = "__";
        }
        $destination = $_GET['coming_from'];
        $schedule_time = $_GET['schedule_time'];
        $probable_time = $_GET['probable_time'];
        if (!empty($probable_time)) {
            $pb_time = $probable_time;
        } else {
            $pb_time = "__:__";
        }
        $username = $_SESSION['user_name'];
        $ip_addr = $_SERVER['REMOTE_ADDR'];
        $auditQry = "INSERT INTO tbl_auditor(username,ipaddr,description,train_no,action) VALUES ('$username','$ip_addr','Add into departure Schedule Display','" . $id . "','Add')";
        $conn->query($auditQry);
        $tidsQry = "INSERT INTO tbl_tids_report(user_name,ip_address,description,action) VALUES ('$username','$ip_addr','$train_name($train_no)  $destination স্টেশন এর উদ্দেশে  নির্ধারিত সময় $schedule_time টা সম্ভাব্য সময় $pb_time টায় $plt_no নং প্লাটফর্ম   থেকে ছেড়ে যাবে ।', 'Add')";
        $conn->query($tidsQry);
        $x = "UPDATE tbl_departure_schedule SET status=1 WHERE departure_schedule_id='" . $id . "'";
        $conn->query($x);
        header("location:display.departure_schedule.php");
    } else if ($_GET['status'] == 'cancel') {
        $id = $_GET['id'];
        $train_no = $_GET['train_no'];
        $train_name = $_GET['train_name'];
        $platform_no = $_GET['platform_no'];
        if (!empty($platform_no)) {
            $plt_no = $platform_no;
        } else {
            $plt_no = "__";
        }
        $destination = $_GET['coming_from'];
        $schedule_time = $_GET['schedule_time'];
        $probable_time = $_GET['probable_time'];
        if (!empty($probable_time)) {
            $pb_time = $probable_time;
        } else {
            $pb_time = "__:__";
        }
        $username = $_SESSION['user_name'];
        $ip_addr = $_SERVER['REMOTE_ADDR'];
        $auditQry = "INSERT INTO tbl_auditor(username,ipaddr,description,train_no,action) VALUES ('$username','$ip_addr','Cancel from departure Schedule Display','" . $id . "','cancel')";
        $conn->query($auditQry);
        $tidsQry = "INSERT INTO tbl_tids_report(user_name,ip_address,description,action) VALUES ('$username','$ip_addr','$train_name($train_no)  $destination স্টেশন এর উদ্দেশে  নির্ধারিত সময় $schedule_time টা সম্ভাব্য সময় $pb_time টায় $plt_no নং প্লাটফর্ম   থেকে ছেড়ে যাবে । ', 'cancel')";
        $conn->query($tidsQry);
        $x = "UPDATE tbl_departure_schedule SET status=0 WHERE departure_schedule_id='" . $id . "' ";
        $conn->query($x);
        header("location:display.departure_schedule.php");
    } else if ($_GET['status'] == 'delete') {
        $id = $_GET['id'];
        $train_no = $_GET['train_no'];
        $train_name = $_GET['train_name'];
        $platform_no = $_GET['platform_no'];
        if (!empty($platform_no)) {
            $plt_no = $platform_no;
        } else {
            $plt_no = "__";
        }
        $destination = $_GET['coming_from'];
        $schedule_time = $_GET['schedule_time'];
        $probable_time = $_GET['probable_time'];
        if (!empty($probable_time)) {
            $pb_time = $probable_time;
        } else {
            $pb_time = "__:__";
        }
        $username = $_SESSION['user_name'];
        $ip_addr = $_SERVER['REMOTE_ADDR'];
        $auditQry = "INSERT INTO tbl_auditor(username,ipaddr,description,train_no,action) VALUES ('$username','$ip_addr','Delete from departure Schedule Table','" . $id . "','cancel')";
        $conn->query($auditQry);
        $tidsQry = "INSERT INTO tbl_tids_report(user_name,ip_address,description,action) VALUES ('$username','$ip_addr','$train_name($train_no)  $destination স্টেশন এর উদ্দেশে  নির্ধারিত সময় $schedule_time টা সম্ভাব্য সময় $pb_time টায় $plt_no নং প্লাটফর্ম   থেকে ছেড়ে যাবে ।', 'delete')";
        $conn->query($tidsQry);
        $q = "DELETE FROM tbl_departure_schedule WHERE departure_schedule_id='" . $id . "'";
        $conn->query($q);
        header("location:display.departure_schedule.php");
    }
}
?>
<!DOCTYPE html>
<html  lang="bn" >
    <head>
        <title>ট্রেন ছাড়ার সময়সূচি</title>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <script src="../../script/jquery.js" type="text/javascript"></script>
        <link href="../../css/jquery.dataTables.css" rel="stylesheet">
        <script src="../../script/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../script/main.js" type="text/javascript"></script>
        <script>
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').focus()
            })
        </script>
        <script>
            function check_detele() {
                var check = confirm('Are you sure to delete this !!');
                if (check) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
        <style>
            @font-face {
                font-family: myFirstFont;
                src: url(../fonts/SolaimanLipi.ttf);
            }

            body{
                //margin:0 auto;
                font-family: myFirstFont;
            }
            /*tr:nth-child(odd){background-color:#D9EDF7;}
            tr:nth-child(even){background-color:#FCF8E3;}*/
            th{background-color:#DFF0D8;}
            .activebutton{ margin:0 auto; margin-top:7px; background-color:#009900; height:17px; line-height:17px; vertical-align:middle; width:17px; border-radius:50%; text-align:center;}
            .deactivebutton{ margin:0 auto; margin-top:7px; background-color:#FF0000; height:17px; width:17px;  line-height:17px; vertical-align:middle; border-radius:50%;text-align:center;}
            .fa-times{ color:#FFFFFF;}
            .fa-check{ color:#FFFFFF;}
            table{ text-align:center}
            th{ text-align:center}
            a{ margin-right:8px;}
            /*
            .middle{height:auto;width:80%;margin:0 auto;border-radius:10px;
            padding:20px;margin-top:50px;
            box-shadow:-2px 2px 15px #ccc,2px 2px 15px #ccc,2px -2px 15px #ccc,-2px -2px 15px #ccc;
            }
            */
            .middle h1{margin-top:0;font-size:22px;text-transform: uppercase;} 

        </style>
    </head>
    <body>
        <div class="middle" >            
            <h2 class="page-header" style="text-align:center"><?php echo $tids_departure_heading;   ?> </h2>
            <hr/>
            <form name="form1" method="post" action=""  >
                <a href="add.departure_schedule.php" class="btn btn-info btn-lg"><i class="fa fa-plus"></i> Departure Schedule</a><br/><br/>
                <div class="table-responsive">
                    <table id="myTable" class=" table table-bordered table-condensed table-hover tablesorter example">
                        <thead> 
                            <tr>

                                <th>Sl No</th>
                                <th><?php echo $train_no; ?></th>
                                <th><?php echo $train_name; ?></th>
                                <th><?php echo $platform; ?></th>
                                <th><?php echo $destination; ?></th>
                                <th><?php echo $dep_schedule_time; ?></th>
                                <th> <?php echo $departure_probable_time; ?></th>
                                <th>Status</th>
                                <th>Action</th>	
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sl_no = 1;
                            while ($row = $rst->fetch_assoc()) {
                                ?>
                                <tr>

                                    <td><?php echo $sl_no; ?></td>
                                    <td><?php echo $row['train_no'] ?></td>
                                    <td><?php echo $row['train_name'] ?></td>
                                    <td><?php echo $row['platform_no'] ?></td>
                                    <td><?php echo $row['destination'] ?></td>
                                    <td><?php echo $row['schedule_time'] ?></td>
                                    <td><?php echo $row['probable_time'] ?></td>
                                    <td>
                                        <?php
                                        if ($row['status'] == 1) {
                                            echo "<div class='activebutton'><i class='fa fa-check'></i></div>";
                                        } else {
                                            echo "<div class='deactivebutton'><i class='fa fa-times'></i></div>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="edit_departure_schedule.php?id=<?php echo $row['departure_schedule_id']; ?>&
                                           train_no=<?php echo $row['train_no'] ?>&
                                           train_name=<?php echo $row['train_name'] ?>&
                                           platform_no=<?php echo $row['platform_no'] ?>&
                                           destination=<?php echo $row['destination'] ?>&
                                           schedule_time=<?php echo $row['schedule_time'] ?>&
                                           probable_time=<?php echo $row['probable_time'] ?>" class="btn btn-info btn-sm"><span class="fa fa-pencil-square-o"> Update</span></a>
                                           <?php
                                           if ($row['status'] == 0) {
                                               ?>
                                            <a href="?status=schedule&id=<?php echo $row['departure_schedule_id']; ?>&
                                               train_no=<?php echo $row['train_no'] ?>&
                                               train_name=<?php echo $row['train_name'] ?>&
                                               platform_no=<?php echo $row['platform_no'] ?>&
                                               destination=<?php echo $row['destination'] ?>&
                                               schedule_time=<?php echo $row['schedule_time'] ?>&
                                               probable_time=<?php echo $row['probable_time'] ?>" class="btn btn-success  btn-sm" title="Schedule Now"> <span class="fa fa-check" ></span></a>
                                               <?php
                                           } else {
                                               ?>
                                            <a href="?status=cancel&id=<?php echo $row['departure_schedule_id']; ?>&
                                               train_no=<?php echo $row['train_no'] ?>&
                                               train_name=<?php echo $row['train_name'] ?>&
                                               platform_no=<?php echo $row['platform_no'] ?>&
                                               destination=<?php echo $row['destination'] ?>&
                                               schedule_time=<?php echo $row['schedule_time'] ?>&
                                               probable_time=<?php echo $row['probable_time'] ?>" class="btn btn-warning  btn-sm" title="Cancel"><span class="fa fa-times" ></span></a>
                                               <?php
                                           }
                                           ?>
                                        <a href="?status=delete&id=<?php echo $row['departure_schedule_id']; ?>&
                                           train_no=<?php echo $row['train_no'] ?>&
                                           train_name=<?php echo $row['train_name'] ?>&
                                           platform_no=<?php echo $row['platform_no'] ?>&
                                           destination=<?php echo $row['destination'] ?>&
                                           schedule_time=<?php echo $row['schedule_time'] ?>&
                                           probable_time=<?php echo $row['probable_time'] ?>" class="btn btn-danger  btn-sm" onclick="return check_detele();
                                                                                "><span class="fa fa-trash-o"> Delete</span></a>
                                    </td>
                                </tr>
                                <?php
                                $sl_no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </body>

</html> 
<?php
endforeach;
?>


























