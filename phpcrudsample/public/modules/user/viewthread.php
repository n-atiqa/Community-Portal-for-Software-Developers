<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;

use classes\business\ForumManager;
use classes\entity\Forum;
use classes\entity\Respond;
use classes\business\Validation;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
session_regenerate_id(TRUE);

$_SESSION['thread_id'] = $_GET['thread_id'];
//echo ($_GET['thread_id']);
?>

<?php

$formerror="";
$title="";
$description="";
$respond="";
$content="";
$success="";
$userid="";
$date_created="";
$error_lname="";
$error="";
$firstName="";
$id="";
$validate=new Validation();

	

	if(isset($_POST["submitted"])){
		
		$content=strip_tags($_POST["respond"]);	
		//$validate->check_lname($content, $error_lname);
	  

	  if($error_lname == ""){
		  
		  	$respond=new Respond();
			$respond->respond=$content; 
			$respond->thread_id=$_GET["thread_id"];
			$respond->userid=$_SESSION['id']; 
			$FM=new ForumManager();
			$FM->insertRespond($respond);
			$success="Updated Successfully!";

	}else{
		  $formerror="Please provide required values";
		  
	}
	}

    if(isset($_GET["thread_id"])){ 
              $FM=new ForumManager();
              $viewthread=$FM->getForumById($_GET["thread_id"]);
              $title=$viewthread->title;
              $userid=$viewthread->userid;
              $date_created=$viewthread->date_created;
              $description=$viewthread->description;
            }
	
	$UM=new UserManager(); 
	$username=$UM->getUserById($viewthread->userid);
	$firstName=$username->firstName;

?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	  <title>Read Thread</title>
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
				  <h4><a href="projectqstsol.php"><strong><span class="glyphicon glyphicon-arrow-left"></span> Back</strong></a></h4>
				</div>
			</div>
		  </div>

	<!--Content -->
	<div class="container" style="margin-top: 50px;">
	<div class="row">
		<div class="col-md-1"></div>
		 <div class="col-md-10" style="background: white; border-radius: 10px; padding: 20px; margin-bottom: 50px;">
			<table class="table table-hover">
		<thead>
		  <tr>
			<th style="font-size: 25px;"><?=$title?></th>
		  </tr>
		</thead>
		<tbody>
		  <tr>
				  <td><p><?=$description?></p></td>
				  <td><strong><?=$firstName?></strong>
				  <br>
			  Created: <?=$date_created?></td>
		  </tr>
	<?php	  
		  if(isset($_GET["thread_id"])){
			$FM=new ForumManager();
			$responds=$FM->getResponseById($_GET["thread_id"]);
			//print_r($jobs);
	}

	$UM=new UserManager(); 

		if(isset($responds)){
			?>
			<form method="post">

			<table class="table table-hover">
					<thead>
					<tr>
					   <th style="font-size: 25px;"><b>Responses</b></th>      
					</tr>  
					</thead>
					  <tbody>	
			<?php 

			foreach ($responds as $respond) {
				if($respond!=null){
					$users=$UM->getUserById($respond->userid);
					?>
					<tr>
					   <td><?=$respond->respond?></td>
					   <td><strong><?=$users->firstName?></strong>
					   <br>
					   Posted: <?=$respond->posted?></td>
					   

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
		<div class="col-md-1" ></div>

	</div>
	</div>
	<div class="container">
	<div class="row">
		<div class="col-md-1"></div>
			
		<div class="col-md-10" style="background: white; border-radius: 10px; padding: 20px; margin-bottom: 50px;">
		<h3 style="text-align:center;"><strong>Replies:</strong></h3>
		
		<div class="form-group">
		  <label class="control-label col-sm-2" for="response">Response:</label>
			<div class="col-sm-9 offset-sm-1">
			<textarea class="form-control" rows="5" id="respond" name="respond" placeholder="Type in content" required></textarea>
			</div>	
		</div>		

		<div class="form-group">
		<div class="col-sm-offset-5 col-sm-7">
		<input type="submit" name="submitted" value="Reply" class="btn btn-primary btn-md" style="width:120px;">
		</div>  
		</div>
		</form>
		</div>
		
		<div class="col-md-1" style="margin: 67px;"></div>
		</div>
		</div>
	</body>
	</html>

<?php
include '../../includes/footer.php';
?>