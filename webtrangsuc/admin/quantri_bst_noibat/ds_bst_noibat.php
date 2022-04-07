
<?php
	// lấy danh sách bộ sưu tập nổi bật
	$qr = "
		SELECT * FROM bosuutap_noibat
		ORDER BY id DESC
	";
	$ds_bst_noibat = mysqli_query($conn,$qr);
?>

<div class="qt_bst_noibat">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Quản Trị Bộ Sưu Tập Nổi Bật</li>
        </div>
    </div>
    <div class="main_content">
        <div class="tac_vu">
            <div class="them_moi">
                <a href="admin/?xem=them_bosutap_noibat"><li><span class="glyphicon glyphicon-plus"></span> Thêm Bộ Sưu Tập Nổi Bật</li></a>
            </div>
            <div class="tim_kiem">
                <input type="text" placeholder="Search = Tên bộ sưu tập" name="search">
                <button type="submit">Tìm kiếm</button>
            </div>
            <div class="sap_xep_sp_admin">
                <h5>Sắp xếp theo: </h5>
                <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value)">
                    <option value="">Mặc định</option>
                    <!-- sắp xếp id giảm dần -->
                    <option value="">ID Giảm dần</option>
                    <!-- sắp xếp id tăng dần -->
                    <option value="">ID tăng dần</option>
                </select>
            </div>
        </div>
        <div class="hienthi_noidung">
            <div class="table_sp">
                <div class="top_table">
                    <div class="tt-dm" style="width: 3%;">STT</div>
                    <div class="tt-dm" style="width: 3%;">ID</div>
                    <div class="tt-dm" style="width: 15%;">Tên Bộ Sưu Tập</div>
                    <div class="tt-dm" style="width: 24%;">Mô Tả</div>
                    <div class="tt-dm" style="width: 25%;">Đường Link</div>
                    <div class="tt-dm" style="width: 20%;">Hình Ảnh</div>
                    <div class="tt-dm" style="width: 5%;">Status</div>
                    <div class="tt-dm" style="width: 5%;border-right: none">Tác Vụ</div>
                </div>
                <div class="main_table">
                    <?php
                        $num = 1;
                        while($row_ds_bst_noibat = mysqli_fetch_array($ds_bst_noibat)){
                    ?>
                    <div class="box_tt">
                        <div class="thongtin_bst">
                            <div class="tt-bst" style="width: 3%;"><?php echo $num ?></div>
                            <div class="tt-bst" style="width: 3%;"><?php echo $row_ds_bst_noibat['id'] ?></div>
                            <div class="tt-bst" style="width: 15%;"><?php echo $row_ds_bst_noibat['ten'] ?></div>
                            <div class="tt-bst" style="width: 24%;"><textarea style="width: 95%; height: 90%;"><?php echo $row_ds_bst_noibat['mo_ta'] ?></textarea></div>
                            <div class="tt-bst" style="width: 25%;"><textarea style="width: 95%; height: 90%;"><?php echo $row_ds_bst_noibat['link'] ?></textarea></div>
                            <div class="tt-bst" style="width: 20%;"><img src="admin/images/<?php echo $row_ds_bst_noibat['hinh_anh'] ?>" width = "95%" height = "90%"></div>
                            <div class="tt-bst" style="width: 5%;"><?php if(($row_ds_bst_noibat["an_hien"]) == 1 ){ echo "Hiện";}else{ echo "Ẩn";}?></div>
                            <div class="tt-bst" style="width: 5%; border-right: none; display: flex; justify-content: space-evenly;">
                                <a href="admin/?xem=sua_bosutap_noibat&id_bst=<?php echo $row_ds_bst_noibat['id'] ?>" class="sua" title="Sửa bộ sưu tập nổi bật" style="color:#333" onclick="if (!confirm('Bạn có chắc chắn muốn sửa bộ sưu tập nổi bật?')) { return false }"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="admin/?xem=xoa_bosutap_noibat&id_bst=<?php echo $row_ds_bst_noibat['id'] ?>" class="xoa" title="Xóa danh mục" style="color: red" onclick="if (!confirm('Bạn có chắc chắn muốn xóa bộ sưu tập nổi bật?')) { return false }"><span class="glyphicon glyphicon-remove"></span></a>
                            </div>
                        </div>
                    </div>
                    <?php
                        $num++;
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

            
            
            
            
