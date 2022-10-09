<?php
include ("../include/connection.php");

if(isset($_POST['submit'])){
    $name = $_POST["product-name"];
    $description = $_POST["product-description"];
    $price = $_POST["product-price"];
    $quantity = $_POST["product-quantity"];
    
    $image = $_FILES["product-image"]['name'];
    $image_tmp_name = $_FILES["product-image"]['tmp_name'];

    if(empty($name) || empty($description)  || empty($quantity) || empty($price) ||   empty( $image)){
        echo " <h1>Please fill All Available fields</h1>";
       
    }else{

        move_uploaded_file( $image_tmp_name, "./images/$image");

        $insert = "INSERT INTO products (name, description, image, price, quantity) VALUES (:name, :description, :image,
         :price, :quantity)";
         $statement = $connection->prepare( $insert);
         $statement->execute(['name' =>$name, 'description' => $description, 'image' =>$image, 'price' => $price,
          'quantity' => $quantity]);

          echo "<h4 class='success'>Product Inserted Successfully</h4>";
        

    
    }
   


}

?>
<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product Form</title>
    <link rel="stylesheet" href="styleproduct.css">
 </head>
 <body>
   
        <div class = "Product-head">
            <h1>Insert Products</h1>
           
            <p></p>
        </div>

    <div class = "Product-form-container">
        <form action="" method = "POST" enctype = "multipart/form-data">
            <div>
                <label >Product Name</label>
                <input type="text" name="product-name" placeholder="Enter Product Name" autocomplete = "off" required>
            </div>
            <div>
                 <label >Product Description</label>
                <input type="text" name="product-description" placeholder="Enter Product Description" autocomplete = "off" required >
            </div>

            <div>
                 <label >Product Image</label>
                <input type="file" name="product-image" >
            </div>

            <div>
                 <label >Product Price</label>
                <input type="text" name="product-price" placeholder="Enter Product Price" autocomplete = "off" required >
            </div>

            <div>
                 <label >Product Quantity</label>
                <input type="text" name="product-quantity" placeholder="Enter Product Quantity" autocomplete = "off" required >
            </div>

            <div>
                 
                <input class = "insert-btn" type="submit" name="submit" value ="Insert Product">
                <a href="index.php"><span>Return to Dashboard</span></a>
            </div>

            
        </form>
   </div>
 </body>
 </html>