<?php
	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	include("./admin/carbon/autoload.php");
	
	$now = Carbon::now("Asia/Ho_chi_minh")->toDateString();
	
	// thêm user
	if(isset($_POST["dang_ky"]) ){
		$password = $_POST["password"];	
		$ho_va_ten = $_POST["fullname"];	 	
		$email = $_POST["email"];		
		$so_dien_thoai = $_POST["phone"];
		$password = md5($password);

		// thêm tài khoản vào database
		$insert_user = "INSERT INTO user VALUES(null, null, '$password', '$ho_va_ten', '$email', '$so_dien_thoai', '$now', '3: Khách hàng')";
		mysqli_query($conn,$insert_user);
		//chuyển hướng trang đến trang danh index;
		echo '<script>alert("Đăng ký tài khoản thành công!")</script>';
		header("location: ./");
	}	
?>
<div class="kh_login">
	<div class="container">
		<div class="duongdan">
			<div class="ten_danh_muc"><a href="#">Trang chủ</a> / <span>Đăng Ký</span></div>
		</div>
		<div class="dang_ky">
			<div class="top_dang_ky">
				<h3>Đăng Ký Tài Khoản</h3>
			</div>
			<div class="main_dangky">
				<div class="form_dangky">
					<form action="" method="POST">
						<div class="top_form">
							<p>Thông tin cá nhân</p>
						</div>
						<div class="main_form">
							<label for="customer_fullname">Họ và Tên<span class="required">*</span></label>
							<input type="text" class="full_name" name="fullname" autocomplete="off" required></input>
							<label for="customer_email">Email <span class="required">*</span></label>
							<input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="email" name="email" autocomplete="off" required></input>
							<label for="customer_phone">Số điện thoại<span class="required">*</span></label>
							<input type="text" class="phone" name="phone" autocomplete="off" required></input>
							<label for="customer_password">Password <span class="required">*</span></label>
							<input type="password" class="password" name="password" required></input>
						</div>
						<div class="end_form">
							<p class="reg">Nếu đã có tài khoản click vào <a href="?xem=login">đây</a> để đăng nhập.</p>
							<div class="social-login">
								<p>Nếu bạn có một tài khoản, vui lòng đăng nhập *</p>
								<a href="#" class="fb btn">
						        	<i class="fa fa-facebook fa-fw"></i> Facebook
						        </a>
								<a href="#" class="google btn"><i class="fa fa-google fa-fw">
						        	</i> Google+
						        </a>
							</div>
							<div class="btn_login">
							    <button type="submit" name="dang_ky">Đăng Ký</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>	