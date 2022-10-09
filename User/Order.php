<?php
session_start();
include ("../include/connection.php");
include ("../Functions/functions.php");



if(isset($_GET["userid"])){
    $User_id =$_GET["userid"];

     
}

// getting total items and total price of the items

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
    // var_dump($user_email);


$total_price =0;

$cart_price_query ="SELECT * FROM `cart` WHERE user_id ='$user_id' ";
$result_cart_price = $connection->query($cart_price_query);
$count_cart_items = $result_cart_price->rowCount();
 
// $status = 'Pending';

while($row_price = $result_cart_price->fetch(PDO::FETCH_ASSOC)){
   
    // getting product id
    $product_id = $row_price["id"];
    $select_product = "SELECT * FROM `products` WHERE id = $product_id ";
    $run_price = $connection->query($select_product);
    while($row_product_price = $run_price->fetch(PDO::FETCH_ASSOC)){
        $product_price = $row_product_price['price'];
        $product_name = $row_product_price['name']; 
        $product_price_value = ($product_price);
        $total_price+=$product_price_value ;
        var_dump($product_price) ;
        var_dump( $product_name) ;

    }
}

// getting quantity from cart
$get_cart = "SELECT * FROM `cart`";
$result_cart = $connection->query($get_cart);
while($get_item_quantity = $result_cart->fetch(PDO::FETCH_ASSOC)){
    $quantity = $get_item_quantity["quantity"];
}

var_dump($quantity) ;

if($quantity == 1){
    $quantity = 1;
    $subtotal=$total_price;

}else{
    $quantity = $quantity;
    $subtotal=$total_price*$quantity;
}

//  insertting into user order table

// $insert_order = "INSERT INTO `orders` (user_id, product_id, total_price)
//  VALUES ( :user_id,  :product_id, :total_price )";
//  $stmt = $connection->prepare($insert_order);
//  $stmt->execute(['user_id' =>$user_id, 'product_id' =>$product_id,'total_price' =>$subtotal]);

 
    // echo "<script>alert('Orders are Submitted Successfully')</script>";
    // echo "<script>window.open('paymentPage.php', '_self')</script>";

 

//  order pending

// $insert_pending_order = "INSERT INTO `oders_pending` (User_id, product_id, quantity, status)
//  VALUES ( $user_id,  $product_id, $quantity, '$status' )";

// $insert_pending_result = mysqli_query($connect, $insert_pending_order);

// deleting items from cart after inserting into orders table

// $delete_cart = "DELETE FROM `cart`WHERE user_id = '$user_id'";
// $result_delete = $connection->query($delete_cart);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Gateway</title>
</head>
<body>
    <style>
        .container{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 4em;
        }
        body{
            background-color: #f4f4f4;
        }
    </style>
   
    <div class = "container">
        <!-- <img src="../Admin/images/payment_image.jpg" width = "40%" alt=""> -->
        <h2>Welcome Jehos</h2>
        <form id="paymentForm">
            <div class="form-submit">
                <button type="submit" onclick="payWithPaystack()"> Pay </button>
            </div>
        </form>
    </div>
<script src="https://js.paystack.co/v1/inline.js"></script> 
<script>
    const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);

function payWithPaystack(e) {
  e.preventDefault();
    const Api_key ='pk_test_1c283a3b89227094c1bac1ac95f0dd9c3ceefa32';

     let handler = PaystackPop.setup({
    key: Api_key, // Replace with your public key
    email: "<?php echo $user_email; ?>",
    amount: <?php echo $subtotal; ?>*100,
    ref: 'PRN'+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    firstname: '<?php echo $user_firstname ;?>',
    lastname: '<?php echo $user_lastname ;?>',
    onClose: function(){
        window.location.href = "checkout.php";
      alert('Transaction Cancelled.');
    },
    callback: function(response){
      let message = 'Payment Successful! Reference: ' + response.reference;
      alert(message);
      window.location.href= "verify_transaction.php?reference=" + response.reference;
    //  window.location.href='success_page.php?Payment Succesfful';
    }
  });

  handler.openIframe();
}
</script>
</body>
</html>