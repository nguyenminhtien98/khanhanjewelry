<?php 
	$qr = "select * from banner 
		   where vi_tri = 1 and an_hien = 1";
	$query_banner = mysqli_query($conn,$qr);
	$banner_2 = mysqli_fetch_array($query_banner);
?>

<div class="banner_2">
	<div class="ct_banner">
    	<a href="<?php echo $banner_2['link'] ?>"><img src="././admin/images/<?php echo $banner_2['hinh_anh'] ?>" alt="Image" style="max-width:100%;"></a>
    </div>
</div>