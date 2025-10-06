<?php

$sql1 = $conn->query("SELECT * FROM tbl_tvc_slot WHERE slot_id=1");
$slot_time1 = $sql1->fetch_assoc();
$slot_start_time1 = $slot_time1['slot_start_time'];
$slot_end_time1 = $slot_time1['slot_end_time'];

$sql2 = $conn->query("SELECT * FROM tbl_tvc_slot WHERE slot_id=2");
$slot_time2 = $sql2->fetch_assoc();
$slot_start_time2 = $slot_time2['slot_start_time'];
$slot_end_time2 = $slot_time2['slot_end_time'];

$sql3 = $conn->query("SELECT * FROM tbl_tvc_slot WHERE slot_id=3");
$slot_time3 = $sql3->fetch_assoc();
$slot_start_time3 = $slot_time3['slot_start_time'];
$slot_end_time3 = $slot_time3['slot_end_time'];

$sql4 = $conn->query("SELECT * FROM tbl_tvc_slot WHERE slot_id=4");
$slot_time4 = $sql4->fetch_assoc();
$slot_start_time4 = $slot_time4['slot_start_time'];
$slot_end_time4 = $slot_time4['slot_end_time'];

$sql5 = $conn->query("SELECT * FROM tbl_tvc_slot WHERE slot_id=5");
$slot_time5 = $sql5->fetch_assoc();
$slot_start_time5 = $slot_time5['slot_start_time'];
$slot_end_time5 = $slot_time5['slot_end_time'];

$sql6 = $conn->query("SELECT * FROM tbl_tvc_slot WHERE slot_id=6");
$slot_time6 = $sql6->fetch_assoc();
$slot_start_time6 = $slot_time6['slot_start_time'];
$slot_end_time6 = $slot_time6['slot_end_time'];

$sql7 = $conn->query("SELECT * FROM tbl_tvc_slot WHERE slot_id=7");
$slot_time7 = $sql7->fetch_assoc();
$slot_start_time7 = $slot_time7['slot_start_time'];
$slot_end_time7 = $slot_time7['slot_end_time'];

$sql8 = $conn->query("SELECT * FROM tbl_tvc_slot WHERE slot_id=8");
$slot_time8 = $sql8->fetch_assoc();
$slot_start_time8 = $slot_time8['slot_start_time'];
$slot_end_time8 = $slot_time8['slot_end_time'];

$sql9 = $conn->query("SELECT * FROM tbl_tvc_slot WHERE slot_id=9");
$slot_time9 = $sql9->fetch_assoc();
$slot_start_time9 = $slot_time9['slot_start_time'];
$slot_end_time9 = $slot_time9['slot_end_time'];

$sql10 = $conn->query("SELECT * FROM tbl_tvc_slot WHERE slot_id=10");
$slot_time10 = $sql10->fetch_assoc();
$slot_start_time10 = $slot_time10['slot_start_time'];
$slot_end_time10 = $slot_time10['slot_end_time'];

$sql11 = $conn->query("SELECT * FROM tbl_tvc_slot WHERE slot_id=11");
$slot_time11 = $sql11->fetch_assoc();
$slot_start_time11 = $slot_time11['slot_start_time'];
$slot_end_time11 = $slot_time11['slot_end_time'];


if (($current_time > $slot_start_time1 ) && ($current_time < $slot_end_time1)) {
    $sql = $conn->query("SELECT tts.*,tt.tvc_name FROM tbl_tvc_schedule AS tts,tbl_tvc AS tt WHERE tts.tvc_id=tt.tvc_id AND tts.schedule_date='$current_date' AND tts.slot_id=1 AND tts.publication_status=1 ORDER BY tts.tvc_order ASC");
    $videoArray = array();
    $scheduleIdArray = array();
    while ($row = $sql->fetch_assoc()) {
        $scheduleIdArray[] = $row['schedule_id'];
        $videoArray[] = "videos/" . $row['tvc_name'];
    }
} else if (($current_time > $slot_start_time2 ) && ($current_time < $slot_end_time2)) {
    $sql = $conn->query("SELECT tts.*,tt.tvc_name FROM tbl_tvc_schedule AS tts,tbl_tvc AS tt WHERE tts.tvc_id=tt.tvc_id AND tts.schedule_date='$current_date' AND tts.slot_id=2 AND tts.publication_status=1 ORDER BY tts.tvc_order ASC");
    $videoArray = array();
    $scheduleIdArray = array();
    while ($row = $sql->fetch_assoc()) {
        $scheduleIdArray[] = $row['schedule_id'];
        $videoArray[] = "videos/" . $row['tvc_name'];
    }
} else if (($current_time > $slot_start_time3 ) && ($current_time < $slot_end_time3)) {
    $sql = $conn->query("SELECT tts.*,tt.tvc_name FROM tbl_tvc_schedule AS tts,tbl_tvc AS tt WHERE tts.tvc_id=tt.tvc_id AND tts.schedule_date='$current_date' AND tts.slot_id=3 AND tts.publication_status=1 ORDER BY tts.tvc_order ASC");
    $videoArray = array();
    $scheduleIdArray = array();
    while ($row = $sql->fetch_assoc()) {
        $scheduleIdArray[] = $row['schedule_id'];
        $videoArray[] = "videos/" . $row['tvc_name'];
    }
} else if (($current_time > $slot_start_time4 ) && ($current_time < $slot_end_time4)) {
    $sql = $conn->query("SELECT tts.*,tt.tvc_name FROM tbl_tvc_schedule AS tts,tbl_tvc AS tt WHERE tts.tvc_id=tt.tvc_id AND tts.schedule_date='$current_date' AND tts.slot_id=4 AND tts.publication_status=1 ORDER BY tts.tvc_order ASC");
    $videoArray = array();
    $scheduleIdArray = array();
    while ($row = $sql->fetch_assoc()) {
        $scheduleIdArray[] = $row['schedule_id'];
        $videoArray[] = "videos/" . $row['tvc_name'];
    }
} else if (($current_time > $slot_start_time5 ) && ($current_time < $slot_end_time5)) {
    $sql = $conn->query("SELECT tts.*,tt.tvc_name FROM tbl_tvc_schedule AS tts,tbl_tvc AS tt WHERE tts.tvc_id=tt.tvc_id AND tts.schedule_date='$current_date' AND tts.slot_id=5 AND tts.publication_status=1 ORDER BY tts.tvc_order ASC");
    $videoArray = array();
    $scheduleIdArray = array();
    while ($row = $sql->fetch_assoc()) {
        $scheduleIdArray[] = $row['schedule_id'];
        $videoArray[] = "videos/" . $row['tvc_name'];
    }
} else if (($current_time > $slot_start_time6) && ($current_time < $slot_end_time6)) {
    $sql = $conn->query("SELECT tts.*,tt.tvc_name FROM tbl_tvc_schedule AS tts,tbl_tvc AS tt WHERE tts.tvc_id=tt.tvc_id AND tts.schedule_date='$current_date' AND tts.slot_id=6 AND tts.publication_status=1 ORDER BY tts.tvc_order ASC");
    $videoArray = array();
    $scheduleIdArray = array();
    while ($row = $sql->fetch_assoc()) {
        $scheduleIdArray[] = $row['schedule_id'];
        $videoArray[] = "videos/" . $row['tvc_name'];
    }
} else if (($current_time > $slot_start_time7 ) && ($current_time < $slot_end_time7)) {
    $sql = $conn->query("SELECT tts.*,tt.tvc_name FROM tbl_tvc_schedule AS tts,tbl_tvc AS tt WHERE tts.tvc_id=tt.tvc_id AND tts.schedule_date='$current_date' AND tts.slot_id=7 AND tts.publication_status=1 ORDER BY tts.tvc_order ASC");
    $videoArray = array();
    $scheduleIdArray = array();
    while ($row = $sql->fetch_assoc()) {
        $scheduleIdArray[] = $row['schedule_id'];
        $videoArray[] = "videos/" . $row['tvc_name'];
    }
} else if (($current_time > $slot_start_time8 ) && ($current_time < $slot_end_time8)) {
    $sql = $conn->query("SELECT tts.*,tt.tvc_name FROM tbl_tvc_schedule AS tts,tbl_tvc AS tt WHERE tts.tvc_id=tt.tvc_id AND tts.schedule_date='$current_date' AND tts.slot_id=8 AND tts.publication_status=1 ORDER BY tts.tvc_order ASC");
    $videoArray = array();
    $scheduleIdArray = array();
    while ($row = $sql->fetch_assoc()) {
        $scheduleIdArray[] = $row['schedule_id'];
        $videoArray[] = "videos/" . $row['tvc_name'];
    }
} else if (($current_time > $slot_start_time9 ) && ($current_time < $slot_end_time9)) {
    $sql = $conn->query("SELECT tts.*,tt.tvc_name FROM tbl_tvc_schedule AS tts,tbl_tvc AS tt WHERE tts.tvc_id=tt.tvc_id AND tts.schedule_date='$current_date' AND tts.slot_id=9 AND tts.publication_status=1 ORDER BY tts.tvc_order ASC");
    $videoArray = array();
    $scheduleIdArray = array();
    while ($row = $sql->fetch_assoc()) {
        $scheduleIdArray[] = $row['schedule_id'];
        $videoArray[] = "videos/" . $row['tvc_name'];
    }
} else if (($current_time > $slot_start_time10 ) && ($current_time < $slot_end_time10)) {
    $sql = $conn->query("SELECT tts.*,tt.tvc_name FROM tbl_tvc_schedule AS tts,tbl_tvc AS tt WHERE tts.tvc_id=tt.tvc_id AND tts.schedule_date='$current_date' AND tts.slot_id=10 AND tts.publication_status=1 ORDER BY tts.tvc_order ASC");
    $videoArray = array();
    $scheduleIdArray = array();
    while ($row = $sql->fetch_assoc()) {
        $scheduleIdArray[] = $row['schedule_id'];
        $videoArray[] = "videos/" . $row['tvc_name'];
    }
} else {

    $sql = $conn->query("SELECT tts.*,tt.tvc_name FROM tbl_tvc_schedule AS tts,tbl_tvc AS tt WHERE tts.tvc_id=tt.tvc_id AND tts.schedule_date='$current_date' AND tts.slot_id=11 AND tts.publication_status=1 ORDER BY tts.tvc_order ASC");
    $videoArray = array();
    $scheduleIdArray = array();
    while ($row = $sql->fetch_assoc()) {
        $scheduleIdArray[] = $row['schedule_id'];
        $videoArray[] = "videos/" . $row['tvc_name'];
    }
}
/*
  //$sql=$conn->query("SELECT * FROM tbl_tvc_schedule WHERE DATE(scheduled_time)='$current_time' AND publication_status=1 ORDER BY scheduled_time ASC");

 */
