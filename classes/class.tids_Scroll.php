<?php
//defined('TIDS') or die("Sorry, you are not allowed to directly access this page.<br /> Please press the back button in your browser."); 
$DbConFile="dbConfig/settings";
require_once ($DbConFile.'.php');
class tids_Scroll{    
    private $db;
     function __construct($DB_conn)
    {                                  
            $this->db = $DB_conn;
    }
    public function showDataTidsScroll(){
            $sql="select * from tbl_tids_scroll WHERE status=1";
            $qry=$this->db->query($sql) or die("failed !");
		$data=array();
            while($row=$qry->fetch(PDO::FETCH_ASSOC)){
                    $data[]=$row;
            }
            return $data;
    }
}
$tidsScroll_obj=new tids_Scroll($db_conn);

