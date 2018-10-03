<?php  include "header.php";

echo "<br />";
//echo "LogLevel " . $_GET['loglevel'] . "<br>";
echo "TimePeriod " . $_GET['tmpperiod'] . "<br>";

$socketis = new Socket();

$tmpName = $_GET['actualmodulename'];
$timeperiod = $_GET['tmpperiod'];

echo "menoSenzora" . $tmpName. "<br>";		
//$sql = "UPDATE initialstate SET SvetloPerioda = '$timeperiod', LogLevel = '$loglevel'";

	//if ($conn1->query($sql) === TRUE) {
		echo "init state set"."<br>";
		$socketis->setTmpPeriod($tmpName,$timeperiod);
		header("Location: temperature.php");
	/*} else {
		echo "Error: " . $sql . "<br>" . $conn1->error;
	}
	$conn1->close();		*/

	
	
	

?>