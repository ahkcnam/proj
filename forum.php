<?php 
session_start();
require "secured.php";
require_once "db.php";//firt we want to fetch the data then prepare a query
$sql="SELECT * FROM Members m,Comments c WHERE c.MemberId=m.Id;";
$stmt=$con->prepare("INSERT INTO Comments (MemberId,PostDate,PostText) VALUES (?,?,?);");
$stmt->bind_param("iss",$id,$date,$text);

if(isset($_POST["postText"])){
    $id=$_SESSION["info"]["Id"];
    $date=date("Y-m-d");
    $text=$_POST["postText"];
    $stmt->execute();//we can optimize the work with leting the javaScript update the html table and prepare the statement only once rather the every time when the page reload.
}
$res=$con->query($sql);
if(!($res))die("An error has occur");
?>
<html>
    <head>

    </head>
    <body>
        <table style="width: 100%;" border="2">
            <tr>
                <th>Member</th>
                <th>Comments</th>
                <th>Delete</th>
                <th>Edition</th>
            </tr>
            <?php while($row=$res->fetch_assoc()){
                echo" <tr>  <td>".$row["PostDate"]." ".$row["FirstName"].$row["LastName"]."<br>".$row["Email"]." (".$row["Country"].")<br><img src='image/".$row["ProfilePicture"]."' alt='<Profile Picture>' style='height: 70px;width: 70px;'></td>
                            <td>".$row["PostText"]."</td>
                            <td><a href='delete.php?id=".$row["Cid"]."'><img src='delete.png' alt='delete icon(pic)' style='height: 50px;width: 50px;'></a></td>
                            <td><a href='edit.php?id=".$row["Cid"]."'><img src='edit.png' alt='delete icon(pic)' style='height: 50px;width: 50px;'></a></td> 
                      </tr>";
            }
            ?>
        </table>
        <form action="forum.php" method="post">
            <label for="postText">Add Comment</label>
            <textarea name="postText" cols="50" rows="5"></textarea><br>
            <input type="submit" value="post">
        </form>
        <br><br><a href='logout.php'>Log out</a>
    </body>
</html>