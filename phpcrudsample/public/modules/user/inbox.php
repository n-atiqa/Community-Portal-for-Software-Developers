<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\UserManager;   
use classes\entity\User;
use classes\business\MessageManager;
use classes\entity\Message;
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
$to_id="";
$validate=new Validation();


	$MM=new MessageManager();
	$messages=$MM->getReceiveById($_SESSION["id"]); 

	$UM=new UserManager();
			
		if(isset($messages)){
		?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	  <title>Inbox</title>
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
	  
	  
	  <!--Content -->
	<div class="container" style="margin-top: 70px;">
		<div class="row">
			<div class="col-md-3" style="background: whitesmoke; border-radius: 10px;text-align: center; padding: 20px;">
				
				<a href="compose.php" style="font-size: 20px;"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;"></span> New Message</a>
				<br>
				<a href="inbox.php" style="font-size: 20px;"><span class="glyphicon glyphicon-envelope" style="font-size: 20px;"></span> Inbox</a>
				<br>
				<a href="sent.php" style="font-size: 20px;"><span class="glyphicon glyphicon-send" style="font-size: 20px;"></span> Sent </a>
				</div>
			
		<div class="col-md-1"></div>

		<div class="col-md-8" style="background: rgba(255, 255, 255, 1.0); border-radius: 10px; padding: 20px; margin-bottom: 120px;">
			<h1 class="text-center"><strong>Inbox</strong></h1>
			
			<br>
			<br>
			<form method="post" action="inbox.php">
			<table class="table table-hover">
		<thead>
		  <tr>
			<th>From</th>
			<th>Subject</th>
			<th>Received</th>
			<th>Action</th>
		  </tr>
		</thead>
		<tbody>
			<?php 

			foreach ($messages as $message) {
				if($message!=null){
					$users=$UM->getUserById($message->from_id);
					?>
					<tr>
					<td><?=$users->firstName?></td>   
					<td><?=$message->subject?></td>
					<td><?=$message->time_sent?></td>
					<td><a href='viewmessage.php?message_id=<?php echo $message->message_id ?>'>Read</a></td>
					</tr>
					<?php 
				}
			}
			?>
		</tbody>
	  </table>
			<?php 
		} else { echo "no results";}
	?>
			</form>
	</div>

		</div>
		<div class="row">
		<div class="col-md-12" style="margin: 67px;"></div>
		</div>
		</div>
		</body>
	</html>
		
<?php
include '../../includes/footer.php';
?>