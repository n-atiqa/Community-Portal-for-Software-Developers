<?php
if(!isset($_SESSION['email'])){
    header("Location:/phpcrudsample/public/login.php");
}

if(isset($_SESSION["email"])) {
if($_SESSION["account"]=='deactivate') {
//session_destroy();
header("Location:/phpcrudsample/public/accessdenied.php");

}
}
?>