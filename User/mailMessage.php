
                                <html>
                                <head>
                                    <meta charset="UTF-8">
    
                                    

                                </head>
                                <body>
                                    <table cellspacing = "20" cellpadding = "10" >
                                    
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Product price</th>
                                                

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        $user_id = $_SESSION['id'];
                                        $cart_price_query ="SELECT * FROM `cart` WHERE user_id ='$user_id' ";
                                        $result_cart_price = $connection->query($cart_price_query);
                                        $count_cart_items = $result_cart_price->rowCount();
                                
                                        while($row_price = $result_cart_price->fetch(PDO::FETCH_ASSOC)){

                                           
                                    
                                            // getting product id and product name
                                            $product_id = $row_price["id"];
                                            $select_product = "SELECT * FROM `products` WHERE id = $product_id ";
                                            $run_price = $connection->query($select_product);

                                            $get_cart = "SELECT * FROM `cart` WHERE id =$product_id";
                                            $result_cart = $connection->query($get_cart);
                                            while($get_item_quantity = $result_cart->fetch(PDO::FETCH_ASSOC)){
                                                $quantity = $get_item_quantity["quantity"];
    
                                                
                                            }
                                            while($row_product_price = $run_price->fetch(PDO::FETCH_ASSOC)){
                                                $product_price = $row_product_price['price'];
                                                $product_name = $row_product_price['name']; 
                                                
                                                echo"<tr>
                                                <td>  $product_name</td>
                                                <td>  $quantity</td>
                                                <td>  $product_price</td>
                                               
                                                </tr>"; 
                                                
                                            }
                                        }
                    
                                        ?>
                                        <tr>
                                        <th>Total Amount  &#8358; <?php echo "$amount";?></th>
                                        </tr>
                                        
                                        </tbody>
                                       
                                    </table>

                                   
                                </body>
                            </html>