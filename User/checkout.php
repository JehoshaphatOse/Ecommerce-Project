
<?php
session_start();
include ("../include/connection.php");
// include ("../Functions/functions.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoping Cart</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <link rel="stylesheet" href="../Style.css">
</head>
<body >

    
    <div class="Product" id="product-cart">
        <div class="header-content">
            <ul class="nav-left">
                <li>
                    <a href="../product_page.php">Home</a>
                    <a href="#">Products</a>
                    <a href="#"> Products</a>
                    <a href="#">Products</a>
                    <a href="#">Contact</a>
                  
                </li>
            </ul>
        </div>
        <div class = "nav-right">
                
                <!-- <a class = "register-btn" href="#" target ="_blank">My Account</a> -->


                
                <?php
                    
                    if(isset($_SESSION['username'])){
                        echo "<a class = 'register-btn' href='#' target ='_blank'>My Account</a>";
                    }else{
                        echo " <a class = 'register-btn' href='#' target ='_blank'>Register</a>";
                    }

                    if(!isset($_SESSION['identifier'])){
                        echo "<a class = 'login-btn' href='../index.php' target ='_blank'>Login</a>";
                    }else{
                        echo "<li><a class = 'login-btn' href='../Logout.php'>Logout</a></li>";

                    }
                    if(isset($_SESSION['username'])){
                        echo " <p class= 'welcome-paragraph'>Welcome <span class = 'username'>".$_SESSION['username']."</span></p>";
                    }else{
                        echo " <p class= 'welcome-paragraph'>Welcome Guest</p>";
                    }
                    
                ?>


        </div>
        
    </div>
   
   

    <section>
        <div>
        
        <?php
                
                include ("payment.php");
            
        ?>
           

           

          
        </div>
        

    </section>

    <!-- <div class="footer">
         <p>All right Reserved</p>   
    </div> -->


</body>

</html>