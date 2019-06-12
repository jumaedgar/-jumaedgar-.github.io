<?php include 'composepro.php';?>
<head>
<meta charset="UTF-8">
<title>SMS/USSD CS - Compose</title>
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
<style>
#quest, #topic{
       margin-top: 30px;
       padding: 0 50px;
    }
#topic{
     margin-top: 50px;
     padding: 0;
     width: 650px;
    }
#quest textarea, #quest input[type=text], #topic input[type=text]{
    font-family: "Roboto", sans-serif;
    padding: 10px 20px;
    margin: 6px 0;
    font-size: 18px;
    box-sizing: border-box;
    background-color:#ff702263;
    color: #fff;
    border: 0;
    border-radius: 3px;
}
#quest textarea, #quest input[type=text]{
    width: 100%;
}
#topic input[type=text]{
    width: 545px;
    margin: 1px 5px 0 0;
}
#quest textarea:focus, #quest input[type=text]:focus,#topic input[type=text]:focus {
    background-color: #000;
}
#topic #topicbutton{
    padding: 11px 20px;
    font-size: 15px;
    border-radius: 5px; 
    border: solid 2px #003333;
    background-color: #fff;
    color: #003333;
    cursor: pointer;
}
#topic #topicbutton:hover{ 
    border: solid 2px #003333;
    background-color: #003333;
    color: #fff;
    cursor: pointer;
}
</style>
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
            echo $recepients;
if($query2 != ''){   
    echo '<table>';
            while ($row2 = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
            $count1++;
                $qid = $row2['quiz_id'];
		$quiz = $row2['quiz'];
                if($status == 'finished' || $status == 'active'){
                $results = '<th rowspan = "2"><a href="doughnut-chart-with-index-label.php?qid='.$qid.'&total_resp='.$numrows1.'"><img src="results.png" alt="View Results" style="width:48px;height:48px;"></a></th>';
                }
                echo '<tr><th>Q'.$count1 .': '.$quiz.'?</th>'.$results.'</tr><tr><td>';               
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
} 
         echo $form;
        ?>
</div>
</div>
</div>
</div>
</body>
</html>
