<?php
include_once('dbconnect.php');
$find = $_GET['find'];
switch ($find)
{
	case 'train':
	$query ="SELECT arrival_train_id FROM tbl_train_list_arrival WHERE arrival_train_id='".$_GET['id']."'";
	break;
}
$result =mysql_query($query);
					if(mysql_num_rows($result) > 0)
					{
					$row =mysql_fetch_row($result);
					echo "<input name='txttrain_no' value='$row[0]' type='text' id='txttrain_no' class='form-control'/>";
					}
				else
					{
					echo 'No Information found';
					}	

?>


