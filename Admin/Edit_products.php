
<?php
// session_start();
include ("../include/connection.php");

if(isset($_GET['edit_products'])){
    $edit_id = $_GET['edit_products'];
    
    $get_edit_data = "SELECT * FROM `products` WHERE id = $edit_id";
    $result = $connection->query($get_edit_data);
    $fetch =   $result->fetch(PDO::FETCH_ASSOC);
    $product_name =  $fetch['name'];
    $product_desc =  $fetch['description'];
    $image_of_product =  $fetch['image'];
    $product_price =  $fetch['price'];
    $product_qty =  $fetch['quantity'];

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Products</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3>Edit Products</h3>
    <div class = "Product-form-container">
        <form action="" method = "POST" enctype = "multipart/form-data">
            <div>
                <label >Product Name</label>
                <input type="text" name="product-title" value= '<?php echo $product_name;?>'  required>
            </div>
            <div>
                 <label >Product Description</label>
                <input type="text" name="product-description" value= '<?php echo $product_desc;?>'  required >
            </div>

            <div>
                 <label >Product Image</label>
                <input type="file" name="product-image"  >
                <img class = 'input-img' src='./images/<?php echo $image_of_product;?>' alt="">
            </div>

            <div>
                 <label >Product Price</label>
                <input type="text" name="product-price" value= '<?php echo $product_price;?>' required >
            </div>

            <div>
                 <label >Product Quantity</label>
                <input type="text" name="product-quantity" value= '<?php echo $product_qty;?>'  required >
            </div>

            <div>
                 
                <input class = "edit-btn" type="submit" name="edit_product_btn" value ="Update Product">
                <!-- <a href="index.php"><span>Return to Dashboard</span></a> -->
            </div>

            
        </form>
   </div>

</body>
</html>

<!-- edit btn clicked function -->

<?php
if(isset($_POST['edit_product_btn'])){
    $product_title = $_POST['product-title'];
    $product_description = $_POST['product-description'];
    $product_price = $_POST['product-price'];
    $product_quantity = $_POST['product-quantity'];
   
    
    $product_image = $_FILES['product-image']['name'];
    $product_image_tmpName = $_FILES['product-image']['tmp_name'];

    // checking if fileds are empty
    if(empty($product_title) || empty($product_description)  || empty($product_quantity) || empty($product_price) ||  empty( $product_image)){
        echo " <script>alert('Please fill All Available fields')</script>";
       
    }else{
        move_uploaded_file($product_image_tmpName, "./images/$product_image");

        $update_products ="UPDATE products SET name = :name, description =:description,
        image = :image, price = :price, quantity =:quantity WHERE id = :id" ;
        $stmt =$connection->prepare($update_products);
        
       $stmt->execute(['name' =>$product_title, 'description' =>$product_description, 'image' =>$product_image,
        'price'=>$product_price, 'quantity' =>$product_quantity, 'id' =>$edit_id]);
            // echo " <script>alert('Product Updated Successfully')</script>";
            echo " <script>window.open('./View_products.php','_self')</script>";
    }
}
?>