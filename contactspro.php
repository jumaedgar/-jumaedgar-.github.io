<?php
include_once("check_login_status.php");
// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
$u = $_SESSION["username"];
$sql = "SELECT name, p_num FROM users WHERE p_num='$u' LIMIT 1";
        $query = mysqli_query($db_conx, $sql);
        $row = mysqli_fetch_row($query);
		$name = $row[0];
		$phone = $row[1];		
                
            $contacts = '';
            $topbuttons = '';
            $topbuttons .= '<input type="button" id="back" value="Back"/>';
            $error = '';
            $message = '';
            $insertbutton = '';
            if(isset($_GET['id'])){
                $surv_id = $_GET['id']; 
                $insertbutton .= '<tr><td colspan = "4"><input type="button" id="insert" style="background-color: Green; border: 0; color: #fff;" class="ok" value="Insert Respondents"/></td></tr>';
            }
if(isset($_POST['btnImport'])){
    if(!empty($_FILES['excelFile']['tmp_name'])){
        $fileName = explode('.',$_FILES['excelFile']['name']);
        if($fileName[1]=='csv'){
            $file = $_FILES['excelFile']['tmp_name'];
            $openFile = fopen($file,'r');
            $number = 0;          
            while($dataFile=fgetcsv($openFile,3000,',')){
                $number++;
                $cname = $dataFile[0];
                $mobile = $dataFile[1];
                $group = $dataFile[2];               
    
                if($number != 1){
                    $sql = "INSERT INTO contacts (username, cont_name, cont_num, cont_group) VALUES('$phone', '$cname','$mobile','$group')";
                    $query = mysqli_query($db_conx, $sql);
                }
            }
            $number = $number-1;
            $message = '<div id="error"><p>'.$number. ' Contact(s) added successfully.</p></div>';
        }else{
            $error .= '<div id="error"><p>Choose a .csv file to upload</p></div>';
        }
    }else{
        $error .= '<div id="error"><p>Choose a file to upload!!!!</p></div>';
    }
}

$sql = "SELECT * FROM contacts WHERE username='$phone'";
        $query1 = mysqli_query($db_conx, $sql);
        $number = 1;
        $title = '';
		$numrows = mysqli_num_rows($query1);
		if ($numrows < 1) {
		 $title .= "<div id='lead'><p>0 contacts found</p></div>";
		} else {
                        $topbuttons .= '<input type="button" id="delete" class="ok" value="DELETE"/>';
			$contacts .=  '<table id="table"><thead>
		  <tr>
                        <th>No.</th>
			<th>Name</th>
			<th>Mobile No.</th>
			<th>Group</th>
		  </tr></thead><tbody>';
		while ($row1 = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
		$no = $number++;
		$nme = $row1["cont_name"];
		$mob = $row1["cont_num"];
                $grp = $row1["cont_group"];
		
			$contacts .= '<tr>
			<td>' .$no.'</td>
			<td>'.$nme.'</td>
			<td>'.$mob.'</td>
			<td>'.$grp.'</td>
		  </tr>';
		}
                $contacts .= $insertbutton;
		$contacts .= '</tbody></table>';
                }
 $delmessage = '';
 if(isset($_GET['pTableData'])){
// Unescape the string values in the JSON array
$tableData = stripcslashes($_GET['pTableData']);

// Decode the JSON array
$tableData = json_decode($tableData,TRUE);

$num_rows = count($tableData);

if($num_rows >= 1){
    $delmessage .=  $num_rows .' contact(s) have been deleted';
}
for($i = 0; $i < count($tableData); $i++) {
                $mobi = $tableData[$i]['Mobile No'];
    		$sql = "DELETE FROM contacts WHERE cont_num= '$mobi'"; 
		$query = mysqli_query($db_conx, $sql);
    }
 }
?>