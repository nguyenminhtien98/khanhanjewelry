<?php
	$id_banner = $_GET["id_banner"];
	$qr = "DELETE FROM banner
			WHERE id = '$id_banner';
	";
	mysqli_query($conn,$qr);
	//chuyển hướng trang đến trang danh sách danh mục;
	header("location: ?xem=ds_banner");
?>