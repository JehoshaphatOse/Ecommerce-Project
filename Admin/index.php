<?php
session_start();
include ("../include/connection.php");


if(isset($_SESSION['id'])){

    $select = "SELECT * FROM users WHERE role= 'Admin'";
    $stmt = $connection->query($select);
    $fetch =$stmt->fetch(PDO::FETCH_ASSOC);
    $id = $fetch['id'];

    if($_SESSION['id'] ==  $id){     ?>


    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Admin Dashboard</title>
        <link rel='stylesheet' href='style.css'>
    </head>
    <body>

        <style>

            .dashboard{
            color: black;
            margin-top: 1em;
            }
            ul{
                text-align: center;
            }
        </style>
        <div class = 'Admin-header'>
            <h1>LOGO</h1>
            <ul>
                <li>
                    <?php
                        if(isset($_SESSION['id'])){
                            echo "<a href=''>Welcome ".$_SESSION['username']."</a>";
                        }else{
                            echo "<a href=''>Welcome Admin</a>";
                        }
                    ?>
                    
                </li>
            </ul>
        </div>

        <div class = "main-container">
            <div class = "left-nav">
                    <!-- <div class = "Admin-Image"> 
                        <img src="../images/Iphone 11.jpg" alt="">
                        <h5>Admin Name</h5>
                    </div>  -->
                    <h1 class = "dashboard">Dashboard </h1>
                    
                    <div class = "Individual-btns">
                    <ul>
                            <li>
                                <a href="index.php">Home</a>
                            </li>
                            <li>
                                <a href="insert_product.php">Insert Products</a>
                            </li>

                            <li>
                                <a href="View_products.php">View Products</a>
                            </li>
                            
                            <li>
                                <a href="List_orders.php">All Orders</a>
                            </li>
                            
                            <li>
                                <a href="All_Users.php">All Users</a>
                            </li>
                            <li>
                                <a href="../Logout.php">Logout</a>
                            </li>
                    </ul>
                    </div>
                </div>
            <div class = "right-body">
                
                    <h3>Manage Details</h3>
                

                
                    <?php
                
                        // if(isset($_SESSION['username'])){
                        //  $user_id = $_SESSION['id'];
                        


                            if(isset($_GET["view_products"])){
                                // include ("View_products.php");
                            }

                            if(isset($_GET["edit_products"])){
                                include ("Edit_products.php");
                            }

                            if(isset($_GET["delete_products"])){
                                include ("Delete_products.php");
                            }

                            if(isset($_GET["list_orders"])){
                                // include ("List_orders.php");
                            }

                            if(isset($_GET["delete_oders"])){
                                include ("delete_orders.php");
                            }

                            if(isset($_GET["list_users"])){
                                // include ("All_Users.php");
                            }

                            if(isset($_GET["delete_users"])){
                                include ("delete_Users.php");
                            }
        
                    ?> 
                
            </div>
            

        </div>

        
    </body>
    </html> 


        <?php }else{
            header('location:../index.php');
        }
}


?>
