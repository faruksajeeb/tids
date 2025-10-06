<?php
mysql_connect('localhost','root','123456');
mysql_select_db('db_tids');
mysql_query('SET CHARACTER SET utf8');
mysql_query("SET SESSION collation_connection ='utf8_general_ci'"); 

/*
$host_name='localhost';
$user_name='root';
$password='';
$database_name='db_train';

//create connection
$conn= new mysqli($host_name,$user_name,$password);
if($conn){
	$conn->select_db($database_name);		
}
// Check connection
if ($conn->connect_error) {
    die("<font color='red'> Database server not connected: </font>" . $conn->connect_error);
}else{
	//echo "Connected successfully";
}
$conn->set_charset('utf8');
$conn->query("SET SESSION collation_connection ='utf8_general_ci'");

$conn->close();
*/
?>
