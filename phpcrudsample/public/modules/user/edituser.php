<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
session_regenerate_id(TRUE);
?>

<?php

$formerror="";
$firstName="";
$lastName="";
$companyName="";
$city="";
$country="";
$email="";
$password="";
$account="";
$role="";
$id="";

	if(isset($_GET["id"])){
	  $UM=new UserManager();
	  $existuser=$UM->getUserById($_GET["id"]);
	  $firstName=$existuser->firstName;
	  $lastName=$existuser->lastName;
	  $email=$existuser->email;
	  $companyName=$existuser->companyName;
	  $country=$existuser->country;
	  $city=$existuser->city;
	  $role=$existuser->role;
	  //print_r($existuser);
	}
	
	if(isset($_POST["submitted"])){   
	echo $_POST['role'];
	$id = $_GET["id"];
	$role=$_POST['role'];
	 $UM=new UserManager();
    $existuser=$UM->updateuser($id,$role);
          header("Location:../../modules/user/userlist.php");
    }else{ 
      $formerror="Please provide required values";
	  
     }
	

?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	  <title>Edit User</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	 
	</head>
	<body style="background: url('../../images/OLENCD0.png') no-repeat center center fixed; 
	  -webkit-background-size: cover;
	  -moz-background-size: cover;
	  -o-background-size: cover;
	  background-size: cover;"> <!-- Credit to the author<a href="http://www.freepik.com">Designed by Graphiqastock / Freepik</a> -->

		<div class="container">
		<div class="row">
				<div class="col-md-11"></div>
				<div class="col-md-1" style="background: whitesmoke; border-radius: 10px;">
			<h4><a href="userlist.php""><strong><span class="glyphicon glyphicon-arrow-left"></span> Back</strong></a></h4>
				</div>
		</div>
		</div>

	<!--Content -->
	<div class="container" style="margin-top: 70px;">
		<div class="row">			
		<div class="col-md-3"></div>

		<div class="col-md-6" style="background: rgba(255, 255, 255, 1.0); border-radius: 10px; padding: 20px; margin-bottom: 100px;">
			<h1 class="text-center"><strong><span class="glyphicon glyphicon-user" style="font-size: 40px;"></span> Edit <?=$firstName?> <?=$lastName?></strong></h1>
			<hr>
		   <form class="form-horizontal" name="editUser" method="post">
			   <div class="form-group">
		  <label class="control-label col-sm-6" for="firstname">First Name:</label>
		  <div class="col-sm-6">
			  <p style="font-size: 20px;"><?=$firstName?></p></div>

		</div>  
		
		<div class="form-group">
		  <label class="control-label col-sm-6" for="l_name">Last Name:</label>
		  <div class="col-sm-6">
			  <p style="font-size: 20px;"><?=$lastName?></p></div>
		</div>
			
		<div class="form-group">
		  <label class="control-label col-sm-6" for="email">Email:</label>
		  <div class="col-sm-6">
			  <p style="font-size: 20px;"><?=$email?></p>
		  </div>

		</div>
			   
				   
		<div class="form-group">
		  <label class="control-label col-sm-6" for="companyName">Company Name:</label>
		  <div class="col-sm-6">
			  <p style="font-size: 20px;"><?=$companyName?></p>
		  </div>
		</div>
			 
		<div class="form-group">
		  <label class="control-label col-sm-6" for="country">Country:</label>
		  <div class="col-sm-6">
			  <p style="font-size: 20px;"><?=$country?></p>
		  </div>
		</div>
	  
		<div class="form-group">
		  <label class="control-label col-sm-6" for="city">City:</label>
		  <div class="col-sm-6">
			  <p style="font-size: 20px;"><?=$city?></p>
		  </div>
		</div>

		<div class="form-group">
		  <label class="control-label col-sm-6" for="role">Role:</label>
		  <div class="col-sm-6">
			  <p style="font-size: 20px;"><?=$role?></p> 
		  </div>
		</div>  
		
		<div class="form-group">	
			<div class="col-sm-4"></div>
			  <select class="control-label col-sm-4" name="role">
				<option>admin</option>
				<option>user</option>
			  </select>
			<div class="col-sm-4"></div>	  
		</div>
		
		
		<div class="form-group">
		<div class="col-sm-offset-5 col-sm-7">
		<input type="submit" name="submitted" value="Edit" class="btn btn-info btn-md" style="width:120px;">
		</div>
		</div>   
	</form>
	</div>
	<div class="col-md-3"></div>
		</div>
		
	</div>
	</body>
	</html>

<?php
include '../../includes/footer.php';
?>