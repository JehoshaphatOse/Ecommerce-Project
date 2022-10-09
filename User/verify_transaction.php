<?php
$ref = $_GET["reference"];
if($ref == ""){
    header('Location:javascript://history.go(-1)');
}
?>
<?php
  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($ref),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer sk_test_0104aa7a59bf52584764f1e87abdf8c39203bccf",
      "Cache-Control: no-cache",
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);
  
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    // echo $response;
    $result = json_decode($response);
  }
  if($result->data->status == 'success'){
    $status = $result->data->status;
    $referenceNo = $result->data->reference;
    $amount = $result->data->amount / 100;
    $email =$result->data->customer->email;

    
    session_start();
    include ("../include/connection.php");
    include ("../Functions/functions.php");

   
    $user_id = $_SESSION['id'];
    $cart_price_query ="SELECT * FROM `cart` WHERE user_id ='$user_id' ";
    $result_cart_price = $connection->query($cart_price_query);
    $count_cart_items = $result_cart_price->rowCount();

    while($row_price = $result_cart_price->fetch(PDO::FETCH_ASSOC)){
   
    // getting product id
    $product_id = $row_price["id"];
    }


    $insert_order = "INSERT INTO `orders` (user_id, product_id, total_price, status)
    VALUES ( :user_id,  :product_id, :total_price, :status )";
    $stmt = $connection->prepare($insert_order);
    if($stmt->execute(['user_id' =>$user_id, 'product_id' =>$product_id,'total_price' =>$amount, 'status'=>$status])){
        header("Location: success_page.php?status=Payment_Succesful");
        exit;
    }else{
        echo "<script>alert ('An Error Occured')</script>";
    }
}else{
  $insert_order = "INSERT INTO `orders` (user_id, product_id, total_price, status)
    VALUES ( :user_id,  :product_id, :total_price, :status )";
    $stmt = $connection->prepare($insert_order);
    if($stmt->execute(['user_id' =>$user_id, 'product_id' =>$product_id,'total_price' =>$amount, 'status'=>"Failed"])){
        header("Location: Error_page.php?status=Payment_Succesful");
    
    exit;
}
?>