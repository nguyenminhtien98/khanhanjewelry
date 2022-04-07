<?php
	$id_danh_muc = $_GET["id_danhmuc"];
	$qr = "DELETE FROM danh_muc
			WHERE menu_id = '$id_danh_muc';
	";
	mysqli_query($conn,$qr);
	//chuyển hướng trang đến trang danh sách danh mục;
	echo "<script> window.location.href='admin/?xem=ds_danh_muc'</script>";
?>