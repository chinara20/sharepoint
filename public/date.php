<?php
$date1 = "2023-03-14 09:00:00";
$date2 = "2023-03-14 14:00:00";
$timestamp1 = strtotime($date1);
$timestamp2 = strtotime($date2);
echo "Difference between two dates is " . $hour = abs($timestamp2 - $timestamp1)/(60*60) . " hour(s)";
?>