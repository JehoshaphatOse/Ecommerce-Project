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
    <title>All Users</title>
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

                <h3>All Users</h3>

                <table  cellspacing = "5" cellpadding = "5"  >
						<thead>

                                <?php
                                    $get_users = "SELECT * FROM `users` WHERE role = 'User'";
                                    $result_users =$connection->query( $get_users);
                                    $row_count = $result_users->rowCount();
                                    

                                if($row_count==0){
                                    echo "<h2>No Users Yet</h2>";
                                }else{
                                    echo "<tr>
                                        <th>S/N</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th> Email</th>
                                        <th>Delete</th>
        
                                    </tr>
                            </thead>";
                                $number = 0;
                                while($row_data = $result_users->fetch(PDO::FETCH_ASSOC)){
                                    $user_id= $row_data['id'];
                                    $first_name= $row_data['first_name']; 
                                    $last_name= $row_data['last_name']; 

                                    $user_email= $row_data['email']; 
                                    // $role= $row_data['User']; 
                                    
                                   
                                    $number++;
                                    echo "<tr>
                                    <td> $number</td>
                                    <td> $first_name</td>
                                    <td> $last_name</td>
                                    <td>$user_email</td>
                                
                                    <td> <a class = 'delete-btn' href='index.php?delete_users=$user_id'>Delete</a> </td>
                                </tr>";


                                }
                            }
                            
                                ?>
							
						<tbody>
                            
                            

                        
                            


                       
                            

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