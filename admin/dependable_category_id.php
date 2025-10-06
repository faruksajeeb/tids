<?php
include_once('dbconnect.php');
$find = $_GET['find'];
switch ($find)
{
	case 'category':
	$query ="SELECT category_id FROM company_group WHERE company_id=".$_GET['cid']."";
	break;
}
$result =mysql_query($query);
	if(mysql_num_rows($result) > 0)
	{
	$row =mysql_fetch_row($result);
	if($row[0]==2){
	echo "<input name='catid' value='$row[0]' type='text' id='catid' class='form-control'/><br/>";
	echo "<input name='txtfile' type='file' id='txtfile' class='form-control' >";
	}else{
		echo "<input name='catid' value='$row[0]' type='text' id='catid' class='form-control'/>
				
		";
	}
	}
	else
	{
	echo 'No Information found';
	}	

?>


