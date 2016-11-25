<?php
require('config.php'); //Get the config file, with the info to connect

$ms = new mysqli(MHost, MUser, MPassword, MDB); //Create the connection with the config arguments

if($ms->connect_errno) { //Connection falure
	die("Ha ocurrido un error conectando con MYSQL" . $ms->error);
}

if(!$ms->set_charset(MCharset)) //Select charset
	echo "Ha ocurrido un error dando codificación, " . $this->ms->errno . ":" . $this->ms->error;

//Create the needed table
$sql = "CREATE TABLE IF NOT EXISTS user(id INT AUTO_INCREMENT, user VARCHAR(150), password VARCHAR(150), PRIMARY KEY(id))";
if(!$ms->query($sql)) //Execute query
	echo "Error creando la base de datos user (" . $ms->errno . "): " . $ms->error;

?>