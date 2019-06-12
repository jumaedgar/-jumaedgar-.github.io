<?php
include_once("check_login_status.php");

if (isset($_GET['qid'])){
    $qid = $_GET['qid'];
    $num_resp = $_GET['total_resp'];
    
    $sql = "SELECT quiz FROM quiz WHERE quiz_id='$qid'";
        $query = mysqli_query($db_conx, $sql);
        $row = mysqli_fetch_row($query);
		$quiz = $row[0];
                
    $sql1 = "SELECT * FROM options WHERE quiz_id='$qid'";
    $total_resp = 0;
    $sector = '';
        $query1 = mysqli_query($db_conx, $sql1);
        while ($row1 = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
		$option = $row1['option'];
                $count = $row1['count'];
                $perc_count = ($count/$num_resp)*100;
                $total_resp += $row1['count'];   
                $sector .= '{ y: '.round($perc_count,2).', indexLabel: "('.$option.') {y}%" },';
         }
         $non_resp = $num_resp - $total_resp;
         $perc_non_resp = ($non_resp/$num_resp)*100;            
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<script type="text/javascript">
		window.onload = function () {
			var chart = new CanvasJS.Chart("chartContainer", {
				title: {
					text: "<?php echo $quiz;?>?"
				},
				animationEnabled: true,
				theme: "theme2",
				data: [
				{
					type: "doughnut",
					indexLabelFontFamily: "Garamond",
					indexLabelFontSize: 20,
					startAngle: 0,
					indexLabelFontColor: "dimgrey",
					indexLabelLineColor: "darkgrey",
					toolTipContent: "{y} %",

					dataPoints: [
                                            { y: <?php echo round($perc_non_resp,2);?>, indexLabel: "(non response) {y}%" },
                                            <?php echo rtrim($sector, ",");?>					
					]
				}
				]
			});

			chart.render();
		}
	</script>
	<script src="js/canvasjs.min.js"></script>
	<title>CanvasJS Example</title>
</head>
<body>
	<div id="chartContainer" style="height: 635px; width: 100%;">
	</div>
</body>
</html>
