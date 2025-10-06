<!DOCTYPE html>
<html>
<head>
<title>Display video Ads</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/jquery.dataTables.css" rel="stylesheet">
<script src="../script/jquery.js" type="text/javascript"></script>
<script src="../script/main.js" type="text/javascript"></script>
<style>
body{}
.middle{height:auto;width:80%;margin:0 auto;border-radius:10px;
text-align:center;padding:20px;margin-top:20px;
box-shadow:-2px 2px 15px #ccc,2px 2px 15px #ccc,2px -2px 15px #ccc,-2px -2px 15px #ccc;
}
.middle h1{margin-top:0;font-size:22px;text-transform: uppercase;} 
</style>
 <script>
	function check_detele() {
		var check=confirm('Are you sure to delete this !!');
		if(check) {
			return true;
		} else {
			return false;
		}
	}
 </script>
</head>
<body>
<div class="middle" >

<h1 class="page-header">Settings</h1>

	<a href="tvc_playing_time.php" class="btn btn-info ">TVC</a>
	<a href="#" class="btn btn-info btn-default">Company Logo</a>
	<a href="tids_settings.php" class="btn btn-info btn-default">TIDS</a>

</div>
<script src="../script/jquery.dataTables.min.js" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		$('.example').dataTable();
			});
</script>
</body>
</html>
