<?php 
session_start();
require "secured.php";
if(isset($_GET["id"])){
    require_once "db.php";
    $id=mysqli_real_escape_string($con,$_GET["id"]);
    $con->query("DELETE FROM Comments WHERE Cid=".$id.";");
    if($con->affected_rows==1)header("location:forum.php");
    else {echo "<p style='color:red'>An error has occur: redirecting to the login page</p>"; sleep(5);session_destroy();header("location:index.php");}
}
header("location:forum.php");
?>