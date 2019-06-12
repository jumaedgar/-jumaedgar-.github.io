  <?php
include_once("check_login_status.php");
// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
$u = $_SESSION["username"];
$sql = "SELECT name, p_num FROM users WHERE p_num='$u' LIMIT 1";
        $query = mysqli_query($db_conx, $sql);
        $row = mysqli_fetch_row($query);
		$name = $row[0];
		$phone = $row[1];
		         
if (isset($_GET['surv_id'])){
      // GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
$s = $_GET["surv_id"];
$sql1 = "SELECT * FROM recepients WHERE surv_id='$s'";
        $query1 = mysqli_query($db_conx, $sql1);
$sql2 = "SELECT * FROM surveys WHERE surv_id='$s'";
        $query2 = mysqli_query($db_conx, $sql2); 
        $row2 = mysqli_fetch_row($query2);
		$surv_title = $row2[2];

        while ($row1 = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
		$recepient = ',+254'.$row1["resp_num"];
		}	
                $recepients = substr($recepient, 1);
		$message = 'To participate in '.$surv_title.'- a survey by '. $name .'. Dial *123*'.$s.'# For more information, call '.$phone ;  
                
        $sql3 = "UPDATE surveys SET Status='active' WHERE surv_id='$s'"; 
                $query3 = mysqli_query($db_conx, $sql3); 
  }
  
  // Be sure to include the file you've just downloaded
require_once('AfricasTalkingGateway.php');
// Specify your login credentials
$username   = "edgarsurvey";
$apikey     = "637545182736bbf0480874d0c92d04421eb3fc10fcc2da391b971db8c616b1f3";
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
$recepients = $recepients;
// And of course we want our recipients to know what we really do
$message    = $message;
// Create a new instance of our awesome gateway class
$gateway    = new AfricasTalkingGateway($username, $apikey);
// Any gateway error will be captured by our custom Exception class below, 
// so wrap the call in a try-catch block
try 
{ 
  // Thats it, hit send and we'll take care of the rest. 
  $results = $gateway->sendMessage($recepients, $message);
            
  foreach($results as $result) {
    // status is either "Success" or "error message"
    echo " Number: " .$result->number;
    echo " Status: " .$result->status;
    echo " MessageId: " .$result->messageId;
    echo " Cost: "   .$result->cost."\n";
  }
}
catch ( AfricasTalkingGatewayException $e )
{
  echo "Encountered an error while sending: ".$e->getMessage();
}

?>