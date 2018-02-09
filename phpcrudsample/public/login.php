<?php
session_start();
use classes\business\UserManager;
use classes\business\Validation;

require_once 'includes/autoload.php';
require_once 'includes/password.php';
include 'includes/header.php';
session_regenerate_id(TRUE);
$formerror="";

$role="";
$account="";
$email="";
$password="";
$error_auth="";
//$error_name="";
$error_passwd="";
$error_email="";
$validate=new Validation();
$validate1=new Validation();

	if(isset($_POST["submitted"])){
		$email=$_POST["email"];
		$password=$_POST["password"];
		
		$validate->check_password($password, $error_passwd);
		$validate1->check_email($email, $error_email);
			
			if($error_passwd == "" && $error_email == "" ) {
			$UM=new UserManager();				
			$existuser=$UM->getUserByEmail($email);
			
				if(isset($existuser)){
					
					$hashpass= $existuser->password;
					
					if (password_verify($password, $hashpass)) {

						
						$_SESSION['email']=$email;
						$_SESSION['id']=$existuser->id;
						$_SESSION['role']=$existuser->role;
                                                $_SESSION['account']=$existuser->account;
						$_SESSION['password']=$password;
						//echo '<meta http-equiv="Refresh" content="1; url=home.php">';
						echo '<meta http-equiv="Refresh" content="1; url=modules/user/updateprofile.php">';
						
					} else {
					$formerror="Invalid User Name or Password";
					  }
				}
				else{
					$formerror="Invalid User Name or Password";
				}
			}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<style>
.error{color:red;}
}
</style>
<body style="background: url('images/91134-OIW11W-632.png') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;"> 
   <div class="container-fluid">
       
  <!--Content -->
  <div class="row" style="margin-top: 100px;">
      <div class="col-md-3"></div>
      
      <div class="col-md-6" style="text-align: center; background: rgba(255, 255, 255, 1.0); border-radius: 10px; padding-bottom: 10px; box-shadow: 10px 10px 5px black;">
          <h2><strong>Login</strong></h2>

          <form class="form-horizontal" name="myForm" method="post">

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-9 offset-sm-1">
        <input type="email" class="form-control" id="email" placeholder="Your email address" name="email" value="<?=$email?>" pattern=".{1,}" required title="Cannot be empty field">
		<span class="error"><?php echo $error_email?></span>
      </div>
	  <br>
    </div>
              
    <div class="form-group">
      <label class="control-label col-sm-2" for="password">Password:</label>
      <div class="col-sm-9 offset-sm-1">          
        <input type="password" class="form-control" id="password" placeholder="Your password" name="password" value="<?=$password?>" pattern=".{6,}" required title="6 characters minimum">
      	<span class="error"><?php echo $error_passwd?></span>
	  </div>
	  <br>
    </div>
	
              <div class="form-group"><div class="col-sm-12"><a href="./forgetpassword.php">Forgotten your password?</a></div></div>
                      
    
    <div class="form-group">        
      <div class="col-sm-6">
        <a href="modules/user/register.php" class="btn btn-warning btn-md" style="width: 120px;">Register</a>
      </div>
	   <div class="col-sm-6">
		<input type="submit" name="submitted" value="Login" class="btn btn-primary btn-md" style="width: 120px;">
      </div>
    </div>
              <div class="error"><?=$formerror?></div>
  </form>
          
          
      </div>

      <div class="col-md-3" style="margin: 100px;"></div>
      
  </div>
  
    </div>
<!--<link rel="stylesheet" href=".\css\pure-release-1.0.0\pure-min.css">


<h1 style="margin-top: 60px; text-align:center;">Login</h1>
<form name="myForm" method="post" class="pure-form pure-form-stacked" style="margin-left: 40%;>
<table border='0' width="100%" style=";">
  <tr>    
    <td>Email</td>
    <td><input type="email" name="email" value="<?=$email?>" pattern=".{1,}" required title="Cannot be empty field" size="30">
	<span class="error"><?php echo $error_email?></span></td>
	<td>
  </tr>
  <tr>    
    <td>Password</td>
    <td><input type="password" name="password" value="<?=$password?>" pattern=".{6,}" required title="6 characters minimum" size="30">
	<span class="error"><?php echo $error_passwd?></span></td>	
  </tr> 
  <tr>
    <td><br></td>
    <td><input type="submit" name="submitted" value="Submit" class="pure-button pure-button-primary"></td>
     <td><input type="reset" name="reset" value="Cancel" class="pure-button pure-button-primary"></td>
  </tr>
  <tr>
  <td></td>
    <td>
	<div class="error"><?=$formerror?></div>
       <br><a class="pure-button" href="modules/user/register.php">Register Now</a>
	   <a class="pure-button" href="./forgetpassword.php">Forget Password</a>
    </td>
  </tr>   
</table>
</form>-->
</body>
</html>


<?php
include 'includes/footer.php';
?>