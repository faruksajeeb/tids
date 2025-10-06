<?php
include("../classes/dbConfig/config.php");
include('../classes/class.Admin_login.php');
if(isset($_SESSION['uid'])){
    header('Location:dashboard.php');
}
$userClass = new userClass();

//$errorMsgReg='';
$errorMsgLogin = '';
/* Login Form */
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
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        
        <title>ARTS-Admin</title>
        <link rel="icon" href="<?php echo BASE_URL; ?>img/arts_logo_icon.png" type="image/png">
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>/admin/style.css" media="screen" type="text/css" />
        <link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <script src="../script/jquery-2.2.3.min.js" type="text/javascript"></script>
        <!--[if IE]><script type="text/javascript" src="excanvas.js"></script><![endif]-->
        <script src="../script/coolclock.js" type="text/javascript"></script>
        <script src="../script/moreskins.js" type="text/javascript"></script>

    </head>

    <body>
        <span style="position: fixed; right:20px;top:20px;">
         <!--   <img src="../images/alarmclock.gif"/> -->
            <canvas class="CoolClock:::::showDigital:logClockRev"></canvas>
        </span>
        <div class="login-wrap">
           
            <div style="background-color:#1387C4"; margin-top:0px; padding:5px;">
                <img src="../images/arts_logo.png" width="320"/><br/>
            </div>
            <div style="padding:15px; text-align:center;">
                <span style="color:red;text-align:center;font-weight:bold"><?php echo $errorMsgLogin; ?></span>
                <form method="post" action="">
                    <div class="form">
                        <input type="text" placeholder="Username" name="usernameEmail" id="user_name" required/>
                        <span class="icon-unlock"></span><input type="password" placeholder="Password" name="password" id="password" required />
                        <input type="submit" value="LOG IN" name="loginSubmit" id="Submit"/>
                    </div>
                </form>
                <div id="version"><small >ARTS Software Solutions</small></div>
            </div>
        </div>
    </body>
</html>
