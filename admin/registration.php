<?php
include_once('pagesession.php');
include_once('dbconnect.php');
if(isset($_POST['Submit'])){
	$username=$_POST['un'];
	$password=$_POST['pw'];
	$q="select * from user where username='".$username."' and password='".$password."'";
	$r=$mysqli->query($q);
	$row=mysqli_fetch_row($r);
	$nrow=mysqli_num_rows($r);
	if($nrow>0){
		header('location:registration.php');
	}else{
		$qq="insert into user (username,password) values('".$_POST['un']."','".$_POST['pw']."')";
		$rr=$mysqli->query($qq);
		header('location:indexi.php');
	}
}
?>
<!DOCTYPE html>
<html style="background-image: url(../images/footer_lodyas.png); background-repeat: no-repeat; background-size:cover;">
<head>
  <meta charset="UTF-8">
  <title>Login & Register form</title>
    <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
	<script type="text/javascript" src="../script/jquery.js"></script>
	<script type="text/javascript">
	  $(document).ready(function(){
		$('#un').keyup(function(){
			if($('#un').val()==""){
				$('#status').html("<b>Must Not Be Blank</b>");
			}else{
			$.post(
			  'check.php',
			  { x : $('#un').val()},
			  function(data){
				  $('#status').html(data);
				}
			)};
		});
	 });
	</script>
</head>

<body >

  <div class="login-wrap" style="background-color:#998164">
  <h2>Admin Register</h2>
<form method="post" action="">
  <div class="form" >
	<span id="status"></span>
    <input type="text" placeholder="Username" name="un" id="un" required/>
    <input type="password" placeholder="Password" name="pw" id="pw" required/>
    <input type="submit" value="Sign Up" name="Submit" id="Submit" style="background-color:green"/>
  </div>
 </form>
</div>
</body>
</html>