<?php

if(isset($_GET['delete_users'])){
    $delete_User_id =$_GET['delete_users'];

    $delete_User_query = "DELETE FROM `users` WHERE id = $delete_User_id ";
    $result_delete_user = $connection->query($delete_User_query);

   
        // echo " <script>alert('User Deleted Successfully')</script>";
        echo " <script>window.open('./All_Users.php','_self')</script>";
    
}


?>