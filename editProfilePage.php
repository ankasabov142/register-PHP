<?php 
session_start();
include"dataBaseConnection.php";
$currUserId=$_SESSION["id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    
<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
<h1>Welcome!</h1>
<h3>Username:</h3>
<input type="text" name="username">

<h3>Email:</h3>
<input type="email" name="email">

<h3>Password:</h3>
<input type="password" name="password">

<h3>Phone Number:</h3>
<input type="text" name="phone">
<br>
<br>

<input type="submit" name="submit" value="Finish Editing">
<input type="submit" name="back" value="Back to Home page">

</form>


</body>
</html>
<?php 
if(isset($_POST["back"])){
header("Location: homePage.php");
}
?>

<?php 
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = filter_input(INPUT_POST,"username", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS);
    $phone = preg_replace('/[^0-9]/', '', $_POST['phone']);

    if(empty($username)|| empty($email)|| empty($password)|| empty($phone)){
        echo('<p>Please fill in all  fields </p>');
        echo('<p>P.S. If you dont want to change some of your details, please type your old data</p>');
    }
    else{
        $hash = password_hash($password,PASSWORD_DEFAULT);
        $sql="UPDATE registeredusers
        SET username = '$username', email = ' $email', password = '$hash', phone = '$phone'
        WHERE id = '$currUserId'";

try{
    mysqli_query($conn,$sql);
    echo "<p>Updated Succsefuly!</p> <br>
    <a href='homePage.php'>Proceed to Home page</a>";
}       
catch(mysqli_sql_exception){
    echo "<p>There was an error filling in your details </p>";
echo "<p>Or they are already used </p>";
}
       


    }
}

mysqli_close($conn);
?>
