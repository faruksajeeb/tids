<?php
$class='Tids_settings';
require_once("../classes/class.".$class.".php");

if(isset($_REQUEST['save_change'])){
	extract($_REQUEST);
	if($tids_settings_obj->updateTidsSetting($id,$tids_refresh_duration,$tids_redirect_duration,$tids_alerm_duration,$tids_arrival_heading,$tids_departure_heading,$train_no,$train_name,$platform,$arr_schedule_time,$dep_schedule_time,$initial_station,$destination,$arrival_probable_time,$departure_probable_time,"tbl_setting")){
		header("location:tids_settings.php?updated_success");
	}else{
		header("Location:tids_settings.php?updated_failure");
	}
}

foreach($tids_settings_obj->showData("tbl_setting") as $value):
    extract($value);
echo <<<ARTS

<!DOCTYPE html>
<html>
    <head>
        <title>TIDS Settings</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <style>
            body{}
            .middle{height:auto;width:50%;margin:0 auto;border-radius:10px;
                    text-align:center;padding:20px;
                    border:1px solid #ccc;
            }
            .middle h1{margin-top:0;font-size:22px;text-transform: uppercase;} 
        </style>
    </head>
    <body>
        <div class="middle" style="">
            
            <h1 class=""><span class="glyphicon glyphicon-cog"></span> TIDS settings</h1>
ARTS;
$message='message';
include_once($message.".php");
echo <<<ARTS
            <form class="" style=" text-align:left;" action="tids_settings.php" method="POST">
                <input type="hidden" name="id"  value="$id  " >
                <table class="table" style="text-align:left" >
                    <tr>
                        <td>
                            <table  class="table"  >                            
                                <tr>
                                    <td><strong>TIDS template refresh time: </strong>
                                        <div class="form-group has-warning has-feedback">  
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-repeat"></span> Min in English</span>
                                                <input type="text" name="tids_refresh_duration"  value="$tids_refresh_duration" class="form-control" id="inputWarning2" aria-describedby="inputWarning2Status">
                                                <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>
                                                <span id="inputWarning2Status" class="sr-only">(warning)</span>
                                            </div>
                                        </div>  </td>
                                </tr>
                                <tr>
                                    <td><strong>TIDS Redirect time: </strong>
                                        <div class="form-group has-warning has-feedback">  
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-refresh"></span> Sec in English</span>
                                                <input type="text" name="tids_redirect_duration" class="form-control" value="$tids_redirect_duration  " id="inputWarning2" aria-describedby="inputWarning2Status">
                                                <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>
                                                <span id="inputWarning2Status" class="sr-only">(warning)</span>
                                            </div>
                                        </div>   </td>
                                </tr>
                                <tr>
                                    <td><strong>TIDS alerm time : </strong>
                                        <div class="form-group has-warning has-feedback">  
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span> Min in english</span>
                                                <input type="text" name="tids_alerm_duration" value="$tids_alerm_duration  " class="form-control" id="inputWarning2" aria-describedby="inputWarning2Status">
                                                <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>
                                                <span id="inputWarning2Status" class="sr-only">(warning)</span>
                                            </div>
                                        </div>   </td>
                                </tr>


                            </table>
                        </td>
                        <td>
                            <table class=" table"  >                              
                                <tr>
                                    <td><strong>Train no label: </strong>
                                        <div class="form-group has-warning has-feedback">  
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span> in Bangla</span>
                                                <input type="text" name="train_no" value="$train_no  " class="form-control" id="inputWarning2" aria-describedby="inputWarning2Status">
                                                <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>
                                                <span id="inputWarning2Status" class="sr-only">(warning)</span>
                                            </div>
                                        </div>   </td>
                                </tr>
                                <tr>
                                    <td><strong>Train name label:</strong>
                                        <div class="form-group has-warning has-feedback">  
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span> in Bangla</span>
                                                <input type="text" name="train_name" value="$train_name  " class="form-control" id="inputWarning2" aria-describedby="inputWarning2Status">
                                                <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>
                                                <span id="inputWarning2Status" class="sr-only">(warning)</span>
                                            </div>
                                        </div>   </td>
                                </tr>
                                <tr>
                                    <td><strong>Platform no label: </strong>
                                        <div class="form-group has-warning has-feedback">  
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span> in Bangla</span>
                                                <input type="text" name="platform" value="$platform  " class="form-control" id="inputWarning2" aria-describedby="inputWarning2Status">
                                                <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>
                                                <span id="inputWarning2Status" class="sr-only">(warning)</span>
                                            </div>
                                        </div>  </td>
                                </tr>
                            </table>
                        </td>
                    </tr>         
                </table> 
              
                <div class="form-group has-warning has-feedback"> 
                    <label class="control-label" for="inputGroupSuccess1">Arrival Heading:</label>
                    <div class="input-group">
                        
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span> in Bangla</span>
                        <input type="text" name="tids_arrival_heading" class="form-control" value="$tids_arrival_heading  " id="inputWarning2" aria-describedby="inputWarning2Status">
                        <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>
                        <span id="inputWarning2Status" class="sr-only">(warning)</span>
                    </div>
                </div>
                <div class="form-group has-warning has-feedback"> 
                     <label class="control-label" for="inputGroupSuccess1">Departure Heading:</label>
                    <div class="input-group">
                       
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span> in Bangla</span>
                        <input type="text" name="tids_departure_heading" class="form-control" value="$tids_departure_heading  " id="inputWarning2" aria-describedby="inputWarning2Status">
                        <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>
                        <span id="inputWarning2Status" class="sr-only">(warning)</span>
                    </div>
                </div>
          
                <table class=" table" style="text-align:left" >
                    <tr>
                        <td>
                            <table  class="table"  >
                                <tr><td style="text-align:center; font-weight: bold"><h4>Arrival</h4></td></tr>

                                <tr>
                                    <td><strong>arrival schedule time lable: </strong>
                                        <div class="form-group has-warning has-feedback">  
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span> in Bangla</span>
                                                <input type="text" name="arr_schedule_time" value="$arr_schedule_time  " class="form-control" id="inputWarning2" aria-describedby="inputWarning2Status">
                                                <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>
                                                <span id="inputWarning2Status" class="sr-only">(warning)</span>
                                            </div>
                                        </div>  </td>
                                </tr>
                                <tr>
                                    <td><strong>Initial Station label: </strong>
                                        <div class="form-group has-warning has-feedback">  
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span> in Bangla</span>
                                                <input type="text" name="initial_station" value="$initial_station  " class="form-control" id="inputWarning2" aria-describedby="inputWarning2Status">
                                                <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>
                                                <span id="inputWarning2Status" class="sr-only">(warning)</span>
                                            </div>
                                        </div>   </td>
                                </tr>
                                <tr>
                                    <td><strong>Arrival probable time label: </strong>
                                        <div class="form-group has-warning has-feedback">  
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span> in Bangla</span>
                                                <input type="text" name="arrival_probable_time" value="$arrival_probable_time  " class="form-control" id="inputWarning2" aria-describedby="inputWarning2Status">
                                                <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>
                                                <span id="inputWarning2Status" class="sr-only">(warning)</span>
                                            </div>
                                        </div>   </td>
                                </tr>


                            </table>
                        </td>
                        <td>
                            <table class=" table"  >
                                <tr><td style="text-align:center;font-weight: bold"><h4>Departure</h4></td></tr>

                                <tr>
                                    <td><strong>departure schedule time lable: </strong>
                                        <div class="form-group has-warning has-feedback">  
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span> in Bangla</span>
                                                <input type="text" name="dep_schedule_time" value="$dep_schedule_time  " class="form-control" id="inputWarning2" aria-describedby="inputWarning2Status">
                                                <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>
                                                <span id="inputWarning2Status" class="sr-only">(warning)</span>
                                            </div>
                                        </div>   </td>
                                </tr>
                                <tr>
                                    <td><strong>Destination label: </strong>
                                        <div class="form-group has-warning has-feedback">  
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span> in Bangla</span>
                                                <input type="text" name="destination" value="$destination  " class="form-control" id="inputWarning2" aria-describedby="inputWarning2Status">
                                                <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>
                                                <span id="inputWarning2Status" class="sr-only">(warning)</span>
                                            </div>
                                        </div>   </td>
                                </tr>
                                <tr>
                                    <td><strong>Departure probabale time label: </strong>
                                        <div class="form-group has-warning has-feedback">  
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span> in Bangla</span>
                                                <input type="text" name="departure_probable_time" value="$departure_probable_time  " class="form-control" id="inputWarning2" aria-describedby="inputWarning2Status">
                                                <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>
                                                <span id="inputWarning2Status" class="sr-only">(warning)</span>
                                            </div>
                                        </div>  </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>

                        <td colspan="2">
                            
                            <input type="submit" name="save_change" value="Save Change" class="btn btn-warning btn-md pull-right" />
                                <a href="dashboard.php" class="btn btn-info btn-md pull-right" style="margin-right:5px;">Cancel</a>
        
                                </td>

                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
ARTS;
endforeach;
?>
