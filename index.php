<?php
session_start();
include ("./include/connection.php");
include ("./Functions/functions.php");


if(isset($_POST["submit"])){
    $email = $_POST['email'];
    $pass = $_POST ["password"];

    $select = "SELECT * FROM users WHERE email = '$email'";
    $result = $connection->prepare($select);
    $result->execute();
    $row_count = $result->rowCount();
    $fetch = $result->fetch(PDO::FETCH_ASSOC);

   
        $id = $fetch['id'];
        $user_email = $fetch['email'];
        $user_firstname = $fetch['first_name'];
        $role = $fetch['role'];
        if($fetch < 1){
            echo "<h4 class='error'>Invalid Login</h4>";
            header("Location: index.php");
        }
   
    // var_dump( $user_email);

    if($row_count > 0){
        if(password_verify( $pass,$fetch['password'])){

            $_SESSION['identifier'] = $email;
            $_SESSION['id'] =   $id;
            $_SESSION['username'] = $user_firstname;
            $_SESSION['role'] =  $role;

            if($role == 'User'){
                header('Location: product_page.php');

            }elseif($role =='Admin'){
                header('Location: ./Admin/index.php');

            }else{
                echo "<h4 class='error'>Invalid Email or Password</h4>";
                exit();
            }

            // echo "Login Successful";
        }else{
            echo "<h4 class='error'>Invalid Login</h4>";

        }
    }else{
        echo "<h4 class='error'>Invalid Login</h4>";

    }
}
?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
    
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Login</title>
        <link rel="stylesheet" href="stylereg.css">
       
    </head>
    <body>
    <div class = "Product-form-container">
        <h2> Login</h2>
            <form action="" method = "POST" enctype = "multipart/form-data">
                <div>
                    <label >Email</label>
                    <input type="email" name="email" placeholder="Enter Email" value ="<?= htmlspecialchars($_POST["email"] ?? "") ?> " require >
                </div>
    
                <div>
                    <label >Password</label>
                    <input type="password" name="password" placeholder="Enter Password" autocomplete = "off" require>
                </div>
    
    
                <div>
                   
                    <input class ="submit-btn-log" type="submit" name="submit" value = "Login">
    
                </div>
                <div class="footer-question">
                Don't Have an Account Yet? <a href="user_registration.php">Register</a>
                </div>
            </form>   
    </body>
    </html>
    
   
   
                
            
        



