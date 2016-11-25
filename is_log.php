<?php

//Start the session
session_start();

//Comprobe if the user is loged
if(!isset($_SESSION['name']))
	header("Location: admin.php"); //Redirect to main page

?>