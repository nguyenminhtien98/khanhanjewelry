
<?php
	// lấy danh sách tất cả đơn hàng
	$qr = "
		SELECT * FROM don_hang
		ORDER BY `id_don_hang` DESC
	";
	$ds_don_hang = mysqli_query($conn,$qr);
?>

<?php
	//truy vấn đếm số đơn hàng
	$qr = "
		SELECT COUNT(id_don_hang) FROM don_hang
	";
	$tong_don_hang = mysqli_query($conn,$qr);
	$row_tong_don_hang = mysqli_fetch_array($tong_don_hang);
?>

<?php
	// lấy danh sách đơn hàng đang chờ xử lý
	$qr = "
		SELECT * FROM don_hang
		WHERE trang_thai=1
		ORDER BY `id_don_hang` DESC
	";
	$ds_dh_cho_xu_ly = mysqli_query($conn,$qr);
?>

<?php
	// truy vấn đếm số đơn hàng đang chờ xử lý
	$qr = "
		SELECT COUNT(trang_thai) FROM don_hang WHERE trang_thai=1
	";
	$don_hang_cho_xl = mysqli_query($conn,$qr);
	$row_don_hang_cho_xl = mysqli_fetch_array($don_hang_cho_xl);
?>

<?php
	// lấy danh sách đơn hàng đang xử lý
	$qr = "
		SELECT * FROM don_hang
		WHERE trang_thai=2
		ORDER BY `id_don_hang` DESC
	";
	$ds_dh_dang_xu_ly = mysqli_query($conn,$qr);
?>

<?php
	// truy vấn đếm số đơn hàng đang xử lý
	$qr = "
		SELECT COUNT(trang_thai) FROM don_hang WHERE trang_thai=2
	";
	$don_hang_xl = mysqli_query($conn,$qr);
	$row_don_hang_xl = mysqli_fetch_array($don_hang_xl);
?>

<?php
	// lấy danh sách đơn hàng đang giao
	$qr = "
		SELECT * FROM don_hang
		WHERE trang_thai=3
		ORDER BY `id_don_hang` DESC
	";
	$ds_dh_dang_giao = mysqli_query($conn,$qr);
?>

<?php
	// truy vấn đếm số đơn hàng đang giao
	$qr = "
		SELECT COUNT(trang_thai) FROM don_hang WHERE trang_thai=3
	";
	$don_hang_dang_giao = mysqli_query($conn,$qr);
	$row_don_hang_dang_giao = mysqli_fetch_array($don_hang_dang_giao);
?>

<?php
	// lấy danh sách đơn hàng giao thành công
	$qr = "
		SELECT * FROM don_hang
		WHERE trang_thai=4
		ORDER BY `id_don_hang` DESC
	";
	$ds_dh_giao_thanh_cong = mysqli_query($conn,$qr);
?>

<?php
	// truy vấn đếm số đơn hàng giao thành công
	$qr = "
		SELECT COUNT(trang_thai) FROM don_hang WHERE trang_thai=4
	";
	$don_hang_giao_thanh_cong = mysqli_query($conn,$qr);
	$row_don_hang_giao_thanh_cong = mysqli_fetch_array($don_hang_giao_thanh_cong);
?>

<?php
	// lấy danh sách đơn hàng đã hủy
	$qr = "
		SELECT * FROM don_hang
		WHERE trang_thai=5
		ORDER BY `id_don_hang` DESC
	";
	$ds_dh_da_huy = mysqli_query($conn,$qr);
?>

<?php
	// truy vấn đếm số đơn hàng đã hủy
	$qr = "
		SELECT COUNT(trang_thai) FROM don_hang WHERE trang_thai=5
	";
	$don_hang_da_huy = mysqli_query($conn,$qr);
	$row_don_hang_da_huy = mysqli_fetch_array($don_hang_da_huy);
?>

<div class="ds_don_hang">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Quản Trị Đơn Hàng</li>
        </div>
    </div>
    <div class="main_content">
        <!-- Nav pills -->
        <ul class="nav nav-pills" style="justify-content: center;">
            <li class="nav-item" style="margin-left: 0px;">
                <a class="nav-link active" data-toggle="pill" href="#tat_ca_don_hang">Tất Cả Đơn Hàng <span class="tb_donhang"><?php echo $row_tong_don_hang['COUNT(id_don_hang)'] ?></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#dangchoxuly">Đang Chờ Xử Lý <span class="tb_donhang"><?php echo $row_don_hang_cho_xl['COUNT(trang_thai)'] ?></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#dang_xu_ly">Đang Xử Lý <span class="tb_donhang"><?php echo $row_don_hang_xl['COUNT(trang_thai)'] ?></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#dang_giao_hang">Đang Giao Hàng <span class="tb_donhang"><?php echo $row_don_hang_dang_giao['COUNT(trang_thai)'] ?></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#giao_hang_thanh_cong">Giao Thành Công <span class="tb_donhang"><?php echo $row_don_hang_giao_thanh_cong['COUNT(trang_thai)'] ?></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#don_hang_da_huy">Đơn Hàng Đã Hủy <span class="tb_donhang"><?php echo $row_don_hang_da_huy['COUNT(trang_thai)'] ?></span></a>
            </li>
        </ul>
        <div class="tab-content">
            <!-- Tất cả đơn hàng -->
            <div class="tab-pane container active" id="tat_ca_don_hang">
                <div class="hienthi_noidung">
                    <div class="table_sp">
                        <div class="top_table">
                            <div class="tt-dh" style="width: 5%;">Id_ĐH</div>
                            <div class="tt-dh" style="width: 43%;">Thông Tin Đơn Hàng</div>
                            <div class="tt-dh" style="width: 11%;">Tổng Tiền</div>
                            <div class="tt-dh" style="width: 11%;">HT TT</div>
                            <div class="tt-dh" style="width: 16%;">Trạng Thái</div>
                            <div class="tt-dh" style="width: 9%;">Ngày Đặt</div>
                            <div class="tt-dh" style="width: 5%; border-right: none">Tác Vụ</div>
                        </div>
                        <div class="main_table" style="border-bottom: 1px solid #d1d0d0;">
                            <?php
                                while($row_ds_don_hang = mysqli_fetch_array($ds_don_hang)){
                            ?>
                            <div class="box_tt">
                                <div class="thongtin_donhang">
                                    <div class="tt-dh" style="width: 5%;">
                                        <p><?php echo $row_ds_don_hang['id_don_hang'] ?></p>
                                    </div>
                                    <div class="info" style="width: 43%;">
                                        <li name="ho_ten">Họ và Tên: <?php echo $row_ds_don_hang['ho_va_ten'] ?></li>
                                        <li name="so_dien_thoai">Số Điện Thoại: <?php echo $row_ds_don_hang['so_dien_thoai'] ?></li>
                                        <li name="dia_chi">Địa Chỉ: <?php echo $row_ds_don_hang['dia_chi_giao_hang'] ?></li>
                                        <li name="email">Email: <?php echo $row_ds_don_hang['email'] ?></li>
                                        <li name="ghi_chu">Ghi Chú: <?php echo $row_ds_don_hang['ghi_chu'] ?></li>
                                    </div>
                                    <div class="tt-dh" style="width: 11%;">
                                        <p><?= $row_ds_don_hang['tong_tien']?><sup class="gia">₫</sup></p>
                                    </div>
                                    <div class="tt-dh" style="width: 11%;">
                                        <p><?php echo $row_ds_don_hang['hinhthuc_thanhtoan'] ?></p>
                                    </div>
                                    <!-- nếu trạng thái đơn hàng bằng đang chờ xử lý thì in ra chữ màu đỏ -->
                                    <?php
                                        if($row_ds_don_hang['trang_thai'] ==1){ 
                                    ?>
                                    <div class="tt-dh" style="width: 16%; color:red; display: flex; flex-direction: column; justify-content: space-evenly">
                                        <p id="trangthai"><?php echo $row_ds_don_hang['trang_thai'] ?></p>
                                        <a href="admin/?xem=xu_ly&id_donhang=<?php echo $row_ds_don_hang['id_don_hang'] ?>" name="donhangmoi">Đơn Hàng Mới</a>
                                    </div>
                                    <!-- nếu trạng thái đơn hàng bằng giao hàng thành công thì in ra chữ màu xanh -->
                                    <?php		
                                        }elseif($row_ds_don_hang['trang_thai'] ==4){
                                    ?>
                                    <div class="tt-dh" style="width: 16%; color:#0ccd10">
                                        <p id="trangthai"><?php echo $row_ds_don_hang['trang_thai'] ?></p>
                                    </div>
                                    <!-- còn nếu không bằng 2 trường hợp trên thì in ra chữ màu đen -->
                                    <?php	
                                        }else{
                                    ?>
                                    <div class="tt-dh" style="width: 16%;">
                                        <p id="trangthai"><?php echo $row_ds_don_hang['trang_thai'] ?></p>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                    <div class="tt-dh" style="width: 9%;">
                                        <p><?php echo $row_ds_don_hang['ngay_dat'] ?></p>
                                    </div>
                                    <div class="tt-dh" style="width: 5%; border-right: none; display: flex; justify-content: space-evenly; flex-direction: column;">
                                        <a href="admin/?xem=chi-tiet_don-hang&id_donhang=<?php echo $row_ds_don_hang['id_don_hang'] ?>" title="Xem chi tiết đơn hàng">Chi tiết</a>
                                        <!-- nếu trạng thái đơn hàng bằng giao hàng thành công thì in ra dấu tích không cho admin sửa -->
                                        <?php
                                            if($row_ds_don_hang['trang_thai']==4){
                                        ?>
                                        <a name="giao_hang_thanh_cong" title="Đơn hàng giao thành công" style="color:#0ccd10"><span class="glyphicon glyphicon-ok"></span></a>
                                        <!-- còn nếu trạng thái đơn hàng không bằng giao hàng thành công thì in ra sửa cho phép admin sửa -->
                                        <?php
                                            }else{
                                        ?>
                                        <a href="admin/?xem=sua_don_hang&id_donhang=<?php echo $row_ds_don_hang['id_don_hang'] ?>" class="sua" title="Sửa đơn hàng" style="color:#333"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <?php
                                            }
                                        ?>
                                        <a href="admin/?xem=xoa_don_hang&id_donhang=<?php echo $row_ds_don_hang['id_don_hang'] ?>" class="xoa" title="Xóa đơn hàng" style="color: red" onclick="if (!confirm('Bạn có chắc chắn muốn xóa đơn hàng?')) { return false }"><span class="glyphicon glyphicon-remove"></span></a>
                                    </div>
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
            <!--  tab đơn hàng chờ xử lý -->
            <div class="tab-pane container fade" id="dangchoxuly">
                <div class="hienthi_noidung">
                    <div class="table_sp">
                        <div class="top_table">
                            <div class="tt-dh" style="width: 5%;">Id_ĐH</div>
                            <div class="tt-dh" style="width: 43%;">Thông Tin Đơn Hàng</div>
                            <div class="tt-dh" style="width: 11%;">Tổng Tiền</div>
                            <div class="tt-dh" style="width: 11%;">HT TT</div>
                            <div class="tt-dh" style="width: 16%;">Trạng Thái</div>
                            <div class="tt-dh" style="width: 9%;">Ngày Đặt</div>
                            <div class="tt-dh" style="width: 5%; border-right: none">Tác Vụ</div>
                        </div>
                        <div class="main_table" style="border-bottom: 1px solid #d1d0d0;">
                            <?php
                                $count = 0;
                                while($row_ds_dh_cho_xu_ly = mysqli_fetch_array($ds_dh_cho_xu_ly)){
                            ?>
                            <div class="thongtin_donhang">
                                <div class="tt-dh" style="width: 5%;">
                                    <p><?php echo $row_ds_dh_cho_xu_ly['id_don_hang'] ?></p>
                                </div>
                                <div class="info" style="width: 43%;">
                                    <li name="ho_ten">Họ và Tên: <?php echo $row_ds_dh_cho_xu_ly['ho_va_ten'] ?></li>
                                    <li name="so_dien_thoai">Số Điện Thoại: <?php echo $row_ds_dh_cho_xu_ly['so_dien_thoai'] ?></li>
                                    <li name="dia_chi">Địa Chỉ: <?php echo $row_ds_dh_cho_xu_ly['dia_chi_giao_hang'] ?></li>
                                    <li name="email">Email: <?php echo $row_ds_dh_cho_xu_ly['email'] ?></li>
                                    <li name="ghi_chu">Ghi Chú: <?php echo $row_ds_dh_cho_xu_ly['ghi_chu'] ?></li>
                                </div>
                                <div class="tt-dh" style="width: 11%;">
                                    <p><?= $row_ds_dh_cho_xu_ly['tong_tien']?><sup class="gia">₫</sup></p>
                                </div>
                                <div class="tt-dh" style="width: 11%;">
                                    <p><?php echo $row_ds_dh_cho_xu_ly['hinhthuc_thanhtoan'] ?></p>
                                </div>
                                <div class="tt-dh" style="width: 16%; color:red;">
                                    <p id="trangthai">
                                    <p><?php echo $row_ds_dh_cho_xu_ly['trang_thai'] ?></p>
                                </div>
                                <div class="tt-dh" style="width: 9%;">
                                    <p><?php echo $row_ds_dh_cho_xu_ly['ngay_dat'] ?></p>
                                </div>
                                <div class="tt-dh" style="width: 5%; border-right: none; display: flex; justify-content: space-evenly; flex-direction: column;">
                                    <a href="admin/?xem=chi-tiet_don-hang&id_donhang=<?php echo $row_ds_dh_cho_xu_ly['id_don_hang'] ?>" title="Xem chi tiết đơn hàng">Chi tiết</a>
                                    <a href="admin/?xem=sua_don_hang&id_donhang=<?php echo $row_ds_dh_cho_xu_ly['id_don_hang'] ?>" class="sua" title="Sửa đơn hàng" style="color:#333"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="admin/?xem=xoa_don_hang&id_donhang=<?php echo $row_ds_dh_cho_xu_ly['id_don_hang'] ?>" class="xoa" title="Xóa đơn hàng" style="color: red" onclick="if (!confirm('Bạn có chắc chắn muốn xóa đơn hàng?')) { return false }"><span class="glyphicon glyphicon-remove"></span></a>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!--  tab đơn hàng đang xử lý -->
            <div class="tab-pane container fade" id="dang_xu_ly">
                <div class="hienthi_noidung">
                    <div class="table_sp">
                        <div class="top_table">
                            <div class="tt-dh" style="width: 5%;">Id_ĐH</div>
                            <div class="tt-dh" style="width: 43%;">Thông Tin Đơn Hàng</div>
                            <div class="tt-dh" style="width: 11%;">Tổng Tiền</div>
                            <div class="tt-dh" style="width: 11%;">HT TT</div>
                            <div class="tt-dh" style="width: 16%;">Trạng Thái</div>
                            <div class="tt-dh" style="width: 9%;">Ngày Đặt</div>
                            <div class="tt-dh" style="width: 5%; border-right: none">Tác Vụ</div>
                        </div>
                        <div class="main_table" style="border-bottom: 1px solid #d1d0d0;">
                            <?php
                                while($row_ds_dh_dang_xu_ly = mysqli_fetch_array($ds_dh_dang_xu_ly)){
                            ?>
                            <div class="thongtin_donhang">
                                <div class="tt-dh" style="width: 5%;">
                                    <p><?php echo $row_ds_dh_dang_xu_ly['id_don_hang'] ?></p>
                                </div>
                                <div class="info" style="width: 43%;">
                                    <li name="ho_ten">Họ và Tên: <?php echo $row_ds_dh_dang_xu_ly['ho_va_ten'] ?></li>
                                    <li name="so_dien_thoai">Số Điện Thoại: <?php echo $row_ds_dh_dang_xu_ly['so_dien_thoai'] ?></li>
                                    <li name="dia_chi">Địa Chỉ: <?php echo $row_ds_dh_dang_xu_ly['dia_chi_giao_hang'] ?></li>
                                    <li name="email">Email: <?php echo $row_ds_dh_dang_xu_ly['email'] ?></li>
                                    <li name="ghi_chu">Ghi Chú: <?php echo $row_ds_dh_dang_xu_ly['ghi_chu'] ?></li>
                                </div>
                                <div class="tt-dh" style="width: 11%;">
                                    <p><?= $row_ds_dh_dang_xu_ly['tong_tien']?><sup class="gia">₫</sup></p>
                                </div>
                                <div class="tt-dh" style="width: 11%;">
                                    <p><?php echo $row_ds_dh_dang_xu_ly['hinhthuc_thanhtoan'] ?></p>
                                </div>
                                <div class="tt-dh" style="width: 16%;">
                                    <p id="trangthai">
                                    <p><?php echo $row_ds_dh_dang_xu_ly['trang_thai'] ?></p>
                                </div>
                                <div class="tt-dh" style="width: 9%;">
                                    <p><?php echo $row_ds_dh_dang_xu_ly['ngay_dat'] ?></p>
                                </div>
                                <div class="tt-dh" style="width: 5%; border-right: none; display: flex; justify-content: space-evenly; flex-direction: column;">
                                    <a href="admin/?xem=chi-tiet_don-hang&id_donhang=<?php echo $row_ds_dh_dang_xu_ly['id_don_hang'] ?>" title="Xem chi tiết đơn hàng">Chi tiết</a>
                                    <a href="admin/?xem=sua_don_hang&id_donhang=<?php echo $row_ds_dh_dang_xu_ly['id_don_hang'] ?>" class="sua" title="Sửa đơn hàng" style="color:#333"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="admin/?xem=xoa_don_hang&id_donhang=<?php echo $row_ds_dh_dang_xu_ly['id_don_hang'] ?>" class="xoa" title="Xóa đơn hàng" style="color: red" onclick="if (!confirm('Bạn có chắc chắn muốn xóa đơn hàng?')) { return false }"><span class="glyphicon glyphicon-remove"></span></a>
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
            <!--  tab đơn hàng đang giao -->
            <div class="tab-pane container fade" id="dang_giao_hang">
                <div class="hienthi_noidung">
                    <div class="table_sp">
                        <div class="top_table">
                            <div class="tt-dh" style="width: 5%;">Id_ĐH</div>
                            <div class="tt-dh" style="width: 43%;">Thông Tin Đơn Hàng</div>
                            <div class="tt-dh" style="width: 11%;">Tổng Tiền</div>
                            <div class="tt-dh" style="width: 11%;">HT TT</div>
                            <div class="tt-dh" style="width: 16%;">Trạng Thái</div>
                            <div class="tt-dh" style="width: 9%;">Ngày Đặt</div>
                            <div class="tt-dh" style="width: 5%; border-right: none">Tác Vụ</div>
                        </div>
                        <div class="main_table" style="border-bottom: 1px solid #d1d0d0;">
                            <?php
                                while($row_ds_dh_dang_giao = mysqli_fetch_array($ds_dh_dang_giao)){
                            ?>
                            <div class="thongtin_donhang">
                                <div class="tt-dh" style="width: 5%;">
                                    <p><?php echo $row_ds_dh_dang_giao['id_don_hang'] ?></p>
                                </div>
                                <div class="info" style="width: 43%;">
                                    <li name="ho_ten">Họ và Tên: <?php echo $row_ds_dh_dang_giao['ho_va_ten'] ?></li>
                                    <li name="so_dien_thoai">Số Điện Thoại: <?php echo $row_ds_dh_dang_giao['so_dien_thoai'] ?></li>
                                    <li name="dia_chi">Địa Chỉ: <?php echo $row_ds_dh_dang_giao['dia_chi_giao_hang'] ?></li>
                                    <li name="email">Email: <?php echo $row_ds_dh_dang_giao['email'] ?></li>
                                    <li name="ghi_chu">Ghi Chú: <?php echo $row_ds_dh_dang_giao['ghi_chu'] ?></li>
                                </div>
                                <div class="tt-dh" style="width: 11%;">
                                    <p><?= $row_ds_dh_dang_giao['tong_tien']?><sup class="gia">₫</sup></p>
                                </div>
                                <div class="tt-dh" style="width: 11%;">
                                    <p><?php echo $row_ds_dh_dang_giao['hinhthuc_thanhtoan'] ?></p>
                                </div>
                                <div class="tt-dh" style="width: 16%;">
                                    <p id="trangthai">
                                    <p><?php echo $row_ds_dh_dang_giao['trang_thai'] ?></p>
                                </div>
                                <div class="tt-dh" style="width: 9%;">
                                    <p><?php echo $row_ds_dh_dang_giao['ngay_dat'] ?></p>
                                </div>
                                <div class="tt-dh" style="width: 5%; border-right: none; display: flex; justify-content: space-evenly; flex-direction: column;">
                                    <a href="admin/?xem=chi-tiet_don-hang&id_donhang=<?php echo $row_ds_dh_dang_giao['id_don_hang'] ?>" title="Xem chi tiết đơn hàng">Chi tiết</a>
                                    <a href="admin/?xem=sua_don_hang&id_donhang=<?php echo $row_ds_dh_dang_giao['id_don_hang'] ?>" class="sua" title="Sửa đơn hàng" style="color:#333"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="admin/?xem=xoa_don_hang&id_donhang=<?php echo $row_ds_dh_dang_giao['id_don_hang'] ?>" class="xoa" title="Xóa đơn hàng" style="color: red" onclick="if (!confirm('Bạn có chắc chắn muốn xóa đơn hàng?')) { return false }"><span class="glyphicon glyphicon-remove"></span></a>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!--  tab đơn hàng giao thành công -->
            <div class="tab-pane container fade" id="giao_hang_thanh_cong">
                <div class="hienthi_noidung">
                    <div class="table_sp">
                        <div class="top_table">
                            <div class="tt-dh" style="width: 5%;">Id_ĐH</div>
                            <div class="tt-dh" style="width: 43%;">Thông Tin Đơn Hàng</div>
                            <div class="tt-dh" style="width: 11%;">Tổng Tiền</div>
                            <div class="tt-dh" style="width: 11%;">HT TT</div>
                            <div class="tt-dh" style="width: 16%;">Trạng Thái</div>
                            <div class="tt-dh" style="width: 9%;">Ngày Đặt</div>
                            <div class="tt-dh" style="width: 5%; border-right: none">Tác Vụ</div>
                        </div>
                        <div class="main_table" style="border-bottom: 1px solid #d1d0d0;">
                            <?php
                                while($row_ds_dh_giao_thanh_cong = mysqli_fetch_array($ds_dh_giao_thanh_cong)){
                            ?>
                            <div class="thongtin_donhang">
                                <div class="tt-dh" style="width: 5%;">
                                    <p><?php echo $row_ds_dh_giao_thanh_cong['id_don_hang'] ?></p>
                                </div>
                                <div class="info" style="width: 43%;">
                                    <li name="ho_ten">Họ và Tên: <?php echo $row_ds_dh_giao_thanh_cong['ho_va_ten'] ?></li>
                                    <li name="so_dien_thoai">Số Điện Thoại: <?php echo $row_ds_dh_giao_thanh_cong['so_dien_thoai'] ?></li>
                                    <li name="dia_chi">Địa Chỉ: <?php echo $row_ds_dh_giao_thanh_cong['dia_chi_giao_hang'] ?></li>
                                    <li name="email">Email: <?php echo $row_ds_dh_giao_thanh_cong['email'] ?></li>
                                    <li name="ghi_chu">Ghi Chú: <?php echo $row_ds_dh_giao_thanh_cong['ghi_chu'] ?></li>
                                </div>
                                <div class="tt-dh" style="width: 11%;">
                                    <p><?= $row_ds_dh_giao_thanh_cong['tong_tien']?><sup class="gia">₫</sup></p>
                                </div>
                                <div class="tt-dh" style="width: 11%;">
                                    <p><?php echo $row_ds_dh_giao_thanh_cong['hinhthuc_thanhtoan'] ?></p>
                                </div>
                                <div class="tt-dh" style="width: 16%; color:#0ccd10;">
                                    <p id="trangthai">
                                    <p><?php echo $row_ds_dh_giao_thanh_cong['trang_thai'] ?></p>
                                </div>
                                <div class="tt-dh" style="width: 9%;">
                                    <p><?php echo $row_ds_dh_giao_thanh_cong['ngay_dat'] ?></p>
                                </div>
                                <div class="tt-dh" style="width: 5%; border-right: none; display: flex; justify-content: space-evenly; flex-direction: column;">
                                    <a href="admin/?xem=chi-tiet_don-hang&id_donhang=<?php echo $row_ds_dh_giao_thanh_cong['id_don_hang'] ?>" title="Xem chi tiết đơn hàng">Chi tiết</a>
                                    <a name="giao_hang_thanh_cong" title="Đơn hàng giao thành công" style="color:#0ccd10"><span class="glyphicon glyphicon-ok"></span></a>
                                    <a href="admin/?xem=xoa_don_hang&id_donhang=<?php echo $row_ds_dh_giao_thanh_cong['id_don_hang'] ?>" class="xoa" title="Xóa đơn hàng" style="color: red" onclick="if (!confirm('Bạn có chắc chắn muốn xóa đơn hàng?')) { return false }"><span class="glyphicon glyphicon-remove"></span></a>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!--  tab đơn hàng đã hủy -->
            <div class="tab-pane container fade" id="don_hang_da_huy">
                <div class="hienthi_noidung">
                    <div class="table_sp">
                        <div class="top_table">
                            <div class="tt-dh" style="width: 5%;">Id_ĐH</div>
                            <div class="tt-dh" style="width: 43%;">Thông Tin Đơn Hàng</div>
                            <div class="tt-dh" style="width: 11%;">Tổng Tiền</div>
                            <div class="tt-dh" style="width: 11%;">HT TT</div>
                            <div class="tt-dh" style="width: 16%;">Trạng Thái</div>
                            <div class="tt-dh" style="width: 9%;">Ngày Đặt</div>
                            <div class="tt-dh" style="width: 5%; border-right: none">Tác Vụ</div>
                        </div>
                        <div class="main_table" style="border-bottom: 1px solid #d1d0d0;">
                            <?php
                                while($row_ds_dh_da_huy = mysqli_fetch_array($ds_dh_da_huy)){
                            ?>
                            <div class="thongtin_donhang" style="color:red">
                                <div class="tt-dh" style="width: 5%;">
                                    <p><?php echo $row_ds_dh_da_huy['id_don_hang'] ?></p>
                                </div>
                                <div class="info" style="width: 43%;">
                                    <li name="ho_ten">Họ và Tên: <?php echo $row_ds_dh_da_huy['ho_va_ten'] ?></li>
                                    <li name="so_dien_thoai">Số Điện Thoại: <?php echo $row_ds_dh_da_huy['so_dien_thoai'] ?></li>
                                    <li name="dia_chi">Địa Chỉ: <?php echo $row_ds_dh_da_huy['dia_chi_giao_hang'] ?></li>
                                    <li name="email">Email: <?php echo $row_ds_dh_da_huy['email'] ?></li>
                                    <li name="ghi_chu">Ghi Chú: <?php echo $row_ds_dh_da_huy['ghi_chu'] ?></li>
                                </div>
                                <div class="tt-dh" style="width: 11%;">
                                    <p><?= $row_ds_dh_da_huy['tong_tien']?><sup class="gia">₫</sup></p>
                                </div>
                                <div class="tt-dh" style="width: 11%;">
                                    <p><?php echo $row_ds_dh_da_huy['hinhthuc_thanhtoan'] ?></p>
                                </div>
                                <div class="tt-dh" style="width: 16%;">
                                    <p id="trangthai">
                                    <p><?php echo $row_ds_dh_da_huy['trang_thai'] ?></p>
                                </div>
                                <div class="tt-dh" style="width: 9%;">
                                    <p><?php echo $row_ds_dh_da_huy['ngay_dat'] ?></p>
                                </div>
                                <div class="tt-dh" style="width: 5%; border-right: none; display: flex; justify-content: space-evenly; flex-direction: column;">
                                    <a href="admin/?xem=chi-tiet_don-hang&id_donhang=<?php echo $row_ds_dh_da_huy['id_don_hang'] ?>" title="Xem chi tiết đơn hàng">Chi tiết</a>
                                    <a href="admin/?xem=sua_don_hang&id_donhang=<?php echo $row_ds_dh_da_huy['id_don_hang'] ?>" class="sua" title="Sửa đơn hàng" style="color:#333"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="admin/?xem=xoa_don_hang&id_donhang=<?php echo $row_ds_dh_da_huy['id_don_hang'] ?>" class="xoa" title="Xóa đơn hàng" style="color: red" onclick="if (!confirm('Bạn có chắc chắn muốn xóa đơn hàng?')) { return false }"><span class="glyphicon glyphicon-remove"></span></a>
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
    </div>
</div>