<?php 
$con=new mysqli("localhost","root","","forum");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
    }


?>