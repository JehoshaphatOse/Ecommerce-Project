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
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>All Orders</title>
        <link rel="stylesheet" href="style.css">
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
                            <a href="All_Users">All Orders</a>
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
                <h3>All Orders</h3>
            

                    <table  cellspacing = "5" cellpadding = "5"  >
                            <thead>

                                    <?php
                                        $get_orders = "SELECT * FROM `orders`";
                                        $result_orders = $connection->query($get_orders);
                                        $row_count = $result_orders->rowCount();
                                        

                                if($row_count==0){
                                    echo "<h2>No Orders Yet</h2>";
                                }else{
                                    echo "<tr>
                                        <th>S/N</th>
                                        <th>Total Price</th>
                                        <th>Product Id</th>
                                        <th>Status</th>
                                        <th>Delete</th>
        
                                    </tr>
                                </thead>";
                                    $number = 0;
                                    while($row_data =  $result_orders->fetch(PDO::FETCH_ASSOC)){
                                        $order_id= $row_data['Id'];
                                        $user_id= $row_data['user_id']; 
                                        $product_id= $row_data['product_id']; 
                                        $price_total= $row_data['total_price'];  
                                        $status= $row_data['status']; 
                                        $number++;
                                        echo "<tr>
                                        <td> $number</td>
                                        <td>$ $price_total</td>
                                        <td>  $product_id</td>
                                        <td>$status</td>
                                        <td> <a class = 'delete-btn' href='index.php?delete_oders=$order_id'>Delete</a> </td>
                                    </tr>";


                                    }
                                }
                                
                                    ?>
                                <!-- <tr>
                                    <th>S/N</th>
                                    <th>Total Products</th>
                                    <th>Total Price</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                    <th>Delete</th>

                                </tr>
                            </thead> -->
                            <tbody>
                                
                                

                            
                                


                        
                                

                            </tbody>
                    </table>
    </body>
    </html>
        <?php }else{
                header('location:../index.php');
            }
}


?>