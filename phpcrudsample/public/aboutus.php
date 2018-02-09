<?php
use classes\business\UserManager;
use classes\business\Validation;

require_once 'includes/autoload.php';
include 'includes/header.php';
session_regenerate_id(TRUE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>About Us</title>
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

 <h2><strong>Job Portal</strong></h2>

<p>
Tired searching for a job? Feeling helpless? Tired of waiting for a response after applying on those job portals? We are there to help you out.

Brand You has come up with an amazing job portal 
where candidates can apply for desired jobs and even employers can post their requirements. 
With two separate registrations, this portal allows both candidates and the employers, an ease in searching for the suitable match for each other. 
It allows the employers to send an email or sms to the candidates they feel are fit for the vacancy they have.
</p>
 
<p>
<strong>Features for Candidates:</strong>

Candidates can search for a job according to their preferred city.
Candidates can send their resumes to the companies which are located in their preferred cities.
Candidates can fill the bio data form which is designed for them in the portal with an attachment of their resume.
Candidates shall receive an email or sms if they are being short listed for the interview by an employer.
 </p>
<p>
<strong>Features for Employers:</strong>

Employers can find suitable candidates by searching with the desired key words for the vacancy.
Employers can post the vacancies by filling up a form designed for the same. They can mention the job description and salary offered in that.
Employers will be allowed to send out an email or sms to those candidates directly who found to fit the criteria of the job opening.
</p>
      </div>

      <div class="col-md-3" style="margin: 80px;"></div>
      
  </div>
  
    </div>
	</body>
	</html>
<?php
include 'includes/footer.php';
?>