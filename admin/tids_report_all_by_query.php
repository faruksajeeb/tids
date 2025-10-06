<?php
include('../classes/dbConfig/config.php');
include_once('../db/db_connect.php');
$start_date = $_POST['from_date'];
$end_date = $_POST['to_date'];
if (empty($start_date) && empty($end_date)) {
    echo "<div style='text-align:center;color:red'>No data available</div>";
    exit;
} else if (!empty($start_date) && !empty($end_date)) {
    $sql = "SELECT * FROM tbl_tids_report  WHERE action_time BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59'  ORDER BY action_time ASC";
} else {
    echo "Query didn't found";
}
?>
<div class="pull-right">

<a href="#" class="btn btn-info " onclick="PrintDiv();"><i class="fa fa-print"></i> Print</a>
<a href="#" class="btn btn-info" onclick="excelExport();"><i class="fa fa-file-excel-o"></i>  Excel</a>
<?php if($_SESSION['user_type']=='super_admin'){?>
<a href="#" class="btn btn-info" onClick ="$('#clientData').tableExport({type:'pdf',escape:'false'});"><i class="fa fa-file-pdf-o"></i>  PDF</a>
<a href="#" class="btn btn-info" onClick ="$('#clientData').tableExport({type:'doc',escape:'false'});"><i class="fa fa-file-word-o"></i>  DOC</a>
<a href="#" class="btn btn-info" onClick ="$('#clientData').tableExport({type:'txt',escape:'false'});"><i class="fa fa-file-text"></i>  txt</a>
<a href="#" class="btn btn-info" onClick ="$('#clientData').tableExport({type:'png',escape:'false'});"><i class="fa fa-file-image-o"></i>  PNG</a>
<a href="#" class="btn btn-info" onClick ="$('#clientData').tableExport({type:'powerpoint',escape:'false'});"><i class="fa fa-file-powerpoint-o"></i>  Powerpoint</a>
<a href="#" class="btn btn-info" onClick ="$('#clientData').tableExport({type:'sql',escape:'false'});">SQL</a>
<a href="#" class="btn btn-info" onClick ="$('#clientData').tableExport({type:'json',escape:'false'});">JSON</a>
<a href="#" class="btn btn-info"  onClick ="$('#clientData').tableExport({type:'csv',escape:'false'});">CSV</a>
<a href="#" class="btn btn-info"onClick ="$('#clientData').tableExport({type:'xml',escape:'false'});">XML</a>
<?php } ?>
</div>
<br/>
<br/>
<div  id="allData" class="allExcel" >
<table width="95%">
    <tr>
        <td colspan="3"></td>        
        <td colspan="3" style="text-align: right;">
            <strong>From date:</strong> 
            <?php if (!empty($start_date)) {
                echo$start_date;
            } else {
                echo "____/__/__";
            } ?> 
            <strong>To date:</strong>
         <?php if (!empty($end_date)) {
                echo$end_date;
            } else {
                echo "____/__/__";
            } ?> 
        </td>
    </tr>
</table> <br/>
<table border="1" style="border-collapse: collapse;" width="100%" class=" table table-bordered table-condensed table-hover example">
    <thead>
        <tr>
            <th>Sl No</th>               
            <th>Description </th>     
            <th>Action</th>     
            <th>Action Time</th>
            <th>Operator Name</th>
            <th>IP Address</th> 
            
        </tr>
    </thead>
    <tbody>
<?php
$i = 1;
$rst = $conn->query($sql);
while ($row = $rst->fetch_assoc()) {
    ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['description'] ?></td>
                <td><?php echo $row['action'] ?></td>
                <td><?php echo $row['action_time'] ?></td>  
                <td><?php echo $row['user_name'] ?></td>
                <td><?php echo $row['ip_address'] ?></td>
            
            </tr>
    <?php
    $i++;
}
?>
    </tbody>
</table>
</div>
<script>
	function excelExport() {
                        $(".allExcel").table2excel({
                                exclude: ".noExl",
                                name: "Excel Document Name",
                                filename: "tidsReports",
                                fileext: ".xls",
                                exclude_img: true,
                                exclude_links: true,
                                exclude_inputs: true
                        });
                }
                function PrintDiv() {    
                        var divToPrint = document.getElementById('allData');
                        var popupWin = window.open('', '_blank', 'width=1000,height=500');
                        popupWin.document.open();
                        popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                        popupWin.document.close();
                 }
</script>
