<?php 
    require "blockchain/blockchain.php";
    
    $jsondata = new Block_chain;
    $payments = $jsondata->read_data('json/payment.json');
    
    if($payments)
	{
		$flag = 1;
		foreach($payments as $key => $val)
		{
			if($val->payment_order_id == $_POST['razorpay_order_id'])
			{
				$val->payment_status = 1;
				$val->updated_at = date('Y-m-d H:i:s');
			}
		}
		$jsondata->update_data('json/payment.json',$payments);
	}
	header("Location: dashboard.php");
?>