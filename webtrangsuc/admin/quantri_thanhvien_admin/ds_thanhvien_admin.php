<?php
	// lấy danh sách thành viên
	$qr = "
		SELECT * FROM user
		ORDER BY `id_user` DESC
	";
	$ds_thanhvien = mysqli_query($conn,$qr);
?>

<div class="ds_thanh_vien_admin">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Danh sách thành viên Admin</li>
        </div>
    </div>
    <div class="main_content">
        <div class="tac_vu" style="justify-content: center;">
            <div class="them_moi">
            	<?php
				// nếu admin đang đăng nhập có id =9 ( là chủ shop) thì cho phép thêm thành viên mới
				if($_SESSION["iduser"]==9){
				?>
                <a href="admin/?xem=them_thanh-vien_admin"><li><span class="glyphicon glyphicon-plus"></span> Thêm Thành Viên</li></a>
                <?php
				// nếu admin đang đăng nhập có id không bằng 9 ( là quản trị viên ) thì không cho phép thêm thành viên mới
				}else{
				?>
                <a title="Phải là chủ shop mới được thêm thành viên" style=" color: white; cursor: no-drop;" onclick="if (!confirm('Phải là chủ shop mới được thêm thành viên!')) { return false }"><li><span class="glyphicon glyphicon-plus"></span> Thêm Thành Viên</li></a>
                <?php
				}
				?>
            </div>
            
        </div>
        <div class="hienthi_noidung">
            <div class="table_sp">
                <div class="top_table">
                    <div class="tt-tv" style="width: 6%;">Id_User</div>
                    <div class="tt-tv" style="width: 15%;">Username</div>
                    <div class="tt-tv" style="width: 13%;">Password</div>
                    <div class="tt-tv" style="width: 15%;">Họ Và Tên</div>
                    <div class="tt-tv" style="width: 15%;">Email</div>
                    <div class="tt-tv" style="width: 11%;">Số Điện Thoại</div>
                    <div class="tt-tv" style="width: 10%;">Vai Trò</div>
                    <div class="tt-tv" style="width: 10%;">Ngày Tạo</div>
                    <div class="tt-tv" style="width: 5%; border-right: none">Tác Vụ</div>
                </div>
                
                <div class="main_table" style="border-bottom: 1px solid #d1d0d0;">
					<?php
                        while($row_ds_thanhvien = mysqli_fetch_array($ds_thanhvien)){
                    ?>
                    <div class="thongtin_thanhvien">
                        <div class="tt-tv" style="width: 6%;"><p><?php echo $row_ds_thanhvien['id_user'] ?></p></div>
                        <div class="tt-tv" style="width: 15%;"><p><?php echo $row_ds_thanhvien['username'] ?></p></div>
                        <div class="tt-tv" style="width: 13%;"><input type="password" readonly="readonly" value="<?php echo $row_ds_thanhvien['password'] ?>" style="width:100%"></input></div>
                        <div class="tt-tv" style="width: 15%;"><p><?php echo $row_ds_thanhvien['ho_va_ten'] ?></p></div>
                        <div class="tt-tv" style="width: 15%;"><textarea><?php echo $row_ds_thanhvien['email'] ?></textarea></div>
                        <div class="tt-tv" style="width: 11%;"><p>0<?php echo $row_ds_thanhvien['so_dien_thoai'] ?></p></div>
                        <div class="tt-tv" style="width: 10%;"><p><?php echo $row_ds_thanhvien['vai_tro'] ?></p></div>
                        <div class="tt-tv" style="width: 10%;"><p><?php echo $row_ds_thanhvien['ngay_tao'] ?></p></div>
                        <div class="tt-tv" style="width: 5%; border-right: none; display: flex; flex-direction: column; justify-content: space-evenly">
                        	<!--kiểm tra nếu admin là chủ shop thì mới được xóa thông tin từng admin-->
                            <!--còn nếu admin là quản trị viên thì không được xóa thông tin từng admin-->
                            <?php
                            if($_SESSION["iduser"]==9){
							?>
                            <a href="admin/?xem=xoa_thongtin_admin&id_thanhvien=<?php echo $row_ds_thanhvien['id_user'] ?>" class="xoa" title="Xóa thông tin" style="color: red" onclick="if (!confirm('Bạn có chắc chắn muốn xóa thành viên?')) { return false }"><span class="glyphicon glyphicon-remove"></span></a>
                            <?php
							}else{
							?>
                            <a class="xoa" title="Bạn không thể xóa" style="color: red; cursor: no-drop;" onclick="if (!confirm('Bạn không phải chủ shop nên không xóa được!')) { return false }"><span class="glyphicon glyphicon-remove"></span></a>
                            <?php
							}
							?>
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