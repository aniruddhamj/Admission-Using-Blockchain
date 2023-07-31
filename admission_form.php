<?php 
	session_start();
	require 'constants.php';
	require "blockchain/blockchain.php";
	$jsondata = new Block_chain;

	if(isset($_SESSION['userdata']) && !empty($_SESSION['userdata']))
	{
		$is_edit = 0;
		$get = $_GET;
		if(isset($get['aid']))
		{
			$admission = $jsondata->read_row_data('json/admission.json',$get['aid']);		
			$is_edit = 1;
		}
		$is_form_submitted = $jsondata->is_form_added('json/admission.json',$_SESSION['userdata']->id); 
		if(!$is_form_submitted || $is_edit == 1)
		{

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
				<div class="row">
					<div class="col-md-12">
						<form action="submit_admission.php" method="post" id="admissionForm">
							<input type="hidden" name="action" value="<?php echo isset($admission->id) ? "edit" : "add"; ?>" />
							<input type="hidden" name="id" value="<?php echo isset($admission->id) ? $admission->id : time(); ?>" />

							<div class="tile">
								<h4><small>
									Application Form No: <b><?php echo isset($admission->id) ? $admission->id : time(); ?></b>
									<a style="float: right;">Date : <?php echo date("d M, Y"); ?></small></a>
								</h4>
								<hr>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Student's Name</label>
											<input type="text" class="form-control" id="student_name" name="student_name" placeholder="Enter student's name" value="<?php echo isset($admission->student_name) ? $admission->student_name : $_SESSION['userdata']->name; ?>" required />
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Student's Father Name</label>
											<input type="text" class="form-control" id="student_father_name" name="student_father_name" placeholder="Enter student's father name" value="<?php echo isset($admission->student_father_name) ? $admission->student_father_name : ''; ?>" />
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Student's Mother Name</label>
											<input type="text" class="form-control" id="student_mother_name" name="student_mother_name" placeholder="Enter student's mother name" value="<?php echo isset($admission->student_mother_name) ? $admission->student_mother_name : ''; ?>" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Student's Mobile No.</label>
											<input type="text" class="form-control" id="student_mobile_no" name="student_mobile_no" placeholder="Enter student's mobile no." value="<?php echo isset($admission->student_mobile_no) ? $admission->student_mobile_no : $_SESSION['userdata']->phone; ?>" />
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Student's Father Mobile No.</label>
											<input type="text" class="form-control" id="student_father_mobile_no" name="student_father_mobile_no" placeholder="Enter student's father mobile no." value="<?php echo isset($admission->student_father_mobile_no) ? $admission->student_father_mobile_no : ''; ?>" />
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Student's Mother Mobile No.</label>
											<input type="text" class="form-control" id="student_mother_mobile_no" name="student_mother_mobile_no" placeholder="Enter student's mother mobile no." value="<?php echo isset($admission->student_mother_mobile_no) ? $admission->student_mother_mobile_no : ''; ?>" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label for="exampleInputEmail1">Permanent Address</label>
											<input type="text" class="form-control" id="permanent_address" name="permanent_address" placeholder="Enter permanent address" value="<?php echo isset($admission->permanent_address) ? $admission->permanent_address : ''; ?>" />
										</div>
									</div>
								</div>	
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label for="exampleInputEmail1">Present Address</label>
											<input type="text" class="form-control" id="present_address" name="present_address" placeholder="Enter present address" value="<?php echo isset($admission->present_address) ? $admission->present_address : ''; ?>" />
										</div>
									</div>
								</div>	
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Student's DOB</label>
											<input type="date" class="form-control" id="student_dob" name="student_dob" placeholder="Enter student's dob" value="<?php echo isset($admission->student_dob) ? $admission->student_dob : ''; ?>" max="<?php echo date('Y-m-d'); ?>" />
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Gender</label>
											<select class="form-control" id="gender" name="gender">
												<option value="">Option</option>
												<option value="M" <?php echo isset($admission->gender) && $admission->gender == "M" ? 'selected' : ''; ?>>Male</option>
												<option value="F" <?php echo isset($admission->gender) && $admission->gender == "F" ? 'selected' : ''; ?>>Female</option>
												<option value="O" <?php echo isset($admission->gender) && $admission->gender == "O" ? 'selected' : ''; ?>>Other</option>
											</select>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Religion</label>
											<select class="form-control" id="religion" name="religion">
												<option value="">Option</option>
												<option value="H" <?php echo isset($admission->religion) && $admission->religion == "H" ? 'selected' : ''; ?>>Hindu</option>
												<option value="C" <?php echo isset($admission->religion) && $admission->religion == "C" ? 'selected' : ''; ?>>Christian</option>
												<option value="M" <?php echo isset($admission->religion) && $admission->religion == "M" ? 'selected' : ''; ?>>Muslim</option>
												<option value="O" <?php echo isset($admission->religion) && $admission->religion == "O" ? 'selected' : ''; ?>>Other</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Student's Nationality</label>
											<input type="text" class="form-control" id="student_nationality" name="student_nationality" placeholder="Enter student's nationality" value="<?php echo isset($admission->student_nationality) ? $admission->student_nationality : ''; ?>" />
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Student's Class</label>
											<select class="form-control" id="student_class" name="student_class">
												<option value="">Option</option>
												<?php 
													for($i = 1; $i <= 12; $i ++)
													{
														if(isset($admission->student_class) && $admission->student_class == $i)
														{
															echo '<option value="'.$i.'" selected>Class '.$i.'</option>';
														} else {
															echo '<option value="'.$i.'">Class '.$i.'</option>';
														}
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="exampleInputEmail1">Application No.</label>
											<input type="text" class="form-control" id="student_id" name="student_id" value="<?php echo isset($admission->id) ? $admission->id : time(); ?>" disabled />
										</div>
									</div>
								</div>						
								<div class="tile-footer">
									<button class="btn btn-warning" type="submit">Save</button>
					            </div>
							</div>
						</form>
					</div>
				</div>
			</main>
<?php
		} else {
			header("Location: dashboard.php");
		}
		require "include/footer.php";
	} else {
		header("Location: login.php");
	}