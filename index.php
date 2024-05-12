<?php
session_start();
if (isset($_POST["userName"]) && isset($_POST["password"])){
    if(empty($_POST["userName"]))echo "<p style='color:red'>error: UserName is empty</p>";
    elseif(empty($_POST["password"]))echo "<p style='color:red'>error: Password is empty</p>";
    else{
             require_once "db.php";
             $sql="SELECT * from Members where UserName='".$_POST["userName"]."' AND Password='".$_POST["password"]."';";
             $resulta=mysqli_query($con,$sql);
             if($resulta->num_rows==1){$_SESSION["info"]=$resulta->fetch_assoc();$_SESSION["logged-in"]=true;header("location:forum.php");}
             else echo "<p style='color:red'>error: Username or Password is invalid</p>";
        }

}
?>
<html>
<head>

</head>
<body>
    <div>
        <?php if(isset($_SESSION["errorMessage"])&&!empty($_SESSION["errorMessage"]))echo "<p>".$_SESSION["errorMessage"]."</p>"; ?>
        <form action='index.php' method='post'>
            <label for='userField'>UserName</label>  <input type='text' name='userName'><br>
            <label for='password'>Password</label>  <input type='password' name='password'><br>
            <input type="submit" name="submit" value="Login"> <br>
            <a href='register.php'>Register</a>
        </form>
        
    </div>
</body>
</html>







