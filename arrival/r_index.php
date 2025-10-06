<?php
$title="পৌঁছার সময়সূচী";
$class='Arrival';
require_once("../classes/class.".$class.".php");
foreach($avl_obj->showData("tbl_setting") as $value):
    extract($value); 
header("Refresh:$tids_redirect_duration; URL=../departure/r_index.php");
include '../view/arrival_view.php';
endforeach;
?>