
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
				echo "<script type='text/javascript'>alert('Email hoặc mật khẩu không đúng');</script>";
			}else{
				// Lấy ra thông tin người dùng và lưu vào session
				while ( $data = mysqli_fetch_array($query) ) {
					$_SESSION["sdt"] = $data["so_dien_thoai"];
				}
				
				// Thực thi hành động sau khi lưu thông tin vào session
				// tiến hành chuyển hướng trang web index.php
				header('Location: ?xem=lich-su-don-hang');
			}
		}
	}

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
					<input type="text" name="phone" required>
					<button type="submit" name="tracuu">Tiếp Tục</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
	if (!isset($_SESSION["sdt"]) ) {
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
					<input type="text" name="phone" required>
					<button type="submit" name="tracuu">Tiếp Tục</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
	}else{
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
						<p>Điện thoại: <span>0<?php echo $_SESSION["sdt"]?></span></p>
						<a href="?action=out_sdt" name="out_sdt">Tra cứu số điện khác</button>
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
								<th style="width:10%">Đơn hàng</th>
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
								<th style="width:13%"><?php echo $row_ds_donhang['tong_tien'] ?></th>
								<th style="width:11%"><?php echo $row_ds_donhang['hinhthuc_thanhtoan'] ?></th>
								<th style="width:16%; color: black;"><?php echo $row_ds_donhang['trang_thai'] ?></th>
							</tr>
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