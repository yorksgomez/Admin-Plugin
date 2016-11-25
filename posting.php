<?php require('is_log.php'); ?>
<link rel="stylesheet" type="text/css" href="posting.css"/>
<form class="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
	<input type="text" class="title" name="title" placeholder="Título"/>
	<input type="file" class="image" name="image"/>
	<textarea class="msg" name="msg" placeholder="Escriba su mensaje"></textarea>
	<input type="submit" class="poster button" name="poster" value="Subir"/>
</form>
<?php
	
	if(isset($_POST['poster']))
		require("post.php");

?>