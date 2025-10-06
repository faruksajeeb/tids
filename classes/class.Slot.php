<?php
//defined('TIDS') or die("Sorry, you are not allowed to directly access this page.<br /> Please press the back button in your browser."); 
$DbConFile="dbConfig/settings";
require_once ($DbConFile.'.php');
class Slot{    
    private $db;
     function __construct($DB_conn)
    {                                
            $this->db = $DB_conn;
    }
    public function update_tvc_order($list){
            $i = 0 ;
            foreach($list as $id) {
                    try {
                        $sql  = 'UPDATE tbl_tvc_schedule SET tvc_order = :tvc_order WHERE schedule_id = :schedule_id' ;
                            $query = $this->db->prepare($sql);
                            $query->bindParam(':tvc_order', $i, PDO::PARAM_INT);
                            $query->bindParam(':schedule_id', $id, PDO::PARAM_INT);
                            $query->execute();
                    } catch (PDOException $e) {
                            echo 'PDOException : '.  $e->getMessage();
                    }
                    $i++ ;
            }
    }


}
$slot_obj =new Slot($db_conn);