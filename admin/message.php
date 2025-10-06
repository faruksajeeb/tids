<?php
if(isset($_GET['inserted']))
{
	?>

	<div class="alert alert-info" style="color:green">
            <strong>WOW!</strong> Record was inserted successfully !
        </div>

    <?php
}
else if(isset($_GET['failure'])){
	?>

	<div class="alert alert-warning" style="color:red">
             <strong>SORRY!</strong> ERROR while inserting record !
        </div>

    <?php
}else if(isset($_GET['updated_success'])){
	?>

	<div class="alert alert-info" style="color:green">
             <strong>Wow!</strong> Record was changed successfully !
        </div>

    <?php
}else if(isset($_GET['updated_failure'])){
	?>

	<div class="alert alert-warning" style="color:red">
             <strong>SORRY!</strong> ERROR while updating record !
        </div>

    <?php
}else if(isset($_GET['deleted_success'])){
	?>
 
	<div class="alert alert-info" style="color:green">
             <strong>:(</strong> Record was deleted successfully !
        </div>

    <?php
}
?>