
<?php
	session_start();
	if(isset($_SESSION["iduser"]) ){
		require "index.php";
	}else{
		require "login-admin.php";
	}
	
?>


