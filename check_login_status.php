<?php
session_start();
include_once("db_conx.php");
// Files that inculde this file at the very top would NOT require 
// connection to database or session_start(), be careful.
// Initialize some vars
$user_ok = false;
$log_id = "";
$log_username = "";
$log_password = "";
// User Verify function
function evalLoggedUser($conx,$id,$u,$p){
$sql = "SELECT * FROM users WHERE user_id='$id' AND p_num='$u' AND password='$p' LIMIT 1";
    $query = mysqli_query($conx, $sql);
    $numrows = mysqli_num_rows($query);
if($numrows > 0){
return true;
}
}
if(isset($_SESSION["userid"]) && isset($_SESSION["username"]) && isset($_SESSION["password"])) {
$log_id = preg_replace('#[^0-9]#', '', $_SESSION['userid']);
$log_username = mysqli_real_escape_string($db_conx, $_SESSION['username']);
$log_password = preg_replace('#[^a-z0-9]#i', '', $_SESSION['password']);
// Verify the user
$user_ok = evalLoggedUser($db_conx,$log_id,$log_username,$log_password);
} else if(isset($_COOKIE["id"]) && isset($_COOKIE["user"]) && isset($_COOKIE["pass"])){
$_SESSION['userid'] = preg_replace('#[^0-9]#', '', $_COOKIE['id']);
    $_SESSION['username'] = mysqli_real_escape_string($db_conx, $_COOKIE['user']);
    $_SESSION['password'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['pass']);
$log_id = $_SESSION['userid'];
$log_username = $_SESSION['username'];
$log_password = $_SESSION['password'];
// Verify the user
$user_ok = evalLoggedUser($db_conx,$log_id,$log_username,$log_password);
if($user_ok == true){

}
}
?>