
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
      alert('Window closed.');
    },
    callback: function(response){
      let message = 'Payment Successful! Reference: ' + response.reference;
      alert(message);
     window.location.href='success_page.php?Payment Succesfful';
    }
  });

  handler.openIframe();
}
</script>
</body>
</html>