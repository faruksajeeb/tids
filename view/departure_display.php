<?php
$class = 'Departure';
require_once("../classes/class." . $class . ".php");
foreach ($dep_obj->showData("tbl_setting") as $value):
extract($value);
?>
<table id="myTable">
        <thead>
            <?php
            echo <<<departure
            <tr>
                <th>$train_no</th>
                <th>$train_name</th>
                <th>$platform</th>
                <th>$destination</th>
                <th>$dep_schedule_time</th>
                <th>$departure_probable_time</th>	 
            </tr>
departure;
            ?>
        </thead>
        <tbody>
            <?php include 'departure.data.display.php';?>
        </tbody>
    </table>

    <?php
endforeach;
?>


























