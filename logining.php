<link rel="stylesheet" type="text/css" href="logining.css">
<form class="login" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
	<input type="text" class="user" name="user" placeholder="User"/>
	<input type="password" class="password" name="password" placeholder="Password"/>
	<input type="submit" class="log button" name="log" value="Log In"> 
</form>	
<?php

	if(isset($_POST['log']))
		require("login.php");

?>