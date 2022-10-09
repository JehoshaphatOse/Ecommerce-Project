<?php
    session_start();
    include ("../include/connection.php");
    include ("../Functions/functions.php");

if (isset($_SESSION['identifier'])){
        $email = $_SESSION['identifier'];

    } 
    $user_id = $_SESSION['id'];
    $select = "SELECT * FROM users WHERE id = $user_id";
    $result = $connection->prepare($select);
    $result->execute();
    $row_count = $result->rowCount();
    $fetch = $result->fetch(PDO::FETCH_ASSOC);

    $id = $fetch['id'];
    $user_email = $fetch['email'];
    $user_firstname = $fetch['first_name'];
    $user_lastname = $fetch['last_name'];
    $role = $fetch['role'];
    



    $total_price =0;
    $cart_price_query ="SELECT * FROM `cart` WHERE user_id ='$user_id' ";
    $result_cart_price = $connection->query($cart_price_query);
    $count_cart_items = $result_cart_price->rowCount();

    while($row_price = $result_cart_price->fetch(PDO::FETCH_ASSOC)){
   
    // getting product id
    $product_id = $row_price["id"];
    $select_product = "SELECT * FROM `products` WHERE id = $product_id ";
    $run_price = $connection->query($select_product);
    while($row_product_price = $run_price->fetch(PDO::FETCH_ASSOC)){
        $product_price = array($row_product_price['price']);
        $product_price_value = array_sum($product_price);
        $total_price+=$product_price_value ;
        // var_dump($total_price) ;
    }
}

    // getting quantity from cart
    $get_cart = "SELECT * FROM `cart`";
    $result_cart = $connection->query($get_cart);
    while($get_item_quantity = $result_cart->fetch(PDO::FETCH_ASSOC)){
        $quantity = $get_item_quantity["quantity"];
    }


    // var_dump($quantity) ;
    if($quantity == 1){
        $quantity = 1;
        $subtotal=$total_price;

    }else{
        $quantity = $quantity;
        $subtotal=$total_price*$quantity;
    }

    $reference = uniqid();

  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./user_css/customer_form.css">
</head>
<body>
    <div class = "container">
        <!-- <img src="../Admin/images/payment_image.jpg" width = "40%" alt=""> -->
        <h2>Payment Details</h2>
        <p>Complete your details by providing your Phone Number</p>
        <div class = "blur"></div>
        <div class ="form-container">
            <form action ="paystack.php" method = "POST">
                <div>
                    <label>First Name</label>
                    <input type="text" name="fname"  value= "<?php echo $user_firstname;?>" readonly >
                </div>
                <div>
                    <label>Last Name</label>
                    <input type="text" name="lname" value= "<?php echo $user_lastname;?>" readonly >
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" name="email" value= "<?php echo $user_email;?>" readonly>
                </div>
                <div>
                    <label>Amount</label>
                    <input type="text" name="amount" value= "<?php echo $subtotal;?>" readonly>
                </div>
                <div>
                <label>Reference Number</label>
                    <input type="text" name="reference" value= "<?php echo  $reference;?>" readonly>
                </div>
                <div>
                    <label>Phone Number</label>
                    <input type="tel" name="phone" placeholder ="Phone Number" >
                </div>
                <div>
                <button type="submit" name = "pay-btn"> Pay </button>

                </div>
                
            </form>
        </div>
    </div>
</body>
</html>