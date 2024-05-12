<?php 
    $countries= [ "FR"=>"France", "LB"=>"Lebanon", "QA"=>"Qatar", "UK"=>"United Kingdom"];
    $keys=array_keys($countries);
    $pattern = "/^[a-zA-Z ]+$/";
    $pattern2="/^([0-9])?[1-9]\/([0-9])?[1-9]\/(19[4-9][0-9]|20[0][0-9])$/";
    if(isset($_POST["firstName"])&& isset($_POST["lastName"]) && isset($_POST["userName"])&& isset($_POST["password"])&& isset($_POST["country"])&&isset($_POST["email"])&&isset($_POST["birthDate"])&&isset($_FILES["ppic"])){
        foreach($_POST as $post)trim($post);
        $_POST["firstName"]=ucfirst(strtolower($_POST["firstName"]));
        $_POST["lastName"]=ucfirst(strtolower($_POST["lastName"]));
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $birthDate=explode("/",$_POST["birthDate"]);
        $file=$_FILES["ppic"];
        $fileExt = pathinfo($file["name"], PATHINFO_EXTENSION);
        if(empty($_POST["firstName"])|| empty($_POST["lastName"]) || empty($_POST["userName"])|| empty($_POST["password"])|| empty($_POST["country"])||empty($_POST["email"])||empty($_POST["birthDate"])||empty($_FILES["ppic"])){
            echo "<p style='color:red'>One or more fields are empty</p>";
        }
        else{if(preg_match($pattern, $_POST['lastName']))
                if(preg_match($pattern, $_POST['firstName']))
                    if (filter_var($email, FILTER_VALIDATE_EMAIL))
                        if( preg_match($pattern2, $_POST['birthDate'])&& checkdate(intval($birthDate[0]),intval($birthDate[1]),intval($birthDate[2])) )
                            if(str_contains('gif--jpg--jpeg--png', strtotime($fileExt))){  
                                require_once "db.php";
                                $userName=mysqli_real_escape_string($con,$_POST["userName"]);
                                $password=mysqli_real_escape_string($con,$_POST["password"]);
                                $country=mysqli_real_escape_string($con,$_POST["country"]);
                                $DOB=$birthDate[2]."-".$birthDate[0]."-".$birthDate[1];
                                $res=$con->query("Select Email, UserName From Members where UserName='".$userName."';");
                                if($res->num_rows==0){
                                    $res=$con->query("Select Email, UserName From Members where Email='".$email."' ;");
                                    if($res->num_rows==0){
                                        $sql="Insert into Members (FirstName, LastName, UserName, Password, BirthDate, Email, Country) VALUES ('".$_POST["firstName"]."','".$_POST["lastName"]."','".$userName."','".$password."','".$DOB."','".$email."','".$country."');";
                                        $res=$con->query($sql);
                                        if($res){
                                            $id=$con->insert_id;
                                            if(!move_uploaded_file($file["tmp_name"], "./image/ppic-".$id.".".$fileExt))echo "<p style='color:red'>There is a problem when moving the file</p>";
                                            $sql="Update Members set ProfilePicture='ppic-".$id.".".$fileExt."' Where Id=".$id.";";
                                            $con->query($sql);
                                            if($con->affected_rows==1)header("location:index.php");
                                            else echo "<p style='color:red'>there is problem uploading the profile picture</p>";
                                        }
                                    }
                                    else echo "<p style='color:red'>This Email is already in use</p>";
                                }
                                else echo "<p style='color:red'>This User Name is already taken</p>";}
                            else echo "<p style='color:red'>There is a problem with the file extention it must be 'gif' or 'jpg' or 'jpeg' or 'pnj'</p>";
                        else echo "<p style='color:red'>Invalid date of birth</p>";
                    else echo "<p style='color:red'>Invalid Email adresse</p>";
                else echo "<p style='color:red'>Invalid First Name</p>";
            else echo "<p style='color:red'>Invalid Last Name</p>";  
        }          

       
    }
?>
<html>
    <head>

    </head>
    <body>
        <form action="register.php" method="post" enctype="multipart/form-data">
            <label for="firstName">First Name : </label><input type="text" name="firstName"><br>
            <label for="lastName">Last Name : </label><input type="text" name="lastName"><br>
            <label for="userName">User Name : </label><input type="text" name="userName"><br>
            <label for="password">Password : </label><input type="password" name="password"><br>
            <label for="country">Country : </label><select name="country"><?php foreach ($keys as $key) echo "<option value='".$key."'>".$countries[$key]."</option>"; ?> </select><br>
            <label for="email">Email : </label><input type="email" name="email"><br>
            <label for="brithDate">Birth Date: </label><input type="text" name="birthDate"><label for="birthDate">mm/dd/yyyy</label><br>
            <label for="ppic">Profile Picture : </label><input type="file" name="ppic"><br>
            <input type="submit" value="Register">
        </form>
    </body>
</html>