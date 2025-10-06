<?php
if((!empty($_SESSION['uid'])) && (!empty($_SESSION['password'])))
{
$session_uid=$_SESSION['uid'];
include('class.Welcome.php');
$welcome_obj = new Welcome();
}
if(empty($session_uid))
{
$url=BASE_URL.'admin/index.php';
header("Location: $url");
}
if(empty($_SESSION['password']))
{
$url=BASE_URL.'admin/lock.php';
header("Location: $url");
}
?>