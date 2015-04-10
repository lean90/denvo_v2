<?php
class TimeService {
    
    static function convertDatetimeToFriendlyMessage($created_time)
    {
        $created_time instanceof DateTime;
        $str = strtotime($created_time);
        $today = strtotime(date('Y-m-d H:i:s'));
        // It returns the time difference in Seconds...
        $time_differnce = $today-$str;
    
        // To Calculate the time difference in Years...
        $years = 60*60*24*365;
    
        // To Calculate the time difference in Months...
        $months = 60*60*24*30;
    
        // To Calculate the time difference in Days...
        $days = 60*60*24;
    
        // To Calculate the time difference in Hours...
        $hours = 60*60;
    
        // To Calculate the time difference in Minutes...
        $minutes = 60;
    
        if(intval($time_differnce/$years) > 1)
        {
            return intval($time_differnce/$years)." năm trước";
        }else if(intval($time_differnce/$years) > 0)
        {
            return intval($time_differnce/$years)." năm trước";
        }else if(intval($time_differnce/$months) > 1)
        {
            return intval($time_differnce/$months)." tháng trước";
        }else if(intval(($time_differnce/$months)) > 0)
        {
            return intval(($time_differnce/$months))." tháng trước";
        }else if(intval(($time_differnce/$days)) > 1)
        {
            return intval(($time_differnce/$days))." Ngày trước";
        }else if (intval(($time_differnce/$days)) > 0)
        {
            return intval(($time_differnce/$days))." Ngày trước";
        }else if (intval(($time_differnce/$hours)) > 1)
        {
            return intval(($time_differnce/$hours))." Giờ trước";
        }else if (intval(($time_differnce/$hours)) > 0)
        {
            return intval(($time_differnce/$hours))." Giờ trước";
        }else if (intval(($time_differnce/$minutes)) > 1)
        {
            return intval(($time_differnce/$minutes))." Phút trước";
        }else if (intval(($time_differnce/$minutes)) > 0)
        {
            return intval(($time_differnce/$minutes))." Phút trước";
        }else if (intval(($time_differnce)) > 1)
        {
            return intval(($time_differnce))." Giây trước";
        }else
        {
            return "Vài giây trước";
        }
    }
    
}