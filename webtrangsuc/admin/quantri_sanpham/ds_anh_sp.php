
<?php
	// lấy danh sách menu theo các id menu
	$qr = "
		SELECT * FROM danh_muc
		WHERE menu_id IN (8,9,10,11,12,13,14,15,16,21)
	";
	$ds_danh_muc = mysqli_query($conn,$qr);
?>

<?php
	// nếu có get id danh mục thì lấy daanh sách sản phẩm theo get id danh mục	
	if (isset($_GET['id_danhmuc'])) {
	$ds_anh_sp = mysqli_query($conn, "SELECT * FROM `san_pham` WHERE menu_id = '$_GET[id_danhmuc]' ORDER BY id_sp DESC");
	// còn không có get id danh mục thì lấy tất các sản phẩm
	}else{$ds_anh_sp = mysqli_query($conn, "SELECT * FROM `san_pham` ORDER BY `san_pham`.`id_sp` DESC");}	
		
?>

<div class="ds_anh_sanpham">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Quản Trị Ảnh Sản Phẩm</li>
        </div>
    </div>
    <div class="main_content">
        <div class="tac_vu" style="justify-content: center; justify-content: space-around;">
        	<div class="sap_xep_sp_admin">
                <h5>Lọc sản phẩm theo: </h5>
                <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value)">
                    <option value="admin/?xem=ds_anh_san_pham">Tất Cả Trang Sức</option>
                    <?php
                        while($row_ds_danh_muc = mysqli_fetch_array($ds_danh_muc)){
                    ?>
                    <option <?php if(isset($_GET['id_danhmuc']) && $_GET['id_danhmuc'] == $row_ds_danh_muc['menu_id']) { ?> selected <?php } ?> value="admin/?xem=ds_anh_san_pham&id_danhmuc=<?php echo $row_ds_danh_muc['menu_id'] ?>"><?php echo $row_ds_danh_muc['ten'] ?></option>
                    <?php
						}
					?>
                </select>
            </div>
            <div class="sap_xep_sp_admin">
                <h5>Sắp xếp theo: </h5>
                <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value)">
                    <option value="">Mặc định</option>
                    <!-- sắp xếp id sản phẩm giảm dần -->
                    <option value="">Id Sản Phẩm Giảm Dần</option>
                    <!-- sắp xếp id sản phẩm tăng dần -->
                    <option value="">Id Sản Phẩm Tăng Dần</option>
                </select>
            </div>
        </div>
        <div class="hienthi_noidung">
            <div class="table_anh_sp">
                <div class="top_table">
                    <div class="tt-anh" style="width: 4%;">Id_SP</div>
                    <div class="tt-anh" style="width: 24%;">Tên Sản Phẩm</div>
                    <div class="tt-anh" style="width: 24%;">Ảnh Đại Diện</div>
                    <div class="tt-anh" style="width: 24%;">Ảnh Chi Tiết</div>
                    <div class="tt-anh" style="width: 24%; border-right: none;">Ảnh Chi Tiết 2</div>
                </div>
                <div class="main_table">
                    <?php
                        while($row_ds_anh_sp = mysqli_fetch_array($ds_anh_sp)){
                    ?>
                    <div class="thongtin_anh_sp">
                        <div class="tt-anh" style="width: 4%;"><p><?php echo $row_ds_anh_sp['id_sp'] ?></p></div>
                        <div class="tt-anh" style="width: 24%;"><p><?php echo $row_ds_anh_sp['ten'] ?></p></div>
                        <div class="tt-anh" style="width: 24%;"><img src="images_sanpham/<?php echo $row_ds_anh_sp['anh_dai_dien'] ?>" width="80%" height="100%"/></div>
                        <div class="tt-anh" style="width: 24%;"><img src="images_sanpham/<?php echo $row_ds_anh_sp['anh_ct'] ?>" width="80%" height="100%"/></div>
                        <div class="tt-anh" style="width: 24%; border-right: none;"><img src="images_sanpham/<?php echo $row_ds_anh_sp['anh_ct2'] ?>" width="80%" height="100%"/></div>
                    </div>
                    <?php
						}
					?>
                </div>
            </div>
        </div>
    </div>
</div>