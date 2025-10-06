<?php
include_once('../db/db_connect.php');
$dt = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
$current_date = $dt->format('Y-m-d');
$current_time = $dt->format('H:i:s');
?>
<!DOCTYPE html PUBLIC>
<html>
    <head>
        <title>ARTS tv</title>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Video Player StyelSheet -->
        <link rel="shortcut icon" href="../img/railwaytv_icon.ico" type="image/x-icon">
        <link rel="icon" href="../img/railwaytv_icon.ico" type="image/x-icon">
        <link href="video-player.css" type="text/css" rel="stylesheet" title="Video Player" />          

        <script type="text/javascript" src="../script/jquery-1.9.1.min.js"></script>

        <script>
            $(document).ready(function () {
                setInterval(function () {
                    $('#time').load('../clock.php');
                }, 1000);
                setInterval('dispalyNewsTickers()', 1000);
            });
            function dispalyNewsTickers() {
                $.ajax({//create an ajax request to load_page.php
                    type: "GET",
                    url: "tvc_news_ticker.php",
                    dataType: "html", //expect html to be returned                
                    success: function (response) {
                        $("#tvc_news_tickers").html(response);
                        //alert(response);
                    }

                });
            }
   </script>
        <style>
            html, body {margin:0;padding:0;height:100%;}
            img{
                opacity:0.8;
                position:fixed;
                height:150px;
                top:-10px;
                right:0px;
                margin-top:0px;
                z-index:9999;	
            }
            #tvc_news_tickers{
                padding:10px 20px;
                border-radius: 5px;
                 background-color:#003366;
                font-size:30px;
            }


        </style>
    </head>
    <body onLoad="currentDateTime();setInterval('slotChange()', 1000);onload(); setInterval('Intermission()', 1000);" >

        <video  id="idle_video" height="100%" width="100%"  onended="onVideoEnded();" playing>
            <!-- Video Display Here -->
        </video>
        <div id="intermission_message" style="visibility: hidden">
            <center> <div  id="message"  class="demo"   >
         </div></center>
        </div>        
        <?php 
        include_once('video_player.php');
                //echo $videoArray[0];
        if (isset($videoArray[0])) {
         ?>
        <img src="../img/arts_tv_logo.png" />
    <div  class="bottom" >		 
        <div><marquee  scrollamount="10" ><span id="tvc_news_tickers" class="marquee_bottom"></span></marquee></div>	
    </div>
   <!-- <div id="time">
    </div> -->
<?php } else { ?>
    <style>
        body{            
            background-image: url('../img/arts_tv_logo.jpg'); 
        }
    </style>
<?php } ?>
        <script  type="text/javascript" >
            //alert(currentDateTime());
            var schedule_list = <?php echo json_encode($scheduleIdArray) ?>;
            var video_list = <?php echo json_encode($videoArray) ?>;
            //var video_list      = ["a.mp4","b.mp4"];
            //alert(video_list);
            var video_index = 0;
            var video_player = null;
            video_player = document.getElementById("idle_video");
            //alert(video_player.currentSrc);
            if (video_list == '') {
                location = "index.php";
            }
            function currentDateTime() {
                var currentDate = new Date();
                var curDay = currentDate.getDate();     // Get current date
                var curMonth = currentDate.getMonth() + 1; // current month
                var curYear = currentDate.getFullYear();
                if (curDay < 10)
                    curDay = "0" + curDay;
                if (curMonth < 10)
                    curMonth = "0" + curMonth;
                if (curYear < 10)
                    curYear = "0" + curYear;
                var cDate = curDay + "/" + curMonth + "/" + curYear;
                var curSecs = currentDate.getSeconds();
                var curHour = currentDate.getHours();
                var curMin = currentDate.getMinutes();
                if (curSecs < 10)
                    curSecs = "0" + curSecs;
                if (curMin < 10)
                    curMin = "0" + curMin;
                if (curHour < 10)
                    curHour = "0" + curHour;
                var time = curHour + ":" + curMin + ":" + curSecs;
                var playing_time = cDate + " " + time;
                return playing_time;
            }

            function onload() {
                console.log("body loaded");
                video_player.setAttribute("src", video_list[video_index]);
                //video_player.setAttribute("type",'video/flv');
                video_player.play();
                var current_schedule = schedule_list[video_index];
                var current_time = currentDateTime();

                $.ajax({
                    url: "insert_report.php",
                    type: "POST",
                    cache: false,
                    data: {
                        n1: current_schedule,
                        n2: current_time
                    }
                });
            }
            function onVideoEnded() {
                console.log("video ended");
                if (video_index < video_list.length - 1) {
                    video_index++;
                } else if (video_index === video_list.length - 1) {
                    location = "index.php";
                    video_index = '';
                } else {
                    video_index = 0;
                }
                video_player.setAttribute("src", video_list[video_index]);
                video_player.play();
                var current_schedule = schedule_list[video_index];
                var current_timee = currentDateTime();
                $.ajax({
                    url: "insert_report.php",
                    type: "POST",
                    cache: false,
                    data: {
                        n1: current_schedule,
                        n2: current_timee
                    }
                });
            }

            function Intermission() {
                var currentDate = new Date();
                curSecs = currentDate.getSeconds();
                curHour = currentDate.getHours();
                curMin = currentDate.getMinutes();
                if (curSecs < 10)
                    curSecs = "0" + curSecs;
                if (curMin < 10)
                    curMin = "0" + curMin;
                if (curHour < 10)
                    curHour = "0" + curHour;
                time = curHour + ":" + curMin + ":" + curSecs;
                //alert(time);
                /*mid-night Intermission */
<?php
$sql = "SELECT * FROM  tbl_tvc_intermission_time WHERE intermission_id=1 AND publication_status=1";
$row = $conn->query($sql);
$result_midnignt = $row->fetch_assoc();
?>
        if (time > "<?php echo $result_midnignt['start_time']; ?>" && time < "<?php echo $result_midnignt['end_time']; ?>") {
            location = "default.php";
        }
//Start Fhojor Section
<?php
$sql_fhojor = "SELECT * FROM tbl_tvc_intermission_time WHERE intermission_id=6 AND publication_status=1";
$fhojor = $conn->query($sql_fhojor);
$result_fhojor = $fhojor->fetch_assoc();
?>
                if (time > "<?php echo $result_fhojor['start_time']; ?>" && time < "<?php echo $result_fhojor['end_time']; ?>") {
                    video_player.pause();
                    //var message = "ফজরের নামাজের বিরতি";
                    var message = "<?php echo $result_fhojor['description']; ?>";
                    document.getElementById("message").innerHTML = message;
                    document.getElementById("intermission_message").style.visibility = "visible";
                }
                if (time === "<?php echo $result_fhojor['end_time']; ?>") {
                    video_player.play();
                    var message = "";
                    document.getElementById("message").innerHTML = message;
                    document.getElementById("intermission_message").style.visibility = "hidden";

                }
                //End Fojor Section
                //Start Johor Section
<?php
$sql_johor = "SELECT * FROM tbl_tvc_intermission_time WHERE intermission_id=2 AND publication_status=1";
$johor = $conn->query($sql_johor);
$result_johor = $johor->fetch_assoc();
?>
                if (time > "<?php echo $result_johor['start_time']; ?>" && time < "<?php echo $result_johor['end_time']; ?>") {
                    video_player.pause();
                    //var message = "জোহরের নামাজের বিরতি";
                    var message = "<?php echo $result_johor['description']; ?>";
                    document.getElementById("message").innerHTML = message;
                    document.getElementById("intermission_message").style.visibility = "visible";
                }
                if (time === "<?php echo $result_johor['end_time']; ?>") {
                    video_player.play();
                    var message = "";
                    document.getElementById("message").innerHTML = message;
                    document.getElementById("intermission_message").style.visibility = "hidden";
                }
                //End Johor Section ** Start Asor section
<?php
$sql_achor = "SELECT * FROM tbl_tvc_intermission_time WHERE intermission_id=3 AND publication_status=1";
$achor = $conn->query($sql_achor);
$result_achor = $achor->fetch_assoc();
?>
                if (time > "<?php echo $result_achor['start_time']; ?>" && time < "<?php echo $result_achor['end_time']; ?>") {
                    video_player.pause();
                    //var message = "আসরের নামাজের বিরতি";
                    var message = "<?php echo $result_achor['description']; ?>";
                    document.getElementById("message").innerHTML = message;
                    document.getElementById("intermission_message").style.visibility = "visible";
                }
                if (time === "<?php echo $result_achor['end_time']; ?>") {
                    video_player.play();
                    var message = "";
                    document.getElementById("message").innerHTML = message;
                    document.getElementById("intermission_message").style.visibility = "hidden";
                }
                //End Asor Section ** Start Magrib section
<?php
$sql_magrib = "SELECT * FROM tbl_tvc_intermission_time WHERE intermission_id=4 AND publication_status=1";
$magrib = $conn->query($sql_magrib);
$result_magrib = $magrib->fetch_assoc();
?>
                if (time > "<?php echo $result_magrib['start_time']; ?>" && time < "<?php echo $result_magrib['end_time']; ?>") {
                    video_player.pause();
                    //var message = "মাগরিবের নামাজের বিরতি";
                    var message = "<?php echo $result_magrib['description']; ?>";
                    document.getElementById("message").innerHTML = message;
                    document.getElementById("intermission_message").style.visibility = "visible";
                }
                if (time === "<?php echo $result_magrib['end_time']; ?>") {
                    video_player.play();
                    var message = "";
                    document.getElementById("message").innerHTML = message;
                    document.getElementById("intermission_message").style.visibility = "hidden";
                }
                //End Magrib ** Start Esha section
<?php
$sql_esha = "SELECT * FROM tbl_tvc_intermission_time WHERE intermission_id=5 AND publication_status=1";
$esha = $conn->query($sql_esha);
$result_esha = $esha->fetch_assoc();
?>
                if (time > "<?php echo $result_esha['start_time']; ?>" && time < "<?php echo $result_esha['end_time']; ?>") {
                    video_player.pause();
                    //var message = "এশার নামাজের বিরতি";
                    var message = "<?php echo $result_esha['description']; ?>";
                    document.getElementById("message").innerHTML = message;
                    document.getElementById("intermission_message").style.visibility = "visible";
                }
                if (time === "<?php echo $result_esha['end_time']; ?>") {
                    video_player.play();
                    var message = "";
                    document.getElementById("message").innerHTML = message;
                    document.getElementById("intermission_message").style.visibility = "hidden";

                }
                //End Esha
            }
            function slotChange() {
                var currentDate = new Date();
                curSecs = currentDate.getSeconds();
                curHour = currentDate.getHours();
                curMin = currentDate.getMinutes();
                if (curSecs < 10)
                    curSecs = "0" + curSecs;
                if (curMin < 10)
                    curMin = "0" + curMin;
                if (curHour < 10)
                    curHour = "0" + curHour;
                time = curHour + ":" + curMin + ":" + curSecs;
                if (time === "<?php echo $slot_start_time1; ?>") {
                    location = "index.php";
                } else if (time === "<?php echo $slot_start_time2; ?>") {
                    location = "index.php";
                } else if (time === "<?php echo $slot_start_time3; ?>") {
                    location = "index.php";
                } else if (time === "<?php echo $slot_start_time4; ?>") {
                    location = "index.php";
                } else if (time === "<?php echo $slot_start_time5; ?>") {
                    location = "index.php";
                } else if (time === "<?php echo $slot_start_time6; ?>") {
                    location = "index.php";
                } else if (time === "<?php echo $slot_start_time7; ?>") {
                    location = "index.php";
                } else if (time === "<?php echo $slot_start_time8; ?>") {
                    location = "index.php";
                } else if (time === "<?php echo $slot_start_time9; ?>") {
                    location = "index.php";
                } else if (time === "<?php echo $slot_start_time10; ?>") {
                    location = "index.php";
                } else if (time === "<?php echo $slot_start_time11; ?>") {
                    location = "index.php";
                } else {

                }
            }

        </script>
    </body>
</html>
