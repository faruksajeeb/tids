  <?php
  include('../../classes/dbConfig/config.php');
  $tvc_name=$_POST['tvc_name'];
    
  ?>

   <span id="video_title" style="font-size:20px; font-weight: bold; color:#fff;position: absolute; top:15px; left:20px;margin-left: 10px; margin-right: 10px;"><?php  echo $tvc_name; ?></span>

   <video width="650" controls style="border:3px solid #cc0000;background-color: #000">
 
    <source src="<?php echo BASE_URL; ?>com/videos/<?php echo $tvc_name;?>" type="video/mp4" > 
    <img src="<?php echo BASE_URL; ?>img/video_not_available.jpg" width="100%" alt="Image Not Found" style="border:3px solid #cc0000;">
</video>

<script>
var v = document.querySelector('video'),
    sources = v.querySelectorAll('source'),
    lastsource = sources[sources.length-1];
lastsource.addEventListener('error', function(ev) {
  var d = document.createElement('div');
  d.innerHTML = v.innerHTML;
  v.parentNode.replaceChild(d, v);
}, false);
</script>