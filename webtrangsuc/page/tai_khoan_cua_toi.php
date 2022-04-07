<?php
	if (isset($_SESSION["user_kh"])) {
		$id_user = $_SESSION["user_kh"];
		
		$qr = "SELECT * FROM `don_hang` 
			WHERE id_user = '".$id_user."'
			ORDER BY `id_don_hang` DESC
			";
		$ds_don_hang = mysqli_query($conn,$qr);
	}
?>

<div class="taikhoan_kh">
	<div class="container">
		<div class="top_page">
			<div class="duongdan">
				<div class="ten_danh_muc" style="padding: 20px 0;"><a href="#">Trang chủ</a> / <span>Trang Khách Hàng</span></div>
			</div>
		</div>
		<div class="main_page_kh">
			<div class="left_page">
				<div class="account_cuatoi">
					<div class="top_account">
						<h3>tài khoản của tôi</h3>
					</div>
					<div class="main_account">
						<?php if(isset($_SESSION["user_kh"])) { ?>
						<p>Họ và tên: <span><?php echo $_SESSION["name_kh"];?></span></p>
						<p>Điện thoại: <span>0<?php echo $_SESSION["sdt_kh"];?></span></p>
						<p>Email: <span><?php echo $_SESSION["email_kh"] ?></span></p>
						<?php 
							}else{
						?>
							<p style="margin: 0; padding: 5px; text-align: center;">Chưa đăng nhập</p>
							<p style="margin: 0; padding: 5px; text-align: center;">Đăng nhập tại <a href="?xem=login" style="color: #333; font-weight: 700;">đây</a></p>
						<?php
							}
						?>
					</div>
				</div>
			</div>
			<div class="right_page">
				<div class="top_right_page">
					<h2>thông tin đơn hàng</h2>
				</div>
				<div class="thong_tin_don_hang">
				
					<table>
						<thead>
							<tr>
								<th style="width:10%">Mã đơn hàng</th>
								<th style="width:11%">Ngày đặt</th>
								<th style="width:39%">Địa chỉ</th>
								<th style="width:13%">Giá trị đơn hàng</th>
								<th style="width:11%">Tình trang thanh toán</th>
								<th style="width:16%">Tình trạng đơn hàng</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if (isset($_SESSION['user_kh'])) {
									while($row_ds_donhang = mysqli_fetch_array($ds_don_hang)){
							?>
							<tr>
								<th style="width:10%">#<?php echo $row_ds_donhang['id_don_hang'] ?></th>
								<th style="width:11%"><?php echo $row_ds_donhang['ngay_dat'] ?></th>
								<th style="width:39%"><?php echo $row_ds_donhang['dia_chi_giao_hang'] ?></th>
								<th style="width:13%"><?php echo $row_ds_donhang['tong_tien'] ?><sup class="gia">₫</sup></th>
								<th style="width:11%"><?php echo $row_ds_donhang['hinhthuc_thanhtoan'] ?></th>
								<?php 
									if ($row_ds_donhang['trang_thai'] ==1) { 
								?>
								<th style="width:16%; color: red;"><?php echo $row_ds_donhang['trang_thai'] ?></th>
								<?php 
									}elseif ($row_ds_donhang['trang_thai'] == 4) {
								?>
								<th style="width:16%; color:#0ccd10"><?php echo $row_ds_donhang['trang_thai'] ?></th>
								
								<?php 
									}else{ 
								?>
								<th style="width:16%; color: black;"><?php echo $row_ds_donhang['trang_thai'] ?></th>
								<?php 
									} 
								?>
							</tr>

							<div class="chitiet_donhang_mobile">
								<p>Mã đơn hàng: #<?php echo $row_ds_donhang['id_don_hang'] ?></p>
								<p>Ngày đặt: <?php echo $row_ds_donhang['ngay_dat'] ?></p>
								<p>Địa chỉ: <?php echo $row_ds_donhang['dia_chi_giao_hang'] ?></p>
								<p>Giá trị đơn hàng: <?php echo $row_ds_donhang['tong_tien'] ?><sup class="gia">₫</sup></p>
								<?php 
									if ($row_ds_donhang['trang_thai'] ==1) { 
								?>
								<p>Tình trạng đơn hàng: <span style="color: red;"><?php echo $row_ds_donhang['trang_thai'] ?></span><p>
								<?php 
									}elseif ($row_ds_donhang['trang_thai'] == 4) {
								?>
								<p>Tình trạng đơn hàng: <span style="color:#0ccd10"><?php echo $row_ds_donhang['trang_thai'] ?></span><p>
								
								<?php 
									}else{ 
								?>
								<p>>Tình trạng đơn hàng: <span style="color: black;"><?php echo $row_ds_donhang['trang_thai'] ?></span><p>
								<?php 
									} 
								?>
							</div>
							<?php
									}
								}else{
							?>
							<tr><td colspan="6" style="padding: 5px">Không có đơn hàng</td></tr>
							<?php
								}
							?>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>