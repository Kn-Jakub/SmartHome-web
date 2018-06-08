<?php

error_reporting(E_ALL);

/* Allow the script to hang around waiting for connections. */
set_time_limit(0);

/* Turn on implicit output flushing so we see what we're getting
 * as it comes in. */
ob_implicit_flush();


class Socket
{
	private $serverSocket;
	private $clientSocket;

	function __construct(){

		$address = gethostbyname('localhost');
		$port = 10010;
		if (($this->clientSocket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
	    		echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
		}
	/*
		if (socket_bind($this->serverSocket, $address, $port) === false) {
			echo "socket_bind() failed: reason: " . socket_strerror(socket_last_error($this->serverSocket)) . "\n";
		}

		if (socket_listen($this->serverSocket, 5) === false) {
			echo "socket_listen() failed: reason: " . socket_strerror(socket_last_error($this->serverSocket)) . "\n";
		}
		*/
		if(socket_connect($this->clientSocket, $address, $port) === false) {
			 echo "socket_connect() failed.\nReason:".socket_strerror(socket_last_error($socket)) . "\n";
		}
	}

	function acceptClient(){
	
		if (($this->clientSocket = socket_accept($this->serverSocket)) === false) {
			echo "socket_accept() failed: reason: " . socket_strerror(socket_last_error($this->serverSocket)) . "\n";
			return false;
		}
		
	}
	function setLogLevel($LogLevel, $seconds){
		$msg = chr(5).pack('S', $seconds).$LogLevel;
		echo $msg;
		socket_write($this->clientSocket, $msg, strlen($msg));

	}
	function setAlarmActivity($secstate, $timeForAlarm){
		$msg = chr(4).$secstate.pack('S', $timeForAlarm);
		echo $msg;
		socket_write($this->clientSocket, $msg, strlen($msg));
   }
	

	function setLights($sensorName, $state, $lightColor){
		$sensorName = trim($sensorName);
		$lightColor = trim($lightColor);
		$msg = chr(0).$state.$lightColor.$sensorName;
		echo $msg;
		socket_write($this->clientSocket, $msg, strlen($msg));

	}
	function setTmpPeriod($sensorName, $seconds){
      $sensorName = trim($sensorName);
		$msg = chr(1).pack('S', $seconds).$sensorName;
		echo $msg;
		socket_write($this->clientSocket, $msg, strlen($msg));

	}
	/*
	function setLightPeriod($seconds, ){
		$msg = chr(2).$seconds;
		echo $msg;
		socket_write($this->clientSocket, $msg, strlen($msg));

	}*/
	
	function shutDownCppServer(){
		$msg = chr(2);
		socket_write($this->clientSocket, $msg, strlen($msg));

	}
	function assignedMVM($MVMname,$sensorName) {
		$MVMname = trim($MVMname);
		$sensorName = trim($sensorName);
		$msg = chr(3).$MVMname.'@'.$sensorName;
		echo $msg;
		socket_write($this->clientSocket, $msg, strlen($msg));
	}

	function receiveMsg($buf){
		if (false === ($buf = socket_read($this->clientSocket, 2048, PHP_NORMAL_READ))) {
            echo "socket_read() failed: reason: " . socket_strerror(socket_last_error($this->clientSocket)) . "\n";
            return false;
      }
      return true;
	}
  
	function unconnectClient(){
		socket_close($this->clientSocket);	
	}
	function __destruct(){
		echo "I go close serverSocket\n";
		socket_close($this->clientSocket);
	}
}
/*
$socketis = new Socket();
echo "Som pred accept\n";
$socketis->acceptClient();

echo "ACCEPT uspesne ....nastav svetlo prvy krat Zadaj meno senzora \n";
/*
$nameOfLights = fgets(STDIN);
echo "Zadaj znaky \n";
$State = fgets(STDIN);
$socketis->setLights($nameOfLights,$State,$State,$State,$State);
echo "Prve nastavenie uspesne ....nastav svetlo druhy krat \n";
$State = fgets(STDIN);
$socketis->setLights($nameOfLights,$State,$State,$State,$State);
echo "Druhe nastavenie uspesne ....Vypniserver c++ \n";
$line = fgetc(STDIN);

$socketis->shutDownCppServer();
echo "Vypnuty\n";
$line = fgetc(STDIN);
/*
for($i = 0; $i <11; $i++){
	sleep(5);
	switch($i) {
		case 0:$masse = chr(0)."Message from PHP (CASE 0)";
		$socketis->sendMsg($client,$masse);
		echo $masse."\n";
		break;
		case 1:$masse = chr(1)."Message from PHP (CASE 1)";
		$socketis->sendMsg($client,$masse);
		echo $masse."\n";
		break;
		case 2:$masse = chr(2)."Message from PHP (CASE 2)";
		$socketis->sendMsg($client,$masse);
		echo $masse."\n";
		break;
		case 3:$masse = chr(3)."Message from PHP (CASE 3)";
		$socketis->sendMsg($client,$masse);
		echo $masse."\n";
		break;
		case 4:$masse = chr(4)."Message from PHP (CASE 4)";
		$socketis->sendMsg($client,$masse);
		echo $masse."\n";
		break;
		case 5:$masse = chr(5)."Message from PHP (CASE 5)";
		$socketis->sendMsg($client,$masse);
		echo $masse."\n";
		break;
		case 6:$masse = chr(6)."Message from PHP (CASE 6)";
		$socketis->sendMsg($client,$masse);
		echo $masse."\n";
		break;
		case 7:
		break;
		case 8:
		break;
		case 9:
		break;
		default:$masse = chr(10)."BAD OPTIONS";
		$socketis->sendMsg($client,$masse);
		echo $masse."\n";
		break;
	}



}*/


?>
