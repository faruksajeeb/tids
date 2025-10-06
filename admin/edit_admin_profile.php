<?php
include('../classes/dbConfig/config.php');
include_once('../db/db_connect.php');
//echo $_SESSION['user_name'];
$sid=$_SESSION['uid'] ;
$sql="SELECT * FROM tbl_admin WHERE id=$sid ";
$query=$conn->query($sql);
$result=$query->fetch_assoc();
//var_dump($result);
if(isset($_POST['submit'])){
$image = $_FILES['picture']['name']; 
echo $image;
$name=$_POST['name'];
$birthday=$_POST['birthday'];
$gender=$_POST['gender'];
$email=$_POST['email'];
$job_title=$_POST['job_title'];
$mobile=$_POST['mobile'];
$hd=$_POST['hd'];
$udt="Update tbl_admin SET image='$image',name='$name',birth_day='$birthday',gender='$gender',email='$email',job_title='$job_title',mobile='$mobile' WHERE id='$hd'";
move_uploaded_file($_FILES['picture']['tmp_name'],'../images/admin/'.$image) or die("cannot upload image");
$query=$conn->query($udt);
header("location:admin_profile.php");
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
.middle{height:auto;width:30%;margin:0 auto;border-radius:10px;
text-align:center;padding:20px;margin-top:50px;
box-shadow:-2px 2px 15px #ccc,2px 2px 15px #ccc,2px -2px 15px #ccc,-2px -2px 15px #ccc;
}
.middle h1{margin-top:0;font-size:22px;text-transform: uppercase;} 
</style>
</head>
<body>

<div class="middle" style="">
<h1>Edit Profile</h1>
<form name="form1" id="form1" method="post" action="" enctype="multipart/form-data" >
<input type="hidden" name="hd" id="hd" value="<?php echo $result['id']?>">

<table class="table-condensed table-hover ">
    
     <tr>
      <th>Name</th>
      <td>
	  <input type="text" name="name"  id="name" value="<?php echo $result['name'];?>" class="form-control">
	
	  </td>
    </tr> 
		<tr>
      <th>Birthday</th>
          <td>
		  <input type="date" name="birthday"  id="birthday" value="<?php echo $result['birth_day'];?>" class="form-control">

	  </td>
    </tr>
	<tr>
      <th>Gender</th>
      <td><input name="gender" type="text" id="gender" class="form-control" value="<?php echo $result['gender'];?>" ></td>
    </tr>	
	<tr>
      <th>Email</th>
      <td><input name="email" type="email" id="email" class="form-control" value="<?php echo $result['email'];?>"  ></td>
    </tr>
	<tr>
      <th>Job Title</th>
      <td><input name="job_title" type="text" id="job_title" class="form-control" value="<?php echo $result['job_title'];?>"  required></td>
    </tr>
	<tr>
      <th>Mobile</th>
      <td><input name="mobile" type="text" id="mobile" class="form-control" value="<?php echo $result['mobile'];?>" ></td>
    </tr>
    <tr>
      <th><img src="<?php echo BASE_URL; ?><?php  echo 'images/admin/'.$result['image'];  ?>" height="50" width="50"></th>
      <td><input name="picture" type="file" id="picture" class="form-control" value="<?php echo $result['image'];?>" ></td>
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