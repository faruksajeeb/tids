<?php
require_once("../classes/class.Slider.php");
?>
<div class="slider artslogo">							
    <div class="slider-wrapper theme-default">
        <div id="slider" class="nivoSlider">
            <?php
            foreach ($slider_obj->showData("tbl_tids_slider") as $value):
                extract($value);
                echo <<<show
	<img src="../img/$image_title" alt="Image" height="100" width="200"/>		
show;
            endforeach;
            ?>
        </div>
    </div>							
</div>

<!-- <marquee id="ReloadTop" class="marquee_top" scrollamount="15"></marquee> -->
<marquee id="text_scrolling" class="marquee_bottom" scrollamount="10" ></marquee>
<div style="clear:both;">
    <div id="clock1"></div>
</div>