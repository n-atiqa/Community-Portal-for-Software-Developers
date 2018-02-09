<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;
use classes\business\ForumManager;
use classes\entity\Forum;
use classes\business\Validation;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
session_regenerate_id(TRUE);


$formerror="";
$title="";
$date_created="";
$userid="";
$error_fname="";
$validate=new Validation();

	if(isset($_POST["submitted"])){
		
		$title=strip_tags($_POST["title"]);
		$validate->check_fname($title, $error_fname); 
		
		$FM=new ForumManager();
		$forums=$FM->search($title);
		//print_r($forums);
	} else {
		$FM=new ForumManager();
		$forums=$FM->getAllThreads();
		//print_r($forums);
	  }

	  
	$UM=new UserManager(); 

	if(isset($forums)){
		?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	  <title>Projects/Questions & Solutions</title>
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
					<form method="post" action="projectqstsol.php">
						<div class="col-md-10">
							<h1><strong>Search Posts</strong></h1>
						</div>
						<div class="col-md-2" style="margin-top: 17px;">
					  <a href='newtopic.php' class="btn btn-warning btn-md"><span class="glyphicon glyphicon-edit"></span> Post New</a></div>
				  </div><br>

						<div class="col-sm-3 offset-sm-8">
						 <div class="form-group"> 
						  <input type="text" class="form-control" id="title" placeholder="Title" name="title"> 
						  <span class="error"><?php echo $error_fname?></span>
						 </div>
						</div>
						
						<div class="col-sm-1">
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
			<th>Title</th> 
			<th>Posted on</th>
			<th>Posted by</th>
			<th>More</th>

		  </tr>
		</thead>	   
		<tbody>		
	<?php 

			foreach ($forums as $forum) {
				if($forum!=null){
					$users=$UM->getUserById($forum->userid);
					?>
					<tr>
					<td><?=$forum->title?></td>   
					<td><?=$forum->date_created?></td>
					<td><?=$users->firstName?></td>
					<td><a href='viewthread.php?thread_id=<?php echo $forum->thread_id ?>'>View</a></td>
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