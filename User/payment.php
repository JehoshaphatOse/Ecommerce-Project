<?php
session_start();
include ("../include/connection.php");
include ("../Functions/functions.php");


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Gateway</title>
</head>
<style>
img{
    width: 500px;
}

.container{
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 60px;
    margin-bottom: 50px;


}
.pay-btn{
    padding: 0 100px;
    font-size: 25px;
    font-weight: bold;
    color: orange;
}
a{
    text-decoration: none;
}
.payment-header{
    text-align: center;
    color: rgb(42, 42, 146);
    margin-top: 6em;
}


</style>


<body>

<?php
$user_id = $_SESSION['id'];
// print_r($user_id);


?>



   

    <div>
        <h2 class = "payment-header">Payment Options</h2>
    </div>
    <div class = "container">
    <a href="https://www.paypal.com"><img src="../Admin/images/payment.png" alt=""></a>
    <a href="Customer_form.php?userid=<?php echo $user_id?>"><p class = "pay-btn">Pay Now</p></a>


    </div>
</body>
</html>



