<?php
require_once '../../includes/autoload.php';
include '../../includes/header.php'
?>
<?php
session_start();
//read from session
$firstName=$_SESSION["firstName"];
session_regenerate_id(TRUE);
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	  <title>Thank You</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<style>
	.error{color:red;}
	</style>
	<body style="background: url('../../images/91134-OIW11W-632.png') no-repeat center center fixed; 
	  -webkit-background-size: cover;
	  -moz-background-size: cover;
	  -o-background-size: cover;
	  background-size: cover;"> <!--<a href="http://www.freepik.com">Designed by Freepik</a>-->
		<div class="container-fluid">
		
	  <!--Content -->
	  <div class="row" style="margin-top: 100px;">
		  <div class="col-md-3"></div>
		  
		  <div class="col-md-6" style="text-align: center; background: rgba(255, 255, 255, 1.0); border-radius: 10px; padding: 20px; box-shadow: 10px 10px 5px black;">
			  <h2><strong><?php echo "Thank You ". $firstName?></strong></h2>
			  <h3 style="margin-bottom: 40px;">You have successfully registered to community portal</h3>
			  <h4>Continue with <a href="../../login.php">login</a></h4>
		  </div>

		  <div class="col-md-3" style="margin: 200px;"></div>
		  
	  </div>
	  
		</div>
		</body>
		</html>	

<?php
include '../../includes/footer.php';
?>