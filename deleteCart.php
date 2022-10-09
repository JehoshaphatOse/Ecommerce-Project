<?php

include ("./include/connection.php");
if(isset($_POST['delete'])){
    $id = $_POST['id'];

    $delete = "DELETE FROM cart WHERE id = :id";
    $stmt = $connection->prepare($delete);
    $stmt->execute(['id' => $id]);

    if($stmt){
        echo "Product Deleted Successfully";
    }
}
?>