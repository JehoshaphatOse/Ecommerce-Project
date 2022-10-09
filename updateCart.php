<?php


include ("./include/connection.php");
    $msg = array();                   
    if(isset($_POST['update'])){
        $quantity = $_POST["qty"];
        $id = $_POST['id'];
        $total = $_POST['total'];
        $qtyAmount = $_POST['qtyAmount'];

        $select_products = "SELECT * FROM `products` WHERE id = $id";
        $result_statement = $connection->query($select_products);
        $product_price_row = $result_statement->fetch(PDO::FETCH_ASSOC);
        $price_table = $product_price_row['price'];
        $ePrice = $price_table * $quantity;
        $total_price = $total + $ePrice;
        
        $update_cart = "update `cart` set quantity = :quantity where id = :id";
        $result_quantity = $connection->prepare($update_cart);
        $result_quantity->execute(['quantity' =>$quantity, 'id' => $id] );

        $msg['totalPrice'] = $total_price - $qtyAmount;
        $msg['rowPrice'] = $ePrice;
    }

    echo json_encode($msg);
?>