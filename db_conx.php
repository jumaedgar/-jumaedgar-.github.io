<?php
//Establishing a database connection
$db_conx = mysqli_connect('localhost', 'root', '', 'smsaces');

//Evaluating the connection
if (mysqli_connect_errno()){
	echo mysqli_connect_error();
	exit();
}
?>