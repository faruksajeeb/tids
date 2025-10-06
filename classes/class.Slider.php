<?php
//defined('TIDS') or die("Sorry, you are not allowed to directly access this page.<br /> Please press the back button in your browser."); 
$DbConFile="dbConfig/settings";
require_once ($DbConFile.'.php');
class Slider{    
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
}
$slider_obj=new Slider($db_conn);

