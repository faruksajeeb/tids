<?php
$class = 'Arrival';
require_once("../classes/class." . $class . ".php");
foreach ($avl_obj->showData("tbl_setting") as $value):
    extract($value);
    ?>
    <form name="form1" method="post" action="" >	
        <table id="myTable" class="">
            <thead> 
                <?php
                echo <<<arrival
                        <tr>
                         <th>$train_no</th>
                         <th>$train_name</th>
                         <th>$platform</th>
                         <th>$initial_station</th>
                         <th>$arr_schedule_time</th>
                         <th>$arrival_probable_time</th>	 
                       </tr>
arrival;
                ?>
            </thead>
            <tbody>
                <?php include_once'arrival.data.display.php'; ?>
            </tbody>
        </table>
    </form>
    <?php
endforeach;
?>

























