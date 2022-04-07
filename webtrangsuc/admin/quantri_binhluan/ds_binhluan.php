
<?php
	// lấy danh sách danh mục
	$qr = "
		SELECT * FROM comment
		ORDER BY `id` DESC
	";
	$ds_binhluan = mysqli_query($conn,$qr);
?>

 <?php
    // duyệt commnent
    if(isset($_GET["id_cmt"])) {
    $id_cmt = $_GET["id_cmt"];
    $sql_update = "UPDATE comment SET trang_thai='Đã duyệt' WHERE id='".$id_cmt."'";
        $query = mysqli_query($conn,$sql_update);
    //chuyển hướng trang đến trang danh sách danh mục;
    header("location: ?xem=ds_binh-luan");
    }
?>

<div class="qt_danhmuc">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Quản Trị Bình Luận</li>
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
                    <div class="tt-dm" style="width: 4%;">Id</div>
                    <div class="tt-dm" style="width: 5%;">Id_SP</div>
                    <div class="tt-dm" style="width: 12%;">Trạng Thái</div>
                    <div class="tt-dm" style="width: 18%;">Tên Khách Hàng</div>
                    <div class="tt-dm" style="width: 8%;">Rating</div>
                    <div class="tt-dm" style="width: 31%;">ND Comment</div>
                    <div class="tt-dm" style="width: 12%;">Ngày Giờ</div>
                    <div class="tt-dm" style="width: 7%; border-right: none">Tác Vụ</div>
                </div>
                <div class="main_table">
                    <?php
                        $num = 1;
                        while($row_ds_binhluan = mysqli_fetch_array($ds_binhluan)){
                    ?>
                    <div class="box_tt">
                        <div class="thongtin_danhmuc">
                            <div class="tt-dm" style="width: 3%;"><?= $num ?></div>
                            <div class="tt-dm" style="width: 4%;"><?php echo $row_ds_binhluan['id'] ?></div>
                            <div class="tt-dm" style="width: 5%;"><?php echo $row_ds_binhluan['id_sp'] ?></div>
                            <?php
                                if($row_ds_binhluan['trang_thai'] == 'Chưa duyệt') {
                            ?>
                            <div class="tt-dm" style="width: 12%;"><a href="admin/?xem=ds_binh-luan&id_cmt=<?php echo $row_ds_binhluan['id'] ?>" style="color: red;"><?php echo $row_ds_binhluan['trang_thai'] ?></a></div>
                            <?php
                            }else{
                            ?>
                            <div class="tt-dm" style="width: 12%; color: #0ccd10;"><?php echo $row_ds_binhluan['trang_thai'] ?></div>
                            <?php
                            }
                            ?>
                            <div class="tt-dm" style="width: 18%;"><?php echo $row_ds_binhluan['ten'] ?></div>
                            <div class="tt-dm" style="width: 8%;"><?php echo $row_ds_binhluan['rating'] ?></div>
                            <div class="tt-dm" style="width: 31%;"><textarea><?php echo $row_ds_binhluan['comment'] ?></textarea></div>
                            <div class="tt-dm" style="width: 12%;"><?php echo $row_ds_binhluan['ngay_gio'] ?></div>
                            <div class="tt-dm" style="width: 7%; border-right: none; display: flex; justify-content: space-evenly;">
                                <a href="admin/?xem=chi-tiet-binh-luan&id_cmt=<?php echo $row_ds_binhluan['id'] ?>" class="sua" title="Trả lời bình luận" style="color:#333" onclick="if (!confirm('Bạn có chắc chắn muốn trả lời bình luận?')) { return false }"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="admin/?xem=xoa_danh_muc&id_danhmuc=<?php echo $row_ds_binhluan['menu_id'] ?>" class="xoa" title="Xóa danh mục" style="color: red" onclick="if (!confirm('Bạn có chắc chắn muốn xóa danh mục?')) { return false }"><span class="glyphicon glyphicon-remove"></span></a>
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

            
            
            
            
