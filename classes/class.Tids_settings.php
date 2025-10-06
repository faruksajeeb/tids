<?php

//defined('TIDS') or die("Sorry, you are not allowed to directly access this page.<br /> Please press the back button in your browser."); 
$DbConFile = "dbConfig/settings";
require_once ($DbConFile . '.php');

class Tids_settings {

    private $db;

    function __construct($DB_conn) {
        $this->db = $DB_conn;
    }

    public function showData($table) {
        $sql = "select * from $table";
        $qry = $this->db->query($sql) or die("failed !");
$data=array();
        while ($row = $qry->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function updateTidsSetting($id, $tids_refresh_duration, $tids_redirect_duration, $tids_alerm_duration, $tids_arrival_heading, $tids_departure_heading, $train_no, $train_name, $platform, $arr_schedule_time, $dep_schedule_time, $initial_station, $destination, $arrival_probable_time, $departure_probable_time, $table) {
        $sql = "UPDATE $table SET tids_refresh_duration=:tids_refresh_duration,tids_redirect_duration=:tids_redirect_duration,tids_alerm_duration=:tids_alerm_duration,tids_arrival_heading=:tids_arrival_heading,tids_departure_heading=:tids_departure_heading,train_no=:train_no,train_name=:train_name,platform=:platform,arr_schedule_time=:arr_schedule_time,dep_schedule_time=:dep_schedule_time,initial_station=:initial_station,destination=:destination,arrival_probable_time=:arrival_probable_time,departure_probable_time=:departure_probable_time WHERE id=:id";
        $q = $this->db->prepare($sql);
        $q->execute(array(
            ':id' => $id, ':tids_refresh_duration' => $tids_refresh_duration,
            ':tids_redirect_duration' => $tids_redirect_duration,
            ':tids_alerm_duration' => $tids_alerm_duration,
            ':tids_arrival_heading' => $tids_arrival_heading,
            ':tids_departure_heading' => $tids_departure_heading,
            ':train_no' => $train_no,
            ':train_name' => $train_name,
            ':platform' => $platform,
            ':arr_schedule_time' => $arr_schedule_time,
            ':dep_schedule_time' => $dep_schedule_time,
            ':initial_station' => $initial_station,
            ':destination' => $destination,
            ':arrival_probable_time' => $arrival_probable_time,
            ':departure_probable_time' => $departure_probable_time
                )
        );
        return true;
    }

}

$tids_settings_obj = new Tids_settings($db_conn);

