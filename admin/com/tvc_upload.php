<?php
include('../../classes/dbConfig/config.php');
include_once('../../db/db_connect.php');
include("../../getDur/getid3/getid3.php");
$message='';
//ini_set("post_max_size", "1024M");
//ini_set("upload_max_filesize", "1024M");
//ini_set("memory_limit", "1024M"); 
/*
foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
    $file_name = $key.$_FILES['files']['name'][$key];
    $file_size =$_FILES['files']['size'][$key];
    $file_tmp =$_FILES['files']['tmp_name'][$key];
    $file_type=$_FILES['files']['type'][$key];
}*/

//echo 'Hello';
if(!empty($_FILES)) {
    $i=1;
foreach($_FILES['txtfile']['tmp_name'] as $key => $tmp_name ){
if(is_uploaded_file($_FILES['txtfile']['tmp_name'][$key])) {   
                  $filename=$_FILES['txtfile']['name'][$key];
                  $file=preg_replace('/[^A-Za-z0-9 _ .-]/', '', $filename);
                  $file_type = $_FILES['txtfile']['type'][$key];
                  $file_size = $_FILES['txtfile']['size'][$key];
                  $directory="../../com/videos/";                   
                  if($file){                      
                      $target_file = $directory . basename($file);  
                      $check = preg_match('/video\//',$file_type);
                      $file_ext_type = pathinfo($target_file, PATHINFO_EXTENSION);
                      if($check):
                            if (file_exists($target_file)) {
                                echo "File-".$file.' <font color=red>already exists. Please select a new file.<br/></font>';
                                //exit();
                            } else {
                                if ($file_size > 2147483648 /*bytes*/) { 
                                    echo '<font color=red>Sorry,</font> File-'.$file. '<font color=red> is too large.Maximum size 2GB<br/></font>';
                                    //exit();
                                } else {
                                        if ($file_ext_type != 'mp4' && $file_ext_type != 'webm') {
                                            echo "File-".$file.'<font color=red>Sorry, only mp4 & webm files are allowed.<br/></font>';
                                        } else {											 
											 $uploadOk=move_uploaded_file($_FILES['txtfile']['tmp_name'][$key], $target_file);
											 echo "File-".$file." <font color=green>Uploaded Successfully! <br/></font> ";												
                                            if($uploadOk){
											   /* 
                                                    if insert or duration is not work on linux server please get file permission ........
                                                    sudo chmod -R 777 /var/www/html/tids_airport/getDur/
                                                    sudo chmod -R 777 /var/www/html/tids_airport/getDur/getid3/
                                                    then restart apache server
                                                 */
											   $getID3 = new getID3;												 
												$path ="$directory/$file";
												$mixinfo = $getID3->analyze( $path );
												 
												// Optional: copies data from all subarrays of [tags] into [comments] so
												// metadata is all available in one location for all tag formats
												// metainformation is always available under [tags] even if this is not called
												getid3_lib::CopyTagsToComments($mixinfo);
												 
												// Output desired information in whatever format you want
												// Note: all entries in [comments] or [tags] are arrays of strings
												// See structure.txt for information on what information is available where
												// or check out the output of /demos/demo.browse.php for a particular file
												// to see the full detail of what information is returned where in the array
												//echo @$ThisFileInfo['comments_html']['artist'][0]; // artist from any/all available tag formats
												//echo @$ThisFileInfo['tags']['id3v2']['title'][0];  // title from ID3v2
												//$bit_rate = $mixinfo['audio']['bitrate'];           // audio bitrate
												$play_time = $mixinfo['playtime_seconds'];            // playtime in minutes:seconds, formatted string
												 
												//print_r($mixinfo);
												 /*
												list($mins , $secs) = explode(':' , $play_time);
												 
												if($mins > 60)
												{
													$hours = intval($mins / 60);
													$mins = $mins - $hours*60;
												}
												 
												$play_time = sprintf("%02d:%02d:%02d" , $hours , $mins , $secs);
												 */
												//echo $play_time;
												$duration=$play_time;                 
											$sql="INSERT INTO tbl_tvc(client_id,tvc_name,duration,type,size) VALUES(".$_POST['cname'].",'$file','$duration','$file_type','$file_size')";
											$conn->query($sql);
                                            }else{
                                                die(mysql_error());
                                               echo '<font color=red>There was a problem Uploading file and Query problem</font>';
                                            }
                                        }
                                }
                                
                            }
                        else:
                              echo " <font color=red>The File-</font>".$i. "<font color=red> is not a video file.<br/></font>";           
                        endif;
                    }else{
                        echo '<font color=red>Please select a file.</font>';
                        //exit();
                    }
            $company_name=$_FILES['txtfile']['name'][$key];
            $username=$_SESSION['user_name'];
            $ip_addr=$_SERVER['REMOTE_ADDR'];
            $auditQry = "INSERT into tbl_auditor(username,ipaddr,description,train_no,action) 
              VALUES ('$username','$ip_addr','Add into Video list table','$company_name','Add')";
            $audit_result=$conn->query($auditQry);
$i++;
            
                    }}
}else{
                        echo '<font color=red>Please select a file.</font>';
                        //exit();
                    }

?>