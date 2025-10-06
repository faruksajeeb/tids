<?php
$title="পৌঁছার সময়সূচী";
$class='Arrival';
require_once("../classes/class.".$class.".php");
foreach($avl_obj->showData("tbl_setting") as $value):
    extract($value);
    $refresh_time = $tids_refresh_duration* 60;
header("Refresh:$refresh_time; URL=index.php");
include '../view/arrival_view.php';
endforeach;
?>
