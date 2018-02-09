<?php
namespace classes\business;

use classes\entity\Forum;
use classes\entity\Job;
use classes\entity\Jobapply;
use classes\entity\Respond;
use classes\data\ForumManagerDB;


class ForumManager
{
    public static function getAllThreads(){
        return ForumManagerDB::getAllThreads();
    }
    
	public function insertForum(Forum $forum){
        ForumManagerDB::insertForum($forum);
    }
	
	public static function getResponsebyid($thread_id){
        return ForumManagerDB::getResponsebyid($thread_id);
    }
	
	public function insertRespond(Respond $respond){
        ForumManagerDB::insertRespond($respond);
    }
	
	public static function getAllJobs(){
        return ForumManagerDB::getAllJobs();
    }
	
	public static function getAllJobapply(){
        return ForumManagerDB::getAllJobapply();
    }
	
	public function insertJob(Job $job){
        ForumManagerDB::insertJob($job);
    }
	
	public function insertJobapply(Jobapply $jobapply){
        ForumManagerDB::insertJobapply($jobapply);
    }

    public function getForumById($thread_id){
        return ForumManagerDB::getForumById($thread_id);
    }	
	
	public function getApplyById($job_id){
        return ForumManagerDB::getApplyById($job_id);
    }	
		
	public function getJobById($job_id){
        return ForumManagerDB::getJobById($job_id);
    }	
		
	public static function search($title){
		Return ForumManagerDB::search($title);
		 
    }
	
	public static function searchJob($position_title, $company_name, $country){
		Return ForumManagerDB::searchJob($position_title, $company_name, $country);
		 
    }

}

?>