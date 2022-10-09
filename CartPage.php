<?php
session_start();
include ("./include/connection.php");
include ("Functions/functions.php");
?>

<?php
         
        
         cart();
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Details</title>
    <link rel="stylesheet" href="Style-cartPage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/64fbf8a835.js" crossorigin="anonymous"></script> 
</head>
<body >
<!-- onload="return grandT()" -->


    <h2>Cart Details</h2>
    
    <section class="Table" id="Table-box">
        <h4>Order Summary</h4>
        <form action="" method = "POST">
            <table>
                <thead id="cart-header">
                    <tr>
                        <th id="Product">PRODUCT IMAGE</th>
                        <th>PRODUCT NAME</th>
                        <th>QUANTITY</th>
                        <th>PRICE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody class="body" id="products">
                    <?php
                        global $connection;
                        $Id = $_SESSION['id'];
                        $total_price = 0;
                        $cart_query = "SELECT * FROM cart WHERE user_id = '$Id' ";
                        $result = $connection->query($cart_query);
                        
                        while($cart_details_row = $result->fetch(PDO::FETCH_ASSOC)){
                            $cart_id = $cart_details_row["id"];
                            $cart_qty = $cart_details_row['quantity'];
                            $select_products = "SELECT * FROM `products` WHERE id = $cart_id";
                            $result_statement = $connection->query($select_products);

                            while($product_price_row = $result_statement->fetch(PDO::FETCH_ASSOC)){
                                $product_price = array($product_price_row['price']);
                                $price_table = $product_price_row['price'];
                                $ePrice = $price_table * $cart_qty;
                                $product_title = $product_price_row['name'];
                                $product_image = $product_price_row['image'];
                                $product_values = array_sum($product_price);
                                // $total_price+= $product_values;
                                $total_price = $total_price + $ePrice;
                            ?>
                            <tr id="<?php echo $product_price_row['id'] ?>">
                                <td><img src='Admin/images/<?php echo $product_image?>' width='90px' alt='Ipnone 12'></td>
                                <td><?php echo $product_title?></td>
                                <td><input class='quantity' value="<?php echo $cart_qty; ?>"  type='number' min="1" name ='quantity' id="q<?php echo $product_price_row['id']; ?>"></td>
                                <td><h4 id="hh<?php echo $product_price_row['id']; ?>"> <?php echo number_format($ePrice); ?></h4></td>
                                <td>
                                    <a href="#" class ="update" data-type="update" data-amount="<?php echo $ePrice; ?>" data-total-price="<?php echo $total_price; ?>" data-id="<?php echo $product_price_row['id']; ?>">Update</a>
                                    <!-- <input class='update' type='submit' name = 'update' value = 'Update'> -->
                                    <!-- <input class='delete' type='submit' value = 'Delete' name = 'delete'> -->
                                    <a href="#" class = "delete" data-type="delete" data-id="<?php echo $product_price_row['id']; ?>" >Delete</a>
                                </td>
                            </tr> 
                        <?php }
                        }  
                    ?>
                </tbody>
            </table>
        </form>
        <div class="container">
            <div class="total-container">
                <p>Apply Coupon to get discount!</p>
                <div class="total">
                    <div class="total-summary">
                        <p>Subtotal Price:</p>
                        <h5 class="grand-total">$ <span class="TotalFigure"><?php echo number_format($total_price) ?></span></h5>
                    </div>
                </div>
            </div>

            <div class="coupon-code">
                <input type="text" placeholder="Coupon Code"><a href="#">Apply</a>
            </div>
            <div class="footer">
                <a href="product_page.php">Continue Shoping</a>
                <a href="./User/checkout.php">Proceed to Checkout</a>
            </div>
        </div>
    </section>
    
    <script src="./jquery.js"></script>
    <!-- <script src="./Data.js"></script>
    <script src="./Cart.js"></script> -->
    <script>
        $(document).ready(function(){
            $("#products a").click(function(){
                let type = $(this).data('type');
                let id = $(this).data('id');
                let qty = $("#q"+id).val();
                let totalPrice = $(this).data('total-price');
                let qtyAmount = $(this).data('amount');
                if(type === "update"){
                    $.ajax({
                        method: "POST",
                        url: "./updateCart.php",
                        data:{
                            "id": id,
                            "qty": qty,
                            "total": totalPrice,
                            "qtyAmount": qtyAmount,
                            "update": 1
                        },
                        success: function(data){
                            let value = JSON.parse(data)
                            $(".TotalFigure").text(value.totalPrice) 
                            $('#products #hh'+id).text(value.rowPrice)
                        }
                    })
                }else if(type === "delete"){
                    $.ajax({
                        method: "POST",
                        url: "./deleteCart.php",
                        data:{
                            "id": id,
                            "delete": 1
                        },
                        success: function(data){
                            if(data === "Product Deleted Successfully"){
                                // alert(data)
                                $("#products #"+id).remove()
                            }else{
                                alert(data)
                            }
                        }
                    })
                }
            })
        })
    </script>
</body>
</html>





