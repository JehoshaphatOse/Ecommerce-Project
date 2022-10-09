<?php

if(isset($_GET['delete_products'])){
    $delete_id = $_GET['delete_products'];

    $delete_query = "DELETE FROM `products` WHERE id =$delete_id";
    $result_delete = $connection->query($delete_query);
    
        // echo " <script>alert('Product Deleted Successfully')</script>";
        echo " <script>window.open('./View_products.php','_self')</script>";
    
}
?>