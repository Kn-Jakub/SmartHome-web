<?php  include "header.php";

echo "<br />";
echo "LogLevel " . $_GET['loglevel'] . "<br>";
echo "TimePeriod " . $_GET['timeperiod'] . "<br>";

$socketis = new Socket();

$loglevel = $_GET['loglevel'];
$timeperiod = $_GET['timeperiod'];

			
$sql = "UPDATE initialstate SET SvetloPerioda = '$timeperiod', LogLevel = '$loglevel'";

	if ($conn1->query($sql) === TRUE) {
		echo "init state set"."<br>";
		$socketis->setLogLevel($loglevel,$timeperiod);
		header("Location: setting.php");
	} else {
		echo "Error: " . $sql . "<br>" . $conn1->error;
	}
	$conn1->close();		

	
	
	

?>