<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\FeedbackManager;
use classes\business\UserManager;
use classes\entity\User;


ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
session_regenerate_id(TRUE);
$UM=new UserManager();
$users=$UM->getAllUsers();


	if(isset($users)){
		?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	  <title>List of Users Registered</title>
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
			
			<div class="container" style="margin-top: 70px;">
		<div class="row">
		<div class="col-md-12" style="background: rgba(255, 255, 255, 1.0); border-radius: 10px; padding: 20px; margin-bottom: 100px;">
			<h1 class="text-center"><strong><span class="glyphicon glyphicon-user" style="font-size: 40px;"></span> List of Users</strong></h1>
			<hr>
			<br>
			<br>
			<form>
			<table class="table table-hover">
		<thead>
		  <tr>       
			<th>Id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Company Name</th>
			<th>Country</th>
			<th>City</th>
			<th>Role</th>
			<th>Account</th>
			<th>Operation</th>
		  </tr>
		</thead>
		<tbody>
			<?php 

			foreach ($users as $user) {
				if($user!=null){
					?>
					<tr>
					   <td><?=$user->id?></td>
					   <td><?=$user->firstName?></td>
					   <td><?=$user->lastName?></td>
					   <td><?=$user->email?></td>
					   <td><?=$user->companyName?></td>
					   <td><?=$user->country?></td>
					   <td><?=$user->city?></td>
					   <td><?=$user->role?></td>
					   <td><?=$user->account?></td>
					   <td>
							<a href='edituser.php?id=<?php echo $user->id ?>'>Edit</a><br>
							<a href='deleteuser.php?id=<?php echo $user->id ?>'>Delete</a><br>
													<a href='accountuser.php?id=<?php echo $user->id ?>'>Account</a>
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
		</div>
		</div>
	</body>
	</html>

<?php
include '../../includes/footer.php';
?>