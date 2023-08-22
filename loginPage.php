<?php 
include"dataBaseConnection.php";
session_start();
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
                $_SESSION['id']=$row['id'];
                echo "<p>Sucssefully log in!</p> <br>
    <a href='profilePage.php'>Proceed to Profile page</a>";
             } else{
                throw new Exception();
            }
    }
}
    catch (Exception ) {
        echo "Wrong password or username";
    }

}
mysqli_close($conn);
?>