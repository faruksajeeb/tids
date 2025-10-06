<?php
    include_once('../db/db_connect.php');
    $sql="SELECT * FROM tbl_tvc_news_ticker WHERE publication_status=1 AND deletion_status=0";
    $ticker_rst=$conn->query($sql);
    while($ticker_row = $ticker_rst->fetch_assoc())
    {
        ?>
      <span style="padding:10px;color:<?php echo $ticker_row['text_color']?>;background-color:<?php echo $ticker_row['background_color']?>;"> <?php  echo $ticker_row['ticker_description'] ; ?></span> <i class="fa fa-square" aria-hidden="true"></i> 
  <?php
      }
?>
				
