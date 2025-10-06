<?php
//defined('TIDS') or die("Sorry, you are not allowed to directly access this page.<br /> Please press the back button in your browser."); 
class Clock{
    public function __construct(){
              $dt = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
                $current_time = $dt->format(' H:i:s \<\/\b\r\> D \<\/\b\r\> d-M-y ');
                $engDATE = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0, ':', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri');
                $bangDATE = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০', 'ঃ', 'জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর', 'শনিবার', 'রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার');
                $convertedDATE = str_replace($engDATE, $bangDATE, $current_time);
                echo "$convertedDATE";
    }
}
$clock_obj=new Clock();

