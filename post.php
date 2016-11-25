<?php
require('mysql_connect.php'); //Get connection file

//Input getting
$title = trim($_POST['title']); //Get title from input
$msg = trim($_POST['msg']); //Get message from input
//Image getting
$image_name = $_FILES['image']['name'];
$image_type = $_FILES['image']['type'];
$image_size = $_FILES['image']['size'];
$image_url = $_FILES['image']['tmp_name'];
$is_correct = true; //Say if a image have the requeriments

//File exam
if($image_size > 500000) { //Test image size, must be less that 500kb
	$is_correct = false;
	$error = "Error, la imagen es muy pesada, asegurese de que pese menos de 500 kb\n";
}

if(strstr($image_type, '/', true) != 'image') { //Test if is a image
	$is_correct = false;
	$error = "Error, el archivo subido no es una imagen o no se reconoce como una\n";
}

//File uploading
if($is_correct) { //No errors with image. Continue normally
	
	if(!move_uploaded_file($image_url, "Image/" . $image_name)) //Sube la imagen y revisa si fue subida correctamente
		echo "<p class='message error'>Error subiendo la imagen</p>";

}else { //Errors in image, go to posting page showing the error
	echo "<p class='message error'>" . $error . "</p>";
}

//JSON updating
$file_name = "post.json"; //This variable save the json name

$file_content = file_get_contents($file_name); //Gets the content of JSON

if($file_content === NULL || $file_content === FALSE) //Combrobe content errors
	echo "<p class='message error'>Error, no se ha podido obtener contenido del JSON</p>";

$file_json = json_decode($file_content); //Convert the content on a array

if($file_json === NULL || $file_json === FALSE) //Comprobe converting errors
	echo "<p class='message error'>Error, no se ha podido convertir el contenido en JSON</p>";

$time = time() - (3600 * 7); //Control the hour errors

//Add the new post
$file_json[] = array("title"=>$title, "msg"=>$msg, "image"=>$image_name, "date"=>date('d/m/Y h:i A', $time), "name"=>$_SESSION['name']);

$file_json = json_encode($file_json); //Re-Code the JSON

if($file_json === NULL || $file_json === FALSE) //Comprobe encoding
	echo "<p class='message error'>Error codificando JSON</p>";

$file_content = file_put_contents($file_name, $file_json); //Re-Put the JSON with new content

if($file_content === NULL || $file_json === FALSE) //Comprobe if putting content had errors
	echo "<p class='message error'>Error dando contenido del JSON</p>";

?>