<?php
include('../classes/dbConfig/config.php');
include_once('../db/db_connect.php');
$sid=$_SESSION['uid'];

$sql="SELECT * FROM tbl_admin WHERE id=$sid ";
$query=$conn->query($sql);
$result=$query->fetch_assoc();
//var_dump($result);
$msg="";
if(isset($_POST['submit'])){
$oldPass=md5($_POST['oldPass']);
$newPass=md5($_POST['newPass']);
$reNewPass=md5($_POST['reNewPass']);
$hd=$_POST['hd'];
if($newPass==$reNewPass){
    if($oldPass==$result['password']){
        $udt="Update tbl_admin SET password='$newPass' WHERE id='$hd' AND password='$oldPass' ";
        $query=$conn->query($udt);
        header("location:admin_profile.php");
    }else{
        $msg= '<i class="fa fa-times" aria-hidden="true"></i>'."  Your Current password was incorrect.";
    }

}else{
    $msg="  Passwords doesn't match.";
    //$msg= '<i class="fa fa-times" aria-hidden="true"></i>'."  Your Current password was incorrect.";
}
}


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo BASE_URL; ?>script/jquery.js" type="text/javascript"></script>
<link href="<?php echo BASE_URL; ?>css/jquery.dataTables.css" rel="stylesheet">
<script src="<?php echo BASE_URL; ?>script/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>script/main.js" type="text/javascript"></script>
<style>
h1{
	text-align:center;
}
.marginFirst{
	margin-top:10px;
	margin-bottom:30px;
}
.middle{height:auto;width:40%;margin:0 auto;border-radius:10px;
text-align:center;padding:20px;margin-top:50px;
box-shadow:-2px 2px 15px #ccc,2px 2px 15px #ccc,2px -2px 15px #ccc,-2px -2px 15px #ccc;
}
.middle h1{margin-top:0;font-size:22px;text-transform: uppercase;} 
</style>
</head>
<body>

<div class="middle" style="">
<h1>Change Password</h1>
<form name="form1" id="form1" method="post" action="">
<input type="hidden" name="hd" id="hd" value="<?php echo $result['id']?>">

<table class="table-condensed table-hover " width="80%">
    <span style="color:red;"> <?php echo $msg;?></span>
     <tr>
      <th>Current Password</th>
      <td>
	  <input type="password"  name="oldPass"  id="oldPass" class="form-control">
		

	  </td>
    </tr> 
		<tr>
      <th>New Password</th>
          <td>
	  <input type="password" name="newPass"  id="newPass" class="form-control">
		
	  </td>
    </tr>
	<tr>
      <th>Re-type New</th>
      <td><input type="password" name="reNewPass"  id="reNewPass" class="form-control"  ></td>
    </tr>	
	
   <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="Submit Updated" class="btn btn-success btn-sm" />
    </tr>
      </table>
</form>
</div>

</body>
</html>