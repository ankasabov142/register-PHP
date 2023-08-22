<?php 
include"dataBaseConnection.php";
?>

<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
<h1>Welcome!</h1>
<h3>Username:</h3>
<input type="text" name="username">

<h3>Password:</h3>
<input type="password" name="password">

<br>
<br>

<input type="submit" name="submit" value="Log in">
</form>


<?php 
if($_SERVER["REQUEST_METHOD"]=="POST"){

    $username = filter_input(INPUT_POST,"username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS);
    $sql="SELECT * FROM registeredusers WHERE username = '$username'";
    try{
         $result =mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
            $row =mysqli_fetch_assoc($result);
             $hashPass =$row['password'];
             if(password_verify($password,$hashPass)){
                echo 'Sucssefully log in';
             } else{
                throw new Exception();
            }
    }
}
    catch (Exception ) {
        echo "Wrong shit bro";
    }

}
// if($_SERVER["REQUEST_METHOD"]=="POST"){
//     $username = filter_input(INPUT_POST,"username", FILTER_SANITIZE_SPECIAL_CHARS);
//     $email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_EMAIL);
//     $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS);
//     $phone = preg_replace('/[^0-9]/', '', $_POST['phone']);

//     if(empty($username)|| empty($email)|| empty($password)|| empty($phone)){
//         echo('<p>Please fill in all required fields </p>');
//         echo('<p>P.S. Your phone number must contain only 10 digits</p>');
//     }
//     else{
//         $hash = password_hash($password,PASSWORD_DEFAULT);
//       $sql = "INSERT INTO registeredusers (username,email,password,phone)
//     VALUES('$username','$email','$hash','$phone')";
// try{
//     mysqli_query($conn,$sql);
//     echo "<p>You are now registered!</p> <br>
//     <a href='loginPage.php'>Proceed to Login page</a>";
// }       
// catch(mysqli_sql_exception){
//     echo "<p>There was an error filling in your details </p>";
// echo "<p>Or they are already used </p>";
// }
       


//     }
// }

/*if (filter_var($email, FILTER_VALIDATE_EMAIL))*/
mysqli_close($conn);
?>