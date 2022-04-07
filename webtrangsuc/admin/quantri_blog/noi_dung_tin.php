<?php
	// lấy danh sách tin
	$qr = "
		SELECT * FROM blog
		ORDER BY `id` DESC
	";
	$ds_nd_tin = mysqli_query($conn,$qr);
?>
<div class="ds_nd_tin">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Blog <span style="color: black;">></span> Nội Dung Tin Tức </li>
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
                    <div class="tt-tin" style="width: 48%;border-right: none;">Nội Dung Tin</div>
                </div>
                <div class="main_table">
					<?php
                        while($row_ds_nd_tin = mysqli_fetch_array($ds_nd_tin)){
                    ?>
                    <div class="box_tt_tin">
                        <div class="thongtin_tin">
                            <div class="tt-tin" style="width: 4%;"><p><?php echo $row_ds_nd_tin['id'] ?></p></div>
                            <div class="tt-tin" style="width: 15%;"><p><?php echo $row_ds_nd_tin['loai_tin'] ?></p></div>
                            <div class="tt-tin" style="width: 33%;"><p><?php echo $row_ds_nd_tin['title'] ?></p></div>
                            <div class="tt-tin" style="width: 48%;border-right: none;"><textarea class="ckeditor" name="ckeditor" id="noi_dung"><?php echo $row_ds_nd_tin['noi_dung'] ?></textarea></div>
                        </div>
                    </div>
					<?php
						}
					?>
                </div>
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
