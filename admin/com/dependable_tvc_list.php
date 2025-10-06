<?php
include_once('../../db/db_connect.php');
$find = $_GET['find'];
switch ($find){
	
	case 'videos':
	$query ="SELECT tvc_id,tvc_name FROM tbl_tvc WHERE publication_status=1 AND client_id=".$_GET['id']."";
	break;
}
if ($conn->query($query)){
$result = $conn->query($query);
	
		?>
		<option>Please Select Title</option>
		<?php
		while($row =$result->fetch_array()){
		?>
			<option value="<?php echo $row[0]; ?>">
					<?php echo $row[1]; ?>
			</option>
		<?php		
		}
}
?>


