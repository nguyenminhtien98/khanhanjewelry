
<?php 
	// kiểm tra người dùng đã ấn nút tiếp tục thì mới thực hiện gửi dữ liệu
	if (isset($_POST["tracuu"])) {
		// lấy thông tin người dùng 
		$phone = $_POST["phone"];

		if ($phone == "") {
			echo "số điện thoại không được để trống!";
		}else{
			$sql = "SELECT * FROM `don_hang` WHERE so_dien_thoai = '$phone'";
			$query = mysqli_query($conn,$sql);
			$num_rows = mysqli_num_rows($query);
			if ($num_rows==0) {
				echo "<script type='text/javascript'>alert('Số điện thoại không tồn tại trong hệ thống');</script>";
			}else{
				// Lấy ra thông tin người dùng và lưu vào session
				while ( $data = mysqli_fetch_array($query) ) {
					$_SESSION["sdt_tc"] = $data["so_dien_thoai"];
				}
				
				// Thực thi hành động sau khi lưu thông tin vào session
				// tiến hành chuyển hướng trang web index.php
				header('Location: ?xem=lich-su-don-hang');
			}
		}
	}
?>

<?php
	// lấy danh sách đơn hàng theo sdt
	if (isset($_SESSION["sdt_tc"])) {
		// nối số 0 và sdt
		$chuoi = "0";
		$session = $_SESSION["sdt_tc"];
		$phone = $chuoi."".$session."";
		
		$qr = "SELECT * FROM `don_hang` 
			WHERE so_dien_thoai = '".$phone."'
			ORDER BY `id_don_hang` DESC
			";
		$ds_don_hang = mysqli_query($conn,$qr);
	}
?>

<?php
	// out số điện thoại
	if(isset($_GET["action"]) && $_GET["action"] == "out_sdt"){
		unset($_SESSION["sdt_tc"]);
		header('location: ?xem=lich-su-don-hang');
	}
	
?>


<?php
	// kiểm tra nếu không tồn tại session sdt thì hiển thị form tra cứu đơn hàng bằng số điện thoại
	if (!isset($_SESSION["sdt_tc"]) ) {
?>
<div class="tracuu_donhang">
	<div class="container">
		<div class="form_tracuu">
			<form action="" method="POST">
				<div class="bg_tracuu">
					<img src="./images/bg_tracuu.jpg" width="100%" height="630px">
				</div>
				<div class="form_sdt">
					<span>Tra cứu thông tin đơn hàng</span>
					<input type="text" name="phone" placeholder="Nhập số điện thoại mua hàng" autocomplete="off" required>
					<button type="submit" name="tracuu">Tiếp Tục</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
	}else{
	// ngược lại nếu tồn tại session sdt thì hiển thị ra trang khách hàng
?>
<div class="lich_su_don_hang">
	<div class="container">
		<div class="top_page">
			<div class="duongdan">
				<div class="ten_danh_muc" style="padding: 20px 0;">
					<a href="#">Trang chủ</a> / <span>Tra Cứu Đơn Hàng Bằng Số Điện Thoại</span>
				</div>
			</div>
		</div>
		<div class="main_page_kh">
			<div class="left_page">
				<div class="account_cuatoi">
					<div class="top_account">
						<h3>thông tin</h3>
					</div>
					<div class="main_account">
						<p>Số điện thoại: <span>0<?php echo $_SESSION["sdt_tc"]?></span></p>
						<a href="?xem=lich-su-don-hang&action=out_sdt" name="out_sdt">Tra cứu số điện thoại khác</a>
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
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	}
?>