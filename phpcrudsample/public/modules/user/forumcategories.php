<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\FeedbackManager;
use classes\business\UserManager;
use classes\entity\User;
use classes\entity\Forumcat;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
session_regenerate_id(TRUE);
$UM=new UserManager();
$users=$UM->getAllUsers();

		?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	  <title>Forum</title>
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
	  
	  <div class="container" style="margin-top: 70px;">
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-10" style="background: whitesmoke; border-radius: 10px;">
					<div class="row">
						<div class="col-md-12">
							<h1><strong>Forums</strong></h1></div>
				  </div>
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
			<th>Title</th>
			<th>Description</th>
		  </tr>
		</thead>
		<tbody>
		  <tr>
			  <td><span class="glyphicon glyphicon-bullhorn"></span><a href="projectqstsol.php"> Projects/Questions & Solutions</a></td>
			  <td>Discussion on projects, questions and solutions</td>
		  </tr>
		  <tr>
			  <td><span class="glyphicon glyphicon-bullhorn"></span><a href="jobopp.php"> Job Opportunities</a></td>
			  <td>Job vacancy postings</td>
		  </tr>

		</tbody>
	  </table>
	</div>


		<div class="col-md-1" style="margin: 80px;"></div>

	</div>
	</div>
	</body>
	</html>

<?php
include '../../includes/footer.php';
?>