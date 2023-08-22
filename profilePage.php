<?php 
session_start();
include"dataBaseConnection.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php 
$currUserId=$_SESSION["id"];

try{
$sql="SELECT * FROM registeredusers WHERE id = '$currUserId'";
         $result =mysqli_query($conn,$sql);
            $row =mysqli_fetch_assoc($result);
            $username=$row['username'];
            $email=$row['email'];
            $password=$row['password'];
            $phone=$row['phone'];
                
    
    }
    catch (Exception ) {
        echo "Wrong password or username";
    }



mysqli_close($conn);

?>