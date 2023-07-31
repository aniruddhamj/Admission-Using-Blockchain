<?php
    require "blockchain/blockchain.php";
    require "razorpay/Razorpay.php";
    use Razorpay\Api\Api;
    
    $amount = 500;
    $apikeysecret = new Api("rzp_test_CADdKRwhRNwSbu","vVSf5d6EoL5OQIVI7VcVwIwe");
    $order   = $apikeysecret->order->create(array("amount" => (float) $amount*100,"currency" => "INR","receipt"  => "rcptid_".''.rand(10000,99999)));
    $orderId = $order['id'];
    $apiKey  = "rzp_test_CADdKRwhRNwSbu";
    
    $postdata['id'] = time();
	$postdata['admission_id'] = $_GET["aid"];
	$postdata['payment_status'] = "0";
	$postdata['payment_order_id'] = $orderId;
	$postdata['created_at'] = date("Y-m-d H:i:s");
	$postdata['updated_at'] = date("Y-m-d H:i:s");
	$jsondata = new Block_chain;
	$response = $jsondata->add_data('json/payment.json',$postdata);
?>
<button id="rzp-button" hidden>Pay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript">
    var callback_url = "https://tegaitsolutions.com/projects/admission/paymentResponse.php";
    var apiKey       = "<?php echo $apiKey; ?>";
    var orderId      = "<?php echo $orderId; ?>";
    var amount       = "<?php echo $amount; ?>";
    var cust_name    = "";
    var cust_mail    = "";
    var cust_phon    = "";
    var site_name    = "Admission";

    var options = { 
        "key": apiKey, "amount": amount, "name": site_name, "order_id": orderId, "callback_url": callback_url,
        "prefill": { "name": cust_name, "email": cust_mail, "contact": cust_phon }
    };
    var rzp = new Razorpay(options);
    document.getElementById('rzp-button').onclick = function(e){
        rzp.open();
        e.preventDefault(); 
    }
    document.getElementById("rzp-button").click();
</script>