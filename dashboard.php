<?php 
	session_start();
	require "constants.php";
	require "blockchain/blockchain.php";
	
	$jsondata = new Block_chain;
	if(isset($_SESSION['userdata']) && !empty($_SESSION['userdata']))
	{
		require "include/header.php";

		$admission = $jsondata->is_form_added('json/admission.json',$_SESSION['userdata']->id);
		
		$is_payment_done = 0;
		$payments = $jsondata->read_data('json/payment.json');
        if($payments)
        {
            foreach($payments as $payment)
            {
                if(isset($admission->id) && $payment->admission_id == $admission->id && $payment->payment_status == 1)
                    $is_payment_done = 1;
            }
        }
		if($admission)
		{
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
					<div class="table-responsive">
						<table class="table table-default table-bordered">
							<thead>
								<tr>
									<th>Application No</th>
									<th>Name</th>
									<th>Basic Verification</th>
									<th>Documents Verification</th>
									<th>Payment Verification</th>
									<th>Final Verification</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><b><?php echo $admission->id; ?></b></td>
									<td><?php echo ucwords($admission->student_name); ?></td>
									<td align="center">
										<?php 
											if($admission->basic_verification == 0)
											{
												echo '<span class="text-danger"><i class="fa fa-remove"></i></span>';
											} else {
												echo '<span class="text-success"><i class="fa fa-check"></i></span>';
											}
										?>
									</td>
									<td align="center">
										<?php 
											if($admission->document_verification == 0)
											{
												echo '<span class="text-danger"><i class="fa fa-remove"></i></span>';
											} else {
												echo '<span class="text-success"><i class="fa fa-check"></i></span>';
											}
										?>
									</td>
									<td align="center">
										<?php 
											if($admission->payment_verification == 0)
											{
												echo '<span class="text-danger"><i class="fa fa-remove"></i></span>';
											} else {
												echo '<span class="text-success"><i class="fa fa-check"></i></span>';
											}
										?>
									</td>
									<td align="center">
										<?php 
											if($admission->final_verification == 0)
											{
												echo '<span class="text-danger"><i class="fa fa-remove"></i></span>';
											} else {
												echo '<span class="text-success"><i class="fa fa-check"></i></span>';
											}
										?>
									</td>
									<td align="center">
										<?php 
											if($admission->basic_verification == 0)
											{
										?>
												<a href="admission_form.php?aid=<?php echo $admission->id; ?>">Edit</a>
										<?php
											} else if($admission->basic_verification == 1 && $admission->document_verification == 0 && $admission->payment_verification == 0 && $admission->final_verification == 0) {
										?>
												<a href="upload_document.php?aid=<?php echo $admission->id; ?>">Upload Documents</a>	
										<?php
											} else if($admission->basic_verification == 1 && $admission->document_verification == 1 && $admission->payment_verification == 0 && $admission->final_verification == 0) {
										        if($is_payment_done == 0)
										            echo '<a href="payment.php?aid='.$admission->id.'">Do Payment</a>';
										        else 
										            echo '<a href="javascript:;">Payment Done</a>';
											} else {
												echo '-';
											}
										?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</main>
<?php
		} else if(in_array($_SESSION['userdata']->role,array('admin1','admin2','admin3','admin4'))) {
			$forms = $jsondata->read_data('json/admission.json');
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
					<div class="table-responsive">
						<table class="table table-default table-bordered">
							<thead>
								<tr>
									<th>Application No</th>
									<th>Name</th>
									<th>Basic Verification</th>
									<th>Documents Verification</th>
									<th>Payment Verification</th>
									<th>Final Verification</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									if($forms)
									{
									    $payments = $jsondata->read_data('json/payment.json');
										foreach($forms as $form)
										{
										    $is_payment_done = 0;
                                            if($payments)
                                            {
                                                foreach($payments as $payment)
                                                {
                                                    if($payment->admission_id == $form->id && $payment->payment_status == 1)
                                                        $is_payment_done = 1;
                                                }
                                            }
                                        
											$basic_verification = $form->basic_verification;
											$document_verification = $form->document_verification;
											$payment_verification = $form->payment_verification;
											$final_verification = $form->final_verification;
											if($_SESSION['userdata']->role == 'admin1') {
								?>
												<tr>
													<td><b><?php echo $form->id; ?></b></td>
													<td><?php echo ucwords($form->student_name); ?></td>
													<td align="center">
														<?php 
															if($basic_verification == 0)
															{
																echo '<span class="text-danger"><i class="fa fa-remove"></i></span>';
															} else {
																echo '<span class="text-success"><i class="fa fa-check"></i></span>';
															}
														?>
													</td>
													<td align="center">
														<?php 
															if($document_verification == 0)
															{
																echo '<span class="text-danger"><i class="fa fa-remove"></i></span>';
															}
														?>
													</td>
													<td align="center">
														<?php 
															if($payment_verification == 0)
															{
																echo '<span class="text-danger"><i class="fa fa-remove"></i></span>';
															}
														?>
													</td>
													<td align="center">
														<?php 
															if($final_verification == 0)
															{
																echo '<span class="text-danger"><i class="fa fa-remove"></i></span>';
															}
														?>
													</td>
													<td align="center">
														<a href="admission_form_view.php?aid=<?php echo $form->id; ?>">View</a>
													</td>
												</tr>
								<?php
											} else if($_SESSION['userdata']->role == 'admin2') {
								?>
												<tr>
													<td><b><?php echo $form->id; ?></b></td>
													<td><?php echo ucwords($form->student_name); ?></td>
													<td align="center">
														<?php 
															if($basic_verification == 0)
															{
																echo '<span class="text-danger"><i class="fa fa-remove"></i></span>';
															} else {
																echo '<span class="text-success"><i class="fa fa-check"></i></span>';
															}
														?>
													</td>
													<td align="center">
														<?php 
															if($document_verification == 0)
															{
																echo '<span class="text-danger"><i class="fa fa-remove"></i></span>';
															} else {
																echo '<span class="text-success"><i class="fa fa-check"></i></span>';
															}
														?>
													</td>
													<td align="center">
														<?php 
															if($payment_verification == 0)
															{
																echo '<span class="text-danger"><i class="fa fa-remove"></i></span>';
															}
														?>
													</td>
													<td align="center">
														<?php 
															if($final_verification == 0)
															{
																echo '<span class="text-danger"><i class="fa fa-remove"></i></span>';
															}
														?>
													</td>
													<td align="center">
														<a href="document_view.php?aid=<?php echo $form->id; ?>">View</a>
													</td>
												</tr>
								<?php
											} else if($_SESSION['userdata']->role == 'admin3') {
								?>
												<tr>
													<td><b><?php echo $form->id; ?></b></td>
													<td><?php echo ucwords($form->student_name); ?></td>
													<td align="center">
														<?php 
															if($basic_verification == 0)
															{
																echo '<span class="text-danger"><i class="fa fa-remove"></i></span>';
															} else {
																echo '<span class="text-success"><i class="fa fa-check"></i></span>';
															}
														?>
													</td>
													<td align="center">
														<?php 
															if($document_verification == 0)
															{
																echo '<span class="text-danger"><i class="fa fa-remove"></i></span>';
															} else {
																echo '<span class="text-success"><i class="fa fa-check"></i></span>';
															}
														?>
													</td>
													<td align="center">
														<?php 
															if($payment_verification == 0)
															{
																echo '<span class="text-danger"><i class="fa fa-remove"></i></span>';
															} else {
																echo '<span class="text-success"><i class="fa fa-check"></i></span>';
															}
														?>
													</td>
													<td align="center">
														<?php 
															if($final_verification == 0)
															{
																echo '<span class="text-danger"><i class="fa fa-remove"></i></span>';
															} else {
																echo '<span class="text-success"><i class="fa fa-check"></i></span>';
															}
														?>
													</td>
													<td align="center">
														<?php 
															if($payment_verification == 0)
															{
															    if($is_payment_done == 0)
															    {
															        echo '<p class="badge badge-warning badge-lg">Payment Pending</p>';
															    } else {
														?>
														            <a href="submit_verification.php?aid=<?php echo $form->id; ?>&payment=verify" class="badge badge-info badge-lg">Payment Verify</a>
														<?php
															    }
															} else {
														?>
																<a href="javascript:;" class="badge badge-success badge-lg">Payment Verified</a>
														<?php
															}
														?>
													</td>
												</tr>
								<?php
											} else if($_SESSION['userdata']->role == 'admin4' && $basic_verification == 1 && $document_verification == 1 && $payment_verification == 1) {
								?>
												<tr>
													<td><b><?php echo $form->id; ?></b></td>
													<td><?php echo ucwords($form->student_name); ?></td>
													<td align="center">
														<?php 
															if($basic_verification == 0)
															{
																echo '<span class="text-danger"><i class="fa fa-remove"></i></span>';
															} else {
																echo '<span class="text-success"><i class="fa fa-check"></i></span>';
															}
														?>
													</td>
													<td align="center">
														<?php 
															if($document_verification == 0)
															{
																echo '<span class="text-danger"><i class="fa fa-remove"></i></span>';
															} else {
																echo '<span class="text-success"><i class="fa fa-check"></i></span>';
															}
														?>
													</td>
													<td align="center">
														<?php 
															if($payment_verification == 0)
															{
																echo '<span class="text-danger"><i class="fa fa-remove"></i></span>';
															} else {
																echo '<span class="text-success"><i class="fa fa-check"></i></span>';
															}
														?>
													</td>
													<td align="center">
														<?php 
															if($final_verification == 0)
															{
																echo '<span class="text-danger"><i class="fa fa-remove"></i></span>';
															} else {
																echo '<span class="text-success"><i class="fa fa-check"></i></span>';
															}
														?>
													</td>
													<td align="center">
														<a href="student_view.php?aid=<?php echo $form->id; ?>">View</a>
													</td>
												</tr>
								<?php
											}
										}
									} else {
										echo '<tr><td colspan="7">No data found</td></tr>';
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</main>
<?php
		} else {
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
					<p class="alert alert-warning">You do not submit admission form. Please <a href="admission_form.php">click here</a> to fill your form.</p>
				</div>
			</main>
<?php		
		}
		require "include/footer.php";
	} else 
		header("Location: index.php");