<?php
session_start();
require_once '../../includes/autoload.php';
require_once '../../includes/password.php';

use classes\business\UserManager;
use classes\entity\User;
use classes\business\Validation;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
session_regenerate_id(TRUE);
?>

<?php
$success="";
$formerror="";
$firstName="";
$lastName="";
$email="";
$companyName="";
$city="";
$country="";
$password="";
$error_fname="";
$error_lname="";
$error_passwd="";
$error_email="";
$validate=new Validation();
$validate1=new Validation();
$validate2=new Validation();
$validate3=new Validation();
$validate4=new Validation();





	if(!isset($_POST["submitted"])){
		
		$validate->check_password($password, $error_passwd);
		$validate1->check_fname($firstName, $error_fname);
		$validate2->check_lname($lastName, $error_lname);
		$validate3->check_email($email, $error_email);
		$validate4->check_lname($companyName, $error_lname);

		
		$UM=new UserManager();
		$existuser=$UM->getUserByEmail($_SESSION["email"]);
		$firstName=$existuser->firstName;
		$lastName=$existuser->lastName;
		$email=$existuser->email;
		$companyName=$existuser->companyName;
		$city=$existuser->city;
		$country=$existuser->country;
		$password=$_SESSION["password"]; 
	}else {
	  $firstName=$_POST["firstName"];
	  $lastName=$_POST["lastName"];
	  $email=$_POST["email"];
	  $companyName=$_POST["companyName"];
	  $city=$_POST["city"];
	  $country=$_POST["country"];
	  $password=$_POST["password"];

	  if($firstName!='' && $lastName!='' && $email!='' && $password!=''){
		   $update=true;
		   $UM=new UserManager();
		   if($email!=$_SESSION["email"]){
			   $existuser=$UM->getUserByEmail($email);
			   if(is_null($existuser)==false){
				   $formerror="User Email already in use, unable to update email";
				   $update=false;
			   }
		   }
		   if($update){
			   $existuser=$UM->getUserByEmail($_SESSION["email"]);
			   $existuser->firstName=$firstName;
			   $existuser->lastName=$lastName;
			   $existuser->email=$email;
			 $existuser->companyName=$companyName;
			 $existuser->city=$city;
			 $existuser->country=$country;
			 $hash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 10));
			 $existuser->password=$hash;	
			 //  $existuser->password=$password;
			   $UM->saveUser($existuser);
			   $_SESSION["email"]=$email;
			   $success="Updated Successfully!";
			   
			  // header("Location:../../home.php");
		   }
	  }else{
		  $formerror="Please provide required values";
	  }
	 }
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	  <title>Update Profile</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	 
	</head>
	<body style="background: url('../../images/91134-OIW11W-632.png') no-repeat center center fixed; 
	  -webkit-background-size: cover;
	  -moz-background-size: cover;
	  -o-background-size: cover;
	  background-size: cover;"> <!--<a href="http://www.freepik.com">Designed by Freepik</a>-->
	  
	  <!--Content -->
	<div class="container" style="margin-top: 70px;">
	<div class="row">
		<div class="col-md-3" style="background: whitesmoke; border-radius: 10px;text-align: center;">
			<h3><strong>Welcome <?=$firstName?>!</strong></h3>
			<hr>
			<a href="compose.php" style="font-size: 20px;"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;"></span> New Message</a><br>
			<a href="inbox.php" style="font-size: 20px;"><span class="glyphicon glyphicon-envelope" style="font-size: 20px;"></span> Inbox</a>
			<br>
			<a href="sent.php" style="font-size: 20px;"><span class="glyphicon glyphicon-send" style="font-size: 20px;"></span> Sent </a>

		</div>

		<div class="col-md-1"></div>

		<div class="col-md-8" style="background: rgba(255, 255, 255, 1.0); border-radius: 10px; padding: 20px; margin-bottom: 50px;">

		<div class="row">

			<div class="col-md-1"></div>
		
		<div class="col-md-10 offset-md-1 ">
			<h1 class="text-center"><strong>Update profile</strong></h1>
			<br>
		<form class="form-horizontal" name="myForm" method="post">
				   
		
		<div class="form-group">
		  <label class="control-label col-sm-2" for="firstName">First Name:</label>
		  <div class="col-sm-9 offset-sm-1">
			<input type="text" class="form-control" id="firstName" name="firstName" value="<?=$firstName?>">
		  </div>
		  <br>
		</div>  

		<div class="form-group">
		  <label class="control-label col-sm-2" for="lastName">Last Name:</label>
		  <div class="col-sm-9 offset-sm-1">
			<input type="text" class="form-control" id="lastName" name="lastName" value="<?=$lastName?>">
		  </div>
		  <br> 
		</div> 
		
		<div class="form-group">
		  <label class="control-label col-sm-2" for="email">Email:</label>
		  <div class="col-sm-9 offset-sm-1">
			<input type="email" class="form-control" id="email" name="email" value="<?=$email?>">
		  </div>
		  <br> 
		</div> 
		
		<div class="form-group">
		  <label class="control-label col-sm-2" for="companyName">Company Name:</label>
		  <div class="col-sm-9 offset-sm-1">
			<input type="text" class="form-control" id="companyName" name="companyName" value="<?=$companyName?>">
		  </div>
		  <br>
		<span class="error"><?php echo $error_lname?></span>
		</div> 
		
		<div class="form-group">
		  <label class="control-label col-sm-2" for="country">Country:</label>
		  <div class="col-sm-9 offset-sm-1">
		  <input type="text" class="form-control" id="country" name="country" value="<?=$country?>">
		  </div>
		  <br> 
		</div> 

		<div class="form-group">
		  <label class="control-label col-sm-2" for="city">City:</label>
		  <div class="col-sm-9 offset-sm-1">
			<input type="text" class="form-control" id="city" name="city" value="<?=$city?>">
		  </div>
		  <span class="error"><?php echo $error_lname?></span>
		  <br> 
		</div>
		
		<div class="form-group">
		  <label class="control-label col-sm-2" for="password">Password:</label>
		  <div class="col-sm-9 offset-sm-1">
			<input type="password" class="form-control" id="password" name="password" value="<?=$password?>">
		  </div>
		  <br> 
		</div>
		
		<div class="form-group">
		  <label class="control-label col-sm-2" for="password">Retype Password:</label>
		  <div class="col-sm-9 offset-sm-1">
			<input type="password" class="form-control" id="cpassword" name="cpassword" value="<?=$password?>">
		  </div>
		  <br> 
		</div>
			
		<div class="form-group">
			<div class="col-sm-offset-5 col-sm-7">
			  <input type="submit" name="submitted" value="Save" class="btn btn-info" style="width:120px;">
			</div>
		  </div>

	</form>
		</div>
	 
	</div>
	</div>
	</div>
	</div>
	  
	  </body>
	  </html>
<?php
include '../../includes/footer.php';
?>