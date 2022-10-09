<?php

if(isset($_GET['delete_oders'])){
    $delete_id =$_GET['delete_oders'];

    $delete_query = "DELETE FROM `orders` WHERE Id = $delete_id ";
    $result_delete = $connection->query($delete_query);

   
        // echo " <script>alert('Order Deleted Successfully')</script>";
        echo " <script>window.open('./List_orders.php','_self')</script>";
    
}


?>