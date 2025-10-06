<?php
include('../../classes/dbConfig/config.php');
include_once('../../db/db_connect.php');
?>
<link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL; ?>css/jquery.dataTables.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo BASE_URL; ?>script/jquery-2.2.3.min.js"></script> 
<script type="text/javascript" src="<?php echo BASE_URL; ?>script/bootstrap.min.js"></script>

<script type="text/javascript" src="../exportData/tableExport.js"></script>
<script type="text/javascript" src="../exportData/jquery.base64.js"></script>
<script type="text/javascript" src="../exportData/html2canvas.js"></script>
<script type="text/javascript" src="../exportData/jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="../exportData/jspdf/jspdf.js"></script>
<script type="text/javascript" src="../exportData/jspdf/libs/base64.js"></script>
<script type="text/javascript" src="../exportData/jquery.table2excel.js"></script>
<style>

body{}

.middle{height:auto;margin:0 auto;border-radius:10px;
text-align:center;padding:20px;margin-top:20px;
}
.middle h1{margin-top:0;font-size:22px;text-transform: uppercase;} 
</style>

     <script type="text/javascript">
         
         function details(){
                  $.ajax({    //create an ajax request to load_page.php
                    type: "GET",
                    url: "tvc_report_detail.php",             
                    dataType: "html",   //expect html to be returned  
                    
                    success: function(response){                    
                        $("#detail_report").html(response); 
                        //alert(response);
                    }

                });
            }
            function all_tvc(){
                  $.ajax({    //create an ajax request to load_page.php
                    type: "GET",
                    url: "tvc_report_all.php",           
                    dataType: "html",   //expect html to be returned                
                    success: function(response){                    
                        $("#all").html(response); 
                        //alert(response);
                    }
                });
            }
            
             function reportByClient(){
                  $.ajax({    //create an ajax request to load_page.php
                    type: "GET",
                    url: "tvc_report_client.php",           
                    dataType: "html",   //expect html to be returned                
                    success: function(response){                    
                        $("#client").html(response); 
                        //alert(response);
                    }
                });
            }function tvc_chart(){
                  $.ajax({    //create an ajax request to load_page.php
                    type: "GET",
                    url: "tvc_chart_report.php",           
                    dataType: "html",   //expect html to be returned                
                    success: function(response){                    
                        $("#chart").html(response); 
                        //alert(response);
                    }
                });
            }
            

</script>
</head>
<body onload="all_tvc();">
<div class="middle" >

    <h1 class="page-header"><img src="../../img/report.png" alt="tvc icon" width="50"/>TVC  Report</h1>

  <ul class="nav nav-tabs">
       <li  class="active" ><a  href="#home" onclick="all_tvc();">All</a></li>
      <li ><a href="#menu1"  onclick="reportByClient();">Report by Client</a></li>
     
    <li><a href="#menu2" onclick="details();">Report by TVC(Broadcasting Time)</a></li>
   <?php if($_SESSION['user_type']=='super_admin'){ ?> <li><a href="#menu3" onclick="tvc_chart();">Report by chart</a></li>
<?php } ?>
     
  </ul>

  <div class="tab-content" style="background-color: #ccffff;">
   
      <div id="home" class="tab-pane fade in active">
            <div id="all" align="center" >
        </div>
    </div>
       <div id="menu1" class="tab-pane fade in active">     
        
        <div id="client" align="center">        </div>       
    </div>
    <div id="menu2" class="tab-pane fade">
       <div id="detail_report" align="center" > </div>
     </div>
 
      <div id="menu3" class="tab-pane fade">
       <div id="chart" align="center" > </div>
    </div> 
 


<script>
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
});

</script>

</div>
</div>


<script src="<?php echo BASE_URL; ?>admin/datetime/jquery.datetimepicker.js"></script>
<script src="<?php echo BASE_URL; ?>script/jquery.dataTables.min.js" type="text/javascript"></script>

</body>

