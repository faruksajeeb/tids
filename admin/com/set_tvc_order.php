<?php
//defined('TIDS') or die("Sorry, you are not allowed to directly access this page.<br /> Please press the back button in your browser."); 

// including the config file
$class='Slot';
require_once("../../classes/class.".$class.".php");
/*
function connect() {
	$host = 'localhost';
	$db_name = 'db_tids';
	$db_user = 'root';
	$db_password = '';
    return new PDO('mysql:host='.$host.';dbname='.$db_name, $db_user, $db_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}
$pdo = connect();
 
 */

// get the list of items id separated by cama (,)
$list_order = $_POST['list_order'];

// convert the string list to an array
$list = explode(',' ,$list_order);
$slot_obj->update_tvc_order($list);


