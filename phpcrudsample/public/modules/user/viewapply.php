<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\ForumManager;
use classes\entity\Jobapply;
use classes\business\Validation;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
session_regenerate_id(TRUE);

$_SESSION['job_id'] = $_GET['job_id'];


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

		$FM=new ForumManager();
		$jobapplys=$FM->getApplyById($job_id);
		//print_r($jobs);
	  }

	if(isset($jobapplys)){
		?>
		<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
		<form class="pure-form" method="post" action="jobopp.php">
		<fieldset>
			<h2>Search Form</h2>

			<input type="text" placeholder="Position Title" name="position_title" required>
			<input type="text" placeholder="Company Name" name="company_name" required>
			<input type="text" placeholder="Country" name="country" required>

			<button type="submit" class="pure-button pure-button-primary" name="submitted">Search</button> <a href='newjob.php'>Post Job</a>
		</fieldset>
	</form>
		<table class="pure-table pure-table-bordered" width="800">
				<tr>
				<thead>
				 
				   
				   <th><b>Position Title</b></th>      
				  <th><b>Company Name</b></th> 
				   <th><b>Country</b>			   
				   <th><b>Posted By</b>
				   <th><b>Posted On</b>
				   <th><b>View</b>
				   </thead>
				</tr>    
		<?php 

		foreach ($jobapplys as $jobapply) {
			if($jobapply!=null){
				?>
				<tr>
				   
				   
				   <td><?=$jobapply->firstname?></td>
				   <td><?=$jobapply->lastname?></td>

							   <td>
						<a href='viewjob.php?job_id=<?php echo $job->job_id ?>'>View</a>
						
				   </td>

				</tr>
				<?php 
			}
		}
		?>
		</table><br/><br/>
		<?php 
	}
?>



<?php
include '../../includes/footer.php';
?>