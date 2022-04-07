
<?php  
	// lấy chi tiết đơn hàng theo id đơn hàng
	$don_hang = mysqli_query($conn, "SELECT don_hang.id_don_hang, don_hang_chi_tiet.*, san_pham.ten AS ten_sp
	FROM don_hang
	INNER JOIN don_hang_chi_tiet ON don_hang.id_don_hang = don_hang_chi_tiet.id_don_hang
	INNER JOIN san_pham ON san_pham.id_sp = don_hang_chi_tiet.id_sp
	WHERE don_hang_chi_tiet.id_don_hang = " . $_GET['id_donhang']);
	$don_hang = mysqli_fetch_all($don_hang, MYSQLI_ASSOC);

?>

<div class="chitiet_donhang">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Chi Tiết Đơn Hàng</li>
        </div>
    </div>
    <div class="main_content">
        <div class="tac_vu">
            <div class="them_moi">
                <a href="admin/?xem=them_danh_muc"><li><span class="glyphicon glyphicon-plus"></span> Thêm Danh Mục</li></a>
            </div>
            <div class="tim_kiem">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit">Tìm kiếm</button>
            </div>
            <div class="sap_xep_sp_admin">
                <h5>Sắp xếp theo: </h5>
                <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value)">
                    <option value="">Mặc định</option>
                    <!-- sắp xếp giá giảm dần -->
                    <option value="">Giá giảm dần</option>
                    <!-- sắp xếp giá tăng dần -->
                    <option value="">Giá tăng dần</option>
                    <!-- sắp xếp sản phẩm mới về -->
                    <option value="">Mới nhất</option>
                    <!-- sắp xếp sản phẩm bán chạy -->
                    <option value="">Bán chạy</option>
                </select>
            </div>
        </div>
        <div class="hienthi_noidung">
            <div class="table_sp" style="width: 75%; margin: auto;">
                <div class="top_table">
                    <div class="tt-dh" style="width: 10%;">Id_ĐH_CT</div>
                    <div class="tt-dh" style="width: 8%;">Id_ĐH</div>
                    <div class="tt-dh" style="width: 13%;">Id Sản Phẩm</div>
                    <div class="tt-dh" style="width: 44%;">Tên Sản Phẩm</div>
                    <div class="tt-dh" style="width: 10%;">Số Lượng</div>
                    <div class="tt-dh" style="width: 15%;border-right: none">Giá Sản Phẩm</div>
                </div>
                <div class="main_table" style="border-bottom: 1px solid #d1d0d0;">
                    <?php
						foreach ($don_hang as $row_donhang_ct)	{
					?>
                    <div class="thongtin_donhang">
                        <div class="tt-dh-ct" style="width: 10%;"><p><?php echo $row_donhang_ct['id_don_hang_ct'] ?></p></div>
                        <div class="tt-dh-ct" style="width: 8%;"><p><?php echo $row_donhang_ct['id_don_hang'] ?></p></div>
                        <div class="tt-dh-ct" style="width: 13%;"><p><?php echo $row_donhang_ct['id_sp'] ?></p></div>
                        <div class="tt-dh-ct" style="width: 44%;"><p><?php echo $row_donhang_ct['ten_sp'] ?></p></div>
                        <div class="tt-dh-ct" style="width: 10%;"><p><?php echo $row_donhang_ct['so_luong'] ?></p></div>                        <div class="tt-dh-ct" style="width: 15%;border-right: none"><p><?= number_format($row_donhang_ct['gia_sp'], 0, ",", ".")?><sup class="gia">₫</sup></p></div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>