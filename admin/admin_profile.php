<?php
include('../classes/dbConfig/config.php');
include_once('../db/db_connect.php');
//echo $_SESSION['user_name'];
$sid=$_SESSION['uid'] ;
$sql="SELECT * FROM tbl_admin WHERE id=$sid ";
$query=$conn->query($sql);
$result=$query->fetch_assoc();
//var_dump($result);




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
    .middle{height:100%;width:40%;margin:0 auto;border-radius:0px;
padding:20px;padding-top:50px;
box-shadow:-2px 2px 15px #ccc,2px 2px 15px #ccc,2px -2px 15px #ccc,-2px -2px 15px #ccc;
}

th,td{
	font-size:24px;
	
}

</style>
</head>
<body>
    <div class="middle" style="">
<div class="col-sm-12 marginFirst">

    <div class="row" style="text-align: left;">
        <div class="col-md-3" >
                <img src="<?php echo BASE_URL; ?><?php  echo 'images/admin/'.$result['image'];  ?>" height="100" width="100">
        </div> 
        <div class="col-md-6">
            <h1><?php echo $result['name'];  ?></h1>
        </div>
        <div class="col-md-3">
               <a href="edit_admin_profile.php" class="btn btn-info btn-sm pull-right" target="divId">Edit Profile</a>
        </div>
    </div>

</div>
<div class="row">

<div class="col-sm-12">
<table class="table table-reflow">

<tr><th>Username:</th><td><?php echo $result['username'];  ?></td></tr>
<tr><th>Password:</th><td>     <a href="change_admin_password.php" class="btn btn-success btn-sm pull-right" style="margin-right:20px;" target="divId">Change Password</a>
    </td></tr>
<tr><th>Birthday:</th><td><?php echo $result['birth_day'];  ?></td></tr>
<tr><th>Gender:</th><td><?php echo $result['gender'];  ?></td></tr>
<tr><th>Email:</th><td><?php echo $result['email'];  ?></td></tr>
<tr><th>Job Title:</th><td><?php echo $result['job_title'];  ?></td></tr>
<tr><th>Mobile:</th><td><?php echo $result['mobile'];  ?></td></tr>
</table>
</div>

</div>

</div>
        </div>
</body>
</html>