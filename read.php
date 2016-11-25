<?php
$file_name = "post.json"; //Name of JSON file

$file_content = file_get_contents($file_name); //Gets the content of JSON

if($file_content === NULL || $file_content === FALSE) //Combrobe content errors
	echo "<p class='message error'>Error, no se ha podido obtener contenido del JSON</p>";

$file_json = json_decode($file_content); //Convert the content on a array

if($file_json === NULL || $file_json === FALSE) //Comprobe converting errors
	echo "<p class='message error'>Error, no se ha podido convertir el contenido en JSON</p>";

for($i = count($file_json) - 1; $i >= 0; $i--) { //Select (on reverse) all getted rows
	echo "<div class='post'>\n";
		echo "<img class='image' src='Image/" . $file_json[$i]->image . "' alt='" . $file_json[$i]->image . "'/>";
		echo "<h4 class='title'>" . $file_json[$i]->title . "</h4>\n";
		echo "<span class='insec'>\n";
		echo "<span class='date'>" . $file_json[$i]->date . "</span>";
		echo " Por: ";
		echo "<span class='name'>" . $file_json[$i]->name . "</span>\n";
		echo "</span>";
		echo "<p class='message'>" . $file_json[$i]->msg . "</p>";
	echo "</div>\n";
}

?>