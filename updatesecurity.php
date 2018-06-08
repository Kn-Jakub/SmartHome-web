<?php  include "header.php";

echo "<br />";
echo "SecurityActive: " . $_GET['optradio'] . "<br>";
echo "Meno : " . $_GET['user'] . "<br>";
echo "Time : " . $_GET['timesecur'] . "<br>";
$socketis = new Socket();

$secstate = $_GET['optradio'];
$timesecure = $_GET['timesecur'];

$boolvalue;
if($secstate === "active") {
   $boolvalue = 1;
}else{
   $boolvalue = 0;
}
			
$sql = "UPDATE initialstate SET SecurityState = '$boolvalue'";

	//if ($conn1->query($sql) === TRUE) {
		echo "init state set"."<br>";
		$socketis->setAlarmActivity($boolvalue,$timesecure);
		header("Location: security.php");
	//} else {
		//echo "Error: " . $sql . "<br>" . $conn1->error;
	//}
	$conn1->close();		

	
	
	

?>