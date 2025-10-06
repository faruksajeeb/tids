<?php
$alermDur = $tids_alerm_duration * 60;
foreach ($dep_obj->showDataDeparture() as $value):
    extract($value);
    $dt = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
    $current_time = $dt->format('H:i');
    $sdlTime = $schedule_time;
    $late_schedule_time = $probable_time;
    $engDATE = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0, ':');
    $bangDATE = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০', 'ঃ');
    $convertedTIME = str_replace($bangDATE, $engDATE, $sdlTime);
    $late_convertedTIME = str_replace($bangDATE, $engDATE, $late_schedule_time);
    
    $schedule_timestamp = strtotime($convertedTIME);
    $late_schedule_timestamp = strtotime($late_convertedTIME);
    $current_timestamp = strtotime($current_time);
  
    $diff = $schedule_timestamp - $current_timestamp;
    $late_diff = $late_schedule_timestamp - $current_timestamp;
   
    ?>
    <tr >
        <td style="background-color:<?php if ($probable_time == '') {
        if (($diff > 0) and ( $diff < $alermDur)) {
            echo '#FF0000;'.'color:#fff';
        }
    } else {
        if (($late_diff > 0) and ( $late_diff < $alermDur)) {
            echo '#FF0000;'.'color:#fff';
        }
    } ?>;"><span class="<?php if ($probable_time == '') {
        if (($diff > 0) and ( $diff < $alermDur)) {
            echo 'blink';
        }
    } else {
        if (($late_diff > 0) and ( $late_diff < $alermDur)) {
            echo 'blink';
        }
    } ?>"><?php echo $train_no ?></span></td>
        <td style="background-color:<?php if ($probable_time == '') {
        if (($diff > 0) and ( $diff < $alermDur)) {
            echo '#FF0000;'.'color:#fff';
        }
    } else {
        if (($late_diff > 0) and ( $late_diff < $alermDur)) {
            echo '#FF0000;'.'color:#fff';
        }
    } ?>;"><span class="<?php if ($probable_time == '') {
        if (($diff > 0) and ( $diff < $alermDur)) {
            echo 'blink';
        }
    } else {
        if (($late_diff > 0) and ( $late_diff < $alermDur)) {
            echo 'blink';
        }
    } ?>"><?php echo $train_name ?> </span></td>
        <td style="background-color:<?php if ($probable_time == '') {
        if (($diff > 0) and ( $diff < $alermDur)) {
            echo '#FF0000;'.'color:#fff';
        }
    } else {
        if (($late_diff > 0) and ( $late_diff < $alermDur)) {
            echo '#FF0000;'.'color:#fff';
        }
    } ?>;"><span class="<?php if ($probable_time == '') {
        if (($diff > 0) and ( $diff < $alermDur)) {
            echo 'blink';
        }
    } else {
        if (($late_diff > 0) and ( $late_diff < $alermDur)) {
            echo 'blink';
        }
    } ?>"><?php echo $platform_no ?></span></td>
        <td style="background-color:<?php if ($probable_time == '') {
        if (($diff > 0) and ( $diff < $alermDur)) {
            echo '#FF0000;'.'color:#fff';
        }
    } else {
        if (($late_diff > 0) and ( $late_diff < $alermDur)) {
            echo '#FF0000;'.'color:#fff';
        }
    } ?>;"><span class="<?php if ($probable_time == '') {
        if (($diff > 0) and ( $diff < $alermDur)) {
            echo 'blink';
        }
    } else {
        if (($late_diff > 0) and ( $late_diff < $alermDur)) {
            echo 'blink';
        }
    } ?>"><?php echo $destination ?></span></td>
        <td style="background-color:<?php if ($probable_time == '') {
        if (($diff > 0) and ( $diff < $alermDur)) {
            echo '#FF0000;'.'color:#fff';
        }
    } else {
        if (($late_diff > 0) and ( $late_diff < $alermDur)) {
            echo '#FF0000;'.'color:#fff';
        }
    } ?>;color:<?php if ($probable_time != '') {
        echo '#A8A8A8';
    } ?>"><span class="<?php if ($probable_time == '') {
        if (($diff > 0) and ( $diff < $alermDur)) {
            echo 'blink';
        }
    } else {
        if ($probable_time != '') {
            echo '';
        } else {
            if (($late_diff > 0) and ( $late_diff < $alermDur)) {
                echo 'blink';
            }
        }
    } ?>"><?php echo $schedule_time ?></span></td>
        <td style="background-color:<?php if ($probable_time == '') {
        if (($diff > 0) and ( $diff < $alermDur)) {
            echo '#FF0000;'.'color:#fff';
        }
    } else {
        if (($late_diff > 0) and ( $late_diff < $alermDur)) {
            echo '#FF0000;'.'color:#fff';
        }
    } ?>;"><span class="<?php if ($probable_time == '') {
        if (($diff > 0) and ( $diff < $alermDur)) {
            echo 'blink';
        }
    } else {
        if (($late_diff > 0) and ( $late_diff < $alermDur)) {
            echo 'blink';
        }
    } ?>"><?php echo $probable_time ?></span></td>		  

    </tr>
    <?php
endforeach;
?>