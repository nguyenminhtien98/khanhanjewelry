<?php
	$id_bst = $_GET["id_bst"];
	$qr = "DELETE FROM bosuutap_noibat
			WHERE id = '$id_bst';
	";
	mysqli_query($conn,$qr);
	//chuyển hướng trang đến trang danh sách danh mục;
	header("location: ?xem=ds_bosutap_noibat");
?>