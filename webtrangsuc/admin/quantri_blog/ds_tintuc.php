
<?php
	// lấy danh sách tin
	$qr = "
		SELECT * FROM blog
		ORDER BY `id` DESC
	";
	$ds_tin = mysqli_query($conn,$qr);
?>

<div class="qt_ds_blog">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Quản Trị Blog</li>
        </div>
    </div>
    <div class="main_content">
        <div class="tac_vu">
            <div class="them_moi">
                <a href="admin/?xem=them-tin-tuc"><li><span class="glyphicon glyphicon-plus"></span> Thêm Tin Tức</li></a>
            </div>
            <div class="anh_tin">
                <a href="admin/?xem=anh-tin"><li><span class="glyphicon glyphicon-picture" style="padding-right: 5px;"></span> Xem Ảnh Tin</li></a>
            </div>
            <div class="noi_dung_tin">
                <a href="admin/?xem=noi-dung-tin"><li><i class="fa fa-file-text" style="font-size:15px; display: contents; color: white;"></i><span style="padding-left: 10px;">Xem Nội Dung Tin</span></li></a>
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
                    <!-- sắp xếp theo tin nổi bật -->
                    <option value="">Tin nổi bật</option>
                </select>
            </div>
        </div>
        <div class="hienthi_noidung">
            <div class="table_sp">
                <div class="top_table">
                    <div class="tt-tin" style="width: 3%;">STT</div>
                    <div class="tt-tin" style="width: 3%;">ID</div>
                    <div class="tt-tin" style="width: 14%;">Loại Tin</div>
                    <div class="tt-tin" style="width: 28%;">Tiêu Đề</div>
                    <div class="tt-tin" style="width: 26%;">Tóm Tắt</div>
                    <div class="tt-tin" style="width: 7%;">Tin Nổi Bật</div>
                    <div class="tt-tin" style="width: 8%;">Ngày Đăng</div>
                    <div class="tt-tin" style="width: 6%;">Ẩn Hiện</div>
                    <div class="tt-tin" style="width: 5%;border-right: none;">Tác Vụ</div>
                </div>
                <div class="main_table">
                    <?php
                        $num = 1;
                        while($row_ds_tin = mysqli_fetch_array($ds_tin)){
                    ?>
                    <div class="box_tt">
                        <div class="thongtin_tin">
                            <div class="tt-tin" style="width: 3%;"><p><?= $num ?></p></div>
                            <div class="tt-tin" style="width: 3%;"><p><?php echo $row_ds_tin['id'] ?></p></div>
                            <div class="tt-tin" style="width: 14%;"><p><?php echo $row_ds_tin['loai_tin'] ?></p></div>
                            <div class="tt-tin" style="width: 28%;"><p><?php echo $row_ds_tin['title'] ?></p></div>
                            <!-- kiểm tra nếu tin có nội dung tóm tắt thì in ra tóm tắt -->
                            <?php
                                if(strlen($row_ds_tin['tom_tat'])>0 ){
                            ?>
                            <div class="tt-tin" style="width: 26%;"><textarea style="min-height: 90%;width: 90%"><?php echo $row_ds_tin['tom_tat'] ?></textarea></div>
                            <?php
                                }else{
                            ?>
                            <!-- còn nếu tin không có tóm tắt thì in ra NULL -->
                            <div class="tt-tin" style="width: 26%;"><p>NULL</p></div>
                            <?php
                                }
                            ?>
                            <div class="tt-tin" style="width: 7%;"><input type="checkbox" name="tin_noi_bat" <?php  if($row_ds_tin['tin_noi_bat']==1) { ?> checked <?php } ?>></input></div>
                            <div class="tt-tin" style="width: 8%;"><p><?php echo $row_ds_tin['ngay_dang'] ?></p></div>
                            <!-- kiểm tra nếu ẩn hiện của tin là hiện thì in ra chữ hiện -->
                            <?php
                                if(($row_ds_tin['an_hien'])==1 ){
                            ?>
                            <div class="tt-tin" style="width: 6%;"><p>Hiện</p></div>
                            <?php
                                }else{
                            ?>
                            <!-- còn nếu ẩn hiện của tin là ẩn thì in ra chữ ẩn-->
                            <div class="tt-tin" style="width: 6%;"><p>Ẩn</p></div>
                            <?php
                                }
                            ?>
                            <div class="tt-tin" style="width: 5%; border-right: none; display: flex; justify-content: space-evenly; flex-direction: column;">
                                <a href="admin/?xem=sua-tin&id_tin=<?php echo $row_ds_tin['id'] ?>" class="sua" title="Sửa tin" style="color:#333" onclick="if (!confirm('Bạn có chắc chắn muốn sửa tin?')) { return false }"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="admin/?xem=xoa_tin&id_tin=<?php echo $row_ds_tin['id'] ?>" class="xoa" title="Xóa tin" style="color: red" onclick="if (!confirm('Bạn có chắc chắn muốn xóa tin?')) { return false }"><span class="glyphicon glyphicon-remove"></span></a>
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