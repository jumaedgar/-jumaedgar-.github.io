<?php
include_once("check_login_status.php");
// If user is already logged in, header that weenis away
if($user_ok == true){
header("location: user.php?u=".$_SESSION["username"]);
    exit();
}
?>
<?php
// Ajax calls this NAME CHECK code to execute
if (isset($_POST["namecheck"])) {
    $name = preg_replace('#[^a-z0-9]#i', '', $_POST['namecheck']);
    if (is_numeric($name[0])) {
        echo '<p> company name must begins with alphabet</p>';
        exit();
    } else if (strlen($name) < 3 || strlen($name) > 16) {
        echo '<p>company name must be 3-16 characters long</p>';
        exit();
    }
} else if (isset($_POST["passwordcheck"])) {
    $password = $_POST['passwordcheck'];
    if (strlen($password) < 8) {
        echo '<p>password too short ( 8 charactors and above)</p>';
        exit();
    } else if (preg_match('/(\w)\1{3,}/', $password)) {
        echo '<p>weak password (not allow 4+ repeated chars)</p>';
        exit();
    }
}

include_once("db_conx.php");

if (isset($_POST['phonecheck'])) {
    $phone = mysqli_real_escape_string($db_conx, $_POST['phonecheck']);
    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        echo '<p>invalid mobile number "' . $phone . '"</p>';
    } else {
        $sql = "SELECT user_id FROM users WHERE p_num='$phone' LIMIT 1";
        $query = mysqli_query($db_conx, $sql);
        $phone_check = mysqli_num_rows($query);
        
        if ($phone_check < 1) {
            echo '';
            exit();
        } else {
            echo '<p>\'' . $phone . '\' is already in use</p>';
            exit();
        }
    }
}
// Ajax calls this REGISTRATION code to execute
if (isset($_POST["m"])) {
// CONNECT TO THE DATABASE
    include_once("db_conx.php");
// GATHER THE POSTED DATA INTO LOCAL VARIABLES
    $m = mysqli_real_escape_string($db_conx, $_POST['m']);
    $n = preg_replace('#[^a-z0-9]#i', '', $_POST['n']);
    $p = $_POST['p'];
	$p1 = $_POST['p1'];
// DATA CHECKS FOR USERNAME AND EMAIL
    $sql = "SELECT user_id FROM users WHERE p_num='$m' LIMIT 1";
    $query = mysqli_query($db_conx, $sql);
    $m_check = mysqli_num_rows($query);
// FORM DATA ERROR HANDLING
    if ($m == "" || $n == "" || $p == "" || $p1 == "") {
        echo "<p>some values are missing.</p>";
        exit();
    } else if (is_numeric($n[0])) {
        echo '<p>company name begin with alphabets</p>';
        exit();
    } else if (strlen($n) < 3 || strlen($n) > 16) {
        echo "<p>names are 3-16 character long</p>";
        exit();
    } else if ($m_check > 0) {
        echo "<p>mobile number unavailable</p>";
        exit();
    } else if (!preg_match("/^[0-9]{10}$/", $m)) {
        echo '<p>mobile number is invalid </p>';
        exit();
    } else if (strlen($p) < 8) {
        echo '<p>your password is too short</p>';
        exit();
    } else if (preg_match('/(\w)\1{3,}/', $p)) {
        echo '<p>your password is very weak</p>';
        exit();
    } 
	else if ($p != $p1) {
        echo '<p>your passwords do not match </p>';
        exit();
    }else {
// END FORM DATA ERROR HANDLING
        // Begin Insertion of data into the database
// Hash the password and apply your own mysterious unique salt

        $p_hash = md5($p);
// Add user info into the database table for the main site table
        $sql = "INSERT INTO users (name, p_num, password, reg_date) VALUES('$n', '$m','$p_hash',now())";
        $query = mysqli_query($db_conx, $sql);
        $uid = mysqli_insert_id($db_conx);
		
		// CREATE THEIR SESSIONS AND COOKIES
		$_SESSION['userid'] = $uid;
		$_SESSION['username'] = $m;
		$_SESSION['password'] = $p_hash;
		setcookie("id", $uid, strtotime( '+30 days' ), "/", "", "", TRUE);
		setcookie("user", $m, strtotime( '+30 days' ), "/", "", "", TRUE);
		setcookie("pass", $p_hash, strtotime( '+30 days' ), "/", "", "", TRUE); 

        echo "signup_success";
        exit();
    }
    exit();
}
?>