<?php
include('../classes/dbConfig/config.php');
include('../classes/session.php');
$userDetails = $welcome_obj->userDetails($session_uid);
?>
<!DOCTYPE html>
<html>
    <head>
       <title>ARTS-Admin</title>
        <link rel="icon" href="<?php echo BASE_URL; ?>img/arts_logo_icon.png" type="image/png">
        <link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo BASE_URL; ?>css/metisMenu.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo BASE_URL; ?>css/sb-admin-2.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo BASE_URL; ?>script/jquery-1.9.1.min.js"></script>
        <style>
            @font-face {
                font-family: myFirstFont;
                src: url(../fonts/SolaimanLipi.ttf);
            }
body{	
	font-family: myFirstFont;
}
.company_name{
    height: 100px;
}
.dynamic_area iframe {width: 100%;height:760px;z-index:2;}
#nav{ }
#nav li{float:left;list-style-type:none; position:relative;z-index:1;}
#nav a {padding:20px 30px;font-weight:bold; width:160px; display:block; background-color:#666666;color:#fff; text-decoration:none; border-left:1px solid #fff;border-right:1px solid #fff;}
#nav a:hover {background-color:#009999;}
#nav li>ul li a{border-bottom:1px solid #FFFFFF;}
#nav ul{display:none; position:absolute; padding:0; width:160px;}
#nav li:hover>ul{display:block; background-color:#009999;color:#FFFFFF;border-bottom-right-radius:5px;border-bottom-left-radius:5px; border-bottom:1px solid #FFFFFF;}
#nav li>ul li a:hover{background-color:#009999;color:#FFFFFF; border-bottom:1px solid #FFFFFF;}
#nav li:hover{display:block; background-color:#009999; border-radius:5px;}
#nav ul ul{left:160px; top:0;}
.hearder {padding-top:5px; }
        </style>
        
<script type="text/javascript">
idleTime = 0;
$(document).ready(function() {

                setInterval(function () { $('#clock1').load('../view/clock.php') }, 1000);
  
    var idleInterval = setInterval("timerIncrement()",30*6000); // 1 minute=6000
    $(this).mousemove(function(e) {
        idleTime = 0;
    });
    $(this).keypress(function(e) {
        idleTime = 0;
    });

});

function timerIncrement() {

    idleTime = idleTime + 1;

    if (idleTime >= 5) {
        window.location ="<?php echo BASE_URL; ?>classes/lock.php";
    }
}
    /*
    setTimeout(function () {
        window.location.href = "logout.php";
    }, 60 * 10 * 60 * 60); // 30 minutes 
    */

  
</script>

    </head>
    <body>
        <div id="wrapper">
            <div class="hearder" role="navigation" style=" ">
                <div class="row company_name" style="">
                    <a class="navbar-brand" href="<?php echo BASE_URL; ?>admin/dashboard.php" >
                        <img style="float:left;margin-left:20px; margin-top:-12px; height:70px;" src="<?php echo BASE_URL; ?>images/arts_logo.png" alt="ARTS TIDS(Logo)" >			
                    </a>

                    <ul class="navbar-top-links navbar-right " style="margin-right:5px;">
                        <li>
                            <b>Welcome to Khulna TIDS</b> 
                            <a href="<?php echo BASE_URL; ?>classes/lock.php"><span class="glyphicon glyphicon-lock"></span> Lock</a>
                            <a href="admin_profile.php" target="divId"><img src='<?php echo BASE_URL; ?>images/admin/<?php echo $userDetails->image; ?>' height="50" width="50" class="img-circle"> <b> <?php echo $userDetails->name; ?>
                                </b>
                            </a>
                        </li>
                       <li>
                            <a href="<?php echo BASE_URL; ?>classes/logout.php" class="btn btn-danger btn-xs"> <b>Log Out</b> <i class="fa fa-sign-out"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="row topnav">
                    <div class="col-md-12" style="background-color:#666666 ">
                        <ul id="nav">
                            <li><a href="dashboard.php" >Dashboard</a></li>
                            <li><a >Schedule</a>
                                <ul>
                                    <li><a href="<?php echo BASE_URL; ?>admin/arrival/display.arrival_schedule.php" target="divId">Arrival</a></li>						
                                    <li><a href="<?php echo BASE_URL; ?>admin/departure/display.departure_schedule.php" target="divId">Departure</a></li>                                                
                                </ul>
                            </li>                                                                 
                            <li><a  >Train List</a>
                              <ul>
                                    <li><a href="<?php echo BASE_URL; ?>admin/arrival/display.arrival_train_list.php" target="divId" >Arrival</a></li>
                                    <li><a href="<?php echo BASE_URL; ?>admin/departure/display.departure_train_list.php" target="divId" >Departure</a></li>
                                </ul>
                             
                            </li>

                            <li><a href="<?php echo BASE_URL; ?>admin/com/display.tvc.php" target="divId" >ARTS tv</a></li>
                            <li><a   >Display</a>
                                <ul>
                                    <li><a href="arrival_display.php" target="divId">Arrival</a></li>						
                                    <li><a href="departure_display.php" target="divId">Departure</a></li>                                                
                                </ul>
                            </li>
                            <li><a >Scroll</a>
                                <ul>
                                    <!-- <li><a href="display_scroll_up_superadmin.php" target="divId">Scroll Up</a></li> -->
                                    <li><a href="<?php echo BASE_URL; ?>admin/scroll/view.tids_scroll.php" target="divId">TIDS Scroll</a></li>
                                    <li><a href="<?php echo BASE_URL; ?>admin/scroll/view.tvc_scroll.php" target="divId">TVC Scroll</a></li>
                                </ul>
                            </li>
                            <?php
                            if ($userDetails->usertype == 'super_admin') {
                                ?>
                                <li><a href="audit_trial.php" target="divId" >Administration</a></li>
                            <?php } ?>
                            <li><a >Advance</a>
                                <ul>
                                    <!-- <li><a href="display_scroll_up_superadmin.php" target="divId">Scroll Up</a></li> -->
                                    <li><a href="export_database.php" target="divId"><i class="fa fa-download" aria-hidden="true"></i>  Backup Database</a></li>

                                </ul>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
           <div class="container-fluid ">
			<div class="row">
				<div class="dynamic_area" >
					<iframe id="divId" name="divId" src="admin_welcome.php" frameborder="0"></iframe>				
				</div>				
			</div>
			<div class="row" style="text-align:center">
			    <div class="col-md-12">Copyright @ <?php echo date('Y');?> || ARTS Software Solutions</div>
			</div>
		</div>
        </div>
        <script src="<?php echo BASE_URL; ?>script/bootstrap.min.js"></script>
    </body>
</html>
<span id="clock1" style="position: fixed; left:0;bottom:50px; color: #fff; background: #333333; padding: 5px; border-bottom-right-radius: 5px; border-top-right-radius: 5px;"></span>



