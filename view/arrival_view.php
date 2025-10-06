<!DOCTYPE html>
<html>
    <head>
        <title>TIDS-<?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />		
        <link rel="shortcut icon" href="../img/arts_logo_icon.png" type="image/png">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../css/slider.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="../css/arrival/arrival.css" rel="stylesheet" type="text/css" media="all"/>

        <script type="text/javascript" src="../script/jquery-1.9.1.min.js"></script>        
        <script type="text/javascript" src="../script/jquery.nivo.slider.js"></script>
        <script type="text/javascript" src="../script/arrival/arrival.js"></script> 	
    </head>
    <body onLoad="setInterval('blink()',1000);">
        <div id="main">
            <div class="page_header"><?php include "header_view.php";?></div>
            <div id="schedule"><!--Train information display here --></div>
            <div id="footer"><?php include "footer_view.php";?></div>
        </div>
    </body>
</html>

