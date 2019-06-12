<?php
include_once("check_login_status.php");
// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
$u = $_SESSION["username"];
$sql = "SELECT name, p_num FROM users WHERE p_num='$u' LIMIT 1";
        $query = mysqli_query($db_conx, $sql);
        $row = mysqli_fetch_row($query);
		$name = $row[0];
		$phone = $row[1];
$topbuttons = '';
$compile = '';
$topbuttons .= '<input type="button" id="back" value="Back"/>';
$title = '';
$form = '';
$error = '';
$question = '';
$options = '';
$count1 = '';
$db_id = '';
$qid = '';
$posed = '';
$query2 = '';
$recepients = '';
$buttons = '';
$inserterror = '';
$results = '';

if(isset($_GET['id'])){
    $db_id .= $_GET['id'];
}else if (isset($_POST['topic'])){
    $new_topic = $_POST['topic'];
    if($new_topic == ''){
        $error = "<div id='error'><p>Survey topic cannot be blank</p></div>";
    }else{
    $sql = "INSERT INTO surveys (username, Surv_topic, status) VALUES('$phone', '$new_topic','draft')";
        $query = mysqli_query($db_conx, $sql);
        $db_id .= mysqli_insert_id($db_conx);   
}
}
if (isset($_POST['quiz'])){
    $new_quiz = $_POST['quiz'];
    $new_option1 = $_POST['option1'];
    $new_option2 = $_POST['option2'];
    $new_option3 = $_POST['option3'];
    $new_option4 = $_POST['option4'];
    $new_option5 = $_POST['option5'];
    if($new_quiz == '' || $new_option1 == '' || $new_option2 == ''){
        $error = "<div id='error'><p>You must fill atlease the survey question, option 1 and option 2</p></div>";
    }else{
    $sql4 = "INSERT INTO quiz (surv_id, quiz) VALUES('$db_id', '$new_quiz')";
        $query4 = mysqli_query($db_conx, $sql4);
        $db_qid = mysqli_insert_id($db_conx);
        $sql5 = "INSERT INTO options (quiz_id, option) VALUES('$db_qid', '$new_option1')";
        $query5 = mysqli_query($db_conx, $sql5); 
        $sql6 = "INSERT INTO options (quiz_id, option) VALUES('$db_qid', '$new_option2')";
        $query6 = mysqli_query($db_conx, $sql6);
        $sql7 = "INSERT INTO options (quiz_id, option) VALUES('$db_qid', '$new_option3')";
        $query7 = mysqli_query($db_conx, $sql7);
        $sql8 = "INSERT INTO options (quiz_id, option) VALUES('$db_qid', '$new_option4')";
        $query8 = mysqli_query($db_conx, $sql8);
        $sql9 = "INSERT INTO options (quiz_id, option) VALUES('$db_qid', '$new_option5')";
        $query9 = mysqli_query($db_conx, $sql9);
        $sql10 = "DELETE FROM options WHERE option= ''"; 
		$query10 = mysqli_query($db_conx, $sql10);
}
}
            if(isset($_GET['fn'])){ 

            $sql14 = "SELECT * FROM quiz WHERE surv_id='$db_id'";
        $query14 = mysqli_query($db_conx, $sql14);
		while ($row14 = mysqli_fetch_array($query14, MYSQLI_ASSOC)) {
		$quiz_id = $row14['quiz_id'];

                    $sql16 = "DELETE FROM options WHERE quiz_id = '$quiz_id'";
                    $query16 = mysqli_query($db_conx, $sql16); 
                    
            }
            
            $sql15 = "DELETE FROM quiz WHERE surv_id = '$db_id'";
                    $query15 = mysqli_query($db_conx, $sql15); 
    
            $sql13 = "DELETE FROM surveys WHERE surv_id = '$db_id' LIMIT 1";
                    $query13 = mysqli_query($db_conx, $sql13);
                    
            $sql17 = "DELETE FROM recepients WHERE surv_id = '$db_id'";
                    $query17 = mysqli_query($db_conx, $sql17);
                    
                    header('Location: user.php?loc=draft'); 
                }
if($db_id != ''){
 if(isset($_GET['pTableData'])){
// Unescape the string values in the JSON array
$tableData = stripcslashes($_GET['pTableData']);

// Decode the JSON array
$tableData = json_decode($tableData,TRUE);

$num_rows = count($tableData);

if($num_rows >= 1){
    for($i = 0; $i < count($tableData); $i++) {
                $mobi = $tableData[$i]['Mobile No'];
                $name1 = $tableData[$i]['Name'];
    		$sql11 = "INSERT INTO recepients (surv_id, recepient, resp_num, level) VALUES('$db_id', '$name1','$mobi','0')";
                $query11 = mysqli_query($db_conx, $sql11);
    }
    $inserterror .= $num_rows.' respondent(s) have been added. <a href="contacts1.php?id='.$db_id.'">+Add more respondants</a>';
}else {
    $inserterror .=  'No respondants inserted.'; 
    $inserterror .= ' Please select table columns to <a href="contacts1.php?id='.$db_id.'"> +Add</a>';
}
 }else {
     $inserterror .= ' <a href="contacts1.php?id='.$db_id.'">+Add respondants</a><br>';
 }
    
    $sql = "SELECT * FROM surveys WHERE username='$phone' AND surv_id = '$db_id' LIMIT 1";
        $query1 = mysqli_query($db_conx, $sql);
        $row1 = mysqli_fetch_row($query1);
		$db_id = $row1[0];
		$topic = $row1[2];
                $status = $row1[3];                       
			$title .= "<p>".$topic."</p>";
    $sql1 = "SELECT * FROM quiz WHERE surv_id='$db_id'";
        $query2 = mysqli_query($db_conx, $sql1);
        $numrows = mysqli_num_rows($query2);
        
        if($numrows >= 1 && $status == 'draft'){
            $compile .= '<a id ="compile"href = "compile.php?id='.$db_id.'">Compile questionare</a>';
        }
        if($status == 'draft'){
            $topbuttons .= '<a href="compose.php?id='.$db_id.'&fn=delete" id="delete">Delete<a/>';
         $form .="<div id='quest'>"
                 . "".$error.""
                 . "<form action='compose.php?id=".$db_id."' method='post'> "
                 . "<textarea id = 'question' name= 'quiz' placeholder='survey question'></textarea><br>"
                 . "<input type='text' name= 'option1' placeholder='option 1'/><br>"
                 . "<input type='text' name= 'option2' placeholder='option 2'/><br>"
                 . "<input type='text' name= 'option3' placeholder='option 3'/><br>"
                 . "<input type='text' name= 'option4' placeholder='option 4'/><br>"
                 . "<input type='text' name= 'option5' placeholder='option 5'/><br>"
                 . "<div id ='ending'><button id='insert'>Insert question</button> ".$compile."</div>"
                 . "</form></div>";
        }
        $numrows1 = 0;
        $sql12 = "SELECT * FROM recepients WHERE surv_id='$db_id'";
        $query12 = mysqli_query($db_conx, $sql12);
        $numrows1 = mysqli_num_rows($query12);
        
        if($numrows1 >= 1){
            $buttons .= '<div id="ending"><a id="deploy" href="send.php?surv_id='.$db_id.'">Deploy Survey</a>';
            $buttons .= '<a id="draft" href="">Save to Drafts</a>';
            $buttons .= '<a id="schedule" href="#">Schedule</a></div>';
        }
 else {$buttons .= '<div id="ending"><a id="draft" href="">Save to Drafts</a></div>';}
        $recepients .= '<ul id="resp"> <p>'.$numrows1.' respondant(s): </p>';
        while ($row12 = mysqli_fetch_array($query12, MYSQLI_ASSOC)) {
		$recepient = $row12['recepient'];
                $recepients .=  '<li>'.$recepient.'</li>';     
         }
        $recepients .= '</ul>';
}else{
    $title .= "<p>your new survey topic will come here</p>";
    $form .="<div id='topic'>"
            . "".$error.""
            . "<form action='compose.php' method='post'> <input type='text' name= 'topic' placeholder='new survey topic'/><button id='topicbutton'>Create</button></form></div>";  
}
?>