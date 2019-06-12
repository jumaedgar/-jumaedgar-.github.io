<?php include 'composepro.php';?>
<head>
<meta charset="UTF-8">
<title>SMS/USSD CS - Compiler</title>
<script src='js/jquery-1.12.3.js'></script>
<script src='js/jquery.dataTables.min.js'></script>
<script src='js/jquery.json-2.4.min.js'></script>
<script>		
	$(document).ready(function() {
                 $('#back').on('click', function(e){				
		window.location = "javascript:history.back()";
		})
	} );
       
</script>
<link rel="stylesheet" href="rest.css">
</head>
<body>
<div id="container">
<div id="pageMiddle">
    <div id="sidebar">
        <?php include_once('pageTOP.php');?>
        <ul>
            <li><a href="contacts.php">Contacts</a></li>
            <li><a href="compose.php">Compose New</a></li>
            <li><a href="user.php">All Surveys</a></li>
            <li><a href="user.php?loc=active">Active</a></li>
            <li><a href="user.php?loc=scheduled">Scheduled</a></li>
            <li><a href="user.php?loc=finished">Finished</a></li>
            <li><a href="user.php?loc=draft">Drafts</a></li>
            <li><a href="user.php?loc=trash">Trash</a></li>
        </ul>      
    </div>
<div id = 'content'>
<div id="topLinks">
<?php echo $topbuttons;?>
</div>
    <div id="surveys">
        <?php 
        echo '<div id = "title">'.$title.'</div>';
                echo '<p id="inserterror">'.$inserterror.'</p>';
                echo $recepients;
if($query2 != ''){
    echo '<table>';
            while ($row2 = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
            $count1++;
                $qid = $row2['quiz_id'];
		$quiz = $row2['quiz'];
                echo '<tr><th>Q'.$count1 .': '.$quiz.'?</th></tr><tr><td>';
                $count2 = '';
    $sql2 = "SELECT * FROM options WHERE quiz_id='$qid'";
        $query3 = mysqli_query($db_conx, $sql2);
        while ($row3 = mysqli_fetch_array($query3, MYSQLI_ASSOC)) {
            $count2++;
		$option = $row3['option'];
                echo '<span>'.$count2 .'</span> '.$option;     
         } 
         echo '</td></tr>';
         }
         echo '</table>';
         echo $buttons;      
} 
        ?>     
    </div>
</div>
</div>
</div>
</body>
</html>
