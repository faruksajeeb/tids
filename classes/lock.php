<?php
include 'dbConfig/config.php';
$session_password='';
$_SESSION['password']='';
if(empty($session_password) && empty($_SESSION['password']))
{
$url=BASE_URL.'admin/lock.php';
header("Location: $url");
//echo "<script>window.location='$url'</script>";
}

?>