<?php
	$id_user = $_GET["id_thanhvien"];
	$qr = "DELETE FROM user
			WHERE id_user = '$id_user';
	";
	mysqli_query($conn,$qr);
	//chuyển hướng trang đến trang danh sách thành viên admin;
	echo "<script> window.location.href='admin/?xem=ds_thanh-vien_admin'</script>";
?>