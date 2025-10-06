<?php
include_once('pagesession.php');
include_once('dbconnect.php');
include("../getDur/getid3/getid3.php");
if(isset($_POST['btn-upload'])){    
                  $filename=$_FILES['file']['name'];
                  $file=preg_replace('/[^A-Za-z0-9 _ .-]/', '', $filename);
                  $file_type = $_FILES['file']['type'];
                  $file_size = $_FILES['file']['size'];
                  $directory="../commercial/videos/";                   
                  if($file){                      
                      $target_file = $directory . basename($file);  
                      $check = preg_match('/video\//',$file_type);
                      $file_ext_type = pathinfo($target_file, PATHINFO_EXTENSION);
                      if($check):
                            if (file_exists($target_file)) {
                                $message ='<font color=red>File already exists. Please select a new file.</font>';
                                //exit();
                            } else {
                                if ($file_size > 500000000) {
                                    $message = '<font color=red>Sorry, your file is too large.</font>';
                                    //exit();
                                } else {
                                        if ($file_ext_type != 'mp4' && $file_ext_type != 'webm') {
                                            $message = '<font color=red>Sorry, only mp4 & webm files are allowed.</font>';
                                        } else {
                                                 $uploadOk=move_uploaded_file($_FILES['file']['tmp_name'], $target_file);
                                           
                                            if($uploadOk){
                                                $message = "<font color=green>Uploaded Successfully</font> !";
                                                $file_du_name="$directory/$file";
                                                $getID3 = new getID3;
                                                $filee = $getID3->analyze($file_du_name);
                                                $duration=$filee['playtime_seconds'];                  
                                                $sql="INSERT INTO tbl_video_ads(company_id,title,duration,type,size) VALUES(".$_POST['cname'].",'$file','$duration','$file_type','$file_size')";
                                                mysql_query($sql);
                                            }else{
                                                die(mysql_error());
                                                $message ='<font color=red>There was a problem Uploading file and Query problem</font>';
                                            }
                                        }
                                }
                                
                            }
                        else:
                              $message = "<font color=red>The selected file is not a video file.</font>";           
                        endif;
                    }else{
                        $message= '<font color=red>Please select a file.</font>';
                        //exit();
                    }
            $company_name=$_FILES['file']['name'];
            $username=$_SESSION['user_name'];
            $ip_addr=$_SERVER['REMOTE_ADDR'];
            $auditQry = "INSERT into tbl_auditor(username,ipaddr,description,train_no,action) 
              VALUES ('$username','$ip_addr','Add into Video list table','$company_name','Add')";
            $audit_result=mysql_query($auditQry);
}