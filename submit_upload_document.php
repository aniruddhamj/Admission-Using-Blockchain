<?php 
	session_start();

	require "blockchain/blockchain.php";

	$post = $_POST;

	$jsondata = new Block_chain;
	$upload_dir = 'assets/uploads/'.basename($_FILES["document_file"]["name"]);

	$postdata['id'] = time();
	$postdata['admission_id'] = $post['id'];
	$postdata['document_name'] = $post['document_name'];
	$postdata['document_file'] = $_FILES['document_file']['name'];
	$postdata['document_addedBy'] = $_SESSION['userdata']->id;
	move_uploaded_file($_FILES["document_file"]["tmp_name"], $upload_dir);
	$jsondata->add_data('json/documents.json',$postdata);

	header("Location: upload_document.php?aid=".$post['id']);
