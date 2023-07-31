<?php 
	session_start();

	require "blockchain/blockchain.php";

	$jsondata = new Block_chain;

	$post = $_POST;

	if($post['action'] == "add")
	{
		$post['basic_verification'] = 0;
		$post['documents'] = array();
		$post['document_verification'] = 0;
		$post['payment_verification'] = 0;
		$post['final_verification'] = 0;
		$post['created_by'] = $_SESSION['userdata']->id;
		$post['updated_by'] = $_SESSION['userdata']->id;
		$post['final_verification'] = 0;
		$post['created_at'] = date("Y-m-d H:i:s");
		$post['updated_at'] = date("Y-m-d H:i:s");
		unset($post['action']);
		$jsondata->add_data('json/admission.json',$post);
	} else {
		unset($post['action']);
		$admission = $jsondata->read_data('json/admission.json');
		if($admission)
		{
			$flag = 1;
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
					$val->basic_verification = $val->basic_verification;
					$val->documents = $val->documents;
					$val->document_verification = $val->document_verification;
					$val->payment_verification = $val->payment_verification;
					$val->final_verification = $val->final_verification;
					$val->created_by = $val->created_by;
					$val->updated_by = $_SESSION['userdata']->id;
					$val->created_at = $val->created_at;
					$val->updated_at = date('Y-m-d H:i:s');
				}
			}
			$jsondata->update_data('json/admission.json',$admission);
		}
	}
	header("Location: dashboard.php");
