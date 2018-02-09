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
?>

<?php
$success="";
$formerror="";
$error_fname="";
$error_lname="";
$userid="";
$company_name="";
$country="";
$details="";
$userid="";
$posted_on="";
$position_title="";
$description="";
$to_id="";
$from_id="";
$firstName="";
$subject="";
$content="";
$firstName="";
$validate=new Validation();
$validate1=new Validation();

	
		if(isset($_POST["submitted"])){ 
		
		$to_id=strip_tags($_POST["to_id"]);
		$subject=strip_tags($_POST["subject"]);
		$content=strip_tags($_POST["content"]);

			
		//$validate->check_fname($subject, $error_fname); 
		//$validate1->check_lname($content, $error_lname); 
		

		if($error_fname == "" && $error_lname == ""){
		
				if($_SESSION["id"] !== $to_id){ 
			$message=new Message();
			$message->from_id=$_SESSION["id"];		
			$message->to_id=$to_id;
			$message->subject=$subject;
			$message->content=$content;
			date_default_timezone_set('Singapore');
			$timestamp = date("Y-m-d H:i:s");
			$message->time_sent=$timestamp;
			$MM=new MessageManager();
			$MM->insertMessage($message);
			//print_r($message);
		
			$success="Message Successfully Sent!";
		// header("Location:../../modules/user/jobopp.php");
    }else{ 
      $formerror="You can't send a message to yourself";
	  
     }
		}
		}
		
		

		$UM=new UserManager();
		$users=$UM->getAllUsers();
		
if(isset($users)){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Compose Message</title>
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

    <div class="col-md-8" style="background: rgba(255, 255, 255, 1.0); border-radius: 10px; padding: 20px; margin-bottom: 50px;">
        <h1 style="text-align: center;"><strong>New Message</strong></h1>
        <br>
        <form class="form-horizontal" name="myForm" method="post">
		<div><?=$formerror?></div> <div><?=$success?></div>
            <div class="form-group">
        <label class="control-label col-sm-1" for="to">To</label>
      <div class="col-sm-11">
        <select name="to_id">
	<option value="">Select...</option>
  		<?php 

		foreach ($users as $user) {
			if($user!=null){
				if($user->id !== $_SESSION["id"]) {
				?>

	<option value="<?=$user->id?><?=$user->firstName?>"> <?php echo $user->firstName;?></option>
	  <?php 
			}
			}
		}
		?>
	</select></td></tr>

  <?php 
	}
?>
      </div>
            </div>
            <div class="form-group">
        <label class="control-label col-sm-1" for="subject">Subject</label>
      <div class="col-sm-11">
        <input type="text" class="form-control" id="subject" placeholder="Title of message" name="subject" required>
      </div>
            </div>
            <div class="form-group">
                <div class="col-sm-1"></div>
      <div class="col-sm-11">
          <textarea class="form-control" rows="5" id="content" name="content" placeholder="Type your message here" required></textarea>
      </div>
    </div>  
            <div class="form-group">        
      <div class="col-sm-offset-5 col-sm-7">
        <input type="submit" name="submitted" value="Send" class="btn btn-info" style="width:120px;">  
      </div>
    </div>
        </form>
    </div>
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