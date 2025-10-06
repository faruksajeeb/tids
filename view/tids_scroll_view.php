<?php
require_once("../classes/class.tids_Scroll.php");

foreach ($tidsScroll_obj->showDataTidsScroll() as $value):
    extract($value);
    echo <<<show_scroll

    <span style="padding:10px;color:$text_color;background-color:$background_color;">
   		$description
    </span>
   <i class="fa fa-square" aria-hidden="true"></i> 
show_scroll;
endforeach;
?>
				
