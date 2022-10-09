<?php

include ("./include/connection.php");
include ("./Functions/functions.php");

if(isset($_POST["submit"])){
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $Cpassword = $_POST['confirm_password'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<h4 class='error'>Invalid Email</h4>";
       
    }
    $select = "SELECT * FROM users WHERE email = '$email'";
    $result = $connection->prepare($select);
    $result->execute();
    $row = $result->rowCount();
    if($row > 0){
        echo "<h4 class='error'>Email Already Exist</h4>";
        exit();


        }elseif($password != $Cpassword){
            echo "<h4 class='error'>Password do not match</h4>";


        }elseif(empty($first_name) || empty( $last_name) || empty( $email)|| empty($Cpassword)){
            echo "<h4 class='error'>Fill All Available fileds</h4>";

        }
    else{
        $register = "INSERT INTO users (first_name, last_name, email,  password) 
        VALUES (:first_name, :last_name,  :email, :password)";
        $statement = $connection->prepare($register);
        if($statement->execute(['first_name' => $first_name, 'last_name'=> $last_name, 'email'=>$email,
        'password'=>  $password_hash])){
            echo "<h4 class='error'>Sucessful</h4>";

            echo " <script>window.open('index.php', '_self')</script>";

        }

       
    
       
    }


    


}


?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="stylereg.css">
   
</head>
<body>
<div class = "Product-form-container">
    <h2>Create an Account</h2>

        <form method = "POST" >
            <div>
                <label >First Name</label>
                <input type="text" name="firstname" placeholder="Enter Name" autocomplete = "off" require>
            </div>

            <div>
                <label >Last Name</label>
                <input type="text" name="lastname" placeholder="Enter Name" autocomplete = "off" require>
            </div>


            <div>
                <label >Email</label>
                <input type="email" name="email" placeholder="Enter Email"  require>
            </div>

            <div>
                <label >Password</label>
                <input type="password" name="password" placeholder="Enter Password" autocomplete = "off" require>
            </div>

            <div>
                <label >Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="Confirm Password" autocomplete = "off" require>
            </div>

            

            <div>
               
                <input class ="submit-btn" type="submit" name="submit" value = "Register">

            </div>
            <div class="footer-question">
            Have an Account Already? <a href="index.php">Login</a>
            </div>
        </form>   
</body>
</html>

