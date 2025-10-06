<?php
$title = "পৌঁছার সময়সূচী";
$class = 'Arrival';
require_once("../../classes/class." . $class . ".php");
foreach ($avl_obj->showData("tbl_setting") as $value):
    extract($value);
    $refresh_time = $tids_refresh_duration * 60;
    require_once '../parmitted.php';
    include_once('../../db/db_connect.php');
    $dt = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
    $current_time = $dt->format(' H:i:s d-M-y ');
    if (isset($_SESSION['uid']) == false) {
        header('location:../index.php');
    }
    $query = "SELECT a_s.*,a_t.train_no,a_t.train_name FROM tbl_arrival_schedule AS a_s,tbl_train_list_arrival AS a_t WHERE a_s.arrival_train_id=a_t.arrival_train_id ORDER BY schedule_time ASC";
    $rst = $conn->query($query);
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
            $coming_from = $_GET['coming_from'];
            $schedule_time = $_GET['schedule_time'];
            $probable_time = $_GET['probable_time'];
            if (!empty($probable_time)) {
                $pb_time = $probable_time;
            } else {
                $pb_time = "__:__";
            }
            $username = $_SESSION['user_name'];
            $ip_addr = $_SERVER['REMOTE_ADDR'];
            $auditQry = "INSERT INTO tbl_auditor(username,ipaddr,description,train_no,action) VALUES ('$username','$ip_addr','Train no $train_no add into Arrival Schedule Display','" . $id . "','Add')";
            $conn->query($auditQry);
            $tidsQry = "INSERT INTO tbl_tids_report(user_name,ip_address,description,action) VALUES ('$username','$ip_addr','$train_name($train_no)  $coming_from স্টেশন থেকে  নির্ধারিত সময় $schedule_time টা সম্ভাব্য সময় $pb_time টায় $plt_no নং প্লাটফর্ম   এ পৌঁছাবে ।', 'Add')";
            $conn->query($tidsQry);
            $x = "UPDATE tbl_arrival_schedule SET status=1 WHERE arrival_schedule_id='" . $id . "'";
            $conn->query($x);
            header("location:display.arrival_schedule.php");
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
            $coming_from = $_GET['coming_from'];
            $schedule_time = $_GET['schedule_time'];

            $probable_time = $_GET['probable_time'];
            if (!empty($probable_time)) {
                $pb_time = $probable_time;
            } else {
                $pb_time = "__:__";
            }
            $username = $_SESSION['user_name'];
            $ip_addr = $_SERVER['REMOTE_ADDR'];
            $auditQry = "INSERT INTO tbl_auditor(username,ipaddr,description,train_no,action) VALUES ('$username','$ip_addr','Train no  $train_no  cancel from Arrival Schedule Display','" . $id . "','cancel')";
            $conn->query($auditQry);
            $tidsQry = "INSERT INTO tbl_tids_report(user_name,ip_address,description,action) VALUES ('$username','$ip_addr','$train_name($train_no)   $coming_from স্টেশন থেকে  নির্ধারিত সময় $schedule_time টা সম্ভাব্য সময় $pb_time টায় $plt_no নং প্লাটফর্ম   এ পৌঁছাবে ।','cancel')";
            $conn->query($tidsQry);
            $x = "UPDATE tbl_arrival_schedule SET status=0 WHERE arrival_schedule_id='" . $id . "' ";
            $conn->query($x);
            header("location:display.arrival_schedule.php");
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
            $coming_from = $_GET['coming_from'];
            $schedule_time = $_GET['schedule_time'];
            $probable_time = $_GET['probable_time'];
            if (!empty($probable_time)) {
                $pb_time = $probable_time;
            } else {
                $pb_time = "__:__";
            }
            $username = $_SESSION['user_name'];
            $ip_addr = $_SERVER['REMOTE_ADDR'];
            $auditQry = "INSERT INTO tbl_auditor(username,ipaddr,description,train_no,action) VALUES ('$username','$ip_addr','Delete from Arrival Schedule Table','" . $id . "','cancel')";
            $conn->query($auditQry);
            $tidsQry = "INSERT INTO tbl_tids_report(user_name,ip_address,description,action) VALUES ('$username','$ip_addr','$train_name($train_no)  $coming_from স্টেশন থেকে  নির্ধারিত সময় $schedule_time টা সম্ভাব্য সময় $pb_time টায় $plt_no নং প্লাটফর্ম   এ পৌঁছাবে ।','delete')";
            $conn->query($tidsQry);
            $q = "delete from tbl_arrival_schedule WHERE arrival_schedule_id='" . $id . "'";
            $conn->query($q);
            header("location:display.arrival_schedule.php");
        }
    }
    ?>
    <!DOCTYPE html>
    <html  lang="bn" >
        <head>
            <title><?php echo $title; ?></title>
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
            <div id="page-content">
                <h2 class="page-header" style="text-align:center"><?php echo $tids_arrival_heading; ?> </h2>
                <hr/>

                <a href="add.arrival_schedule.php" class="btn btn-info btn-lg"><i class="fa fa-plus"></i> Arrival Schedule</a><br/>
                <a class="rtf-export pull-right" href="javascript:void(0)"> Export as .rtf </a> 
                <table id="myTable" class=" table table-bordered table-condensed table-hover tablesorter example">
                    <thead> 
                        <tr>

                            <th>Sl No</th>
                            <th><?php echo $train_no; ?></th>
                            <th><?php echo $train_name; ?></th>
                            <th><?php echo $platform; ?></th>
                            <th><?php echo $initial_station; ?></th>
                            <th><?php echo $arr_schedule_time; ?></th>
                            <th><?php echo $arrival_probable_time; ?></th>
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
                                <td><?php echo $row['coming_from'] ?></td>
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
                                    <a href="edit_arrival_schedule.php?id=<?php echo $row['arrival_schedule_id']; ?>&
                                       train_no=<?php echo $row['train_no'] ?>&

                                       train_name=<?php echo $row['train_name'] ?>&
                                       platform_no=<?php echo $row['platform_no'] ?>&
                                       coming_from=<?php echo $row['coming_from'] ?>&
                                       schedule_time=<?php echo $row['schedule_time'] ?>&
                                       probable_time=<?php echo $row['probable_time'] ?>" class="btn btn-info btn-sm"><span class="fa fa-pencil-square-o"> Update</span></a>
                                       <?php
                                       if ($row['status'] == 0) {
                                           ?>
                                        <a href="?status=schedule&
                                           id=<?php echo $row['arrival_schedule_id']; ?>&
                                           train_no=<?php echo $row['train_no'] ?>&
                                           train_name=<?php echo $row['train_name'] ?>&
                                           platform_no=<?php echo $row['platform_no'] ?>&
                                           coming_from=<?php echo $row['coming_from'] ?>&
                                           schedule_time=<?php echo $row['schedule_time'] ?>&
                                           probable_time=<?php echo $row['probable_time'] ?>
                                           " class="btn btn-success  btn-sm" title="Schedule Now"> <span class="fa fa-check" ></span></a>
                                           <?php
                                       } else {
                                           ?>
                                        <a href="?status=cancel&id=<?php echo $row['arrival_schedule_id']; ?>&train_no=<?php echo $row['train_no'] ?>&train_name=<?php echo $row['train_name'] ?>&platform_no=<?php echo $row['platform_no'] ?>&coming_from=<?php echo $row['coming_from'] ?>&schedule_time=<?php echo $row['schedule_time'] ?>&probable_time=<?php echo $row['probable_time'] ?>
                                           " class="btn btn-warning  btn-sm" title="Cancel"><span class="fa fa-times" ></span></a>
                                           <?php
                                       }
                                       ?>
                                    <a href="?status=delete&
                                       id=<?php echo $row['arrival_schedule_id']; ?>&
                                       train_no=<?php echo $row['train_no'] ?>&

                                       train_name=<?php echo $row['train_name'] ?>&
                                       platform_no=<?php echo $row['platform_no'] ?>&
                                       coming_from=<?php echo $row['coming_from'] ?>&
                                       schedule_time=<?php echo $row['schedule_time'] ?>&
                                       probable_time=<?php echo $row['probable_time'] ?>
                                       " class="btn btn-danger  btn-sm" onclick="return check_detele();
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
        </body>
        <script src="../script/jquery.min.js"></script> 
        <script src="export/FileSaver.js"></script> 
        <script >
                               if (typeof jQuery !== "undefined" && typeof saveAs !== "undefined") {
                                   (function ($) {
                                       $.fn.rtfExport = function (fileName) {
                                           fileName = typeof fileName !== 'undefined' ? fileName : "tids-info";
                                           var static = {
                                               mhtml: {
                                                   top: "Mime-Version: 1.0\nContent-Base: " + location.href + "\nContent-Type: Multipart/related; boundary=\"NEXT.ITEM-BOUNDARY\";type=\"text/html\"\n\n--NEXT.ITEM-BOUNDARY\nContent-Type: text/html; charset=\"utf-8\"\nContent-Location: " + location.href + "\n\n<!DOCTYPE html>\n<html>\n_html_</html>",
                                                   head: "<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n<style>\n_styles_\n</style>\n</head>\n",
                                                   body: "<body>_body_</body>"
                                               }
                                           };
                                           var options = {
                                               maxWidth: 624
                                           };
                                           // Clone selected element before manipulating it
                                           var markup = $(this).clone();

                                           // Remove hidden elements from the output
                                           markup.each(function () {
                                               var self = $(this);
                                               if (self.is(':hidden'))
                                                   self.remove();
                                           });

                                           // Embed all images using Data URLs
                                           var images = Array();
                                           var img = markup.find('img');
                                           for (var i = 0; i < img.length; i++) {
                                               // Calculate dimensions of output image
                                               var w = Math.min(img[i].width, options.maxWidth);
                                               var h = img[i].height * (w / img[i].width);
                                               // Create canvas for converting image to data URL
                                               $('<canvas>').attr("id", "jQuery-rtf-export_img_" + i).width(w).height(h).insertAfter(img[i]);
                                               var canvas = document.getElementById("jQuery-rtf-export_img_" + i);
                                               canvas.width = w;
                                               canvas.height = h;
                                               // Draw image to canvas
                                               var context = canvas.getContext('2d');
                                               context.drawImage(img[i], 0, 0, w, h);
                                               // Get data URL encoding of image
                                               var uri = canvas.toDataURL();
                                               $(img[i]).attr("src", img[i].src);
                                               img[i].width = w;
                                               img[i].height = h;
                                               // Save encoded image to array
                                               images[i] = {
                                                   type: uri.substring(uri.indexOf(":") + 1, uri.indexOf(";")),
                                                   encoding: uri.substring(uri.indexOf(";") + 1, uri.indexOf(",")),
                                                   location: $(img[i]).attr("src"),
                                                   data: uri.substring(uri.indexOf(",") + 1)
                                               };
                                               // Remove canvas now that we no longer need it
                                               canvas.parentNode.removeChild(canvas);
                                           }

                                           // Prepare bottom of mhtml file with image data
                                           var mhtmlBottom = "\n";
                                           for (var i = 0; i < images.length; i++) {
                                               mhtmlBottom += "--NEXT.ITEM-BOUNDARY\n";
                                               mhtmlBottom += "Content-Location: " + images[i].contentLocation + "\n";
                                               mhtmlBottom += "Content-Type: " + images[i].contentType + "\n";
                                               mhtmlBottom += "Content-Transfer-Encoding: " + images[i].contentEncoding + "\n\n";
                                               mhtmlBottom += images[i].contentData + "\n\n";
                                           }
                                           mhtmlBottom += "--NEXT.ITEM-BOUNDARY--";

                                           //TODO: load css from included stylesheet
                                           var styles = "";

                                           // Aggregate parts of the file together 
                                           var fileContent = static.mhtml.top.replace("_html_", static.mhtml.head.replace("_styles_", styles) + static.mhtml.body.replace("_body_", markup.html())) + mhtmlBottom;

                                           // Create a Blob with the file contents
                                           var blob = new Blob([fileContent], {
                                               type: "application/msrtf;charset=utf-8"
                                           });
                                           saveAs(blob, fileName + ".rtf");
                                       };
                                   })(jQuery);
                               } else {
                                   if (typeof jQuery === "undefined") {
                                       console.error("jQuery rtf Export: missing dependency (jQuery)");
                                   }
                                   if (typeof saveAs === "undefined") {
                                       console.error("jQuery rtf Export: missing dependency (FileSaver.js)");
                                   }
                                   ;
                               }

        </script> 
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $("a.rtf-export").click(function (event) {
                    $("#page-content").rtfExport();
                });
            });
        </script>
    </html>
    <?php
endforeach;
?>


























