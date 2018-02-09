<?php
session_start();
use classes\business\UserManager;
use classes\business\Validation;

require_once 'includes/autoload.php';
require_once 'includes/password.php';
include 'includes/header.php';
session_regenerate_id(TRUE);
$formerror="";

$role="";
$account="";
$email="";
$password="";
$error_auth="";
//$error_name="";
$error_passwd="";
$error_email="";
//$noaccess="";
$validate=new Validation();
$validate1=new Validation();

	
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Access Denied</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
.error{color:red;}
}
</style>
</head>
<body style="background: url('images/91134-OIW11W-632.png') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;"> <!--<a href="http://www.freepik.com">Designed by Freepik</a>-->
    <div class="container-fluid">
        
  <!--Content -->
  <div class="row" style="margin-top: 100px;">
      <div class="col-md-3"></div>
      
      <div class="col-md-6" style="text-align: center; background: rgba(255, 255, 255, 1.0); border-radius: 10px; padding: 20px; box-shadow: 10px 10px 5px black;">

<h1 class="error">Your account has been deactivated. <br>Please contact the administrator.</h1>

   <div class="form-group">        
      <div class="col-sm-12"> 
		<a href="login.php" class="btn btn-primary btn-md"  style="width: 120px; margin: 20px;">Login</a>
		<a href="contactus.php" class="btn btn-warning btn-md"  style="width: 120px; margin: 20px;">Contact</a>
		</div>
    </div>
      </div>

      <div class="col-md-3" style="margin: 170px;"></div>
      
  </div>
  
    </div>
	</body>
	</html>	   



<?php
include 'includes/footer.php';
?>