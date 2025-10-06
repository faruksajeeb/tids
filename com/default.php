<?php 
$a=012;
echo $a/4;
include_once('../db/db_connect.php');

		 $sql="SELECT * FROM tbl_tvc_intermission_time WHERE intermission_id=1";
		 $row=$conn->query($sql);
		 $result=$row->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Default </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	
	<script type="text/javascript" src="../script/jquery-1.9.1.min.js"></script>
	<script src="../script/main.js" type="text/javascript"></script>
	<script type="text/javascript" src="../script/jquery.js"></script>
	<script type="text/javascript" src="../script/jquery.min.js"></script>
	<script type="text/javascript" src="../script/jqClock.min.js"></script>
	
	<script type="text/javascript">
            
function getCurrentTime(){
	var myDate = new Date();
	var mySecs = myDate.getSeconds();
	var curHour = myDate.getHours();
	var curMin = myDate.getMinutes();
	

	if(mySecs < 10)
		mySecs = "0" + mySecs;

	if(curMin < 10)
		curMin = "0" + curMin;
	
	if(curHour < 10)
		curHour = "0" + curHour;	

	var time = curHour + ":" + curMin + ":" + mySecs ;
	//document.getElementById('time').innerHTML=time;
	//alert(time);

		if(time == "<?php echo $result['end_time'];?>") //Change this to whatever time you want
			location ="index.php";
}
	</script>
	<style>
		body{
			background-color:#000;
			overflow:hidden;
		}
		  img{
                                    position: absolute;
                                    top:45%;
                                    left:10%;
                                }  
		html{
			width: 100%;height: 100%;
			position: relative;
		}

html,body {
		width: 100%;height: 100%;
			position: relative;
			overflow: hidden;	
			-moz-animation-name: dropHeader;
			-moz-animation-iteration-count: 1;
			-moz-animation-timing-function: ease-in;
			-moz-animation-duration: 0.3s;	

			-webkit-animation-name: dropHeader;
			-webkit-animation-iteration-count: 1;
			-webkit-animation-timing-function: ease-in;
			-webkit-animation-duration:1s;
			/*
			animation-name: dropHeader;
			animation-iteration-count: 1;
			animation-timing-function: ease-in;
			animation-duration: 0.3s;*/
		}
@keyframes dropHeader {   
			0% {
				//left:40%; 
				top:200px;
				width:1%;
				height:1%;
				transform: rotate(360deg);				
				}
		   100% {
				width: 100%;
				height: 100%;
				transform: rotate(0deg);
				}
                                     
	</style>
</head>
<body onload="setInterval('getCurrentTime()', 1000);" >
    
    <img src="../img/arts_tv.gif" width='80%'/>
</body>
</html>
