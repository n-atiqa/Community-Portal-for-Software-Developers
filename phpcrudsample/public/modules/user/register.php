<?php
require_once '../../includes/autoload.php';
require_once '../../includes/password.php';
include '../../includes/header.php';

use classes\util\DBUtil;
use classes\business\UserManager;
use classes\entity\User;
use classes\business\Validation;
session_regenerate_id(TRUE);

$formerror="";
$firstName="";
$lastName="";
$email="";
$password="";
$error_fname="";
$error_lname="";
$error_passwd="";
$error_email="";
$validate=new Validation();
$validate1=new Validation();
$validate2=new Validation();
$validate3=new Validation();


	if(isset($_REQUEST["submitted"])){
		$firstName=$_REQUEST["firstName"];
		$lastName=$_REQUEST["lastName"];
		$email=$_REQUEST["email"];
		$password=$_REQUEST["password"];
		
		$validate->check_password($password, $error_passwd);
		$validate1->check_fname($firstName, $error_fname);
		$validate2->check_lname($lastName, $error_lname);
		$validate3->check_email($email, $error_email);


		if($error_fname == "" && $error_lname == "" && $error_passwd == "" && $error_email == "" ){
			
			$UM=new UserManager();
			$user=new User();
			$user->firstName=$firstName;
			$user->lastName=$lastName;
			$user->email=$email;
			$hash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 10));
			$user->password=$hash;		
			$user->role="user";
            $user->account="active"; //added this
			$existuser=$UM->getUserByEmail($email);	
				
			if(!isset($existuser)){
				// Save the Data to Database
				$UM->saveUser($user);
				#header("Location:registerthankyou.php");
				session_start();
				//Set session variables
				$_SESSION["firstName"]=$firstName;
				//print_r($user);
				echo '<meta http-equiv="Refresh" content="1; url=./registerthankyou.php">';
			}
			else{
				$formerror="User Already Exist";
			}
		}else{
			$formerror="Please fill in all fields";
		}
	}

?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	  <title>Registration</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
	  .error{color:red;}
	#passstrength {
		color:red;
		font-family:verdana;
		font-size:10px;
		font-weight:bold;
	}
	</style>
	</head>


	<body style="background: url('../../images/91134-OIW11W-632.png') no-repeat center center fixed; 
	  -webkit-background-size: cover;
	  -moz-background-size: cover;
	  -o-background-size: cover;
	  background-size: cover;"> <!--<a href="http://www.freepik.com">Designed by Freepik</a>-->
		<div class="container-fluid">
		<span class="error"><?php echo $formerror?></span><br>
	  <!--Content -->
	  <div class="row" style="margin-top: 50px;">
		  <div class="col-md-3"></div>
		  
		  <div class="col-md-6" style="text-align: center; background: rgba(255, 255, 255, 1.0); border-radius: 10px; padding-bottom: 10px; box-shadow: 10px 10px 5px black;">
			  <h2><strong>Create Account</strong></h2>
			  <strong><span class="glyphicon glyphicon-asterisk" style="color: red;"></span>All Fields Required</strong>
			  <br>
			  <br>
			  <form name="myForm" onsubmit="return validateForm()" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				  
		<div class="form-group">
		  <label class="control-label col-sm-2" for="firstName">First Name:</label>
		  <div class="col-sm-9 offset-sm-1">
			  <input type="text" class="form-control" id="firstName" placeholder="Your first name; example 'Sam'" name="firstName" value="<?=$firstName?>" required>
		<span class="error"><?php echo $error_fname?></span>  
		  </div>
		  <br>
		</div>         
				  
		<div class="form-group">
		  <label class="control-label col-sm-2" for="lastName">Last Name:</label>
		  <div class="col-sm-9 offset-sm-1">
			<input type="text" class="form-control" id="lastName" placeholder="Your last name; example 'Smith'" name="lastName" value="<?=$lastName?>" required>
		<span class="error"><?php echo $error_lname?></span>
		  </div>
		  <br>
		</div>  

		<div class="form-group">
		  <label class="control-label col-sm-2" for="email">Email:</label>
		  <div class="col-sm-9 offset-sm-1">
			<input type="email" class="form-control" id="email" placeholder="Your email address" name="email" value="<?=$email?>" required>
		<span class="error"><?php echo $error_email?></span>
		  </div>
		  <br>
		</div>
				  
		<div class="form-group">
		  <label class="control-label col-sm-2" for="password">Password:</label>
		  <div class="col-sm-9 offset-sm-1">          
			<input type="password" class="form-control" id="password" placeholder="Create password for this account" name="password" value="<?=$password?>" pattern=".{6,}" required title="6 characters minimum">
		<span id="passstrength"></span>
		<span class="error"><?php echo $error_passwd?></span><br>	
		  </div>
		  <br>
		</div>
				  
		<div class="form-group">
		  <label class="control-label col-sm-2" for="cpassword">Confirm Password:</label>
		  <div class="col-sm-9 offset-sm-1">          
			<input type="password" class="form-control" id="confirm_password" placeholder="Retype password" name="cpassword"  value="<?=$password?>" pattern=".{6,}" required title="6 characters minimum">
		  </div>
		  <br>
		</div>    

	   <div class="form-group">        
		  <div class="col-sm-12"> 
			<input type="reset" name="reset" value="Reset" class="btn btn-basic btn-md" style="width: 120px; margin: 20px;">
			<input type="submit" name="submitted" value="Register" class="btn btn-success btn-md" style="width: 120px; margin: 20px;">
			</div>
		</div>

	  </form>
			  
			  
		  </div>

		  <div class="col-md-3" style="margin: 67px;"></div>
		  
	  </div>
	  
		</div>
	</body>
	</html>
<script type="text/javascript">
var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

$('#password').keyup(function(e) {
     var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
     var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
     var enoughRegex = new RegExp("(?=.{6,}).*", "g");
     if (false == enoughRegex.test($(this).val())) {
             $('#passstrength').html('More Characters');
     } else if (strongRegex.test($(this).val())) {
             $('#passstrength').className = 'ok';
             $('#passstrength').html('Strong!');
     } else if (mediumRegex.test($(this).val())) {
             $('#passstrength').className = 'alert';
             $('#passstrength').html('Medium!');
     } else {
             $('#passstrength').className = 'error';
             $('#passstrength').html('Weak!');
     }
     return true;
});
</script>


<?php
include '../../includes/footer.php';
?>