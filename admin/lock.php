<?php
include('../classes/dbConfig/config.php');
include('../classes/class.Admin_login.php');
$userClass = new userClass();

if(empty($_SESSION['uid']))
{
$url=BASE_URL.'admin/index.php';
header("Location: $url");
}
if(!empty($_SESSION['password'])){
    $url=BASE_URL.'admin/dashboard.php';
header("Location: $url");
}
$errorMsgLogin = '';
if (!empty($_POST['unlockSubmit'])) {    
    $user_id = $_SESSION['uid'];
    $password = $_POST['password'];
    if (strlen(trim($password)) > 1) {
        $uid = $userClass->userUnlock($user_id,$password);
//echo $uid;
//exit;
        if ($uid != '') {
            //  header('Location:dashboard.php');
            $url = BASE_URL . 'admin/dashboard.php';
            header("Location: $url"); // Page redirecting to home.php 
        } else {
            $errorMsgLogin = "Sorry ! that password is incorrect. Make sure you're using the password for your ARTS tids account .";
        }
    }
}
/*
include("../classes/dbConfig/config.php");
include('../classes/class.Admin_login.php');
if(isset($_SESSION['uid'])){
    header('Location:dashboard.php');
}
$userClass = new userClass();

//$errorMsgReg='';
$errorMsgLogin = '';
/* Login Form */
/*
if (!empty($_POST['loginSubmit'])) {
    $usernameEmail = $_POST['usernameEmail'];
    $password = $_POST['password'];
    if (strlen(trim($usernameEmail)) > 1 && strlen(trim($password)) > 1) {
        $uid = $userClass->userLogin($usernameEmail, $password);
//echo $uid;
//exit;
        if ($uid != '') {
            //  header('Location:dashboard.php');
            $url = BASE_URL . 'admin/dashboard.php';
            header("Location: $url"); // Page redirecting to home.php 
        } else {
            $errorMsgLogin = "Please check login details.";
        }
    }
}

 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        
        <title>ARTS-Admin</title>
        <link rel="icon" href="<?php echo BASE_URL; ?>img/arts_logo_icon.png" type="image/png">      
        <link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <style>
            * {box-sizing: border-box;margin: 0;padding: 0;}
html {background-color:#000;background-image: url(../images/lock_bg.jpg); background-repeat:no-repeat; background-size:cover;font-family: 'Helvetica Neue', Arial, Sans-Serif;}
html .lock-wrap {/*transform: perspective( 600px ) rotateX( 45deg );*/height:225px;text-align: center;position: relative;margin: 20% auto;width: 550px;border-radius: 0;padding:0px;}
#user_image{
    background-color:#1D6294; margin-top:0px; float: left; width:200px; height: 200px; position: relative
}
#unlock-form{
    padding:0 0 0 15px; text-align:center; float: left;width:300px; 
}
html .lock-wrap .form input[type="password"]{width:100%;margin-bottom: 5px;height: 40px;outline: 0;-moz-outline-style: none;}
html .lock-wrap .form input[type="submit"]{float:left;width:50%;margin-bottom: 5px;height: 30px;outline: 0;-moz-outline-style: none;}

html .lock-wrap .form input[type="submit"] {background:#4CAF50;  border: none;  color: white;  font-size: 18px;  font-weight: 200;  cursor: pointer;  transition: box-shadow .4s ease;}
html .lock-wrap .form input[type="submit"]:hover {  box-shadow: 1px 1px 5px #555;}
html .lock-wrap .form input[type="submit"]:active {  box-shadow: 1px 1px 7px #222;}

        </style>
    </head>

    <body>
        <div class="lock-wrap">
            <div id="user_image" style="">               
                <img src="../images/admin/<?php echo $_SESSION['user_image']?>" width="200" height="200" alt="User Image"/>
                <a href="<?php echo BASE_URL; ?>classes/logout.php" style="text-decoration: none;"> <div style="background-color: #008CBA;color:#fff; width: 100%; padding: 5px;" >Not <?php echo $_SESSION['user_name']?>?</div></a>
            </div>            
            <div id="unlock-form"style="">
                <h1 style="color:#fff;font-weight: bold; text-align: left;"><?php echo $_SESSION['user_name']?></h1>
                <span style="color:#fff; float: left;"> Locked</span><br/>
                <br/>
                <form method="post" action="">
                    <div class="form">
                       
                       <span class="icon-unlock"></span><input type="password" placeholder="Password" name="password" id="password" required />
                        <input type="submit" value="Unlock" name="unlockSubmit" id="Submit"/>
                        
                    </div>
                </form>
                </br>
                </br>
               <div><span style="color:red;text-align:center;font-weight:bold"><?php echo $errorMsgLogin; ?></span></div> 
            </div>
             
        </div>
       
    </body>
</html>
