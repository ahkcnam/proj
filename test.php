<?php
$pattern2="/^([0-9])?[1-9]\/([0-9])?[1-9]\/(19[4-9][0-9]|20[0][0-9])$/";
echo preg_match($pattern2, "12/25/2004")."<br>";
$birthDate=explode("/","12/25/2004");
echo gettype($birthDate[0])."<br>";

if( preg_match($pattern2, "12/25/2004")&& checkdate(intval($birthDate[0]),intval($birthDate[1]),intval($birthDate[2])) )echo "yes";

if(checkdate(intval($birthDate[0]),intval($birthDate[1]),intval($birthDate[2])))echo 'true' ;
header("location:index.php");
?>