<?php
$title="ছাড়ার সময়সূচী";
$class='Departure';
require_once("../classes/class.".$class.".php");
foreach($dep_obj->showData("tbl_setting") as $value):
    extract($value);
    $refresh_time = $tids_refresh_duration* 60;
header("Refresh:$refresh_time; URL=index.php");
include '../view/departure_view.php';
endforeach;
?>

