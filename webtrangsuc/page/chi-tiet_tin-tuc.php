<?php
	// hiển thị chi tiết tin theo GET id
	$qr = "
		SELECT * FROM blog
		WHERE id = '$_GET[id_tin]'
	";
	$query_chitiet_tin = mysqli_query($conn,$qr);
	$chitiet_tin = mysqli_fetch_array($query_chitiet_tin);	 
?>

<?php
	// hiển thị 5 tin cùng loại
	// nếu tồn tại GET tin tức và GET = tin tức thì lấy 5 tin có loại tin = tin tức 
	if (isset($_GET["tin-tuc"]) && $_GET["tin-tuc"]="tin-tuc"){
		$qr = "
			SELECT * FROM blog
			WHERE id != '$_GET[id_tin]' AND loai_tin = 'Tin Tức'
			ORDER BY RAND ()
			LIMIT 5 
		";
	// nếu tồn tại GET Kiến Thức Trang Sức và GET = Kiến Thức Trang Sức thì lấy 5 tin có loại tin = Kiến Thức Trang Sức 
	}elseif (isset($_GET["kien-thuc-trang-suc"]) && $_GET["tin-tuc"]="kien-thuc-trang-suc"){
		$qr = "
			SELECT * FROM blog
			WHERE id != '$_GET[id_tin]' AND loai_tin = 'Kiến Thức Trang Sức' 
			ORDER BY RAND ()
			LIMIT 5 
		";
	}
	$tin_cung_loai = mysqli_query($conn,$qr);
?>

<?php
	// hiển thị 5 tin nổi bật
	$qr = "
		SELECT * FROM blog
		WHERE tin_noi_bat = '1'
		ORDER BY id DESC 
		LIMIT 5 
	";
	$tin_noibat = mysqli_query($conn,$qr);
?>

<div class="chi-tiet-tin-tuc">
	<div class="container">
        <div class="top-ct-tintuc">
        	<div class="intro">
            	<img src="./images_blog/<?php echo $chitiet_tin['hinh_anh'] ?>"/>
            </div>
            <div class="tieu_de">
                <h1 class="title"><?php echo $chitiet_tin['title'] ?></h1>
                <span><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $chitiet_tin['ngay_dang'] ?> / Khánh An Jewelry</span>
                <div class="duong_dan">
                	<?php
                		if ($chitiet_tin["loai_tin"] == "Tin Tức"){
					?>
                	<a href="./">Khánh An Jewelry </a><span>/</span><a href="?xem=blog">Blog</a><span>/</span><h3>Tin Tức</h3>
                    <?php
						}else{
					?>
                    <a href="./">Khánh An Jewelry </a><span>/</span><a href="?xem=blog">Blog</a><span>/</span><h3>Kiến Thức Trang Sức</h3>
                    <?php
						}
					?>
                </div>
                <div class="share">
                	<a href="#" class="fa fa-facebook" title="Facebook"></a>
                    <a href="#" class="fa fa-instagram" style="margin-left: 5px;" title="Instagram"></a>
					<a href="#" class="fa fa-twitter" style="background: #55ACEE; color: white; margin-left: 5px;"  title="Twitter"></a>
                </div>
            </div>
        </div>
        <div class="main-ct-tintuc">
        	<div class="noidung-tintuc"><?php echo $chitiet_tin['noi_dung'] ?></div>
            <div class="chia_se">
            	<div class="chia_se_left">
                    <i class='fas fa-share-alt'></i>
                    <span>Share</span>
                </div>
                <div class="share">
                	<a href="#" class="fa fa-facebook" title="Facebook" target="_blank"></a>
                    <a href="#" class="fa fa-instagram" style="margin-left: 5px;" title="Instagram"></a>
					<a href="#" class="fa fa-twitter" style="background: #55ACEE; color: white; margin-left: 5px;"  title="Twitter"></a>
                </div>
            </div>
        </div>
        <div class="footer-ct-tintuc">
            <div class="baiviet_lienquan">
                <h1>Bài Viết Liên Quan</h1>
                <span class="line_bottom"></span>
                <?php
                    while($row_tin_cung_loai = mysqli_fetch_array($tin_cung_loai)){
                ?>
                <li>
                
                    <?php
                        // nếu tin đang xem thuộc loại tin = tin tức thì đường link là tin tức
                        if ($row_tin_cung_loai["loai_tin"]=='Tin Tức'){
                    ?>
                    <a href="blog/tin-tuc/<?php echo $row_tin_cung_loai['code'] ?>-<?php echo $row_tin_cung_loai['id'] ?>.html"><?php echo $row_tin_cung_loai['title'] ?></a>
                    <?php
                    // ngược lại nếu tin đang xem thuộc loại tin = kiến thức trang sức thì đường link là kiến thức trang sức
                        }else{
                    ?>
                    <a href="blog/kien-thuc-trang-suc/<?php echo $row_tin_cung_loai['code'] ?>-<?php echo $row_tin_cung_loai['id'] ?>.html"><?php echo $row_tin_cung_loai['title'] ?></a>
                    <?php
                        }
                    ?>
                </li>
                <?php
                    }
                ?>
            </div>
            <div class="tin_noibat">
           		<h1>Tin Nổi Bật</h1>
                <span class="line_bottom"></span>
                <?php
                    while($row_tin_noibat = mysqli_fetch_array($tin_noibat)){
                ?>
                <li><a href="blog/tin-tuc/<?php echo $row_tin_noibat['code'] ?>-<?php echo $row_tin_noibat['id'] ?>.html"><?php echo $row_tin_noibat['title'] ?></a></li>
                <?php
					}
				?>
            </div>
        </div>
    </div>
</div>