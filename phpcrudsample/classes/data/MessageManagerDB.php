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
	
	
}

?>