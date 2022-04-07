
<?php
	// lấy danh sách thông tin của shop
	$qr = "
		SELECT * FROM thong_tin_shop
		ORDER BY `id` DESC
	";
	$qt_thongtin = mysqli_query($conn,$qr);
?>

<div class="qt_thongtin_shop">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Quản Trị Thông Tin Shop</li>
        </div>
    </div>
    <div class="main_content">
        <div class="tac_vu" style="justify-content: center;">
            <div class="them_moi">
                <a href="admin/?xem=them_danh_muc"><li><span class="glyphicon glyphicon-plus"></span> Thêm Thông Tin</li></a>
            </div>
        </div>
        <div class="hienthi_noidung">
            <div class="table_sp">
                <div class="top_table">
                    <div class="tt-dm" style="width: 3%;">ID</div>
                    <div class="tt-dm" style="width: 15%;">Tên Công Ty</div>
                    <div class="tt-dm" style="width: 9%;">Số Điện Thoại</div>
                    <div class="tt-dm" style="width: 15%;">Địa Chỉ</div>
                    <div class="tt-dm" style="width: 13%;">Mạng XH</div>
                    <div class="tt-dm" style="width: 13%;">Email</div>
                    <div class="tt-dm" style="width: 12%;">Đăng Ký BCT</div>
                    <div class="tt-dm" style="width: 12%;">Chứng Nhận BCT</div>
                    <div class="tt-dm" style="width: 3%;">Ẩn</div>
                    <div class="tt-dm" style="width: 5%; border-right: none">Tác Vụ</div>
                </div>
                <div class="main_table">
					<?php
                        while($row_qt_thongtin = mysqli_fetch_array($qt_thongtin)){
                    ?>
                    <div class="thongtin_congty">
                        <div class="tt-ct" style="width: 3%;"><p><?php echo $row_qt_thongtin['id'] ?></p></div>
                        <div class="tt-ct" style="width: 15%;"><textarea><?php echo $row_qt_thongtin['ten_shop'] ?></textarea></div>
                        <div class="tt-ct" style="width: 9%;"><p><?php echo $row_qt_thongtin['so_dien_thoai'] ?></p></div>
                        <div class="tt-ct" style="width: 15%;"><textarea><?php echo $row_qt_thongtin['dia_chi'] ?></textarea></div>
                        <div class="tt-ct" style="width: 13%;"><textarea><?php echo $row_qt_thongtin['mang_xa_hoi'] ?></textarea></div>
                        <div class="tt-ct" style="width: 13%;"><textarea><?php echo $row_qt_thongtin['email'] ?></textarea></p></div>
                        <div class="tt-ct" style="width: 12%;"><img src="<?php echo $row_qt_thongtin['dang_ky_BCT'] ?>" width="85%"/></div>
                        <div class="tt-ct" style="width: 12%;"><img src="<?php echo $row_qt_thongtin['chung_nhan_BCT'] ?> width="85%""/></div>
                        <div class="tt-ct" style="width: 3%;"><input type="checkbox" name="an"></input></div>
                        <div class="tt-ct" style="width: 5%; border-right: none; display: flex; justify-content: space-evenly;">
                            <a href="admin/?xem=sua_thong-tin_shop&id_thongtin=<?php echo $row_qt_thongtin['id'] ?>" class="sua" style="color:#333"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a href="admin/?xem=xoa_thong-tin_shop&id_thongtin=<?php echo $row_qt_thongtin['id'] ?>" class="xoa" style="color: red" onclick="if (!confirm('Bạn có chắc chắn muốn xóa thông tin?')) { return false }"><span class="glyphicon glyphicon-remove"></span></a>
                        </div>
                    </div>
                    <?php
						}
					?>
                </div>
            </div>
        </div>
    </div>
</div>
            
            
            
            
