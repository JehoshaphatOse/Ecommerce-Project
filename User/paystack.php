<?php
    require "../User/paystack_folder/src/autoload.php";
?>
<?php
    
    if(isset($_POST["pay-btn"])){
        $first_name = $_POST["fname"];
        $last_name = $_POST["lname"];
        $email = $_POST["email"];
        $amount = $_POST["amount"];
        $reff = $_POST["reference"];
        $phone = $_POST["phone"];

        if(empty($first_name) || empty($last_name) || empty($email) || empty($amount)|| empty($reff) ||  empty($phone)){
            echo "<h4 style='color: red; text-align:center;'>All Fields are Required</h4>";
        }else{
           
            $paystack = new Yabacon\Paystack('sk_test_0104aa7a59bf52584764f1e87abdf8c39203bccf');
        
            try{
                $tranx = $paystack->transaction->initialize([
                    'amount'=> $amount *100,       // in kobo
                    'email'=>$email,         // unique to customers
                    'reference'=> $reff, // unique to transactions
                    'callback_url' => 'http://localhost/Ecommerce/User/verify_payment.php',
                ]);
            } catch(\Yabacon\Paystack\Exception\ApiException $e){
                print_r($e->getResponseObject());
                die($e->getMessage());
            }
    
            // store transaction reference so we can query in case user never comes back
            // perhaps due to network issue
            // save_last_transaction_reference($tranx->data->reference);
    
            // redirect to page so User can pay
            header('Location: ' . $tranx->data->authorization_url);
        }
        
        
    }
