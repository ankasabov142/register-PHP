<?php 
include"dataBaseConnection.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:opsz,wght@6..96,500&family=Caprasimo&family=Kanit:ital,wght@0,600;1,300&family=Lilita+One&family=Open+Sans&family=Questrial&family=REM&family=Work+Sans:wght@500&display=swap" rel="stylesheet">
</head>
<body>
<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" class="form">
<h1>Welcome!</h1>
<h3>Email:</h3>
<input type="email" name="email">

<h3>Password:</h3>
<input type="password" name="password">

<br>
<br>

<input type="submit" name="submit" value="Log in" class="button">
</form>

</body>
</html>


<?php 
if($_SERVER["REQUEST_METHOD"]=="POST"){

    $email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS);
    $sql="SELECT * FROM registeredusers WHERE email = '$email'";
    try{
         $result =mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
            $row =mysqli_fetch_assoc($result);
             $hashPass =$row['password'];
             if(password_verify($password,$hashPass)){
                $_SESSION['id']=$row['id'];
                echo "<p class=\"loginPageSucces\">Sucssefully log in!</p> <br>
    <a href='homePage.php' class=\"loginPageSuccesAnchor\">Proceed to Profile page</a>";
             } else{
                throw new Exception();
            }
    }
}
    catch (Exception ) {
        echo "<p class=\"loginPageError\"> Wrong password or username</p>";
    }

}
mysqli_close($conn);
?>