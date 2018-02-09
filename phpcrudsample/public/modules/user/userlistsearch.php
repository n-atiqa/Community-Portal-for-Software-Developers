<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;
use classes\business\Validation;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
session_regenerate_id(TRUE);


$formerror="";
$firstName="";
$lastName="";
$companyName="";
$city="";
$country="";
$error_fname="";


	if(isset($_POST["submitted"])){
		
		$firstName=$_POST["firstName"];
		$lastName=$_POST["lastName"];
		$companyName=$_POST["companyName"];
		$city=$_POST["city"];
		$country=$_POST["country"];

		$UM=new UserManager();
		$users=$UM->search($firstName,$lastName,$companyName, $city, $country);
		//print_r($users);
	} else {
		$UM=new UserManager();
		$users=$UM->getAllUsers();
		//print_r($users);
	  }


	if(isset($users)){
		?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	  <title>Search Users</title>
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
				<div class="col-md-1">
				</div>
				<div class="col-md-10" style="background: whitesmoke; border-radius: 10px;">
					<div class="row">
					<form method="post" action="userlistsearch.php">
						<div class="col-md-12">
							<h1><strong>Search Users</strong></h1>
						</div>

						<div class="col-md-2">
						 <div class="form-group">
						  <input type="text" class="form-control" id="firstName" placeholder="First Name" name="firstName"> 
						 </div>
						</div>
						
						<div class="col-md-2">
						 <div class="form-group">
						  <input type="text" class="form-control" id="lastName" placeholder="Last Name" name="lastName"> 
						 </div>
						</div>
						
						<div class="col-md-2">
						 <div class="form-group">
						  <input type="text" class="form-control" id="companyName" placeholder="Company Name" name="companyName"> 
						 </div>
						</div>
						
						<div class="col-md-2">
						 <div class="form-group">
						  <input type="text" class="form-control" id="city" placeholder="City" name="city"> 
						 </div>
						</div>
						
						<div class="col-md-2">
						 <div class="form-group">
						  <input type="text" class="form-control" id="country" placeholder="Country" name="country"> 
						 </div>
						</div>
						
						
						<div class="col-md-2">
						 <div class="form-group">
						  <button type="submit" name="submitted" class="btn btn-success btn-md"><span class="glyphicon glyphicon-search"></span> Search</button>
						 </div>
						</div> 
				  </form>
					</div>
				</div>
				
				<div class="col-md-1"></div>
				</div>

		</div>
			
			
	<!--Content -->
	<div class="container" style="margin-top: 50px;">
	<div class="row">
		<div class="col-md-1"></div>
			
		
		<div class="col-md-10" style="background: white; border-radius: 10px; padding: 20px; margin-bottom: 50px;">
			<h2><strong>Users</strong></h2>
			<br>
			<table class="table table-hover">
		<thead>
		  <tr>
			<th>First Name</th> 
			<th>Last Name</th>
			<th>Company Name</th>
			<th>City</th>
			<th>Country</th>
			<th>Profile</th>
		  </tr>
		</thead>
		<tbody>
	<?php 

			foreach ($users as $user) {
				if($user!=null){
					?>
					<tr>
					   
					   <td><?=$user->firstName?></td>
					   <td><?=$user->lastName?></td>
					   <td><?=$user->companyName?></td>
					   <td><?=$user->city?></td>
					   <td><?=$user->country?></td>
								   <td>
							<a href='viewuser.php?id=<?php echo $user->id ?>'>View</a>
							
					   </td>

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