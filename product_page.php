<?php
session_start();
include ("./include/connection.php");
include ("Functions/functions.php");


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
    <link rel="stylesheet" href="Style.css">
</head>
<body >

    
    <div class="Product" id="product-cart">
        <div class="header-content">
            <ul class="nav-left">
                <li>
                    <a href="index.php">Home</a>
                    <a href="display_allproduct.php">Products</a>
                    <a href="#"> Products</a>
                    <a href="#">Products</a>
                    <a href="#">Contact</a>
                  
                </li>
            </ul>
        </div>
            <div class = "nav-right">
                
                <!-- <a class = "register-btn" href="#" target ="_blank">My Account</a> -->

                <?php
cart();

?>
                
                <?php
                    if(isset($_SESSION['username'])){
                        echo "<a class = 'register-btn' href='#' target ='_blank'> Account</a>";
                    }else{
                        echo " <a class = 'register-btn' href='#' target ='_blank'>Register</a>";
                    }

                    if(!isset($_SESSION['identifier'])){
                        echo "<a class = 'login-btn' href='index.php' target ='_blank'>Login</a>";
                    }else{
                        echo "<li><a class = 'login-btn' href='Logout.php'>Logout</a></li>";

                    }
                    if(isset($_SESSION['username'])){
                        echo " <p class= 'welcome-paragraph'>Welcome <span class = 'username'>".$_SESSION['username']."</span></p>";
                    }else{
                        echo " <p class= 'welcome-paragraph'>Welcome Guest</p>";
                    }
                ?>


                <!-- <a class = "login-btn" href="UserPanel/UserLogin.php" target ="_blank">Login</a> -->
               

                <a href="CartPage.php"><h3 id="cart">Cart (<span id="cart-count"><?php echo Cart_count();?></span>)</h3></a>
           <!-- <p class= "welcome-paragraph">Welcome Guest</p> -->
                <!-- <form action = "search_product.php" method = "GET" >
                    <input class = "search-bar" type="search" placeholder = "Search" name = "Search_product">
                    
                    <input type="submit" class = "Search-btn" value = "Search" name = "search">
                </form> -->

            </div>
        <!-- <div class="header-cart"> -->
        
        

        <?php
// if(!isset($_SESSION['username'])){
//     echo "<p class= 'welcome-paragraph'>Welcome Guest</p>";
// }else{
//     echo "<p class= 'welcome-paragraph'> ".$_SESSION['username']."</p>";


// }
// ?>

             

        </div>
    </div>
   


    <section class = "GrandParent-container">
        <div class="header-container" id="Products">

        <?php
            getProducts();
        ?>

           

            <!-- <div class="Product-container">
                <img id="Product" src="../images/Iphone 11.jpg" width="250px" alt="Iphone-11">
                <div class="discription">
                    <p class="rating"><i></i>4.1(115)</p>
                    <h3>Apple Iphone 11</h3>
                    <p class="reff">Referrence <span>1254</span> </p>
                    <h4>$ 650</h4>
                    <button class="btn" id="Addbtn">Add to Cart</button>
                </div>
            </div>

                <div class="Product-container">
                    <img id="Product" src="images/Iphone 12 Pro.jpg" width="250px" alt="Iphone 12 Pro">
                    <div class="discription">
                        <p class="rating"><i></i>4.6(145)</p>
                        <h3>Iphone 12 Pro Max</h3>
                        <p class="reff">Referrence <span>1104</span> </p>
                        <h4>$ 750</h4>
                        <button class="btn" id="Addbtn">Add to Cart</button>
                    </div>
                </div>

                <div class="Product-container">
                    <img id="Product" src="images/Airpod pro.jpg" width="250px" alt="Airpod">
                    <div class="discription">
                        <p class="rating"><i></i>3.6(125)</p>
                        <h3>Airpod Pro</h3>
                        <p class="reff">Referrence <span>1704</span> </p>
                        <h4>$ 150</h4>
                        <button class="btn" id="Addbtn">Add to Cart</button>
                    </div>
                </div>

                <div class="Product-container">
                    <img id="Product" src="images/Iphone XS Max.jpg" width="250px" alt="Iphone Xs Max">
                    <div class="discription">
                        <p class="rating"><i></i>4.5(145)</p>
                        <h3>Iphone XS Max</h3>
                        <p class="reff">Referrence <span>1314</span> </p>
                        <h4>$ 480</h4>
                        <button class="btn" id="Addbtn">Add to Cart</button>
                    </div>
                </div>

                <div class="Product-container">
                    <img id="Product" src="images/Apple macbook pro.jpg" width="250px" alt="macbook">
                    <div class="discription">
                        <p class="rating"><i></i>4.5(165)</p>
                        <h3>Apple Macbook Pro</h3>
                        <p class="reff">Referrence <span>1604</span> </p>
                        <h4>$ 1250</h4>
                        <button class="btn" id="Addbtn">Add to Cart</button>
                    </div>
                </div>

                <div class="Product-container">
                    <img id="Product" src="images/Hub Adapter.jpg" width="250px" alt="Adapter">
                    <div class="discription">
                        <p class="rating"><i></i>3.5(76)</p>
                        <h3>Hub Adapter</h3>
                        <p class="reff">Referrence <span>1104</span></p>
                        <h4>$ 190</h4>
                        <button class="btn" id="Addbtn">Add to Cart</button>
                    </div>
                </div>

                <div class="Product-container">
                    <img id="Product" src="images/Smartwatch 1.jpg" width="250px" alt="Smartwatch">
                    <div class="discription">
                        <p class="rating"><i></i>4.1(102)</p>
                        <h3> Black Apple Smartwatch</h3>
                        <p class="reff">Referrence <span>1304</span> </p>
                        <h4>$ 350</h4>
                        <button class="btn" id="Addbtn">Add to Cart</button>
                    </div>
                </div>

                <div class="Product-container">
                    <img id="Product" src="images/Smartwatch 2.jpg" width="250px" alt="Smartwatch">
                    <div class="discription">
                        <p class="rating"><i></i>3.7(15)</p>
                        <h3>Apple Smartwatch</h3>
                        <p class="reff">Referrence <span>1104</span> </p>
                        <h4>$ 370</h4>
                        <button class="btn" id="Addbtn">Add to Cart</button>
                    </div>
                </div>

                <div class="Product-container">
                    <img id="Product" src="images/USB wireless mouse.jpg" width="250px" alt="mouse">
                    <div class="discription">
                        <p class="rating"><i></i>3.5(125)</p>
                        <h3>USB Wireless Mouse</h3>
                        <p class="reff">Referrence <span>1424</span> </p>
                        <h4>$ 240</h4>
                        <button class="btn" id="Addbtn">Add to Cart</button>
                    </div>
                </div> --> 
        </div>
        

    </section>

    <div class="footer">
         <p>All right Reserved</p>   
    </div>


</body>
<!-- <script src="./dynamic.js"></script> -->
<!-- <script src="./Cart.js"></script> -->
</html>