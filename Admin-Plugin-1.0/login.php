<?php
require('mysql_connect.php'); //Get the mysql connection

$user = md5(trim($_POST['user'])); //Get the input user
$password = md5(trim($_POST['password'])); //Get the input password

$sql = "SELECT name FROM user WHERE user=? AND password=?"; //Create the sql query (Not executed at moment)
if(!$sentence = $ms->prepare($sql)) //Prepare query
	echo "Error preparando la consulta MYSQL (" . $sentence->errno . "): " . $sentence->error;

if(!$sentence->bind_param('ss', $user, $password)) //Give needed arguments
	echo "Error con parametros MYSQL (" . $sentence->errno . "): " . $sentence->error;

if(!$sentence->execute()) //Execute query
	echo "Error ejecutando la consulta MYSQL (" . $sentence->errno . "): " . $sentence->error;

if(!$sentence->bind_result($name)) //Give variables to the next result
	echo "Error dando variables a resultado MYSQL (" . $sentence->errno . "): " . $sentence->error;

$res = $sentence->fetch(); //Get the row

if($res === TRUE) { //User and password correct
	session_start(); //Create a session
	$_SESSION['name'] = $name; //Set the user name

	//Close connection
	$sentence->close(); 
	$ms->close();

	header("Location: posting.php"); //Redirect
}else if($res === FALSE) { //Mysql error
	echo "<p class=\"error\">Error Mysql, intentelo más tarde... " . $sentence->errno . ": " . $sentence->error . "</p>";
}else { //User or password faliure
	echo "<p class=\"error\">Usuario o contraseña incorrectos</p>";
}
	
//Close connection
$sentence->close();
$ms->close();
?>