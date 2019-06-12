    <?php
    include_once("check_login_status.php");
    // Reads the variables sent via POST from our gateway
    $sessionId   = $_POST["sessionId"];
    $serviceCode = $_POST["serviceCode"];
    $phoneNumber = $_POST["phoneNumber"];
    $text        = $_POST["text"];
    
    $sql = "SELECT surv_id, level FROM recepients WHERE resp_num='$phoneNumber'";
        $query = mysqli_query($db_conx, $sql);
        $row = mysqli_fetch_row($query);
	$numrows = mysqli_num_rows($query);
        $surv_id = $row[0];
        $level = $row[1];
        
      if($numrows < 1){
		$response = "END You are not a respondant to any active surveys";
                }
      else {
        $sql1 = "SELECT quiz_id, quiz FROM quiz WHERE surv_id='$surv_id'";
        $query1 = mysqli_query($db_conx, $sql1);
        $row1 = mysqli_fetch_row($query1);
	$numrows1 = mysqli_num_rows($query1);
        
        if($level == $numrows1){
                $response = "END You have completed the survey. Thank you for participating";
                }
        else{
        header('Content-type: text/plain');
            $count = '';            
            while ($row1 = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
            $count++;               
                if($count == $level+1){
                    $qid = $row1[0];
                    $quiz = $row1[1];
                    $quiz_num = $level+1;
                    $response .= 'CON Q'.$quiz_num.'/'.$numrows1.': '.$quiz;
                }
                $count1 = '';
            $sql2 = "SELECT * FROM options WHERE quiz_id='$qid'";
                $query2 = mysqli_query($db_conx, $sql2);
                while ($row2 = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
                    $count1++;
                        $option = $row2['option'];
                       $response .='\n'.$count1.'. '.$option;     
                 } 
         }
         
        if($text == ''){
                // Print the response onto the page so that USSD gateway can read it            
                echo $response;
                // DONE!!!
        }else if($text > $count1 || $text < 1){
            echo $error = 'Invalid choice. Try again \n';
            echo $response;
        }else{
            $count2 = '';
            while ($row2 = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
                    $count2++;
                    if($count2 == $text ){ 
                        $option_id = $row2['option_id'];
                        $option_count = $row2['count'];
                        $newcount = $option_count + 1;
                        $sql = "UPDATE option SET count='$newcount' WHERE option_id= '$option_id'"; 
                        $query = mysqli_query($db_conx, $sql);
                    }    
                 }
                $count = '';            
            while ($row1 = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
            $count++;               
                if($count == $level+2){
                    $qid = $row1[0];
                    $quiz = $row1[1];
                    $quiz_num = $level+1;
                    $response .= 'CON Q'.$quiz_num.'/'.$numrows1.': '.$quiz;
                }
                $count1 = '';
            $sql2 = "SELECT * FROM options WHERE quiz_id='$qid'";
                $query2 = mysqli_query($db_conx, $sql2);
                while ($row2 = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
                    $count1++;
                        $option = $row2['option'];
                       $response .='\n'.$count1.'. '.$option;     
                 } 
         } 
         echo $response;
        }           
        }
      }
    ?>