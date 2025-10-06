<?php
//defined('TIDS') or die("Sorry, you are not allowed to directly access this page.<br /> Please press the back button in your browser."); 
$DbConFile="dbConfig/settings";
require_once ($DbConFile.'.php');
class Departure{    
    private $db;
     function __construct($DB_conn)
    {                                  
            $this->db = $DB_conn;
    }
    public function showData($table){
            $sql="select * from $table";
            $qry=$this->db->query($sql) or die("failed !");
	    $data=array();
            while($row=$qry->fetch(PDO::FETCH_ASSOC)){
                    $data[]=$row;
            }
            return $data;
    }
    public function showDataDeparture(){
            $sql="SELECT a_s.*,a_t.train_no,a_t.train_name FROM tbl_departure_schedule AS a_s,tbl_train_list_departure AS a_t WHERE a_s.departure_train_id=a_t.departure_train_id  AND status=1 ORDER BY schedule_time ASC";
            $qry=$this->db->query($sql) or die("failed !");
	$data=array();
            while($row=$qry->fetch(PDO::FETCH_ASSOC)){
                    $data[]=$row;
            }
            return $data;
    }
}
$dep_obj=new Departure($db_conn);

