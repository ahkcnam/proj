<?php 
session_start();
require "secured.php";
if(isset($_GET["id"])){
    require_once "db.php";
    echo "hi";
    
    echo "try";
    $id=mysqli_real_escape_string($con,$_GET["id"]);
    $stmt=$con->prepare("UPDATE Comments SET MemberId=?,PostDate=?,PostText=? Where Cid=".$id.";");
    $stmt->bind_param("iss",$Mid,$date,$text);
    if(isset($_POST["postText2"])){
        echo "here";
        $Mid=$_SESSION["info"]["Id"];
        $date=date("Y-m-d");
        $text=$_POST["postText2"];
        if($stmt->execute())header("location:forum.php");
        else {echo "<p style='color:red'>An error has occur: redirecting to the login page</p>"; sleep(5);session_destroy();header("location:index.php");}

    }
    echo "<form action='edit.php?id=".$id."' method='post'>
            <label for='postText'>Add Comment</label>
            <textarea name='postText2' cols='50' rows='5'></textarea><br>
            <input type='submit' value='post'><br><br><a href='forum.php'>return to the forum</a><br><br><a href='logout.php'>Log out</a>

          </form>";
   
}
else header("location:forum.php");
?>