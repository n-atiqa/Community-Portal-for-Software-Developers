<?php
namespace classes\data;

use classes\entity\Message;
use classes\entity\Reply;
use classes\util\DBUtil;

class MessageManagerDB
{
    public static function fillMessage($row){
        $message=new Message();
        $message->message_id=$row["message_id"];
        $message->from_id=$row["from_id"];
        $message->to_id=$row["to_id"];
        $message->subject=$row["subject"];
		$message->content=$row["content"];
		$message->time_sent=$row["time_sent"];
        return $message;
    }
	
	public static function fillReply($row){
        $reply=new Reply();
        $reply->reply_id=$row["reply_id"];
        $reply->from_id=$row["from_id"];
        //$reply->to_id=$row["to_id"];
        $reply->content=$row["content"];
		$reply->message_id=$row["message_id"];
		$reply->time_sent=$row["time_sent"];
        return $reply;
    }
	
	public static function insertMessage(Message $message){ //insert into db then can display in sent  remember array
        $conn=DBUtil::getConnection();
		$sql="INSERT INTO tb_message(from_id, to_id, subject, content, time_sent) VALUES (?, ?, ?, ?, ?)"; 
		//print_r($message);
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisss", $message->from_id, $message->to_id, $message->subject,$message->content,$message->time_sent); 
        $stmt->execute();
        if($stmt->errno!=0){
            printf("SQL Error: %s.\n",$stmt->error);
        }
        $stmt->close();
        $conn->close();		
		
	}
	
	public static function insertReply(Reply $reply){ //insert into reply db 
        $conn=DBUtil::getConnection();
		$sql="INSERT INTO tb_replymessage(from_id, content, message_id, time_sent) VALUES (?, ?, ?, ?)"; 
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isis", $reply->from_id, $reply->content, $reply->message_id, $reply->time_sent); 
        $stmt->execute();
        if($stmt->errno!=0){
            printf("SQL Error: %s.\n",$stmt->error);
        }
        $stmt->close();
        $conn->close();		
		
	}
	
	public static function getSentById($from_id){ //Display sent messages based on fromid so current user
        $message[]=array();
		$messages[]=array();
        $conn=DBUtil::getConnection();
        $sql="select * from tb_message where from_id='$from_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $message=self::fillMessage($row);
				$messages[]=$message;
            }
        }
        $conn->close();
        return $messages;
    }
	
	public static function getReceiveById($to_id){ //Display receive messages based on to id so current user viewing inbox
        $message[]=array();
		$messages[]=array();
        $conn=DBUtil::getConnection();
        $sql="select * from tb_message where to_id='$to_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $message=self::fillMessage($row);
				$messages[]=$message;
            }
        }
		else {echo "No results"; } //added
		
        $conn->close();
        return $messages;
    }
	
	public static function getMessageById($message_id){
        $message=NULL;
        $conn=DBUtil::getConnection();
        $message_id=mysqli_real_escape_string($conn,$message_id);
        $sql="select * from tb_message where message_id='$message_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $message=self::fillMessage($row);
            }
        }
		else {echo "No results"; }//added
		
        $conn->close();
        return $message;
    }
	
	public static function getReplyById($message_id){ //display reply made based on message id
        $replies[]=array();
        $conn=DBUtil::getConnection();
        $sql="select * from tb_replymessage where message_id='$message_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $reply=self::fillReply($row); 
				$replies[]=$reply;
            } //else {echo "Error updating record: ";}
        }
        $conn->close();
        return $replies;
    }
	
	/*public static function fillRespond($row){
        $respond=new Respond();
        $respond->id=$row["id"];
        $respond->respond=$row["respond"];
        $respond->posted=$row["posted"];
        $respond->thread_id=$row["thread_id"];
		$respond->userid=$row["userid"];
        return $respond;
    }*/
	
	/*public static function fillJob($row){
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
	

	
	/*    public static function viewAccount($id){
        $conn=DBUtil::getConnection();
        $sql="SELECT from tb_user WHERE id='$id';";
        $result = $conn->query($sql);
		if ($conn->query($sql) === TRUE) {
			echo "User Profile";
		} else {
			echo "Error viewing record: " . $conn->error;
		}
		$conn->close();

    }*/
	
	
	
}

?>