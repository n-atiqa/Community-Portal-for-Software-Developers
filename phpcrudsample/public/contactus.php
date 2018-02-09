<?php
use classes\business\UserManager;
use classes\business\Validation;

session_start();
require_once 'includes/autoload.php';
include 'includes/header.php';
session_regenerate_id(TRUE);
//$formerror="* Your feedback has been submitted successfully!";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Contact</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
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

 <h2><strong>Customer Online Care</strong></h2>
Call us at +65 1800 222 6868 for any assistance required.<br>
   Operating hour is from Monday to Saturday, 10am to 7pm;<br>
   Sunday & Public Holiday, 10am to 2pm.<br><br> 
    
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.7600334737967!2d103.88985331447665!3d1.3196913620398996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da19149fe4a925%3A0x82606eb494fd093c!2sLithan+Academy!5e0!3m2!1sen!2ssg!4v1514739525393" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

<?php
include './feedback.php';
?>
      </div>

      <div class="col-md-3" style="margin: 80px;"></div>
      
  </div>
  
    </div>
	</body>
	</html>


<?php
include 'includes/footer.php';
?>