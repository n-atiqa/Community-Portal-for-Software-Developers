<?php
namespace classes\business;


use classes\entity\Message;
use classes\entity\Reply;
use classes\data\MessageManagerDB;


class MessageManager
{
   	public function insertMessage(Message $message){
        MessageManagerDB::insertMessage($message);
    }
	
	public function getSentById($from_id){
        return MessageManagerDB::getSentById($from_id);
    }
   
   	public function getReceiveById($to_id){
        return MessageManagerDB::getReceiveById($to_id);
    }
	
	public function getMessageById($message_id){
        return MessageManagerDB::getMessageById($message_id);
    }
	
	public static function getReplyById($message_id){
        return MessageManagerDB::getReplyById($message_id);
    }
	
	public function insertReply(Reply $reply){
        MessageManagerDB::insertReply($reply);
    }
	
}

?>