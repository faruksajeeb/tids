<?php
global $_Server_name;
global $_User_name;
global $_Password;
global $_DB_name;
$_Server_name='localhost';
$_User_name='root';
$_Password='root';
$_DB_name='db_tids';
//$db_conn;
try{
    $db_conn=new PDO("mysql:host=$_Server_name;dbname=$_DB_name;charset=utf8",$_User_name,$_Password);
    //set the PDO error mode to exception
    $db_conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //echo '<font color=green > Database connected successfuly! </font>';

}catch(PDOException $e){
    echo '<font color=red > Database connection failed </font>'.$e->getMessage();
}
//$db_conn=null;

