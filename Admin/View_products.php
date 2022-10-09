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
        <title>Document</title>
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
                    <h3 class = "view-products-table-head">All Products</h3>
                    <table  cellspacing = "5" cellpadding = "5"  >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Products Name</th>
                                    <th>Products Image</th>
                                    <th>Products price</th>
                                    <th>Edit</th>
                                    <th>Delete</th>





                                </tr>
                            </thead>
                            <tbody>

                            <?php
                            

                            
                                $get_products = "SELECT * FROM `products`";
                                $get_products_result = $connection->query($get_products);
                                $number = 0;
                                while($row_data =  $get_products_result->fetch(PDO::FETCH_ASSOC)){
                                    $product_id = $row_data['id'];
                                    $product_title = $row_data['name'];
                                    $product_image = $row_data['image'];
                                    $product_price = $row_data['price'];
                                
                                    $number++;
                            ?>
                                    <tr>
                                    <td><?php echo $number;?></td>
                                    <td><?php echo $product_title;?></td>
                                    <td><img src = './images/<?php echo $product_image;?>'></td>
                                    <td> $ <?php echo $product_price?></td> 
                                    <td><a class = 'edit-btns' href='index.php?edit_products=<?php echo $product_id ?>'>Edit</a></td>
                                    <td><a class = 'delete-btn' href='index.php?delete_products=<?php echo $product_id ?>'>Delete</a></td>
                                    </tr>
                        <?php
                                }
                            

                        ?>
                                
                            

                        
                                

                            </tbody>
                </table>
            </div>
    </body>
    </html>
    <?php }else{
            header('location:../index.php');
        }
}


?>