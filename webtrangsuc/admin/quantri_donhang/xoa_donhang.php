<?php
	$id_donhang = $_GET["id_donhang"];
	$qr = "DELETE FROM don_hang
			WHERE id_don_hang = '$id_donhang';
	";
	mysqli_query($conn,$qr);
	//chuyển hướng trang đến trang danh sách đơn hàng;
	echo "<script> window.location.href='admin/?xem=ds_don_hang'</script>";
?>