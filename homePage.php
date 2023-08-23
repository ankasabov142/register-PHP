<?php 
session_start();
include"dataBaseConnection.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:opsz,wght@6..96,500&family=Caprasimo&family=Kanit:ital,wght@0,600;1,300&family=Lilita+One&family=Open+Sans&family=Questrial&family=REM&family=Work+Sans:wght@500&display=swap" rel="stylesheet">
</head>
<body>
<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" class="formHome">

<input type="submit" name="edit" value="Edit Profile">
<input type="submit" name="logout" value="Log out">
</form>

</body>
</html>
<?php 
if(isset($_POST["logout"])){
    session_destroy();
    header("Location: registerPage.php");
}
if(isset($_POST["edit"])){
    header("Location: editProfilePage.php");
}
?>

<?php 
$currUserId=$_SESSION["id"];

try{
$sql="SELECT * FROM registeredusers WHERE id = '$currUserId'";
         $result =mysqli_query($conn,$sql);
            $row =mysqli_fetch_assoc($result);
            $username=$row['username'];
            echo "<h1 class=\"homePageWelcome\">Welcome, $username ! </h1> ";
    
    }
    catch (Exception ) {
        echo "Error";
    }



mysqli_close($conn);

?>