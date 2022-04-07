<?php 
	$qr = "select * from thong_tin_shop";
	$query_tt_shop = mysqli_query($conn,$qr);
	$tt_shop = mysqli_fetch_array($query_tt_shop);
?>
<div id="diachi-shop">
	<div class="truso">
		<h4><?php echo $tt_shop['ten_shop'] ?></h4>
		<h5><?php echo $tt_shop['dia_chi'] ?></h5>
		<p>Email: <?php echo $tt_shop['email'] ?></p>
	</div>
	<div class="chungnhan">
		<img src="<?php echo $tt_shop['dang_ky_BCT'] ?>" alt="Image" style="max-width:100%;">
		<img src="images/thongbao.png" alt="Image" style="max-width:100%;">
	</div>
</div>