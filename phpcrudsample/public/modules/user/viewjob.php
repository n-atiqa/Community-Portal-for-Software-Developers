<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;
use classes\business\ForumManager;
use classes\entity\Job;
use classes\entity\Jobapply;
use classes\business\Validation;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
session_regenerate_id(TRUE);

$_SESSION['job_id'] = $_GET['job_id'];
?>

<?php

$formerror="";
$title="";
$description="";
$respond="";
$success="";
$userid="";
$position_title="";
$company_name="";
$details="";
$country="";
$posted_on="";
$firstname="";
$lastname="";
$email="";
$message="";
$error="";
$jobapplys="";
$validate=new Validation();

	if(isset($_POST["submitted"])){
		
		$firstname=strip_tags($_POST["firstname"]);	
		$lastname=strip_tags($_POST["lastname"]);	
		$email=strip_tags($_POST["email"]);	
		$message=strip_tags($_POST["message"]);	
		$validate->check_lname($lastname, $error_lname); 

	  if($error_lname == ""){
		  
		  	$jobapply=new Jobapply();
			//$jobapply->job_id=$_GET["job_id"];			
			$jobapply->firstname=$firstname;
			$jobapply->lastname=$lastname;
			$jobapply->email=$email;
			$jobapply->message=$message;
			$jobapply->job_id=$_GET["job_id"];
			
			$FM=new ForumManager();
			$FM->insertJobapply($jobapply);
			$success="Submitted Successfully!";

	}else{ //print_r($jobapply);
		  $formerror="Please provide required values";
		  
	}

	}		
	if(isset($_GET["job_id"])){ //get job apply by id
	  $FM=new ForumManager();
	  $viewjob=$FM->getJobById($_GET["job_id"]);  
	  $position_title=$viewjob->position_title;
	  $company_name=$viewjob->company_name;
	  $details=$viewjob->details;
	  $country=$viewjob->country;
	  $userid=$viewjob->userid;
	  $posted_on=$viewjob->posted_on;
	}
	
	$UM=new UserManager(); 
	$username=$UM->getUserById($viewjob->userid);
	$firstName=$username->firstName;
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	  <title>Job Info</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	 <style>
	.error{color: red;}
	</style>
	</head>
	<body style="background: url('../../images/91134-OIW11W-632.png') no-repeat center center fixed; 
	  -webkit-background-size: cover;
	  -moz-background-size: cover;
	  -o-background-size: cover;
	  background-size: cover;"> <!-- Credit to the author<a href="http://www.freepik.com">Designed by Graphiqastock / Freepik</a> -->

		  <div class="container">
			<div class="row">
				<div class="col-md-11"></div>
				<div class="col-md-1" style="background: whitesmoke; border-radius: 10px;">
			<h4><a href="jobopp.php"><strong><span class="glyphicon glyphicon-arrow-left"></span> Back</strong></a></h4>
				</div>
		</div>
		</div>
	  
	<!--Content -->
	<div class="container" style="margin-top: 70px;">
		<div class="row">     
		<div class="col-md-1"></div>

		<div class="col-md-10" style="background: rgba(255, 255, 255, 1.0); border-radius: 10px; padding: 20px; margin-bottom: 100px;">
			<h1 class="text-center"><strong><span class="glyphicon glyphicon-briefcase" style="font-size: 40px;"></span> Job Information</strong></h1>
			<hr>
		   <form class="form-horizontal" name="jobview" method="post">
	<div class="error"><?=$formerror?></div><div class="error"><?=$error?></div>
	<h2 style="text-align:center;"><strong><?=$position_title?></strong></h2><br>

		<div class="form-group">
		  <label class="control-label col-sm-5" for="company_name">Company Name:</label>
			<div class="col-sm-7">
			  <p style="font-size: 20px;"><?=$company_name?></p>
			</div>
		</div> 
		
		<div class="form-group">
		  <label class="control-label col-sm-5" for="details">Details:</label>
			<div class="col-sm-7">
			  <p style="font-size: 20px;"><?=$details?></p>
			</div>
		</div>
		
		<div class="form-group">
		  <label class="control-label col-sm-5" for="country">Country:</label>
			<div class="col-sm-7">
			  <p style="font-size: 20px;"><?=$country?></p>
			</div>	
		</div>
		
		<div class="form-group">
		  <label class="control-label col-sm-5" for="userid">Posted By:</label>
			<div class="col-sm-7">
			  <p style="font-size: 20px;"><?=$firstName?></p>
			</div>	
		</div>
		
		<div class="form-group">
		  <label class="control-label col-sm-5" for="posted_on">Posted On:</label>
			<div class="col-sm-7">
			  <p style="font-size: 20px;"><?=$posted_on?></p>
			</div>	
		</div>
		
		<h3 style="text-align:center;"><strong>Job Application:</strong></h3>
		
		<div class="form-group">
		  <label class="control-label col-sm-2" for="firstname">First Name:</label>
			<div class="col-sm-9 offset-sm-1">
			  <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstname" required>
			</div>	
		</div>	

		<div class="form-group">
		  <label class="control-label col-sm-2" for="lastname">Last Name:</label>
			<div class="col-sm-9 offset-sm-1">
			  <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname" required>
			</div>	
		</div>	

		<div class="form-group">
		  <label class="control-label col-sm-2" for="email">Email:</label>
			<div class="col-sm-9 offset-sm-1">
			  <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
			</div>	
		</div>	

		<div class="form-group">
		  <label class="control-label col-sm-2" for="message">Message:</label>
			<div class="col-sm-9 offset-sm-1">
			<textarea class="form-control" rows="5" id="message" name="message" placeholder="Message to Company" required></textarea>
			</div>	
		</div>		
		
		<div class="form-group">
		<div class="col-sm-offset-5 col-sm-7">
		<input type="submit" name="submitted" value="Apply" class="btn btn-primary btn-md" style="width:120px;">
		</div>  
		</div>
		</form>
		<br>
	<?php
	if(isset($_GET["job_id"])){
			$FM=new ForumManager();
			$jobapplys=$FM->getApplyById($_GET["job_id"]);
			//print_r($jobs);
	}

		if(isset($jobapplys)){
			?>
			<form class="form-horizontal" method="post" action="jobopp.php">

				<h2 style="text-align:center;"><strong>List of Applicants</strong></h2>

		</form>
	<table class="table table-hover">
		<thead>
		  <tr>
			<th>First Name</th> 
			<th>Last Name</th>
		  </tr>
		</thead>
		<tbody>	
	<?php 
			foreach ($jobapplys as $jobapply) {
				if($jobapply!=null){
					?>
					<tr>
					   <td><?=$jobapply->firstname?></td>
					   <td><?=$jobapply->lastname?></td>

					</tr>
					<?php 
				} 
			}
			?>
		</tbody>
	</table>
			<?php 
		}
	?>		

	</div>
	<div class="col-md-1" style="margin: 67px;"></div>
		</div>		
	</div>
	</body>
	</html>

<?php
include '../../includes/footer.php';
?>