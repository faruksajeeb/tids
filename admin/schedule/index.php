<!doctype html><head>
   <meta http-equiv="Content-type" content="text/html; charset=utf-8">
   <title>Mini calendar in the scheduler header</title>
	<link   href="codebase/dhtmlxscheduler.css" type="text/css" media="screen" rel="stylesheet" title="no title" charset="utf-8">
	<script src="codebase/dhtmlxscheduler.js" type="text/javascript" charset="utf-8"></script>
   <script src="codebase/ext/dhtmlxscheduler_minical.js" type="text/javascript" charset="utf-8"></script>
   <script src="jquery-1.6.4.min.js" type="text/javascript"></script>

   
<style type="text/css" media="screen">
   html, body{
      margin:0px;
      padding:0px;
      height:100%;
      overflow:hidden;
   } 
.dhx_cal_tabb{ position:absolute;left:250px;top:18px;height:30px;width:170px;border-radius:5px;}  
.dhx_cal_tabb a{ text-decoration:none;}
li{list-style-type:none;}
input[type=checkbox]{position:absolute;left:170px;}
</style>
<script>
$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
              this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
});
</script>
<script type="text/javascript" charset="utf-8">
	function init() {
		scheduler.config.multi_day = true;
		
		scheduler.config.xml_date="%Y-%m-%d %H:%i";
		scheduler.init('scheduler_here',new Date(2015,0,10),"month");
		scheduler.load("./data/events.xml");
	}
	
	function show_minical(){
		if (scheduler.isCalendarVisible())
			scheduler.destroyCalendar();
		else
			scheduler.renderCalendar({
				position:"dhx_minical_icon",
				date:scheduler._date,
				navigation:true,
				handler:function(date,calendar){
					scheduler.setCurrentView(date);
					scheduler.destroyCalendar()
				}
			});
	}
</script>
</head>
<body onLoad="init();">
		<div style='float: left; padding:10px;'>
			<div id="cal_here" style='width:180px;'>
			<h3>Groups</h3>
			<ul>
				<li>Arrival<input type="checkbox" value="Arriaval" id="arrival"></li>
				<li>Deprature<input type="checkbox" value="Deprature" id="deprature"></li>
			</ul>
			<h3>Display</h3>
			<ul>
			    <li><input type="checkbox" id="selecctall"  style="position:absolute;left:30px;"/> Selecct All</li>
				<li><input type="checkbox" class="checkbox1" name="check[]" value="Arriaval" id="arrival">Client PC 1</li>
				<li><input type="checkbox" class="checkbox1" name="check[]" value="Deprature" id="deprature">Client PC 1</li>
				<li><input type="checkbox" class="checkbox1" name="check[]" value="Arriaval" id="arrival">Client PC 1</li>
				<li><input type="checkbox" class="checkbox1" name="check[]" value="Deprature" id="deprature">Client PC 1</li>
				<li><input type="checkbox" class="checkbox1" name="check[]" value="Arriaval" id="arrival">Client PC 1</li>
				<li><input type="checkbox" class="checkbox1" name="check[]" value="Deprature" id="deprature">Client PC 1</li>
				<li><input type="checkbox" class="checkbox1" name="check[]" value="Arriaval" id="arrival">Client PC 1</li>
				<li><input type="checkbox" class="checkbox1" name="check[]" value="Deprature" id="deprature">Client PC 1</li>
				<li><input type="checkbox" class="checkbox1" name="check[]" value="Arriaval" id="arrival">Client PC 1</li>
				<li><input type="checkbox" class="checkbox1" name="check[]" value="Deprature" id="deprature">Client PC 1</li>
				<li><input type="checkbox" class="checkbox1" name="check[]" value="Arriaval" id="arrival">Client PC 1</li>
				<li><input type="checkbox" class="checkbox1" name="check[]" value="Deprature" id="deprature">Client PC 1</li>
			</ul>
			</div>
		</div>
   <div id="scheduler_here" class="dhx_cal_container" style='width:auto;border-left:3px dotted #ccc;height:100%;'>
      <div class="dhx_cal_navline">		 
		 <div class="dhx_cal_today_button"></div>
         <div class="dhx_cal_prev_button">&nbsp;</div>
         <div class="dhx_cal_next_button">&nbsp;</div>  		 
         <div class="dhx_cal_date"></div>         
         <div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
         <div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
         <div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
		 
		 <div class="dhx_minical_icon" id="dhx_minical_icon" onClick="show_minical()">&nbsp;</div>		
      </div>
      <div class="dhx_cal_header">
	  
      </div>
      <div class="dhx_cal_data">
      </div>
   </div>
</body>