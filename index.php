<?php
require_once 'db/db_connect.php';
//$query=mysql_query("select * from tablename")or die(mysql_error()); 
$stmt_sch="SELECT a_s.*,a_t.train_no,a_t.train_name FROM tbl_arrival_schedule AS a_s,tbl_train_list_arrival AS a_t WHERE a_s.arrival_train_id=a_t.arrival_train_id ORDER BY schedule_time ASC";
$rst=$conn->query($stmt_sch);
$xml = '<?xml version="1.0" encoding="UTF-8" ?>';
$xml .="<libraray>\n\t\t";
while($row_arrival=$rst->fetch_assoc()){

    $xml .="<train_schedule>\n\t\t";
    $xml .= "<train_name>".$row_arrival['train_name']."</train_name>\n\t\t";
    $xml .= "<link>".$row_arrival['train_name']."</link>\n\t\t";
    $xml .= "<description>".$row_arrival['coming_from']."</description>\n\t\t";
    $xml .= "<pubDate>".$row_arrival['schedule_time']."</pubDate>\n\t\t";
    $xml.="</train_schedule>\n\t";
}
$xml.="</libraray>\n\r";
$xmlobj=new SimpleXMLElement($xml);
$xmlobj->asXML("text.xml");
header('Content-Type: application/xml');
?>
