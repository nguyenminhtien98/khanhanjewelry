<?php
	$qr = "
		SELECT * FROM blog
		ORDER BY `id` DESC
	";
	$ds_anh_tin = mysqli_query($conn,$qr);
?>


<div class="ds_anh_tin">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Blog <span style="color: black;">></span> Quản Trị Ảnh Tin Tức </li>
        </div>
    </div>
    <div class="main_content">
        <div class="tac_vu" style="justify-content: center;">
            <div class="sap_xep_sp_admin">
                <h5>Sắp xếp theo: </h5>
                <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value)">
                    <option value="">Mặc định</option>
                    <!-- sắp xếp id tin giảm dần -->
                    <option value="">Id Tin Giảm Dần</option>
                    <!-- sắp xếp id tin tăng dần -->
                    <option value="">Id Tin Tăng Dần</option>
                </select>
            </div>
        </div>
        <div class="hienthi_noidung">
            <div class="table_anh_tin">
                <div class="top_table">
                    <div class="tt-tin" style="width: 4%;">Id Tin</div>
                    <div class="tt-tin" style="width: 15%;">Loại Tin</div>
                    <div class="tt-tin" style="width: 33%;">Tiêu Đề Tin</div>
                    <div class="tt-tin" style="width: 48%;border-right: none;">Hình Ảnh</div>
                </div>
                <div class="main_table">
					<?php
                        while($row_ds_anh_tin = mysqli_fetch_array($ds_anh_tin)){
                    ?>
                    <div class="box_tt">
                        <div class="thongtin_tin">
                            <div class="tt-tin" style="width: 4%;"><p><?php echo $row_ds_anh_tin['id'] ?></p></div>
                            <div class="tt-tin" style="width: 15%;"><p><?php echo $row_ds_anh_tin['loai_tin'] ?></p></div>
                            <div class="tt-tin" style="width: 33%;"><p><?php echo $row_ds_anh_tin['title'] ?></p></div>
                            <div class="tt-tin" style="width: 48%;border-right: none;"><img src="images_blog/<?php echo $row_ds_anh_tin['hinh_anh'] ?>" width="98%" height="98%"/></div>
                        </div>
                    </div>
					<?php
						}
					?>
                </div>
                <div class="load_more">
                    <button class="btn_loadMore">Load more <span class="glyphicon glyphicon-chevron-down"></span></button>
                </div>
                <div class="go_to_top">
                    <button class="btn_gototop">Go To Top <span class="glyphicon glyphicon-chevron-up"></span></button>
                </div>
            </div>
        </div>
    </div>
</div>