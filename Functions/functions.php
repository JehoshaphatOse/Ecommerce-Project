<?php
// session_start();
function getProducts(){
    global $connection;


    $select = "SELECT * FROM products order by rand () limit 0,11";
    $statement = $connection->prepare($select);
    $statement->execute();
    $product =$statement->fetchAll();

    foreach($product as $products){
        $id = $products['id'];
        $name = $products['name'];
        $desc = $products['description'];
        $image = $products['image'];
        $price = $products['price'];
        $qty = $products['quantity'];

        echo " <div class='Product-container'>
        <img id='Product' src='./Admin/images/$image' width='250px' alt=$name>
            <div class='discription'>
                <p class='rating'><i></i>4.1(115)</p>
                <h3>$name</h3>
                <p class='reff'>$desc</p>
                <h4>$ $price</h4>
                
                <a class='btn' id='Addbtn' href='product_page.php?add_to_cart=$id'>Add to Cart</a>
            </div>
    </div>";
    }

    

    
}

function cart(){

    if(isset($_SESSION['id'])){
        

        if(isset($_GET["add_to_cart"])){
            // echo "Active";
            global $connection;
            $product_id = $_GET["add_to_cart"];
            $user_id = $_SESSION['id'];
           
    
            $select_query = "SELECT * FROM cart WHERE id = $product_id and user_id = '$user_id'";
            $statement = $connection->query( $select_query);
            $row_count = $statement->rowCount();
    
    
        
            if( $row_count > 0){
               
                // echo "<script>alert('Item Already in Cart')</script>";
                echo "<script>window.open('product_page.php', '_self')</script>";
                }else{
    
                    $insert = "INSERT INTO cart (id, user_id, quantity) VALUES ($product_id, '$user_id', 1)";
                    $statement_insert = $connection->query($insert);
                
                        
                        // echo "";
                        echo "<script>window.open('product_page.php', '_self')</script>";
                    
    
                
            } 
            
            
    
        }
    }
    
}

function Cart_count(){
    if(isset($_GET['add_to_cart'])){
            global $connection;

            $UserId = $_SESSION['id'];

            $select_cart_count = "SELECT * FROM cart WHERE user_id = '$UserId'";
            $statement_cart_count = $connection->query( $select_cart_count);
            $row_cart_count = $statement_cart_count->rowCount();
    }else{
            global $connection;

            $UserId = $_SESSION['id'];

            $select_cart_count = "SELECT * FROM cart WHERE user_id = '$UserId'";
            $statement_cart_count = $connection->query( $select_cart_count);
            $row_cart_count = $statement_cart_count->rowCount();
    }
        echo $row_cart_count;
}



function Total_price(){
    global $connection;
    $User_Id = $_SESSION['id'];
    $total_price = 0;

    $cart_query = "SELECT * FROM cart WHERE user_id = '$User_Id' ";
    $result = $connection->query($cart_query);
    
    while($cart_details_row = $result->fetch(PDO::FETCH_ASSOC)){
        $cart_id = $cart_details_row["id"];
        

        $select_products = "SELECT * FROM `products` WHERE id = $cart_id";
        $result_statement = $connection->query($select_products);
        while($product_price_row = $result_statement->fetch(PDO::FETCH_ASSOC)){
            $product_price = array($product_price_row['price']);
            $product_values = array_sum($product_price);
            $total_price+=$product_values;
        }

    }

        echo $total_price; 
}


// function Total_price(){
//     global $connection;
//     $User_Id = $_SESSION['id'];
//     $total_price = 0;

//     $cart_query = "SELECT * FROM cart WHERE user_id = ' $User_Id' ";
//     $result = $connection->query($cart_query);
//     $cart_details_row = $result->fetchAll();
   
//         $cart_id = $cart_details_row["id"];
//         var_dump($cart_id);
    
        
//         $select_products = "SELECT * FROM products WHERE id = $cart_id";
//         $result_statement = $connection->query($select_products);
//        $product_price_row = $result_statement->fetchAll();
//        foreach($product_price_row as $price_row){
//         $product_price = array($price_row['price']);
//         $product_values = array_sum($product_price);
//         $total_price+=$product_values;
//        }
            
        

    

//         echo $total_price; 
// }
?>