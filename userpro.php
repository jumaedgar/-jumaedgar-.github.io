<?php
include_once("check_login_status.php");
// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
$u = $_SESSION["username"];
$sql = "SELECT name, p_num FROM users WHERE p_num='$u' LIMIT 1";
        $query = mysqli_query($db_conx, $sql);
        $row = mysqli_fetch_row($query);
		$name = $row[0];
		$phone = $row[1];		
                
            $surveys = '';
            $topbuttons = '';
            $topbuttons .= '<input type="button" id="back" value="Back"/>';
            $location = '';
            $statement = '';
            $active = '';
            $scheduled = '';
            $finished = '';
            $draft = '';
            $trash = '';
            $all = '';

if(isset($_GET['loc'])){
    $location .= $_GET['loc'];
    $statement .= "status = '".$location."'";
    if($location == 'active'){
        $active .= 'class="active"';
    }else if($location == 'scheduled'){
        $scheduled .= 'class="active"';
    }else if($location == 'finished'){
        $finished .= 'class="active"';
    }else if($location == 'draft'){
        $draft .= 'class="active"';
    }else if($location == 'trash'){
        $trash .= 'class="active"';
    }
}else{
    $statement .= "status != 'trash' AND status != 'draft'";
    $all .= 'class="active"';
}
$sql = "SELECT * FROM surveys WHERE username='$phone' AND $statement";
        $query1 = mysqli_query($db_conx, $sql);
        $empty = '';        
		$numrows = mysqli_num_rows($query1);
		if ($numrows < 1) {
		 $empty .= "<div id='lead'><p>There are no survey to display.<br></p></div>";
		} else {
                        $topbuttons .= '<input type="button" id="delete" class="ok" value="DELETE"/>';
			$surveys .=  '<table id="table"><tbody>';
		while ($row1 = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
		$surv = $row1["Surv_topic"];
                $id = $row1["surv_id"];
                
                $sql1 = "SELECT * FROM quiz WHERE surv_id='$id'";
                $query2 = mysqli_query($db_conx, $sql1);
                $numrows1 = mysqli_num_rows($query2);
                
                $sql2 = "SELECT * FROM recepients WHERE surv_id='$id'";
                $query3 = mysqli_query($db_conx, $sql2);
                $numrows2 = mysqli_num_rows($query3);
		
			$surveys .= '<tr>
                        <td>'.$id.'</td>
			<td>'.$surv.' (Qs.'.$numrows1.')</td>
                        <td>Rs'.$numrows2.'</td>
                        <td><a href= "compose.php?id='.$id.'"> <img src="open.png" alt="open" style="width:48px;height:48px;"> </a></td>
		  </tr>';
		}
		$surveys .= '</tbody></table>';
                }
 $delmessage = '';
 if(isset($_GET['pTableData'])){
// Unescape the string values in the JSON array
$tableData = stripcslashes($_GET['pTableData']);

// Decode the JSON array
$tableData = json_decode($tableData,TRUE);

$num_rows = count($tableData);

if($num_rows >= 1){
    $delmessage .=  $num_rows .' survey(s) have been moved to trash';
}
for($i = 0; $i < count($tableData); $i++) {
                $topic = $tableData[$i]['Topic'];
                $no = $tableData[$i]['No'];
              if($location == 'trash'){
                 $sql14 = "SELECT * FROM quiz WHERE surv_id='$no'";
                 $query14 = mysqli_query($db_conx, $sql14);
		while ($row14 = mysqli_fetch_array($query14, MYSQLI_ASSOC)) {
                    $quiz_id = $row14['quiz_id'];

                    $sql16 = "DELETE FROM options WHERE quiz_id = '$quiz_id'";
                    $query16 = mysqli_query($db_conx, $sql16); 
                    
            }
            
            $sql15 = "DELETE FROM quiz WHERE surv_id = '$no'";
                    $query15 = mysqli_query($db_conx, $sql15); 
    
            $sql13 = "DELETE FROM surveys WHERE surv_id = '$no' LIMIT 1";
                    $query13 = mysqli_query($db_conx, $sql13);
                    
            $sql17 = "DELETE FROM recepients WHERE surv_id = '$no'";
                    $query17 = mysqli_query($db_conx, $sql17);
                    
                }else{
                $sql = "UPDATE surveys SET status='trash' WHERE Surv_topic= '$topic' AND username = '$phone'"; 
		$query = mysqli_query($db_conx, $sql);
                }
    }
 }
?>