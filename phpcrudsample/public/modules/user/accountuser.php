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
$error="";
$formerror="";
$firstName="";
$lastName="";
$email="";
$password="";
$account="";


	if(isset($_POST["submitted"])){  //can't edit yourself 
	  if(isset($_GET["id"])){
		  
		  if($_GET["id"] !== $_SESSION["id"]){
		  
		   $UM=new UserManager();
		   	$id = $_GET["id"];
			$account=$_POST['account'];
		   $existuser=$UM->updateaccount($_GET["id"],$account);
		     header("Location:../../modules/user/userlist.php");
			//$formerror="Account state edited successfully.";
		   } else { 
		   $error="Unable to update your own account";
		     }
	   }//else if(isset($_POST["cancelled"])){
	//	header("Location:../../home.php");
	}else{
		if(isset($_GET["id"])){
		  $UM=new UserManager();
		  $existuser=$UM->getUserById($_GET["id"]);
		  $firstName=$existuser->firstName;
		  $lastName=$existuser->lastName;
		  $email=$existuser->email;
		  $password=$existuser->password;
		  $account=$existuser->account;
		}
	 }


?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	  <title>Edit Account</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	 <style>
	.error{color: red;}
	</style>
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
			<h1 class="text-center"><strong><span class="glyphicon glyphicon-user" style="font-size: 40px;"></span> Edit User Account</strong></h1>
			<hr>
		<form class="form-horizontal" name="accountuser" method="post">
		  <div class="error"><?=$formerror?></div><div class="error"><?=$error?></div>
	        <h4 style="color:red; text-align:center;"><strong>Editing user activation account</strong></h4><br>
		<div class="form-group">
		  <label class="control-label col-sm-5" for="firstName">First Name:</label>
			<div class="col-sm-7">
			  <p style="font-size: 20px;"><?=$firstName?></p>
			</div>
		</div>  

		<div class="form-group">
		  <label class="control-label col-sm-5" for="lastName">Last Name:</label>
			<div class="col-sm-7">
			  <p style="font-size: 20px;"><?=$lastName?></p>
			</div>
		</div> 
		
		<div class="form-group">
		  <label class="control-label col-sm-5" for="lastName">Email:</label>
			<div class="col-sm-7">
			  <p style="font-size: 20px;"><?=$email?></p>
			</div>
		</div>
		
		<div class="form-group">
		  <label class="control-label col-sm-5" for="lastName">Account:</label>
			<div class="col-sm-7">
			  <p style="font-size: 20px;"><?=$account?></p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-4"></div>
			  <select class="control-label col-sm-4" name="account">
				<option>active</option>
				<option>deactivate</option>
			  </select>
			<div class="col-sm-4"></div>
		</div>
		
		
		<div class="form-group">
		  <div class="col-sm-offset-5 col-sm-7">
		   <input type="submit" name="submitted" value="Edit" class="btn btn-danger btn-md" style="width:120px;">
		  </div>
		</div>

		</form>
		</div>
		<div class="col-md-3" style="margin: 67px;"></div>
		</div>
		
	</div>
	</body>
	</html>

<?php
include '../../includes/footer.php';
?>