<?php
namespace classes\business;

use classes\entity\Feedback;
use classes\data\FeedbackManagerDB;

class FeedbackManager
{
    public static function getAllFeedback(){
        return FeedbackManagerDB::getAllFeedback();
    }
    public function getFeedbackByEmail($email){
        return FeedbackManagerDB::getFeedbackByEmail($email);
    }
    public function deleteFeedback($id){
        return FeedbackManagerDB::deleteFeedback($id);
    }	
    public function insertFeedback(Feedback $feedback){
        FeedbackManagerDB::insertFeedback($feedback);
    }
	
	public function deleteAccount($id){
        FeedbackManagerDB::deleteAccount($id);
    }

}

?>