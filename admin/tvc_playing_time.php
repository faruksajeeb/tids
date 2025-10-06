<?php
include_once('pagesession.php');
include_once('dbconnect.php');
$query="SELECT * FROM tbl_tvc_playing_time";
$rst=mysql_query($query);
?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<style>
tr:nth-child(odd){background-color:#D9EDF7;}
tr:nth-child(even){background-color:#FCF8E3;}
th{background-color:#DFF0D8;}
.activebutton{ margin:0 auto;background-color:#009900; height:20px; width:20px; border-radius:50%; text-align:center;}
.deactivebutton{ margin:0 auto;background-color:#FF0000; height:20px; width:20px; border-radius:50%;text-align:center;}
.fa-times{ color:#FFFFFF;}
.fa-check{ color:#FFFFFF;}

</style>
</head>
<body>
<h1 class="page-header">TVC Intermission Time</h1>
<form name="form1" method="post" action="">
  <table class=" table table-bordered table-condensed table-hover ">
    <tr>
      <th>SLNo</th>
      <th>Description</th>
      <th>Start Time</th>
      <th>End Time</th>	 
	  <th>Action</th>
			 
	 
    </tr>
	<?php
		while($row_tvc=mysql_fetch_assoc($rst)){
	?>
    <tr>
      <td><?php echo $row_tvc['id']?></td>      
      <td><?php echo $row_tvc['description']?></td>
      <td><?php echo $row_tvc['start_time']?></td>
	  <td><?php echo $row_tvc['end_time']?></td>
	  
 	  <td>
		<a href="edit_tvc_play_time.php?id=<?php echo $row_tvc['id'];?>" class="btn btn-info btn-xs"><span class="fa fa-pencil-square-o"> edit</span></a>	
	  </td>
		
    </tr>
	<?php
	}
	?>
  </table>
</form>
</body>
</html>
