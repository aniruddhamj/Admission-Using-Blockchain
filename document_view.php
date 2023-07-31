<?php 
	session_start();

	require 'constants.php';
	require "blockchain/blockchain.php";
	$jsondata = new Block_chain;

	if(isset($_SESSION['userdata']) && !empty($_SESSION['userdata']))
	{
		$get = $_GET;
		if(isset($get['aid']))
		{
			$admission = $jsondata->read_row_data('json/admission.json',$get['aid']);

			require "include/header.php";
?>
			<main class="app-content">
				<div class="app-title">
					<div>
						<h1><i class="fa fa-user"></i> Admission Form</h1>
						<p></p>
					</div>
					<ul class="app-breadcrumb breadcrumb side">
						<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
						<li class="breadcrumb-item">Admission Form</li>
					</ul>
				</div>
				<div class="tile">
					<?php
						$documents = $jsondata->read_data('json/documents.json');
					?>
					<h4>
						<small>Documents</small>
						<?php 
							if($documents && $admission->document_verification == 0)
							{
						?>
								<a href="submit_verification.php?aid=<?php echo $get['aid']; ?>" class="btn btn-warning btn-sm" style="float: right;">Verify Documents</a>
						<?php
							}
						?>
					</h4><hr>
					<div class="table-responsive">
						<table class="table table-default table-bordered">
							<thead>
								<tr>
									<th width="5%">No</th>
									<th width="20%">Document</th>
									<th width="65%">Document Name</th>
									<th width="10%">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									if($documents)
									{
										foreach($documents as $key => $val)
										{
											if($val->admission_id == $get['aid']) {
								?>	
												<tr>
													<td><?php echo $key+1; ?></td>
													<td><img src="assets/uploads/<?php echo $val->document_file; ?>" class="img img-responsive img-thumbnail" style="width: 150px;height: 150px;" /></td>
													<td><?php echo $val->document_name; ?></td>
													<td><a href="assets/uploads/<?php echo $val->document_file; ?>" download>Download</a></td>
												</tr>
								<?php
											}
										}
									} else {
										echo '<tr><td colspan="4">No document uploaded.</td></tr>';
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</main>
<?php
			require "include/footer.php";
		} else {
			header("Location: dashboard.php");	
		}
	} else {
		header("Location: login.php");
	}