<?php
include_once('pagesession.php');
include_once('dbconnect.php');
$query="select * from tbl_video_ads";
$rst=mysql_query($query);
?>
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
/*.middle{height:auto;width:80%;margin:0 auto;border-radius:10px;
text-align:center;padding:20px;margin-top:20px;
box-shadow:-2px 2px 15px #ccc,2px 2px 15px #ccc,2px -2px 15px #ccc,-2px -2px 15px #ccc;
}*/
.middle h1{margin-top:0;font-size:22px;text-transform: uppercase;} 
</style>

</head>
<body>
<div style="width:500px; margin:0 auto;">
<img src="../images/under_construction.png" width="500" height="400"  />
</div>
</body>
</html>
