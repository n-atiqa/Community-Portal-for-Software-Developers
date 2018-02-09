<!-- Navigation Bar -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php 
   if(isset($_SESSION["email"]))
   {
	   if($_SESSION["role"]=='admin') {
?>

 <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" style="font-size: 25px;" href="#"><span class="glyphicon glyphicon-briefcase"></span> ABC Jobs Pte Ltd</a>
    </div>
    <ul class="nav navbar-nav navbar-right" style="font-size: 20px;">
      <li><a href="/phpcrudsample/public/modules/user/updateprofile.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
	  <li><a href="/phpcrudsample/public/modules/user/forumcategories.php"><span class="glyphicon glyphicon-comment"></span> Forum</a></li>
	  <li><a href="/phpcrudsample/public/modules/user/userlist.php"><span class="glyphicon glyphicon-user"></span> Users</a></li>
	  <li><a href="/phpcrudsample/public/modules/user/feedbacklist.php"><span class="glyphicon glyphicon-comment"></span> View Feedback</a></li>
      <li><a href="/phpcrudsample/public/contactus.php"><span class="glyphicon glyphicon-phone-alt"></span> Contact</a></li>
      <li><a href="/phpcrudsample/public/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>
<?php 
   } else
   {
?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

 <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" style="font-size: 25px;" href="#"><span class="glyphicon glyphicon-briefcase"></span> ABC Jobs Pte Ltd</a>
    </div>
    <ul class="nav navbar-nav navbar-right" style="font-size: 20px;">
      <li><a href="/phpcrudsample/public/modules/user/updateprofile.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>  
	  <li><a href="/phpcrudsample/public/modules/user/userlistsearch.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
	  <li><a href="/phpcrudsample/public/modules/user/forumcategories.php"><span class="glyphicon glyphicon-comment"></span> Forum</a></li>  
      <li><a href="/phpcrudsample/public/contactus.php"><span class="glyphicon glyphicon-phone-alt"></span> Contact</a></li>
      <li><a href="/phpcrudsample/public/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>
<?php 
   } }else
   {
?>

 <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" style="font-size: 25px;" href="#"><span class="glyphicon glyphicon-briefcase"></span> ABC Jobs Pte Ltd</a>
    </div>
    <ul class="nav navbar-nav navbar-right" style="font-size: 20px;">
      <li><a href="/phpcrudsample/public/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      <li><a href="/phpcrudsample/public/aboutus.php"><span class="glyphicon glyphicon-info-sign"></span> About</a></li>
      <li><a href="/phpcrudsample/public/contactus.php"><span class="glyphicon glyphicon-phone-alt"></span> Contact</a></li>
    </ul>
  </div>
</nav>
<?php 
   } 
?>