<style>
	#header {
		display: none;
	} 
	#footer {
		display: none;
	}
</style>

<?php  
	$don_hang = mysqli_query($conn, "SELECT don_hang.id_don_hang, don_hang.ho_va_ten, don_hang.so_dien_thoai, don_hang.dia_chi_giao_hang, don_hang.email, don_hang.ghi_chu, don_hang.tong_tien, don_hang.hinhthuc_thanhtoan, don_hang_chi_tiet.*, san_pham.ten AS ten_sp, san_pham.anh_dai_dien, san_pham.giam_gia, san_pham.gia_giam_gia
	FROM don_hang
	INNER JOIN don_hang_chi_tiet ON don_hang.id_don_hang = don_hang_chi_tiet.id_don_hang
	INNER JOIN san_pham ON san_pham.id_sp = don_hang_chi_tiet.id_sp
	WHERE don_hang.id_don_hang = " . $_GET['id_donhang']);
	$don_hang = mysqli_fetch_all($don_hang, MYSQLI_ASSOC);
?>

<div id="dathang_thanhcong">
	<div class="container">
        <div class="top_dathang_tc">
            <div class="logo">
                <img src="./images/logo.png" style="width: 49%;"/>
            </div>
        </div>
        <div class="main_dathang_tc">
            <div class="thongtin_sp_dattc">
            	<div class="thongtin_sanpham">
                    <div class="soluong_dh" id="soluong_sp">
                        <h3>Đơn hàng #<?php echo $don_hang[0]['id_don_hang'] ?> <span><i class="fas fa-angle-down"></i></span></h3></h3>
                        <h3 class="tongtien"><?php echo $don_hang[0]['tong_tien'] ?>đ</h3>
                    </div>
                    <div class="thongtin_dichvu_dh" id="thongtin_dichvu_dh">
                        <?php
							$tongtien_dh = 0;
                        	foreach ($don_hang as $row_donhang_ct)	{
						?>
                        <div class="thongtin_dh">
                            <div class="anhsp">
                                <img src="images_sanpham/<?php echo $row_donhang_ct['anh_dai_dien'] ?>" width="100%" />
                            </div>
                            <div class="thongtin_sp">
                                <span class="ten_sp"><?php echo $row_donhang_ct['ten_sp'] ?></span>
                                <div class="gia_soluong">
                                    <span class="soluong_sp" name="quantity">Số lượng: <?php echo $row_donhang_ct['so_luong'] ?></span>
                                    
                                    <!-- nếu sản phẩm đươc giảm giá thì lấy giá giảm giá nhân với số lượng -->
                                    <?php if($row_donhang_ct['giam_gia']>0){ ?>
                                    
                                    <p><?php echo number_format($row_donhang_ct['gia_giam_gia'], 0, ",", ".") ?><sup class="gia">₫</sup></p>
                                    <!-- còn nếu sản phẩm không đươc giảm giá thì lấy giá bán nhân với số lượng -->
                                    <?php }else{ ?>
                                    <p><?php echo number_format($row_donhang_ct['gia_sp'], 0, ",", ".") ?><sup class="gia">₫</sup></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
						<?php
							// nếu sản phẩm đươc giảm giá thì lấy giá giảm giá nhân với số lượng
							if($row_donhang_ct['giam_gia']>0){
								$tongtien_dh  += ($row_donhang_ct['gia_giam_gia'] * $row_donhang_ct['so_luong']);
							// còn nếu sản phẩm không đươc giảm giá thì lấy giá bán nhân với số lượng
							}else{
								$tongtien_dh  += ($row_donhang_ct['gia_sp'] * $row_donhang_ct['so_luong']);
							}
						
							}
						?>
                        <div class="phi_vanchuyen">
                            <div class="tamtinh">
                                <p>Tạm tính</p>
                                <span><?php echo number_format($tongtien_dh, 0, ",", ".") ?><sup class="gia">₫</sup></span>
                            </div>
                            <div class="phi_ship">
                                <p>Phí vận chuyển</p>
                                <span>Miễn Phí</span>
                            </div>
                        </div>
                        <div class="thanhtien">
                            <p>Tổng cộng</p>
                            <span><?php echo number_format($tongtien_dh, 0, ",", ".") ?><sup class="gia">₫</sup></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="thongtin_dh_dattc">
            	<div class="thong_bao_thanh_cong">
                	<div class="icon_thongbao">
                    	<i class="far fa-check-circle fa-5x" style="color: blue;"></i>
                    </div>
                    <div class="thongbao_goidien">
                    	<h4>Cảm ơn bạn đã đặt hàng</h4>
                        <p>Khánh An Jewelry sẽ điện xác nhận đơn hàng</br>
                        	Xin vui lòng kiểm tra điện thoại của bạn.
                        </p>
                    </div>
                </div>
                <div class="thongtin_diachi_dh">
                	<div class="tt_muahang_diachi">
                    	<div class="thongtin_muahang">
                        	<h3>Thông tin mua hàng</h3>
                            <p>Họ tên: <?php echo $don_hang[0]['ho_va_ten'] ?></p>
                            <p>Số điện thoại: 0<?php echo $don_hang[0]['so_dien_thoai'] ?></p>
                            <p>Ghi chú: <?php echo $don_hang[0]['ghi_chu'] ?></p>
                        </div>
                        <div class="diachi_nhanhang">
                        	<h3>Địa chỉ nhận hàng</h3>
                            <p>Họ tên: <?php echo $don_hang[0]['ho_va_ten'] ?></p>
                            <p>Số điện thoại: 0<?php echo $don_hang[0]['so_dien_thoai'] ?></p>
                            <p>Địa chỉ nhận hàng: <?php echo $don_hang[0]['dia_chi_giao_hang'] ?></p>
                        </div>
                    </div>
                    <div class="thanhtoan_vanchuyen">
                    	<div class="hinhthuc_thanhtoan">
                        	<h3>Hình thức thanh toán</h3>
                            <p><?php echo $don_hang[0]['hinhthuc_thanhtoan'] ?></p>
                        </div>
                        <div class="hinhthuc_giaohang">
                        	<h3>Hình thức giao hàng</h3>
                            <p>Miễn phí vận chuyển</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_dathang_tc">
            <div class="tieptuc-muahang">
                <a href="./">Tiếp tục mua hàng</a>
            </div>
        </div>
    </div>
</div>