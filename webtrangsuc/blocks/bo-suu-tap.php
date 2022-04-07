<?php
	// lấy bộ sưu tập nổi bật
	$qr = "
		SELECT * FROM bosuutap_noibat
		WHERE an_hien = 1
		LIMIT 1
	";
	$bosuutap_noibat = mysqli_query($conn,$qr);
	$row_bosuutap_noibat = mysqli_fetch_array($bosuutap_noibat)
?>
<div id="bst-moi">
	<div id="bst">
		<div id="gt-bst">
			<div id="ct-bst">
				<div class="ten-bst">
					<h3><?php echo $row_bosuutap_noibat['ten'] ?></h3>
					<p>COLLECTION</p>
				</div>
				<div class="tt_nd-bst">
					<?php echo $row_bosuutap_noibat['mo_ta'] ?>
				</div>
				<div class="xt-bst">
					<a href="<?php echo $row_bosuutap_noibat['link'] ?>">Bộ Sưu Tập</a>
				</div>
			</div>
		</div>
		<div id="img-bst"><a href="<?php echo $row_bosuutap_noibat['link'] ?>"><img src="././admin/images/<?php echo $row_bosuutap_noibat['hinh_anh'] ?>" alt="Image" style="max-width:100%;"/></a></div>
	</div>
</div>