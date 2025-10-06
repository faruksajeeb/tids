<?php
include('../../classes/dbConfig/config.php');
include_once('../../db/db_connect.php');
if (isset($_POST['submit_form'])) {
    $start_date = $_POST['from_date'];
    $end_date = $_POST['to_date'];
    if (empty($start_date) && empty($end_date)) {
        echo "<div style='text-align:center;color:red'>No data available</div>";
        exit;
    } else if (!empty($start_date) && !empty($end_date)) {
        $sql2 = "SELECT "
                . "tpr.ip_address,"
                . "COUNT(tpr.schedule_id) AS pspot,"
                . "tt.tvc_name,"
                . "tc.client_name,"
                . "tt.duration,"
                . "SUM(tt.duration) AS total_duration,"
                . "DATE(tpr.playing_time) AS date "
                . "FROM "
                . "tbl_tvc_playing_report AS tpr,"
                . "tbl_tvc_schedule AS tts,"
                . "tbl_client AS  tc,"
                . "tbl_tvc AS tt "
                . "WHERE "
                . "tpr.schedule_id=tts.schedule_id AND "
                . "tts.client_id=tc.client_id AND "
                . "tts.tvc_id=tt.tvc_id  AND "
                . "tpr.playing_time BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59' "
                . "GROUP BY  "
                . "tts.client_id "
                . "ORDER BY "
                . "tc.client_name,tt.tvc_name, date ASC";
    } else {
        echo "Query didn't found";
    }
}
?>
<link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="<?php echo BASE_URL; ?>script/jquery-2.2.3.min.js"></script> 
<script type="text/javascript" src="<?php echo BASE_URL; ?>script/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>admin/exportData/jquery.table2excel.js"></script>

<style>
    tr:nth-child(even) {background: #FFF8DC}
    tr:nth-child(odd) {background: #FFF}
</style>
<div style="width:1300px; margin:0 auto;background-color:#F5F5DC">
    <div style="width:1260px; margin:0 auto;text-align:center;background-color:#F5F5DC">
        <div class="pull-right">
            <a href="#" class="btn btn-info " onclick="PrintDiv2();"><i class="fa fa-print"></i> Print</a>
            <a href="#" class="btn btn-info" onclick="excelExport2();"><i class="fa fa-file-excel-o"></i>  Excel</a>

        </div>

        <div  id="allData2"  class="allExcel2"  >

            <img style=" height:90px;display:block;" src="<?php echo BASE_URL; ?>img/tv_logo_report.png" alt="ARTS tv(Logo)" >	


            <span style="background:#A52A2A;color:white; padding:5px;border-radius:5px;font-size:20px;">TVC REPORT at a glance</span>
            <div   style="" >

                <table width="100%" style="background-color:#F5F5DC">
                    <tr style="background-color:#F5F5DC">
                        <td colspan="2"><strong>Client name: </strong> All</td>


                        <td colspan="2" style="text-align: right;">
                            <strong>From date:</strong> 
                            <?php
                            if (!empty($start_date)) {
                                echo$start_date;
                            } else {
                                echo "____/__/__";
                            }
                            ?> 
                            <strong>To date:</strong>
                            <?php
                            if (!empty($end_date)) {
                                echo$end_date;
                            } else {
                                echo "____/__/__";
                            }
                            ?> 
                        </td>
                    </tr>
                </table> <br/>
                <table border="1" style="border-collapse: collapse;" width="100%" class=" table table-bordered table-condensed table-hover example">
                    <thead>
                        <tr style="background-color:#F5DEB3;">
                            <th>Sl No</th>

                            <th>Client Name </th> 
                            <th>Total Dur(Sec)</th> 
                            <th>Total Dur(Min)</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $total_duration2 = 0;

                        $rst2 = $conn->query($sql2);
                        while ($row2 = $rst2->fetch_assoc()) {
                            ?>
                            <tr style="">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row2['client_name'] ?></td>
                                <td><?php echo $row2['total_duration'] ?></td>
                                <td>
                                    <?php
                                    $get_duration2 = $row2['total_duration'];


                                    //echo floor($get_duration2 / 3600) . gmdate(":i:s", $get_duration2 % 3600);
                                    $minutes = floor($get_duration2 / 60);
                                    $secondsleft = $get_duration2 % 60;
                                    if ($minutes < 10)
                                        $minutes = "0" . $minutes;
                                    if ($secondsleft < 10)
                                        $secondsleft = "0" . $secondsleft;
                                    echo "$minutes:$secondsleft ";

                                    $total_duration2 = $total_duration2 + $get_duration2;
                                    ?>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                    </tbody><tfoot>
                        <tr style="background-color:#F5DEB3;">
                            <td></td>


                            <td style="text-align: right;font-weight: bold">Total :</td>
                            <td style="text-align: left;"><?php echo $total_duration2 . ' Sec'; ?></td>
                            <td style="text-align: left; font-weight: bold">
                                <?php 
                                    //echo floor($total_duration2 / 3600) . gmdate(":i:s", $total_duration2 % 3600) . ' hr'; 
                                $minutes = floor($total_duration2 / 60);
                                $secondsleft = $total_duration2 % 60;
                                if ($minutes < 10)
                                    $minutes = "0" . $minutes;
                                if ($secondsleft < 10)
                                    $secondsleft = "0" . $secondsleft;
                                echo "$minutes:$secondsleft minutes";
                                ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>




        <hr/>


        <?php
        if (isset($_POST['submit_form'])) {
            $start_date = $_POST['from_date'];
            $end_date = $_POST['to_date'];
            if (empty($start_date) && empty($end_date)) {
                echo "<div style='text-align:center;color:red'>No data available</div>";
                exit;
            } else if (!empty($start_date) && !empty($end_date)) {
                $sql = "SELECT "
                        . "tpr.ip_address,"
                        . "COUNT(tpr.schedule_id) AS pspot,"
                        . "tt.tvc_name,"
                        . "tc.client_name,"
                        . "tt.duration,"
                        . "SUM(tt.duration) AS total_duration,"
                        . "DATE(tpr.playing_time) AS date "
                        . "FROM "
                        . "tbl_tvc_playing_report AS tpr,"
                        . "tbl_tvc_schedule AS tts,"
                        . "tbl_client AS  tc,"
                        . "tbl_tvc AS tt "
                        . "WHERE "
                        . "tpr.schedule_id=tts.schedule_id AND "
                        . "tts.client_id=tc.client_id AND "
                        . "tts.tvc_id=tt.tvc_id  AND "
                        . "tpr.playing_time BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59' "
                        . "GROUP BY  "
                        . "tpr.ip_address,"
                        . "tts.tvc_id,"
                        . "tts.client_id,"
                        . "date   "
                        . "ORDER BY "
                        . "tc.client_name,tt.tvc_name, date ASC";
            } else {
                echo "Query didn't found";
            }
        }
        ?>

        <div class="pull-right">
            <a href="#" class="btn btn-info " onclick="PrintDiv();"><i class="fa fa-print"></i> Print</a>
            <a href="#" class="btn btn-info" onclick="excelExport();"><i class="fa fa-file-excel-o"></i>  Excel</a>

        </div>
        <div  id="allData"  class="allExcel"  >
            <img style=" height:90px;display:block;" src="<?php echo BASE_URL; ?>img/tv_logo_report.png" alt="ARTS tv(Logo)" >	


            <span style="background:#A52A2A;color:white; padding:5px;border-radius:5px;font-size:20px;">TVC REPORT</span>
            <div   style="" >

                <table width="100%" style="background-color:#F5F5DC">
                    <tr style="background-color:#F5F5DC">
                        <td colspan="4"><strong>Client name: </strong> All</td>

                        <td></td>
                        <td colspan="3" style="text-align: right;">
                            <strong>From date:</strong> 
<?php
if (!empty($start_date)) {
    echo$start_date;
} else {
    echo "____/__/__";
}
?> 
                            <strong>To date:</strong>
                            <?php
                            if (!empty($end_date)) {
                                echo$end_date;
                            } else {
                                echo "____/__/__";
                            }
                            ?> 
                        </td>
                    </tr>
                </table> <br/>
                <table border="1" style="border-collapse: collapse;" width="" class=" table table-bordered table-condensed table-hover ">
                    <thead>
                        <tr style="background-color:#F5DEB3;">
                            <th>Sl No</th>

                            <th>Client Name </th>     
                            <th>TVC Name </th>  

                            <th>Broacasting Date</th>			
                            <th>TVC Dur(Sec)</th>     
                            <th>Per Day Spot</th>
                            <th>Total Dur(Sec)</th> 
                            <th>Total Dur(hr)</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $total_duration = 0;

                        $rst = $conn->query($sql);
                        while ($row = $rst->fetch_assoc()) {
                            ?>
                            <tr style="">
                                <td><?php echo $i; ?></td>             

                                <td><?php echo $row['client_name'] ?></td>
                                <td><?php echo $row['tvc_name'] ?></td>
                                <td><?php echo $row['date'] ?></td>				
                                <td><?php echo $row['duration'] ?></td>      
                                <td><?php echo $row['pspot'] ?></td>
                                <td><?php echo $row['total_duration'] ?></td>
                                <td>
                                    <?php
                                    $get_duration = $row['total_duration'];


                                    //echo floor($get_duration / 3600) . gmdate(":i:s", $get_duration % 3600);
                                    $minutes = floor($get_duration / 60);
                                    $secondsleft = $get_duration % 60;
                                    if ($minutes < 10)
                                        $minutes = "0" . $minutes;
                                    if ($secondsleft < 10)
                                        $secondsleft = "0" . $secondsleft;
                                    echo "$minutes:$secondsleft ";

                                    $total_duration = $total_duration + $get_duration;
                                    ?>
                                </td>
                            </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                    </tbody>
                    <tfoot>
                        <tr style="background-color:#F5DEB3;">
                            <td></td>
                            <td></td>

                            <td></td>

                            <td></td>                              

                            <td></td> 
                            <td style="text-align: right;font-weight: bold">Total :</td>
                            <td style="text-align: left;"><?php echo $total_duration . ' Sec'; ?></td>
                            <td style="text-align: left; font-weight: bold">
                                <?php
                                //echo floor($total_duration / 3600) . gmdate(":i:s", $total_duration % 3600) . ' hr'; 
                                  $minutes = floor($total_duration / 60);
                                $secondsleft = $total_duration % 60;
                                if ($minutes < 10)
                                    $minutes = "0" . $minutes;
                                if ($secondsleft < 10)
                                    $secondsleft = "0" . $secondsleft;
                                echo "$minutes:$secondsleft minutes";
                                ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            Powred by @ ARTS Railway Station Television
        </div>



    </div>
</div>
<script>
    function excelExport() {
        $(".allExcel").table2excel({
            exclude: ".noExl",
            name: "Excel Document Name",
            filename: "different_client_tvcReportPerSpot",
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
        popupWin.document.write('<html><head><title>ARTS Railway Station TV || TVC report</title><style> body{ text-align:center} tr:nth-child(even) {background: #FFF8DC }tr:nth-child(odd) {background: #FFF}</style></head><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }
    function excelExport2() {
        $(".allExcel2").table2excel({
            exclude: ".noExl",
            name: "Excel Document Name",
            filename: "different_client_tvcReportPerSpot",
            fileext: ".xls",
            exclude_img: true,
            exclude_links: true,
            exclude_inputs: true
        });
    }
    function PrintDiv2() {
        var divToPrint = document.getElementById('allData2');
        var popupWin = window.open('', '_blank', 'width=1000,height=500');
        popupWin.document.open();
        popupWin.document.write('<html><head><title>ARTS Railway Station TV || TVC report</title><style> body{ text-align:center} tr:nth-child(even) {background: #FFF8DC }tr:nth-child(odd) {background: #FFF}</style></head><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }
</script>
