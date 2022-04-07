<style>
	.main_right {
    background-color: #edf0f7;
}
</style>
<?php
	//truy vấn tính tổng doanh thu
	$qr = "
		SELECT SUM(tong_tien) FROM don_hang WHERE trang_thai=4
	";
	$doanh_thu = mysqli_query($conn,$qr);
	$row_doanh_thu = mysqli_fetch_array($doanh_thu);
?>
<?php
	//truy vấn tính tổng đơn hàng
	$qr = "
		SELECT COUNT(id_don_hang) FROM don_hang
	";
	$tong_don_hang = mysqli_query($conn,$qr);
	$row_tong_don_hang = mysqli_fetch_array($tong_don_hang);
?>
<?php
	//truy vấn đơn hàng đang chờ xử lý
	$qr = "
		SELECT COUNT(trang_thai) FROM don_hang WHERE trang_thai=1
	";
	$don_hang_cho_xl = mysqli_query($conn,$qr);
	$row_don_hang_cho_xl = mysqli_fetch_array($don_hang_cho_xl);
?>
<?php
	//truy vấn tính tổng đơn hàng trong ngày
	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	include("carbon/autoload.php");
	$now = Carbon::now("Asia/Ho_chi_minh")->toDateString();
	
	$qr = "
		SELECT COUNT(id_don_hang) FROM don_hang WHERE ngay_dat='".$now."';
	";
	$don_hang_trong_ngay = mysqli_query($conn,$qr);
	$row_don_hang_trong_ngay = mysqli_fetch_array($don_hang_trong_ngay);
?>

<?php
	//truy vấn tổng doanh thu theo tháng
	if (isset($_GET['thang'])) {
		$query_tong_doanhthu = mysqli_query($conn, "SELECT SUM(donhang), SUM(doanhthu), SUM(soluongban) FROM thong_ke WHERE MONTH(ngaydat)='$_GET[thang]'");
		}else{$query_tong_doanhthu = mysqli_query($conn, "SELECT SUM(donhang), SUM(doanhthu), SUM(soluongban) FROM thong_ke WHERE MONTH(ngaydat)=12");	
	}
	$row_tong_doanhthu = mysqli_fetch_array($query_tong_doanhthu);	
?>

<?php 
	//truy vấn sản phẩm giảm giá
	$qr = "select * from san_pham 
		   where giam_gia = 1
		   ORDER BY id_sp DESC
		   ";
	$query_spgiamgia = mysqli_query($conn,$qr);
?>



<?php
// lấy id sản phẩm và số lần mua của top 10 sản phẩm bán chạy trong bảng đơn hàng chi tiết
    $qr = "SELECT `id_sp`, COUNT(`id_sp`) AS `solan` 
    FROM `don_hang_chi_tiet` 
    GROUP BY `id_sp` 
    ORDER BY `solan` DESC 
    LIMIT 10";
    $top_sp_bc = mysqli_query($conn,$qr);
?>


	

<div class="tong_quat">
	<div class="top_tong_quat">
    	<div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Tổng Quát Trang Admin</li>
        </div>
		<div class="thongke_nhanh">
            <!-- tổng doanh thu -->
            <a href="admin/?xem=trang_chu#bangdoanhthu" style="background: #1DD165;">  
                <div class="doanh_thu">
                    <div class="doanhthu_left">
                        <h4>Doanh Thu</h4>
                        <h4><?= number_format($row_doanh_thu['SUM(tong_tien)'], 0, ",", ".")?> VND</h4>
                    </div>
                    <div class="doanhthu_right">
                        <i class='fas fa-money-check-alt'></i>
                    </div>
                </div>
            </a>
            <!-- tổng đơn hàng --> 
            <a href="admin/?xem=ds_don_hang" style="background: #ffbf00"> 
                <div class="tong_don_hang">
                    <div class="tong_dh_left">
                        <h4>Tổng Đơn Hàng</h4>
                        <h4><?php echo $row_tong_don_hang['COUNT(id_don_hang)'] ?> Đơn Hàng</h4>
                    </div>
                    <div class="tong_dh_right">
                        <i class='fas fa-boxes'></i>
                    </div>
                </div>
            </a>
            <!-- tổng đơn hàng đang chờ xử lý --> 
            <a href="admin/?xem=ds_don_hang#dangchoxuly" style="background: #D102B2"> 
                <div class="don_hang_cho_xu_ly">
                    <div class="dh_cho_xu_ly_left">
                        <h4>Đơn Hàng Chờ Xử Lý</h4>
                        <h4><?php echo $row_don_hang_cho_xl['COUNT(trang_thai)'] ?> Đơn Hàng</h4>
                    </div>
                    <div class="dh_cho_xu_ly_right">
                        <i class='fas fa-tools'></i>
                    </div>
                </div>
            </a>
            <!-- tổng đơn hàng trong ngày --> 
            <a href="#" style="background: #4BB8EB"> 
                <div class="don_hang_trong_ngay">
                    <div class="dh_trongngay_left">
                        <h4>Đơn Hàng Trong Ngày</h4>
                        <h4><?php echo $row_don_hang_trong_ngay['COUNT(id_don_hang)'] ?> Đơn Hàng</h4>
                    </div>
                    <div class="dh_trongngay_right">
                        <i class='fas fa-shipping-fast'></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="main_tong_quat">
    	<div class="bd_doanhthu_sp_banchay">
            <div class="left_bieudo">
                <!-- biểu đồ thống kê đơn hàng --> 
                <div class="thong_ke_doanh_thu">
                    <div class="top_doanh_thu">
                        <h3>Biểu Đồ Thống Kê Doanh Thu Theo: <span id="text-date"></span></h3>
                        <div class="chon_thong_ke">
                            <p>Chọn Thống Kê Theo: </p>
                            <select class="select-date">
                                <option value="7ngay">Mặc định</option>
                                <option value="7ngay">7 Ngày qua</option>
                                <option value="28ngay">28 Ngày qua</option>
                                <option value="90ngay">90 Ngày qua</option>
                                <option value="365ngay">365 Ngày qua</option>
                            </select>
                        </div>
                    </div>
                    <div class="bieudo_thongke">
                        <div id="chart" style="height: 276px;"></div>
                    </div>
                </div>
            </div>
            <div class="right_sp_banchay">
                <div class="sp_banchay">
                    <div class="top_sp_banchay">
                        <h3>Top 10 sản phẩm bán chạy</h3>
                    </div>
                    <div class="main_sp_banchay">
                        <?php
                            while($row_top_sp_bc = mysqli_fetch_array($top_sp_bc)){
                            $id_sanpham = $row_top_sp_bc['id_sp'];
                            //truy vấn bảng sản phẩm bằng id để lấy tên sản phẩm giá sp của 10 sp bán chạy
                            $qr = "select * from san_pham 
                                   where id_sp = $id_sanpham
                                   ORDER BY id_sp DESC
                                   ";
                            $query_spbanchay = mysqli_query($conn,$qr);
                            while($row_sp_sp_bc = mysqli_fetch_array($query_spbanchay)){
                        ?>
                        <div class="tt_sp_banchay">
                            <div class="anh">
                                <img src="images_sanpham/<?php echo $row_sp_sp_bc['anh_dai_dien'] ?>" width="100%"/>
                            </div>
                            <div class="ten_luotmua">
                                <span><?php echo $row_top_sp_bc['solan'] ?> Lượt mua</span>
                                <p><?php echo $row_sp_sp_bc['ten'] ?></p>
                            </div>
                            <div class="gia">
                                <?php
                                    if ($row_sp_sp_bc['giam_gia'] == 1 ) {
                                ?>
                                <p><?php echo number_format($row_sp_sp_bc["gia_giam_gia"], 0, ",", ".")?><sup class="gia">₫</sup></p>
                                <?php   
                                    }else{
                                ?>
                                <p><?php echo number_format($row_sp_sp_bc["gia_ban"], 0, ",", ".")?><sup class="gia">₫</sup></p>
                                <?php        
                                    }
                                ?>
                                
                            </div>
                        </div>
                        <?php
                            }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="thongke_tongdoanhthu_thang">
        	<div class="left_bangdoanhthu">
            	<div id="bangdoanhthu">
                    <div class="tong_doanhthu">
                        <div class="top_tong_doanhthu">
                            <h3>Thống Kê Tổng Doanh Thu Theo Tháng</h3>
                            <div class="chon_thongke">
                                <p>Thống kê theo tháng:</p>
                                <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value)">
                                    <option value="admin/?xem=trang_chu">Tháng hiện tại</option>
                                    <option <?php if(isset($_GET['thang']) && $_GET['thang'] == "12") { ?> selected <?php } ?> value="admin/?xem=trang_chu&thang=12">Tháng 12</option>
                                    <option <?php if(isset($_GET['thang']) && $_GET['thang'] == "11") { ?> selected <?php } ?> value="admin/?xem=trang_chu&thang=11">Tháng 11</option>
                                    <option <?php if(isset($_GET['thang']) && $_GET['thang'] == "10") { ?> selected <?php } ?> value="admin/?xem=trang_chu&thang=10">Tháng 10</option>
                                    <option <?php if(isset($_GET['thang']) && $_GET['thang'] == "9") { ?> selected <?php } ?> value="admin/?xem=trang_chu&thang=9">Tháng 9</option>
                                    <option <?php if(isset($_GET['thang']) && $_GET['thang'] == "8") { ?> selected <?php } ?> value="admin/?xem=trang_chu&thang=8">Tháng 8</option>
                                    <option <?php if(isset($_GET['thang']) && $_GET['thang'] == "7") { ?> selected <?php } ?> value="admin/?xem=trang_chu&thang=7">Tháng 7</option>
                                    <option <?php if(isset($_GET['thang']) && $_GET['thang'] == "6") { ?> selected <?php } ?> value="admin/?xem=trang_chu&thang=6">Tháng 6</option>
                                    <option <?php if(isset($_GET['thang']) && $_GET['thang'] == "5") { ?> selected <?php } ?> value="admin/?xem=trang_chu&thang=5">Tháng 5</option>
                                    <option <?php if(isset($_GET['thang']) && $_GET['thang'] == "4") { ?> selected <?php } ?> value="admin/?xem=trang_chu&thang=4">Tháng 4</option>
                                    <option <?php if(isset($_GET['thang']) && $_GET['thang'] == "3") { ?> selected <?php } ?> value="admin/?xem=trang_chu&thang=3">Tháng 3</option>
                                    <option <?php if(isset($_GET['thang']) && $_GET['thang'] == "2") { ?> selected <?php } ?> value="admin/?xem=trang_chu&thang=2">Tháng 2</option>
                                    <option <?php if(isset($_GET['thang']) && $_GET['thang'] == "1") { ?> selected <?php } ?> value="admin/?xem=trang_chu&thang=1">Tháng 1</option>
                                </select>
                            </div>
                        </div>
                        <div class="main_tong_doanhthu">
                            <div class="bang_thongke" style="padding: 0 15px;">
                                <div class="hienthi_noidung">
                                    <div class="table_doanhthu">
                                        <div class="top_table">
                                            <div class="tt-dh" style="width: 30%;">Tổng Đơn Hàng</div>
                                            <div class="tt-dh" style="width: 40%;">Tổng Số Lượng Sản Phẩm Bán Ra</div>
                                            <div class="tt-dh" style="width: 30%; border-right: none">Tổng Doanh Thu</div>
                                        </div>
                                        <div class="main_table" style="border-bottom: 1px solid #d1d0d0;">
                                            
                                            <div class="thongtin_doanhthu">
                                                <div class="tt-dt" style="width: 30%;"><?php echo $row_tong_doanhthu['SUM(donhang)'] ?> Đơn hàng</div>
                                                <div class="tt-dt" style="width: 40%;"><?php echo $row_tong_doanhthu['SUM(soluongban)'] ?> Sản phẩm</div>
                                                <div class="tt-dt" style="width: 30%; border-right: none"><?php echo number_format($row_tong_doanhthu['SUM(doanhthu)'], 0, ",", ".")?> VND</div>
                                            </div>
        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="right_sp_giamgia">
            	<div class="sp_giamgia">
                    <div class="top_sp_giamgia">
                        <h3>Sản Phẩm Giảm Giá</h3>
                    </div>
                    <div class="main_sp_giamgia">
                        <?php
                            while($row_sp_giamgia = mysqli_fetch_array($query_spgiamgia)){
                        ?>
                        <div class="tt_sp_giamgia">
                            <div class="anh">
                                <img src="images_sanpham/<?php echo $row_sp_giamgia['anh_dai_dien'] ?>" width="100%"/>
                            </div>
                            <div class="ten_luotmua">
                                
                                <p><?php echo $row_sp_giamgia['ten'] ?></p>
                            </div>
                            <div class="gia" style="">
                                <p><?php echo number_format($row_sp_giamgia['gia_giam_gia'], 0, ",", ".")?><sup class="gia">₫</sup></p>
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