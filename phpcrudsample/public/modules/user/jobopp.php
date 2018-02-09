<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\UserManager;  // added to get user names
use classes\entity\User;
use classes\business\ForumManager;
use classes\entity\Job;
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
$position_title="";
$company_name="";
$country="";


	if(isset($_POST["submitted"])){
		
		$position_title=strip_tags($_POST["position_title"]);
		$company_name=strip_tags($_POST["company_name"]);
		$country=strip_tags($_POST["country"]);
		

		$FM=new ForumManager();
		$jobs=$FM->searchJob($position_title, $company_name, $country);
		//print_r($jobs);
	} else {
		$FM=new ForumManager();
		$jobs=$FM->getAllJobs();
		//print_r($jobs);
	  }
	  
	  
	$UM=new UserManager();
	
	if(isset($jobs)){
		?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	  <title>Job Vacancies</title>
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
					<form method="post" action="jobopp.php">
						<div class="col-md-10">
							<h1><strong>Search Job Listings</strong></h1>
						</div>
						<div class="col-md-2" style="margin-top: 17px;">
					  <a href='newjob.php' class="btn btn-warning btn-md"><span class="glyphicon glyphicon-edit"></span> Post New</a></div>
				  </div><br>

						<div class="col-md-3">
						 <div class="form-group">
						  <input type="text" class="form-control" id="position_title" placeholder="Position Title" name="position_title"> 
						 </div>
						</div>
						
						<div class="col-md-3">
						 <div class="form-group">
						  <input type="text" class="form-control" id="company_name" placeholder="Company Name" name="company_name"> 
						 </div>
						</div>
						
						<div class="col-md-3">
						 <div class="form-group">
						  <input type="text" class="form-control" id="country" placeholder="Country" name="country"> 
						 </div>
						</div>

						<div class="col-md-3">
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
			<th>Position Title</th> 
			<th>Company Name</th>
			<th>Country</th>
			<th>Posted By</th>
			<th>Posted On</th>
			<th>View</th>
		  </tr>
		</thead>
		<tbody>		
	<?php 

			foreach ($jobs as $job) {
				if($job!=null){
					$users=$UM->getUserById($job->userid);
					?>
					<tr>
					   
					   
					   <td><?=$job->position_title?></td>
					   <td><?=$job->company_name?></td>
					   <td><?=$job->country?></td>				   
					   <td><?=$users->firstName?></td>
					   <td><?=$job->posted_on?></td>
								   <td>
							<a href='viewjob.php?job_id=<?php echo $job->job_id ?>'>View</a>
							
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
	</div>		
	<div class="col-md-1" style="margin: 67px;"></div>
	</div>
	</div>
	</body>
	</html>		

<?php
include '../../includes/footer.php';
?>