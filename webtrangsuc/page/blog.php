<?php
	// hiển thị 1 tin nổi bật
	$qr = "SELECT * FROM blog WHERE loai_tin = 'Tin Tức' AND tin_noi_bat = '1' ORDER BY id DESC LIMIT 0,1";
	$mot_tin_noi_bat = mysqli_query($conn,$qr);
	$row_mot_tin_noi_bat = mysqli_fetch_array($mot_tin_noi_bat);
?>

<?php
	// hiển thị 3 tin nổi bật
	$qr = "SELECT * FROM blog WHERE loai_tin = 'Tin Tức' AND tin_noi_bat = '1' ORDER BY id DESC LIMIT 1,3";
	$ba_tin_noi_bat = mysqli_query($conn,$qr);
?>

<?php
	// hiển thị tin tức
	$qr = "SELECT * FROM blog WHERE loai_tin = 'Tin Tức' ORDER BY id DESC";
	$ds_tin_tuc = mysqli_query($conn,$qr);
	
?>

<?php
	// hiển thị tin loại kiến thức trang sức
	$qr = "SELECT * FROM blog WHERE loai_tin = 'Kiến Thức Trang Sức' ORDER BY id DESC";
	$ds_kt_trang_suc = mysqli_query($conn,$qr);
	
?>


<div class="pages_blog">
	<div class="top_pages_blog">
    	<div class="duong_dan">
        	<a href="./">Trang Chủ</a><span>/</span><h3>Blog</h3>
        </div>
    </div>
	<div class="content_blog">
    	<div class="tintuc_noibat">
        	<div class="tintuc_noibat_left">
            	
            	<div class="content_tintuc">
                    <a href="blog/tin-tuc/<?php echo $row_mot_tin_noi_bat['code'] ?>-<?php echo $row_mot_tin_noi_bat['id'] ?>.html">
                        <div class="avata_tintuc_noibat">
                            <img src="./images_blog/<?php echo $row_mot_tin_noi_bat['hinh_anh'] ?>" width="100%" height="100%"/>
                        </div>
                        <div class="tieude">
                            <h2 class="title"><?php echo $row_mot_tin_noi_bat['title'] ?></h2>
                            <span class="ngay_thang">Khánh An Jewelry / <?php echo $row_mot_tin_noi_bat['ngay_dang'] ?></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="tintuc_noibat_right">
            	<?php
					while($row_ba_tin_noi_bat = mysqli_fetch_array($ba_tin_noi_bat)){
				?>
            	<div class="content_tintuc">
                    <a href="blog/tin-tuc/<?php echo $row_ba_tin_noi_bat['code'] ?>-<?php echo $row_ba_tin_noi_bat['id'] ?>.html">
                        <div class="avata_tintuc_noibat">
                            <img src="./images_blog/<?php echo $row_ba_tin_noi_bat['hinh_anh'] ?>" width="100%" height="100%"/>
                        </div>
                        <div class="tieude">
                            <h4 class="title"><?php echo $row_ba_tin_noi_bat['title'] ?></h4>
                        </div>
                    </a>
                </div>
                <?php
					}
				?>
            </div>
        </div>
        <div class="tintuc_kienthuc-trangsuc">
        	<div class="kienthuc_trangsuc">
            	<div class="top">
                	<h2>Kiến Thức Trang Sức</h2>
                </div>
                <div class="main">
                	<?php
                        while($row_ds_kt_trang_suc = mysqli_fetch_array($ds_kt_trang_suc)){
                    ?>
                    <div class="box_kt_trang_suc">
                        <div class="content_kienthuc">
                            <div class="avata">
                                <a href="blog/kien-thuc-trang-suc/<?php echo $row_ds_kt_trang_suc['code'] ?>-<?php echo $row_ds_kt_trang_suc['id'] ?>.html">
                                    <img src="./images_blog/<?php echo $row_ds_kt_trang_suc['hinh_anh'] ?>" width="100%" />
                                 </a>
                            </div>
                            <div class="title">
                                <a href="blog/kien-thuc-trang-suc/<?php echo $row_ds_kt_trang_suc['code'] ?>-<?php echo $row_ds_kt_trang_suc['id'] ?>.html">
                                    <h3><?php echo $row_ds_kt_trang_suc['title'] ?></h3>
                                 </a>
                            </div>
                        </div>
                    </div>
                    <?php
						}
					?>
                    <div class="load_more_kt">
                    	<button class="btn_loadMore">Load more <span class="glyphicon glyphicon-chevron-down"></span></button>
                    </div>
                    <div class="go_to_top_kt">
                        <button class="btn_gototop">Go To Top <span class="glyphicon glyphicon-chevron-up"></span></button>
                    </div>
                </div>
            </div>
        	<div class="tin_tuc">
            	<div class="top_tintuc">
                	<h2><span>Tin Tức</span></h2>
                </div>
                <div class="main_tintuc">
                	<?php
                        while($row_ds_tin_tuc = mysqli_fetch_array($ds_tin_tuc)){
                    ?>
                    <div class="box_tintuc">
                        <div class="content-tintuc">
                            <div class="avata">
                                <a href="blog/tin-tuc/<?php echo $row_ds_tin_tuc['code'] ?>-<?php echo $row_ds_tin_tuc['id'] ?>.html"><img src="./images_blog/<?php echo $row_ds_tin_tuc['hinh_anh'] ?>" width="100%" height="100%" /></a>
                            </div>
                            <div class="noidung">
                                <div class="title"><a href="blog/tin-tuc/<?php echo $row_ds_tin_tuc['code'] ?>-<?php echo $row_ds_tin_tuc['id'] ?>.html"><?php echo $row_ds_tin_tuc['title'] ?></a></div>
                                <div class="ngaythang"><i class="fa fa-calendar" aria-hidden="true"></i><span><?php echo $row_ds_tin_tuc['ngay_dang'] ?></span></div>
                                <div class="tomtat">
                                    <p><?php echo $row_ds_tin_tuc['tom_tat'] ?></p>
                                </div>
                                <div class="xemthem"><a href="blog/tin-tuc/<?php echo $row_ds_tin_tuc['code'] ?>-<?php echo $row_ds_tin_tuc['id'] ?>.html">Xem thêm</a></div>
                            </div>
                        </div>
                    </div>
                    <?php
						}
					?>
                    <div class="load_more">
                        <button class="loadMore">Load more <span class="glyphicon glyphicon-chevron-down"></span></button>
                    </div>
                    <div class="go_to_top">
                        <button class="btn_gototop">Go To Top <span class="glyphicon glyphicon-chevron-up"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



