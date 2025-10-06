<?php
include('../../classes/dbConfig/config.php');
include_once('../../db/db_connect.php');
if(isset($_POST['submit']))
{	
	$username=$_SESSION['user'];
	$ip_addr=$_SERVER['REMOTE_ADDR'];
	$auditQry = "INSERT into tbl_auditor(username,ipaddr,date_time,table_name,action) 
	VALUES ('$username','$ip_addr',now(),'Insert into TVC scroll table','Insert')";
	$conn->query($auditQry);
	
	$ticker_name=$_POST['ticker_name'];
	$ticker_description=$_POST['txt_description'];
	$client_id=$_POST['client_id'];
	$txtcolor=$_POST['txtcolor'];
	$bgcolor=$_POST['bgcolor'];
	$query="INSERT  INTO tbl_tvc_news_ticker(ticker_name,ticker_description,text_color,background_color,client_id) VALUES('$ticker_name','$ticker_description','$txtcolor','$bgcolor',$client_id)";
	$conn->query($query);
	header('Location:view.tvc_scroll.php');
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Insert TVC Scroll</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
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
<h1 class="page-header">Insert TVC Scroll</h1>
<div style="width:100% ">

                    
<form name="form1" id="form1" method="post" action="" enctype="">
  <table class="table-condensed table-hover ">
 <tr>
    <td>Client Name </td>
    <td>
        <select name="client_id" id="client_id" class="form-control"  required>
            <option value="">select client name</option>
                                    <?php
                                    $sql_tvc_ins = "SELECT * FROM tbl_client WHERE publication_status=1";
                                    $rest_ins = $conn->query($sql_tvc_ins);
                                    while ($row = $rest_ins->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $row['client_id'] ?>"><?php echo $row['client_name'] ?></option>
                                    <?php } ?>
        </select>
    </td>
  </tr>
  <tr>
    <td>Ticker Name </td>
    <td><input name="ticker_name" type="text"  class="form-control" id="ticker_name" size="40"/></td>
  </tr>
  <tr>
    <td>Ticker Description</td>
    <td><label>
      <textarea name="txt_description" cols="40" rows="5" class="form-control" id="txt_description"></textarea>
    </label></td>
  </tr> 
     <tr>
      <th>Text color</th>
      <td><input name="txtcolor" type="color" id="txtcolor" onchange="myFunction()"  value="#ffffff"  >
      <input name="tcolor" type="text" id="tcolor"   >
      </td>
    </tr>
    <tr>
      <th>Background color</th>
      <td><input name="bgcolor" type="color" onchange="myFunction2()" id="bgcolor"  value="#000000"  >
      <input name="bcolor" type="text" id="bcolor"   >
      </td>
    </tr>
  <input name="txtupdate_by" type="hidden" id="txtupdate_by" class="form-control" value="<?php echo $_SESSION['user'];?>">
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" id="submit" value="Submit Scroll" class="btn btn-success btn-sm" />   </tr>
      </table>
</form>
</div>
</div>
</body>
</html>