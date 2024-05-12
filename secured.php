<?php
session_start();
if (!isset($_SESSION["logged-in"]) || $_SESSION["logged-in"]!=true){
    header("location:index.php");
}




?>