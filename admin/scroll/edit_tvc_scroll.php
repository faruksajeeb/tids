<?php
include('../../classes/dbConfig/config.php');
include_once('../../db/db_connect.php');
$xquery="SELECT * FROM tbl_tvc_news_ticker WHERE ticker_id='".$_GET['id']."'";
$result=$conn->query($xquery);
$rows=$result->fetch_assoc();
if(isset($_POST['submit'])){
	
$username=$_SESSION['user_name'];
$ip_addr=$_SERVER['REMOTE_ADDR'];
$auditQry = "INSERT into tbl_auditor(username,ipaddr,description,train_no,action)
  VALUES ('$username','$ip_addr','Update from TVC scroll table','".$_POST['hd']."','edit')";
$conn->query($auditQry);

$x="UPDATE tbl_tvc_news_ticker SET ticker_name='".$_POST['ticker_name']."',ticker_description='".$_POST['ticker_description']."' ,text_color='".$_POST['tcolor']."',background_color='".$_POST['bcolor']."' WHERE ticker_id='".$_POST['hd']."' ";
$conn->query($x);
header("location:view.tvc_scroll.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Update TVC Scroll</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<style>
body{}
.middle{height:auto;width:30%;margin:0 auto;border-radius:10px;
text-align:center;padding:20px;margin-top:50px;
box-shadow:-2px 2px 15px #ccc,2px 2px 15px #ccc,2px -2px 15px #ccc,-2px -2px 15px #ccc;
}
.middle h1{margin-top:0;font-size:22px;text-transform: uppercase;} 
</style>
<script>
function myFunction() {
    var x = document.getElementById("txtcolor").value;
    document.getElementById("tcolor").value = x;
}
function myFunction2() {
    var x = document.getElementById("bgcolor").value;
    document.getElementById("bcolor").value = x;
}
</script>
</head>
<body>
<div class="middle" style="">
<h1 class="">Update TVC Scroll</h1><hr/>
<form name="form1" id="form1" method="post" action="">
<input type="hidden" name="hd" id="hd" value="<?php echo $rows['ticker_id']?>">
<table class="table-condensed table-hover ">
     <tr>
    <td>Client Name </td>
    <td>
        <select name="client_id" id="client_id" class="form-control"  required>
                                <?php
                                    $sql_tvc_ins = "SELECT * FROM tbl_client WHERE publication_status=1";
                                    $rest_ins = $conn->query($sql_tvc_ins);
                                    while ($row = $rest_ins->fetch_assoc()) {
                                        ?>
                                       
                                         <option <?php if ($row['client_id'] ==$rows['client_id']) echo 'selected="selected"' ?>  value="<?php echo $row['client_id']; ?>" >
					<?php echo $row['client_name']; ?>
				</option>
                                    <?php } ?>
        </select>
    </td>
  </tr>
    	<tr>
      <th>Ticker Name</th>
      <td>
          <input type="text" name="ticker_name" cols="60" rows="5" value="<?php echo $rows['ticker_name'];?>" id="description" class="form-control" required>
	  
	  </td>
    </tr>
	<tr>
      <th>Ticker Description</th>
      <td>
	  <textarea name="ticker_description" cols="60" rows="5" id="description" class="form-control" required><?php echo $rows['ticker_description'];?></textarea>
	  
	  </td>
    </tr>
	    <tr>
      <th>Text color</th>
      <td><input name="txtcolor" type="color" id="txtcolor" onchange="myFunction()"  value="<?php echo $rows['text_color'];?>"  >
        <input name="tcolor" type="text" id="tcolor"  value="<?php echo $rows['text_color'];?>" ></td>
    </tr>
    <tr>
      <th>Background color</th>
      <td><input name="bgcolor" type="color" id="bgcolor" onchange="myFunction2()"  value="<?php echo $rows['background_color'];?>"  >
      <input name="bcolor" type="text" id="bcolor"   value="<?php echo $rows['background_color'];?>"></td>
    </tr>
   	    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="Submit Updated" class="btn btn-success btn-sm" />
    </tr>
      </table>
</form>
</div>
</body>
</html>