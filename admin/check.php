<?php
include_once('pagesession.php');
include_once('../dbcon.php');
$selectQuery = 'SELECT username  FROM user WHERE username="'.$_POST['x'].'"';
$result = $mysqli->query($selectQuery);
$numrow=mysqli_num_rows($result);
if($numrow>0){
	echo '<font color=red><b>User name already exist</b></font>';
}
else{
	echo '<font color=green><b>Available for registration</b></font>';
}
?>
