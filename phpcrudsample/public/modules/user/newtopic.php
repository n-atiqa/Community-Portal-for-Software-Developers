<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\ForumManager;
use classes\entity\Forum;
use classes\business\Validation;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
session_regenerate_id(TRUE);
?>

<?php
$success="";
$formerror="";
$error_fname="";
$error_lname="";
$title="";
$userid="";
$description="";
$validate=new Validation();
$validate1=new Validation();
	
		if(isset($_POST["submitted"])){
		$title=strip_tags($_POST["title"]);
		$description=strip_tags($_POST["description"]);
		
		//$validate->check_fname($title, $error_fname);
		//$validate1->check_lname($description, $error_lname);
		
		if($error_fname == "" && $error_lname == ""){
			$forum=new Forum();
			$forum->title=$title;
			$forum->description=$description;
			$forum->userid=$_SESSION["id"];
			$FM=new ForumManager();
			$FM->insertForum($forum);
		 header("Location:../../modules/user/projectqstsol.php");
    }else{ 
      $formerror="Please provide required values";
	  
     }
		}
		
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	  <title>New Post</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	 
	</head>
	<style>
	.correct {color:green; font-weight: bold; font-size: 20px;}
	</style>
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
	<div class="container" style="margin-top: 70px;">
		<div class="row">

		<div class="col-md-2"></div>

		<div class="col-md-8" style="background: rgba(255, 255, 255, 1.0); border-radius: 10px; padding: 20px; margin-bottom: 50px;">
			<h1 style="text-align: center;"><strong>Create New Topic</strong></h1>
			<br>
			<form class="form-horizontal" name="myForm" method="post">
			<div><?=$formerror?></div> <div><?=$success?></div>

		<div class="form-group">
		  <label class="control-label col-sm-2" for="title">Title</label>
			<div class="col-sm-9 offset-sm-1">
			  <input type="text" class="form-control" id="title" placeholder="Title" name="title" required>
			  <span class="error"><?php echo $error_fname?></span>
			</div>
		</div>

		<div class="form-group">
		  <label class="control-label col-sm-2" for="description">Description</label>
			<div class="col-sm-9 offset-sm-1">
			  <textarea class="form-control" rows="5" id="description" name="description" placeholder="Description of post" required></textarea>
			  <span class="error"><?php echo $error_lname?></span>
			</div>
		</div> 	

		<div class="form-group">        
		  <div class="col-sm-offset-5 col-sm-7">
			<input type="submit" name="submitted" value="Post" class="btn btn-info" style="width:120px;">  
		  </div>  
		</div>
			</form>
		</div>
		<div class="col-md-2"></div>
		</div>
	</div>
	<div class="row">
	<div class="col-md-12" style="margin: 67px;"></div>
	</div>
	</body>
	</html>

<?php
include '../../includes/footer.php';
?>