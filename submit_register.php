<?php 
	session_start();

	require "blockchain/blockchain.php";

	$post = $_POST;
	$flag = 1;
	
	$jsondata = new Block_chain;
	$response = $jsondata->read_data('json/user.json');
	if($response)
	{
		foreach($response as $key => $val)
		{
			if($val->email == $post['email'])
			{
				$flag = 0;
				break;
			}
		}
	}
	if($flag == 1)
	{
		$postdata['id'] = time();
		$postdata['name'] = $post['name'];
		$postdata['email'] = $post['email'];
		$postdata['phone'] = $post['phone'];
		$postdata['password'] = md5($post['password']);
		$postdata['role'] = "student";
		$postdata['country'] = "";
		$postdata['state'] = "";
		$postdata['city'] = "";
		$postdata['dob'] = "";
		$postdata['address'] = "";
		$postdata['created_at'] = date("Y-m-d H:i:s");
		$postdata['updated_at'] = date("Y-m-d H:i:s");
		$response = $jsondata->add_data('json/user.json',$postdata);

		$_SESSION['userdata'] = $postdata;
		
		$to = $post['email'];
        $subject = "Admission Project";
     
        $message = "<h1>Thank you to register on Admission.</h1>";
        $message .= "<p>To sign in please <a href='https://tegaitsolutions.com/projects/admission/index.php'>Click here</a></p>";
     
        $header = "From:admission@gmail.com \r\n";
        $header .= "Cc:admission@gmail.com \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
     
        $retval = mail ($to,$subject,$message,$header);
		header("Location: index.php");	
	} else {
	    $_SESSION['error'] = "Email is already used";
		header("Location: sign_up.php");	
	}
