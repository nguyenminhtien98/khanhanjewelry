<?php
	$id_sp = $_GET["id_sanpham"];
	$qr = "DELETE FROM san_pham
			WHERE id_sp = '$id_sp'
	";
	mysqli_query($conn,$qr);
	//chuyển hướng trang đến trang danh sách sản phẩm;
	echo "<script> window.location.href='admin/?xem=ds_san_pham'</script>";
?>