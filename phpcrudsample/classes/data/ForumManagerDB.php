<?php
namespace classes\data;

use classes\entity\Forum;
use classes\entity\Job;
use classes\entity\Jobapply;
use classes\entity\Respond;
use classes\util\DBUtil;

class ForumManagerDB
{
    public static function fillForum($row){
        $forum=new Forum();
        $forum->thread_id=$row["thread_id"];
        $forum->title=$row["title"];
        $forum->description=$row["description"];
        $forum->date_created=$row["date_created"];
		$forum->userid=$row["userid"];
        return $forum;
    }
	
	public static function fillRespond($row){
        $respond=new Respond();
        $respond->respond_id=$row["respond_id"];
        $respond->respond=$row["respond"];
        $respond->posted=$row["posted"];
        $respond->thread_id=$row["thread_id"];
		$respond->userid=$row["userid"];
        return $respond;
    }
	
	public static function fillJob($row){
        $job=new Job();
        $job->job_id=$row["job_id"];
        $job->position_title=$row["position_title"];
        $job->company_name=$row["company_name"];
        $job->country=$row["country"];
		$job->details=$row["details"];
		$job->userid=$row["userid"];
		$job->posted_on=$row["posted_on"];
        return $job;
    }
	
	public static function fillJobapply($row){
        $jobapply=new Jobapply();
        $jobapply->jobapply_id=$row["jobapply_id"];
        $jobapply->firstname=$row["firstname"];
        $jobapply->lastname=$row["lastname"];
        $jobapply->email=$row["email"];
		$jobapply->message=$row["message"];
		$jobapply->job_id=$row["job_id"];
        return $jobapply;
    }
	
	public static function insertJobapply(Jobapply $jobapply){
        $conn=DBUtil::getConnection();
		$sql="INSERT INTO tb_jobapply(firstname, lastname, email, message, job_id) VALUES (?, ?, ?, ?, ?)"; 
		//print_r($jobapply);
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $jobapply->firstname, $jobapply->lastname, $jobapply->email,$jobapply->message, $jobapply->job_id); 
        $stmt->execute();
        if($stmt->errno!=0){
            printf("SQL Error: %s.\n",$stmt->error);
        }
        $stmt->close();
        $conn->close();		
		
	}
	
	public static function insertJob(Job $job){
        $conn=DBUtil::getConnection();
		$sql="INSERT INTO tb_job(position_title, company_name, country, details, userid, posted_on) VALUES (?, ?, ?, ?, ?, ?)"; 
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssis", $job->position_title, $job->company_name, $job->country,$job->details,$job->userid,$job->posted_on); 
        $stmt->execute();
        if($stmt->errno!=0){
            printf("SQL Error: %s.\n",$stmt->error);
        }
        $stmt->close();
        $conn->close();		
		
	}

	public static function insertRespond(Respond $respond){
        $conn=DBUtil::getConnection();
		$sql="INSERT INTO tb_threadmessage(respond, posted, thread_id, userid) VALUES (?, ?, ?, ?)"; 
		//print_r($respond);
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $respond->respond, $respond->posted, $respond->thread_id,$respond->userid); 
        $stmt->execute();
        if($stmt->errno!=0){
            printf("SQL Error: %s.\n",$stmt->error);
        }
        $stmt->close();
        $conn->close();		
		
	}
	
	public static function insertForum(Forum $forum){
        $conn=DBUtil::getConnection();
		$sql="INSERT INTO tb_thread (title, description, date_created, userid) VALUES (?, ?, ?, ?)"; 
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $forum->title, $forum->description,$forum->date_created,$forum->userid); 
        $stmt->execute();
        if($stmt->errno!=0){
            printf("SQL Error: %s.\n",$stmt->error);
        }
        $stmt->close();
        $conn->close();		
		
	}
	
	public static function getForumById($thread_id){
        $forum=NULL;
        $conn=DBUtil::getConnection();
        $id=mysqli_real_escape_string($conn,$thread_id);
        $sql="select * from tb_thread where thread_id='$thread_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $forum=self::fillForum($row);
            }
        }
        $conn->close();
        return $forum;
    }
	
	public static function getJobById($job_id){
        $job=NULL;
        $conn=DBUtil::getConnection();
        $job_id=mysqli_real_escape_string($conn,$job_id);
        $sql="select * from tb_job where job_id='$job_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $job=self::fillJob($row);
            }
        }
        $conn->close();
        return $job;
    }

    public static function getAllThreads(){
        $forums[]=array();
        $conn=DBUtil::getConnection();
        $sql="select * from tb_thread";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $forum=self::fillForum($row);
                $forums[]=$forum;
            }
        }
        $conn->close();
        return $forums;
    }
	
		public static function getApplyById($job_id){ //Display job applicants based on job id
		$jobapply[]=array();
        $jobapplys[]=array();
        $conn=DBUtil::getConnection();
        $sql="select * from tb_jobapply where job_id='$job_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $jobapply=self::fillJobapply($row);
				$jobapplys[]=$jobapply;
            }
        }
        $conn->close();
        return $jobapplys;
    }
	
		public static function getResponseById($thread_id){ //display responses made based on thread id
		$respond[]=array();
        $responds[]=array();
        $conn=DBUtil::getConnection();
        $sql="select * from tb_threadmessage where thread_id='$thread_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $respond=self::fillRespond($row);
				$responds[]=$respond;
            }
        }
        $conn->close();
        return $responds;
    }
	
	    public static function getAllJobs(){
        $jobs[]=array();
        $conn=DBUtil::getConnection();
        $sql="select * from tb_job";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $job=self::fillJob($row);
                $jobs[]=$job;
            }
        }
        $conn->close();
        return $jobs;
    }
	
		public static function getAllJobapply(){
        $jobs[]=array();
        $conn=DBUtil::getConnection();
        $sql="select * from tb_jobapply";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $job=self::fillJobapply($row);
                $jobs[]=$job;
            }
        }
        $conn->close();
        return $jobs;
    }
	
		public static function searchJob($position_title, $company_name, $country){
        $jobs[]=array();
        $conn=DBUtil::getConnection();
		$position_title=mysqli_real_escape_string($conn,$position_title);
		$company_name=mysqli_real_escape_string($conn,$company_name);
		$country=mysqli_real_escape_string($conn,$country);
        $sql="select * from tb_job WHERE position_title LIKE '%$position_title%' AND company_name LIKE '%$company_name%' AND country LIKE '%$country%'";
		//echo $title;
        $queryResult = $conn->query($sql); 
        if ($queryResult->num_rows > 0) {
            while($row = $queryResult->fetch_assoc()){
                $job=self::fillJob($row);
                $jobs[]=$job;
            }
        } 
		else {echo "No results"; }
		
        $conn->close();
        return $jobs;
    }
	
		
	    public static function search($title){
        $forums[]=array();
        $conn=DBUtil::getConnection();
		$title=mysqli_real_escape_string($conn,$title);
        $sql="select * from tb_thread WHERE title LIKE '%$title%'";
		//echo $title;
        $queryResult = $conn->query($sql); 
        if ($queryResult->num_rows > 0) {
            while($row = $queryResult->fetch_assoc()){
                $forum=self::fillForum($row);
                $forums[]=$forum;
            }
        } 
		else {echo "No results"; }
		
        $conn->close();
        return $forums;
    }
		
}

?>