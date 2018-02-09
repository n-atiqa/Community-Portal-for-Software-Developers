<?php
use classes\entity\Feedback;
use classes\business\FeedbackManager;
use classes\business\Validation;

require_once 'includes/autoload.php';
session_regenerate_id(TRUE);
$formerror="";

$email="";
$error_firstname="";
$error_lastname="";
$error_passwd="";
$error_email="";
$error_comments="";
$comments="";
$validate=new Validation();

	if(isset($_POST["submitted"])){
		$email=strip_tags($_POST["email"]);
		$lastname=strip_tags($_POST["lastname"]);
		$firstname=strip_tags($_POST["firstname"]);	
		$comments=strip_tags($_POST["comments"]);	
		
		$validate->check_fname($firstname, $error_firstname);
		$validate->check_lname($lastname, $error_lastname);
		if(empty($error_firstname) && empty($error_lastname) && empty($error_email) && empty($error_comments)){
			$feedback=new Feedback();
			$feedback->firstname=$firstname;
			$feedback->lastname=$lastname;
			$feedback->email=$email;
			$feedback->comments=$comments;
			$FM=new FeedbackManager();
			$FM->insertFeedback($feedback);
			$formerror="* Your feedback submitted successfully!";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>
.error{color:red;}
</style>

    <div style="text-align:center;">
          <h2><strong>Feedback Form</strong></h2>
		  <span class="error"><?php echo $formerror?></span>
          <h3 style="margin-bottom: 40px;">Do give us any feedback if any</h3>
          <form name="myForm" method="post">
		  
	<div class="form-group">
      <label class="control-label col-sm-2" for="firstname">First Name:</label>
      <div class="col-sm-9 offset-sm-1">
		<input type="text" class="form-control" id="firstname" name="firstname" required>
	     <span class="error"><?php echo $error_firstname?></span>	
      </div>
	  <br>
    </div> 
	
    <div class="form-group">
      <label class="control-label col-sm-2" for="lastname">Last Name:</label>
      <div class="col-sm-9 offset-sm-1">
        <input type="text" class="form-control" id="lastname" name="lastname" required>
		 <span class="error"><?php echo $error_lastname?></span>
      </div>
	  <br>
    </div> 	
    <div class="form-group">
	<label class="control-label col-sm-2" for="email">Email:</label>
	<div class="col-sm-9 offset-sm-1">
        <input type="email" class="form-control" id="email" name="email">
         <span class="error"><?php echo $error_email?></span>
	</div>
	  <br>
	</div>
	<div class="form-group">
	<label class="control-label col-sm-2" for="comments">Comments:</label>
	<div class="col-sm-9 offset-sm-1">
		<textarea class="form-control" rows="5" id="comments" name="comments" placeholder="Type your comment here"></textarea>
	</div>
	  <br>
	</div>	
	<div class="form-group">
			<input type="reset" name="reset" value="Reset" class="btn btn-basic btn-md" style="width: 150px; margin: 20px;">
		  <input type="submit" name="submitted" value="Submit" class="btn btn-primary btn-md" style="width: 150px; margin: 20px;">
	</div>	  
</form>
</div>
 




<!--<h1 style="text-align: center;" >Feedback Form</h1>
<form name="myForm" method="post" class="pure-form pure-form-stacked" style="margin-left: 35%;>
<br>

<div><?=$formerror?></div>
<table width="800">
  <tr>
    <td>First Name</td>
    <td><input type="text" name="firstname" size="50"></td>
	<td><?=$error_firstname?></td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td><input type="text" name="lastname" size="50"></td>
	<td><?=$error_lastname?></td>
  </tr>
  <tr>    
    <td>Email</td>
    <td><input type="text" name="email" size="50"></td>
  </tr>
  <tr>    
    <td>Comments</td>
	<td><textarea name="comments" rows = "7" cols = "50"></textarea></td>
  </tr>   
  <tr><td></td>
   <td><br> 
       <input type="submit" name="submitted" value="Submit" class="pure-button pure-button-primary">
       <input type="reset" name="reset" value="Reset" class="pure-button pure-button-primary">
    </td>
  </tr>
</table>
</form>-->