<?php
use classes\business\UserManager;
use classes\business\Validation;

require_once 'includes/autoload.php';
include 'includes/header.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'includes/SMTP.php';
require_once 'includes/PHPMailer.php';
require_once 'includes/Exception.php';
require_once 'includes/password.php';
session_regenerate_id(TRUE);
$formerror="";

$email="";
$password="";
$error_auth="";
$error_name="";
$error_passwd="";
$error_email="";
$validate=new Validation();

	if(isset($_POST["submitted"])){
		$email=$_POST["email"];	
		$validate->check_email($email, $error_email);
		$UM=new UserManager();
		$existuser=$UM->getUserByEmail($email);
		
		if(isset($existuser)){
				//generate new password
				$newpassword=$UM->randomPassword(8,1,"lower_case,upper_case,numbers");
				//update database with new password
				$forgothash=password_hash($newpassword[0], PASSWORD_BCRYPT, array("cost" => 10));
				$UM->updatePassword($email,$forgothash);  
				//coding for sending email
				// do work here
				
				//error_reporting(E_ALL);
				//error_reporting(E_STRICT);
				date_default_timezone_set('Singapore');
				$mail             = new PHPMailer();
				$mail->IsSMTP(); // telling the class to use SMTP
				$mail->SMTPOptions = array(
					'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
								  )
										  );
				//$mail->Host       = "mail.yourdomain.com"; // SMTP server
				//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
														   // 1 = errors and messages
														   // 2 = messages only
				$mail->SMTPAuth   = true;                  // enable SMTP authentication
				$mail->IsHTML(true);
				$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
				$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server smtp.gmail.com
				$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
				$mail->Username   = "YOURGMAILADDRESS";  // GMAIL username
				$mail->Password   = "YOUR PASSWORD";            // GMAIL password

				$mail->SetFrom('YOURGMAILADDRESS', '[Admin] ABC Jobs Pte Ltd');
				$mail->Subject    = "Reset Password";			
				$mail->Body = "Your Temporary Password is ".$newpassword[0];
				//$address = "";
				//$mail->AddAddress($address, "");
				$mail->AddAddress($email);

				if(!$mail->Send()) {
				  echo "Mailer Error: " . $mail->ErrorInfo;
				} else {
				  $formerror="New password have been sent to ".$email;
				}
										
				//$formerror="New password have been sent to ".$email;
				//header("Location:home.php");
		}else{
				$formerror="Invalid email user";
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forget Password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>
.error{color:red;}
</style>
<body style="background: url('images/91134-OIW11W-632.png') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;"> <!--<a href="http://www.freepik.com">Designed by Freepik</a>-->
    <div class="container-fluid">
        
  <!--Content -->
  <div class="row" style="margin-top: 100px;">
      <div class="col-md-3"></div>
      
      <div class="col-md-6" style="text-align: center; background: rgba(255, 255, 255, 1.0); border-radius: 10px; padding: 20px; box-shadow: 10px 10px 5px black;">
          <h2><strong>Forgotten your password?</strong></h2>
          <h3 style="margin-bottom: 40px;">Please type in your email address to reset password</h3>
          <form name="myForm" method="post">
          <div class="form-group">
              <input type="email" class="form-control" id="email" placeholder="Enter in your email used for your account" name="email" value="<?=$email?>" pattern=".{1,}"   required title="Cannot be empty field">
          	<span class="error"><?php echo $error_email?></span>
		  </div>
			<span class="error"><?php echo $formerror?></span><br>
		  
		  <input type="submit" name="submitted" value="Submit" class="btn btn-success btn-md" style="width: 150px; margin: 4px;">
</form>
      </div>

      <div class="col-md-3" style="margin: 80px;"></div>
      
  </div>
  
    </div>
	</body>
	</html>

<!--<html>
<link rel="stylesheet" href=".\css\pure-release-1.0.0\pure-min.css">
<style>
.error{color:red;}
</style>
<body>

<h1 style="margin-top: 60px; text-align:center;">Forget Password</h1>
<form name="myForm" method="post" class="pure-form pure-form-stacked" style="margin-left: 40%;>
<table border='0' width="100%">
  <tr>    
    <td>Email</td>
    <td><input type="email" name="email" value="<?=$email?>" pattern=".{1,}"   required title="Cannot be empty field" size="30">
	<span class="error"><?php echo $error_email?></span></td>
	<td>
  </tr> 
  <tr>
    <td></td>
    <td><br><input type="submit" name="submitted" value="Submit" class="pure-button pure-button-primary">
    </td>
  </tr>
  <tr><span class="error"><?php echo $formerror?></span></tr>
</table>
</form>-->
<?php
include 'includes/footer.php';
?>
