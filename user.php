<?php include 'userpro.php';?>
<head>
<meta charset="UTF-8">
<title>SMS/USSD CS - Home</title>
<script src='js/jquery-1.12.3.js'></script>
<script src='js/jquery.dataTables.min.js'></script>
<script src='js/jquery.json-2.4.min.js'></script>
<script>		
	$(document).ready(function() {
    var table = $('#example').DataTable();
 
    $('#table tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
		var value=$(this).find('td:first').html();
    } );
	
	
 
    $('#delete').on('click', function(e){				
		var TableData;
		function storeTblValues()
		{
			var TableData = new Array();
			$('#table tr.selected').each(function(row, tr){
				TableData[row]={
					"No" : $(tr).find('td:eq(0)').text()
					, "Topic" : $(tr).find('td:eq(1)').text()
				}    
			}); 
			return TableData;
		}
		
		TableData = $.toJSON(storeTblValues());	
		
		window.location = "user.php?loc=<?php echo $location;?>&pTableData=" + TableData;
		
		})
                
                $('#back').on('click', function(e){				
		window.location = "javascript:history.back()";
		})
	} );
		</script>
                <link rel="stylesheet" href="rest.css">
<style>
#contacts{
      padding-top: 20px;
    }
#lead{
     padding: 20px;
    }
#lead p{
    color:#666666;
    text-align: center;
    }
table {
	margin-top: 10px;
	margin-bottom: 10px;
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        font-size: 16px;
}
td{
    cursor: pointer;
    border-top: 1px solid #dddddd;
    border-bottom: 1px solid #dddddd;
    text-align: left;
    padding: 0 12px;
}
.selected{
    background-color: #ddd;
}
</style>
</head>
<body>
<div id="container">
<div id="pageMiddle">
    <div id="sidebar">
        <?php include_once('pageTOP.php');?>
        <ul>
            <li><a href="contacts.php">Contacts</a></li>
            <li><a href="compose.php">Compose New</a></li>
            <li <?php echo $all; ?> ><a href="user.php">All Surveys</a></li>
            <li <?php echo $active; ?>><a href="user.php?loc=active">Active</a></li>
            <li <?php echo $scheduled; ?>><a href="user.php?loc=scheduled">Scheduled</a></li>
            <li <?php echo $finished; ?>><a href="user.php?loc=finished">Finished</a></li>
            <li <?php echo $draft; ?>><a href="user.php?loc=draft">Drafts</a></li>
            <li <?php echo $trash; ?>><a href="user.php?loc=trash">Trash</a></li>
        </ul>      
    </div>
<div id = 'content'> 
    <div id="topLinks">
<?php echo $topbuttons;
        echo '<span>'.$delmessage .'</span>';
?>
</div>
    <div id="contacts">
        <?php 
        echo $empty;
        echo $surveys;
        ?>
    </div>
</div>
</div>
</div>
</body>
</html>
