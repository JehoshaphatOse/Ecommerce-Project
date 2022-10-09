<?php
 //Import PHPMailer classes into the global namespace
        //These must be at the top of your script, not inside a function
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
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
    echo "<script>alert ('An Error Occured')</script>";

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


        //include required phpmailer files
        require '../User/PHPMailer/src/PHPMailer.php';
        require '../User/PHPMailer/src/SMTP.php';
        require '../User/PHPMailer/src/Exception.php';



        //Load Composer's autoloader
        // require 'vendor/autoload.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                                       //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'fae8a7aa0e22d2';                       //SMTP username
            $mail->Password   = '50683d35117bbd';                        //SMTP password
            $mail->SMTPSecure = 'tls';                                  //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('myecommercestore@gmail.com');
            $mail->addAddress($email);     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Thank You for your purchase..Here is your order details';
            ob_start();
            include './mailMessage.php';
            $msg = ob_get_contents();
            ob_end_clean();
            $mail->Body    = $msg;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }


        $insert_order = "INSERT INTO `orders` (user_id, product_id, total_price, status)
        VALUES ( :user_id,  :product_id, :total_price, :status )";
        $stmt = $connection->prepare($insert_order);
        if($stmt->execute(['user_id' =>$user_id, 'product_id' =>$product_id,'total_price' =>$amount, 'status'=>$status])){
            header("Location: success_page.php?status=Payment_Succesful");
        
            $delete_cart = "DELETE FROM `cart`WHERE user_id = '$user_id'";
            $result_delete = $connection->query($delete_cart);
            
        }else{
            echo "<script>alert ('An Error Occured')</script>";
        }
    }else{
      echo "<script>alert ('An Error Occured')</script>";

      $insert_order = "INSERT INTO `orders` (user_id, product_id, total_price, status)
      VALUES ( :user_id,  :product_id, :total_price, :status )";
      $stmt = $connection->prepare($insert_order);
      $stmt->execute(['user_id' =>$user_id, 'product_id' =>$product_id,'total_price' =>$amount, 'status'=>"Failed"]);
        header("Location: Error_page.php?status=Payment_Error");

        $delete_cart = "DELETE FROM `cart`WHERE user_id = '$user_id'";
        $result_delete = $connection->query($delete_cart);
    }
  

    // deleting items from cart after inserting into orders table

 
?>