<?php
include("../classes/dbConfig/config.php");
include('../classes/class.Welcome.php');
$userClass = new userClass();

$errorMsgReg = '';
/* Signup Form */
if (!empty($_POST['signupSubmit'])) {
    $username = $_POST['usernameReg'];
    $user_full_name = $_POST['nameReg'];
    $email = $_POST['emailReg'];
    $password = $_POST['passwordReg'];
    $user_type = $_POST['txt_user_type'];

    /* Regular expression check */
    $username_check = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $username);
    $email_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $email);
    $password_check = preg_match('~^[A-Za-z0-9!@#$%^&*()_]{6,20}$~i', $password);

    if ($username_check && $email_check && $password_check && strlen(trim($name)) > 0) {
        $uid = $userClass->userRegistration($username, $password, $email, $name);
        if ($uid) {
            $url = BASE_URL . 'home.php';
            header("Location: $url"); // Page redirecting to home.php 
        } else {
            $errorMsgReg = "Username or Email already exists.";
        }
    }
}



//............................................................................................................


/*
  include_once('pagesession.php');
  include_once('dbconnect.php');
  if(isset($_POST['submit']))
  {
  $username=$_SESSION['user_name'];
  $ip_addr=$_SERVER['REMOTE_ADDR'];
  $auditQry = "INSERT into tbl_auditor(username,ipaddr,description,train_no,action)
  VALUES ('$username','$ip_addr','Add new user into admin table','".$_POST['txtuser']."','Add')";
  $audit_result=mysql_query($auditQry);

  $user=$_POST['txt_user'];
  $password=md5($_POST['txt_pass']);
  $usertype=$_POST['txt_user_type'];
  $query="INSERT  INTO tbl_admin(username,password,usertype) VALUES('$user','$password','$usertype')";
  $rstt=mysql_query($query);
  header("location:admin_users.php");
  }
 */
?>
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Create New Users</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <style>
            body{}
            .middle{height:auto;width:30%;margin:0 auto;border-radius:10px;
                    text-align:center;padding:20px;margin-top:50px;
                    box-shadow:-2px 2px 15px #ccc,2px 2px 15px #ccc,2px -2px 15px #ccc,-2px -2px 15px #ccc;
            }
        </style>
    </head>
    <body>
        <div class="middle" style="">
            <h1 class="page-header">Create New Users</h1>
            <div style="width:100% ">

                <form name="form1" id="form1" method="post" action="" enctype="">
                    <table class="table-condensed table-hover ">
                        <tr>
                            <td>Username</td>
                            <td><input name="usernameReg" type="text"  class="form-control" id="usernameReg" size="40"/></td>
                        </tr>
                        <tr>
                            <td>Full Name</td>
                            <td><input name="nameReg" type="text"  class="form-control" id="nameReg" size="40"/></td>
                        </tr>
                        <tr>
                            <td>User email</td>
                            <td><input name="emailReg" type="text"  class="form-control" id="emailReg" size="40"/></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input name="passwordReg" type="password"  class="form-control" id="passwordReg" size="40"/></td>
                        </tr>
                        <tr>
                            <th>Usertype</th>
                            <td>
                                <select name="txt_user_type"  id="txt_user_type"class="form-control">
                                    <option>select Usertype</option>
<?php
$q = "select * from tbl_user_type";
$rest = mysql_query($q);
while ($row = mysql_fetch_row($rest)) {
    ?>
                                        <option value="<?php echo $row[1] ?>"><?php echo $row[1] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr> 
                        <td>&nbsp;</td>
                        <td><input type="submit" name="signupSubmit" id="signupSubmit" value="Submit Scroll" class="btn btn-success btn-sm" />   </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>
