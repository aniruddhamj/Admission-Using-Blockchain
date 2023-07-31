<?php 
	session_start();

	require "blockchain/blockchain.php";
	$jsondata = new Block_chain;

	$get = $_GET;
	if(isset($get['aid']) && $get['aid'] != "")
	{
		$admission = $jsondata->read_data('json/admission.json');
		if(isset($get['payment']) && $get['payment'] == 'received')
		{
			if($admission)
			{
			    $created_by = 0;
				foreach($admission as $key => $val)
				{
					if($val->id == $get['aid'])
					{
					    $created_by = $val->created_by;
						$val->final_verification = 1;
						$val->updated_by = $_SESSION['userdata']->id;
						$val->updated_at = date('Y-m-d H:i:s');
					}
				}
				$userdata = $jsondata->read_row_data('json/user.json',$created_by);
                $to = $userdata->email;
                $subject = "Admission - Final Verification";
             
                $message = "<h1>Your final verification is done.</h1>";
                $message .= "<p>Please check updates on our site. <a href='https://tegaitsolutions.com/projects/admission/index.php'>Click here</a></p>";
             
                $header = "From:admission@gmail.com \r\n";
                $header .= "Cc:admission@gmail.com \r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";
             
                $retval = mail($to,$subject,$message,$header);
				$jsondata->update_data('json/admission.json',$admission);
			}
		} else if(isset($get['payment']) && $get['payment'] != 'received') {
			if($admission)
			{
			    $created_by = 0;
				foreach($admission as $key => $val)
				{
					if($val->id == $get['aid'])
					{
					    $created_by = $val->created_by;
						$val->payment_verification = 1;
						$val->updated_by = $_SESSION['userdata']->id;
						$val->updated_at = date('Y-m-d H:i:s');
					}
				}
				$userdata = $jsondata->read_row_data('json/user.json',$created_by);
                $to = $userdata->email;
                $subject = "Admission - Payment Verification";
             
                $message = "<h1>Your payment verification is done.</h1>";
                $message .= "<p>Please check updates on our site. <a href='https://tegaitsolutions.com/projects/admission/index.php'>Click here</a></p>";
             
                $header = "From:admission@gmail.com \r\n";
                $header .= "Cc:admission@gmail.com \r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";
             
                $retval = mail($to,$subject,$message,$header);
				$jsondata->update_data('json/admission.json',$admission);
			}
		} else {
			if($admission)
			{
			    $created_by = 0;
				foreach($admission as $key => $val)
				{
					if($val->id == $get['aid'])
					{
					    $created_by = $val->created_by;
						$val->document_verification = 1;
						$val->updated_by = $_SESSION['userdata']->id;
						$val->updated_at = date('Y-m-d H:i:s');
					}
				}
				$userdata = $jsondata->read_row_data('json/user.json',$created_by);
                $to = $userdata->email;
                $subject = "Admission - Document Verification";
             
                $message = "<h1>Your document verification is done.</h1>";
                $message .= "<p>Please check updates on our site. <a href='https://tegaitsolutions.com/projects/admission/index.php'>Click here</a></p>";
             
                $header = "From:admission@gmail.com \r\n";
                $header .= "Cc:admission@gmail.com \r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";
             
                $retval = mail($to,$subject,$message,$header);
				$jsondata->update_data('json/admission.json',$admission);
			}
		}
	} else {
	    $created_by = 0;
		$post = $_POST;
		$admission = $jsondata->read_data('json/admission.json');
		if($admission)
		{
			foreach($admission as $key => $val)
			{
				if($val->id == $post['id'])
				{
					$val->student_name = $post['student_name'];
					$val->student_father_name = $post['student_father_name'];
					$val->student_mother_name = $post['student_mother_name'];
					$val->student_mobile_no = $post['student_mobile_no'];
					$val->student_father_mobile_no = $post['student_father_mobile_no'];
					$val->student_mother_mobile_no = $post['student_mother_mobile_no'];
					$val->permanent_address = $post['permanent_address'];
					$val->present_address = $post['present_address'];
					$val->student_dob = $post['student_dob'];
					$val->gender = $post['gender'];
					$val->religion = $post['religion'];
					$val->student_nationality = $post['student_nationality'];
					$val->student_class = $post['student_class'];
					$val->basic_verification = 1;
					$val->documents = $val->documents;
					$val->document_verification = $val->document_verification;
					$val->payment_verification = $val->payment_verification;
					$val->final_verification = $val->final_verification;
					$val->created_by = $val->created_by;
					$val->updated_by = $_SESSION['userdata']->id;
					$val->created_at = $val->created_at;
					$val->updated_at = date('Y-m-d H:i:s');
					$created_by = $val->created_by;
				}
			}
			if($created_by != 0)
			{
			    $userdata = $jsondata->read_row_data('json/user.json',$created_by);
                $to = $userdata->email;
                $subject = "Admission - Basic Verification";
             
                $message = "<h1>Your basic verification is done.</h1>";
                $message .= "<p>Please check updates on our site. <a href='https://tegaitsolutions.com/projects/admission/index.php'>Click here</a></p>";
             
                $header = "From:admission@gmail.com \r\n";
                $header .= "Cc:admission@gmail.com \r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";
             
                $retval = mail ($to,$subject,$message,$header);
			}
			$jsondata->update_data('json/admission.json',$admission);
		}
	}
	header("Location: dashboard.php");
