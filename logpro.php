<?php
include_once("check_login_status.php");
// If user is already logged in, header that weenis away
if($user_ok == true){
header("location: user.php?u=".$_SESSION["username"]);
    exit();
}
?>
<?php
// AJAX CALLS THIS LOGIN CODE TO EXECUTE
if(isset($_POST["u"])){
// CONNECT TO THE DATABASE
include_once("db_conx.php");
// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
$u = mysqli_real_escape_string($db_conx, $_POST['u']);
$p = md5($_POST['lp']);

// FORM DATA ERROR HANDLING
if($u == "" || $p == ""){
echo "login_failed";
        exit();
} else {
// END FORM DATA ERROR HANDLING
$sql = "SELECT user_id, p_num, password FROM users WHERE p_num='$u' LIMIT 1";
        $query = mysqli_query($db_conx, $sql);
        $row = mysqli_fetch_row($query);
		$numrows = mysqli_num_rows($query);
$db_id = $row[0];
$db_username = $row[1];
        $db_pass_str = $row[2];
		if($numrows < 1){
		echo "not_exists";
            exit();
		}
else if($p != $db_pass_str){
echo "login_failed";
            exit();
} else {
// CREATE THEIR SESSIONS AND COOKIES
$_SESSION['userid'] = $db_id;
$_SESSION['username'] = $db_username;
$_SESSION['password'] = $db_pass_str;
setcookie("id", $db_id, strtotime( '+30 days' ), "/", "", "", TRUE);
setcookie("user", $db_username, strtotime( '+30 days' ), "/", "", "", TRUE);
    setcookie("pass", $db_pass_str, strtotime( '+30 days' ), "/", "", "", TRUE); 

echo $db_username;
   exit();
}
}
exit();
}
?>