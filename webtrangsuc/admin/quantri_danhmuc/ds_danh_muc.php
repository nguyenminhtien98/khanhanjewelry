
<?php
	// lấy danh sách danh mục
	$qr = "
		SELECT * FROM danh_muc
		ORDER BY `menu_id` DESC
	";
	$ds_danh_muc = mysqli_query($conn,$qr);
?>

<div class="qt_danhmuc">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Quản Trị Danh Mục</li>
        </div>
    </div>
    <div class="main_content">
        <div class="tac_vu">
            <div class="them_moi">
                <a href="admin/?xem=them_danh_muc"><li><span class="glyphicon glyphicon-plus"></span> Thêm Danh Mục</li></a>
            </div>
            <div class="tim_kiem">
                <input type="text" placeholder="Search = Tên danh mục" name="search">
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
                    <div class="tt-dm" style="width: 9%;">Id_Danh Mục</div>
                    <div class="tt-dm" style="width: 10%;">Danh Mục Cha</div>
                    <div class="tt-dm" style="width: 22%;">Tên Danh Mục</div>
                    <div class="tt-dm" style="width: 22%;">Đường Dẫn</div>
                    <div class="tt-dm" style="width: 25%;">Ảnh Danh Mục</div>
                    <div class="tt-dm" style="width: 3%;">Ẩn</div>
                    <div class="tt-dm" style="width: 6%; border-right: none">Tác Vụ</div>
                </div>
                <div class="main_table">
                    <?php
                        $num = 1;
                        while($row_ds_danh_muc = mysqli_fetch_array($ds_danh_muc)){
                    ?>
                    <div class="box_tt">
                        <div class="thongtin_danhmuc">
                            <div class="tt-dm" style="width: 3%;"><p><?= $num ?></p></div>
                            <div class="tt-dm" style="width: 9%;"><p><?php echo $row_ds_danh_muc['menu_id'] ?></p></div>
                            <div class="tt-dm" style="width: 10%;"><p><?php echo $row_ds_danh_muc['menu_parent_id'] ?></p></div>
                            <div class="tt-dm" style="width: 22%;"><p><?php echo $row_ds_danh_muc['ten'] ?></p></div>
                            <div class="tt-dm" style="width: 22%;"><p><?php echo $row_ds_danh_muc['code'] ?></p></div>
                            <div class="tt-dm" style="width: 25%;"><img src="admin/images/<?php echo $row_ds_danh_muc['hinh_anh'] ?>" style="width: 80%"/></div>
                            <div class="tt-dm" style="width: 3%;"><input type="checkbox" name="an" <?php  if($row_ds_danh_muc['an_hien']==0) { ?> checked <?php } ?>></input></div>
                            <div class="tt-dm" style="width: 6%; border-right: none; display: flex; justify-content: space-evenly;">
                                <a href="admin/?xem=sua_danh_muc&id_danhmuc=<?php echo $row_ds_danh_muc['menu_id'] ?>" class="sua" title="Sửa danh mục" style="color:#333" onclick="if (!confirm('Bạn có chắc chắn muốn sửa danh mục?')) { return false }"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="admin/?xem=xoa_danh_muc&id_danhmuc=<?php echo $row_ds_danh_muc['menu_id'] ?>" class="xoa" title="Xóa danh mục" style="color: red" onclick="if (!confirm('Bạn có chắc chắn muốn xóa danh mục?')) { return false }"><span class="glyphicon glyphicon-remove"></span></a>
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

            
            
            
            
