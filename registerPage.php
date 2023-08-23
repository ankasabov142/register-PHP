<?php
include"dataBaseConnection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:opsz,wght@6..96,500&family=Caprasimo&family=Kanit:ital,wght@0,600;1,300&family=Lilita+One&family=Open+Sans&family=Questrial&family=REM&family=Work+Sans:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" class="form">
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

<input type="submit" name="submit" value="Register now">
</form>
</body>
</html>


<?php 
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = filter_input(INPUT_POST,"username", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS);
    $phone = preg_replace('/[^0-9]/', '', $_POST['phone']);

    if(empty($username)|| empty($email)|| empty($password)|| empty($phone)){
        echo('<p class= \"registerPageFailedEchoFill\">Please fill in all required fields </p>');
        echo('<p class= \"registerPageFailedEchoPs\">P.S. Your phone number must contain only 10 digits</p>');
    }
    else{
        $hash = password_hash($password,PASSWORD_DEFAULT);
      $sql = "INSERT INTO registeredusers (username,email,password,phone)
    VALUES('$username','$email','$hash','$phone')";
try{
    mysqli_query($conn,$sql);
    echo "<p class=\"registerPageSuccess\">You are now registered!</p> <br>
    <a href='loginPage.php' class=\"registerPageSuccessAnchor\" >Proceed to Login page</a>";
}       
catch(mysqli_sql_exception){
    echo "<p class=\"registerPageSuccessError\">There was an error filling in your details </p>";
echo "<p class=\"registerPageSuccessErrorVol2\">Or they are already used </p>";
}
       


    }
}

/*if (filter_var($email, FILTER_VALIDATE_EMAIL))*/
mysqli_close($conn);
?>