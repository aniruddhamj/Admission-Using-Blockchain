<!DOCTYPE html>
<?php 
    session_start();
    require 'constants.php';
?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="assets/images/logo/favicon-icon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon-icon.png" type="image/x-icon">
    <title><?php echo APP_NAME; ?></title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link id="color" rel="stylesheet" href="assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@300&display=swap" rel="stylesheet">
	<style>
		body {
			font-family: 'Readex Pro', sans-serif;
		}
	</style>
  </head>
  <body>
    <!-- login page start-->
    <section>         </section>
    <div class="container-fluid p-0">
      <div class="row">
        <div class="col-12">
          <div class="login-card">
            <form class="theme-form login-form" method="post" action="submit_register.php">
              <h4><?php echo APP_NAME; ?></h4>
              <h6>Make your account here.</h6>
              <div class="form-group">
                <label>Name*</label>
                <div class="input-group">
                  <input class="form-control" type="text" name="name" id="name" placeholder="Your name..." required />
                </div>
              </div>
              <div class="form-group">
                <label>Mobile No.*</label>
                <div class="input-group">
                  <input class="form-control" type="number" name="phone" id="phone" placeholder="Your mobile no..." required />
                </div>
              </div>
              <div class="form-group">
                <label>Email</label>
                <div class="input-group">
                  <input class="form-control" type="email" name="email" id="email" placeholder="Your email..." />
                </div>
              </div>
              <div class="form-group">
                <label>Password*</label>
                <div class="input-group">
                  <input class="form-control" type="password" name="password" id="password" placeholder="Your password..." required />
                </div>
              </div>
              <div class="form-group">
                
              </div>
              <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Sign Up</button>
              </div>
              <p>Already have account?<a class="ms-2" href="index.php">Sign In</a></p>
              <?php 
                  if(isset($_SESSION['error']))
                  {
                    echo "<div class='form-group'><p class='alert alert-danger'>".$_SESSION['error']."</p></div>";
                    unset($_SESSION['error']);
                  }
                ?>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- latest jquery-->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <!-- Sidebar jquery-->
    <script src="assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
    <!-- login js-->
    <!-- Plugin used-->
  </body>

<!-- Mirrored from admin.pixelstrap.com/zeta/theme/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 03 Dec 2022 18:13:26 GMT -->
</html>