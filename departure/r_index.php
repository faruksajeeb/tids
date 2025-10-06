<?php
$title="ছাড়ার সময়সূচী";
$class='Departure';
require_once("../classes/class.".$class.".php");
foreach($dep_obj->showData("tbl_setting") as $value):
    extract($value); 
header("Refresh:$tids_redirect_duration; URL=../arrival/r_index.php");
include '../view/departure_view.php';
endforeach;
?>