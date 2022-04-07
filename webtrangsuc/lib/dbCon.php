<?php

	$tenmaychu ='localhost';
	$tentaikhoan ='root';
	$pass ='';
	$csdl ='web_trang_suc';
	$conn = mysqli_connect($tenmaychu,$tentaikhoan,$pass,$csdl) or die('Ko kết nối đc, hãy thử lại');
	mysqli_select_db($conn,$csdl);

?>
