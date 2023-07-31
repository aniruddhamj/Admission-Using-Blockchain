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
					<div class="row">
						<div class="col-md-12">
							<form action="submit_upload_document.php" method="post" id="documentForm" enctype="multipart/form-data">
								<input type="hidden" name="id" value="<?php echo isset($admission->id) ? $admission->id : time(); ?>" />
								<input type="hidden" name="role" value="<?php echo $_SESSION['userdata']->role; ?>" />
								<h4>
									<small>Documents<a style="float: right;">Date : <?php echo date("d M, Y"); ?></small></a>
								</h4>
								<hr>
								<div class="row">
									<div class="col-lg-5">
										<div class="form-group">
											<label for="exampleInputEmail1">Document Name</label>
											<input type="text" class="form-control" id="document_name" name="document_name" placeholder="Enter document name" value="" required />
										</div>
									</div>
									<div class="col-lg-5">
										<div class="form-group">
											<label for="exampleInputEmail1">Document File</label>
											<input type="file" class="form-control" id="document_file" name="document_file" required />
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<label for="exampleInputEmail1">.</label><br>
											<button class="btn btn-warning" type="submit">Upload</button>
										</div>
									</div>
								</div>					
							</div>
						</form>
					</div>
				</div>

				<div class="tile">
					<?php
						$documents = $jsondata->read_data('json/documents.json');
					?>
					<div class="table-responsive">
						<table class="table table-default table-bordered">
							<thead>
								<tr>
									<th width="5%">No</th>
									<th width="85%">Document Name</th>
									<th width="10%">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								    $is_uploaded = 0;
									if($documents)
									{
									    $no = 0;
										foreach($documents as $key => $val)
										{
										    if($val->document_addedBy == $_SESSION['userdata']->id) {
										        $is_uploaded = 1;
										        $no++;
								?>	
    											<tr>
    												<td><?php echo $no; ?></td>
    												<td><?php echo $val->document_name; ?></td>
    												<td><a href="assets/uploads/<?php echo $val->document_file; ?>" download>Download</a></td>
    											</tr>
								<?php
										    }
										}
										if($is_uploaded == 0)
										{
										    echo "<tr><td colspan='3'>No document uploaded yet.</td></tr>";
										}
									} else {
                                        echo "<tr><td colspan='3'>No document uploaded yet.</td></tr>";
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