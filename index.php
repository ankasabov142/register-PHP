<?php
include"dataBaseConnection.php";
echo "I like sspzza";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Register Page via PHP</title>
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
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
mysqli_close($conn);
?>