<?php
$title = "ছাড়ার সময়সূচী";
$class = 'Departure';
require_once("../classes/class." . $class . ".php");
foreach ($dep_obj->showData("tbl_setting") as $value):
    extract($value);
    $refresh_time = $tids_refresh_duration * 60;
    header("Refresh:$refresh_time; URL=index.php");
    include '../view/departure_view.php';
endforeach;
?>

<style>

    #main{
        //  background-color:#000;
    }
    html{
        background-color:#fff;
    }
    body{
        cursor: none;
        width:80%;
        overflow-y:hidden;
        overflow-x:hidden; 
        margin:0 auto;
        border:3px ridge red;
        height: 100%;
        //background-image: url('../img/platform5.jpg');
        background-size:80% 900px;
        background-color:#000;
        //opacity:0.95;
        font-family: myFirstFont;

    }
    #footer{

        overflow-y:hidden;
        overflow-x:hidden; 

        margin:0 auto;


    }
    .marquee_bottom{
        /*/ position: relative;*/
        width:80%;
        overflow-y:hidden;
        overflow-x:hidden; 
        margin:0 auto;
        border-bottom:3px inset red;

    }
    #clock1{ 	
        width:12.5%;
        height: 100px;
        line-height:25px; /* this is what you must define */
        vertical-align: middle;
        position:fixed;
        bottom:0px;
        right:10%;
        margin-bottom:0px;	
        z-index:5;
        border: 2px inset White; 
        background: Black; 
        padding:15px;
        font-size:20px; 
        font-family:clock; 
        font-weight:bold;
        color: LightGreen; 					 
        display: block; 
        text-align:center;
        border-bottom:3px solid red;
        border-right:3px solid red;
    }
    .page_header{
        background-color:#ff0; color:#000;
    }
    th{background-color:#FF8C00; color:#000;}
    tr:nth-child(odd){background-color:#FFD700;}
    tr:nth-child(even){background-color:#ff0;}

    .artslogo{ 
        position:fixed;
        height:100px;
        width:200px;
        bottom:0px;
        left:10%;
        margin-bottom:0px;	
        z-index:9999; 
        border-left:3px solid red;

    }
    .marquee_bottom{ 
        background-color:#ff0 ; color:#fff;
        border-top:2px solid #ccc;
    }
    td{
        //background-color:#800000;
    }
</style>