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


	if(isset($_GET["id"])){
	  $UM=new UserManager();
	  $viewuser=$UM->getUserById($_GET["id"]);
	  $firstName=$viewuser->firstName;
	  $lastName=$viewuser->lastName;
	  $companyName=$viewuser->companyName;
	  $city=$viewuser->city;
	  $country=$viewuser->country;
	}
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	  <title>View Profile</title>
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
	  
		  <div class="container">
			<div class="row">
				<div class="col-md-11"></div>
				<div class="col-md-1" style="background: whitesmoke; border-radius: 10px;">
			<h4><a href="userlistsearch.php"><strong><span class="glyphicon glyphicon-arrow-left"></span> Back</strong></a></h4>
				</div>
		</div>
		</div>
		
		<!--Content -->
	<div class="container" style="margin-top: 70px;">
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-6" style="background: rgba(255, 255, 255, 1.0); border-radius: 10px; padding: 20px; margin-bottom: 50px;">
			<div class="row" style="text-align: center;">
		<div class="col-md-12">
			<h1 class="text-center"><strong><?=$firstName?> <?=$lastName?></strong></h1>
			<hr>
			<br>
		<form class="form-horizontal">
				  
		<div class="form-group">
		  <label class="control-label col-sm-5">First Name:</label>
		  <div class="col-sm-7">
			  <h4><?=$firstName?></h4>
		  </div>

		<label class="control-label col-sm-5">Last Name:</label>
		  <div class="col-sm-7">
			  <h4><?=$lastName?></h4>
			  </div>

		<label class="control-label col-sm-5">Company Name:</label>
		  <div class="col-sm-7">
			  <h4><?=$companyName?></h4>
		  </div>
		
		<label class="control-label col-sm-5">City:</label>
		  <div class="col-sm-7">
			  <h4><?=$city?></h4>
		  </div>
		  
		<label class="control-label col-sm-5">Country:</label>
		  <div class="col-sm-7">
			  <h4><?=$country?></h4>
		  </div>

		</div>
		
		</form>
		</div>
			</div>
			</div>
		</div>
		

		<div class="col-md-3" style="margin: 67px;"></div>

	</div>
	</body>
	</html>
<?php
include '../../includes/footer.php';
?>