<?php
namespace classes\data;

use classes\entity\User;
use classes\util\DBUtil;

class UserManagerDB
{
    public static function fillUser($row){
        $user=new User();
        $user->id=$row["id"];
        $user->firstName=$row["firstname"];
        $user->lastName=$row["lastname"];
        $user->email=$row["email"];
		$user->companyName=$row["companyname"];
		$user->city=$row["city"];
		$user->country=$row["country"];
        $user->password=$row["password"];		
		$user->account_creation_time = $row["account_creation_time"];
		$user->role=$row["role"];
        $user->account=$row["account"];
        return $user;
    }
    public static function getUserByEmailPassword($email,$password){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $email=mysqli_real_escape_string($conn,$email);
        $password=mysqli_real_escape_string($conn,$password);
        $sql="select * from tb_user where email='$email' and password='$password'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
            }
        }
        $conn->close();
        return $user;
    }
    public static function getUserByEmail($email){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $email=mysqli_real_escape_string($conn,$email);
        $sql="select * from tb_user where Email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
            }
        }
        $conn->close();
        return $user;
    }
	
	public static function getUserById($id){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $id=mysqli_real_escape_string($conn,$id);
        $sql="select * from tb_user where id='$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
            }
        }
        $conn->close();
        return $user;
    }
	
    public static function saveUser(User $user){
        $conn=DBUtil::getConnection();
        $sql="call procSaveUser(?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssssssss", $user->id,$user->firstName, $user->lastName, $user->email, $user->companyName, $user->country, $user->city, $user->password, $user->account_creation_time, $user->role, $user->account); 
        $stmt->execute();
        if($stmt->errno!=0){
            printf("Error: %s.\n",$stmt->error);
        }
        $stmt->close();
        $conn->close();
    }
    public static function updatePassword($email,$password){
        $conn=DBUtil::getConnection();
        $sql="UPDATE tb_user SET password='$password' WHERE email='$email';";
        $stmt = $conn->prepare($sql);
		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
		$conn->close();

    }	
	
	    public static function updateuser($id,$role){
        $conn=DBUtil::getConnection();
        $sql="UPDATE tb_user SET role='$role' WHERE id='$id';";
        $result = $conn->query($sql);
		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully"." . sql : ".$sql;
		} else {
			echo "Error updating record: " . $conn->error." . sql : ".$sql;
		}
		$conn->close();

    }	

	    public static function updateaccount($id,$account){ //edit account active or deactivate
        $conn=DBUtil::getConnection();
        $sql="UPDATE tb_user SET account='$account' WHERE id='$id';";
        $result = $conn->query($sql);
		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error." . sql : ".$sql;
		}
		$conn->close();

    }	
	
	
    public static function deleteAccount($id){
        $conn=DBUtil::getConnection();
        $sql="DELETE from tb_user WHERE id='$id';";
        $stmt = $conn->prepare($sql);
		if ($conn->query($sql) === TRUE) {
			echo "<script>alert(Record deleted successfully)</script>";
		} else {
			echo "Error updating record: " . $conn->error;
		}
		$conn->close();

    }		
    public static function getAllUsers(){
        $users[]=array();
        $conn=DBUtil::getConnection();
        $sql="select * from tb_user";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
                $users[]=$user;
            }
        }
        $conn->close();
        return $users;
    }
			
	    public static function search($firstName, $lastName, $companyName, $city, $country){
        $users[]=array();
        $conn=DBUtil::getConnection();
		$firstName=mysqli_real_escape_string($conn,$firstName);
		$lastName=mysqli_real_escape_string($conn,$lastName);
		$companyName=mysqli_real_escape_string($conn,$companyName);
		$city=mysqli_real_escape_string($conn,$city);
		$country=mysqli_real_escape_string($conn,$country);
        $sql="select * from tb_user WHERE firstName LIKE '%$firstName%' AND lastName LIKE '%$lastName%' AND companyName LIKE '%$companyName%' AND city LIKE '%$city%' AND country LIKE '%$country%'";
		//echo $firstName;
        $queryResult = $conn->query($sql); 
        if ($queryResult->num_rows > 0) {
            while($row = $queryResult->fetch_assoc()){
                $user=self::fillUser($row);
                $users[]=$user;
            }
        } 
		else {echo "No results"; }
		
        $conn->close();
        return $users;
    }
	
	    public static function viewAccount($id){
        $conn=DBUtil::getConnection();
        $sql="SELECT from tb_user WHERE id='$id';";
        $result = $conn->query($sql);
		if ($conn->query($sql) === TRUE) {
			echo "User Profile";
		} else {
			echo "Error viewing record: " . $conn->error;
		}
		$conn->close();

    }
	
	
}

?>