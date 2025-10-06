<?php
include_once('../../db/db_connect.php');
$find = $_GET['find'];
switch ($find){	
	case 'tvc_name':
	$query ="SELECT tvc_id,tvc_name FROM tbl_tvc WHERE client_id=".$_GET['id']."";
	break;
}
if ($conn->query($query)){
$result = $conn->query($query);	
		?>
		<option value="">Please select tvc name</option>
		<?php
		while($row = $result->fetch_array()){
		?>
		<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
		<?php
		}
	
}
?>


