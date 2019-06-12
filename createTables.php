<?php
// Set up a connection to the database
include_once ('db_conx.php');

// Create table users
$tbl_users = "CREATE TABLE IF NOT EXISTS users(
		user_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(255) NOT NULL,
		p_num VARCHAR(100) NOT NULL,
		password VARCHAR(255) NOT NULL,
		reg_date TIMESTAMP
		)";
		
		//Executing the table against the database
		$query = mysqli_query($db_conx, $tbl_users);
		
		//Evaluating table execution
		if ($query === TRUE){
			echo 'users table created OK :)<br>';		
		}else {
			echo 'users table NOT created :(<br>';
		}

		// Create table contacts
$tbl_contacts = "CREATE TABLE IF NOT EXISTS contacts(
		cont_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,	
		username VARCHAR(100) NOT NULL,		
		cont_name VARCHAR(255) NOT NULL,
		cont_num VARCHAR(100) NOT NULL,
		cont_group VARCHAR(255)
		)";
		
		//Executing the table against the database
		$query = mysqli_query($db_conx, $tbl_contacts);
		
		//Evaluating table execution
		if ($query === TRUE){
			echo 'contacts table created OK :)<br>';		
		}else {
			echo 'contacts table NOT created :(<br>';
		}
                
                		// Create table recepients
$tbl_recepients = "CREATE TABLE IF NOT EXISTS recepients(
		resp_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,	
                surv_id VARCHAR(100) NOT NULL,	
		recepient VARCHAR(255) NOT NULL,
		resp_num VARCHAR(100) NOT NULL,
		level VARCHAR(255)
		)";
		
		//Executing the table against the database
		$query = mysqli_query($db_conx, $tbl_recepients);
		
		//Evaluating table execution
		if ($query === TRUE){
			echo 'recepients table created OK :)<br>';		
		}else {
			echo 'recepients table NOT created :(<br>';
		}

		// Create table surveys
$tbl_surveys = "CREATE TABLE IF NOT EXISTS surveys(
		surv_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,	
		username VARCHAR(100) NOT NULL,		
		Surv_topic VARCHAR(255) NOT NULL,
                Status VARCHAR(100)
		)";
		
		//Executing the table against the database
		$query = mysqli_query($db_conx, $tbl_surveys);
		
		//Evaluating table execution
		if ($query === TRUE){
			echo 'surveys table created OK :)<br>';		
		}else {
			echo 'surveys table NOT created :(<br>';
		}

		// Create table quiz
$tbl_quiz = "CREATE TABLE IF NOT EXISTS quiz(
		quiz_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,	
		surv_id INT(11) NOT NULL,		
		quiz VARCHAR(1000) NOT NULL
		)";
		
		//Executing the table against the database
		$query = mysqli_query($db_conx, $tbl_quiz);
		
		//Evaluating table execution
		if ($query === TRUE){
			echo 'quiz table created OK :)<br>';		
		}else {
			echo 'quiz table NOT created :(<br>';
		}

		// Create table options
$tbl_options = "CREATE TABLE IF NOT EXISTS options(
	option_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,	
		quiz_id INT(11) NOT NULL,		
		option VARCHAR(255) NOT NULL,
		count INT(11) NOT NULL
		)";
		
		//Executing the table against the database
		$query = mysqli_query($db_conx, $tbl_options);
		
		//Evaluating table execution
		if ($query === TRUE){
			echo 'options table created OK :)<br>';		
		}else {
			echo 'options table NOT created :(<br>';
		}

		?>