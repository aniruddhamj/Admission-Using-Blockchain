<?php 
	session_start();

	require "blockchain/blockchain.php";

	$post = $_POST;
	$flag = 1;

	$jsondata = new Block_chain;
	$response = $jsondata->read_data('json/user.json');
	if($response)
	{
		$found = 0;
		foreach($response as $key => $val)
		{
			if($val->phone == $post['username'] && $val->password == md5($post['password']))
			{
				$found = 1;
				$_SESSION['userdata'] = $val;
				break;			
			}
		}
		if($found == 1)
		{
			header('Location: dashboard.php');
		} else {
			$_SESSION['error'] = "Mobile no. or password is wrong.";
			header('Location: index.php');
		}
	}
