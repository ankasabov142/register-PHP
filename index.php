<?php
include"dataBaseConnection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Register Page via PHP</title>
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
<h1>Welcome!</h1>
<p>Username:</p>
<input type="text" name="username">

<p>Email:</p>
<input type="email" name="email">

<p>Password:</p>
<input type="password" name="password">

<p>Phone Number:</p>
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
        echo('Please fill in all required fields <br>');
        echo('P.S. Your phone number must contain only 10 digits');
    }
    else{
        $hash = password_hash($password,PASSWORD_DEFAULT);
      $sql = "INSERT INTO registeredusers (username,email,password,phone)
    VALUES('$username','$email','$hash','$phone')";
try{
    mysqli_query($conn,$sql);
    echo "<p>You are now registered!</p>";
}       
catch(mysqli_sql_exception){
    echo "<p>There was an error filling in your details </p> <br>";
echo "<p>Or they are already used </p>";
}
       


    }
}

/*if (filter_var($email, FILTER_VALIDATE_EMAIL))*/
mysqli_close($conn);
?>