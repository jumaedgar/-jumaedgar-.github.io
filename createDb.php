 <?php
//Establishing a database connection
$db_conx = mysqli_connect('localhost', 'root', '');

// Evaluating the connection
if ($db_conx->connect_error) {
    die("Connection failed: " . $db_conx->connect_error);
}
// Create database
$sql = "CREATE DATABASE smsaces";
if ($db_conx->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: ";
}
?> 