<?php
$host_name='localhost';
$user_name='root';
$password='root';
$database_name='db_tids';

//create connection
$conn= new mysqli($host_name,$user_name,$password,$database_name);
// Check connection
if($conn->connect_error) {
    die("<font color='red'> Database server not connected: </font>" . $conn->connect_error);
}else{
	//echo "<font color='green'>Database server connected successfully </font>";
}
$conn->set_charset('utf8');
$conn->query("SET SESSION collation_connection ='utf8_general_ci'");

//$conn->close();

?>
