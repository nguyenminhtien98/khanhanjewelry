<?php 
	$qr = "select * from banner 
		   where vi_tri = 0 and an_hien = 1";
	$query_banner = mysqli_query($conn,$qr);
	$banner_1 = mysqli_fetch_array($query_banner);
?>

<div class="banner_1">
	<div class="ct_banner">
    	<div class="thongtin">
        	<p><?php echo $banner_1['ten'] ?></p>
            <a href="<?php echo $banner_1['link'] ?>">Xem ngay</a>
        </div>
    	<img src="././admin/images/<?php echo $banner_1['hinh_anh'] ?>" alt="Image" style="max-width:100%;">
    </div>
</div>