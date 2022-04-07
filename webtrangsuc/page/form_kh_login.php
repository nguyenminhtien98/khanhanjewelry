
<!--kiểm tra đăng nhập-->
<?php
	//Gọi file connection.php ở bài trước
	require_once("./lib/dbCon.php");
	// Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
	if (isset($_POST["login"])) {
		// lấy thông tin người dùng 
		$email = $_POST["email"];
		$password = $_POST["password"];
		$password = md5($password);

		if ($email == "" || $password =="") {
			echo "email hoặc password bạn không được để trống!";
		}else{
			$sql = "SELECT * FROM `user` WHERE email = '$email' AND password = '$password'";
			$query = mysqli_query($conn,$sql);
			$num_rows = mysqli_num_rows($query);
			if ($num_rows==0) {
				echo "<script type='text/javascript'>alert('Email hoặc mật khẩu không đúng');</script>";
			}else{
				// Lấy ra thông tin người dùng và lưu vào session
				while ( $data = mysqli_fetch_array($query) ) {
					$_SESSION["user_kh"] = $data["id_user"];
					$_SESSION["name_kh"] = $data["ho_va_ten"];
					$_SESSION["sdt_kh"] = $data["so_dien_thoai"];
					$_SESSION["email_kh"] = $data["email"];
					$_SESSION["vai_tro"] = $data["vai_tro"];
				}
				
				// Thực thi hành động sau khi lưu thông tin vào session
				// tiến hành chuyển hướng trang web index.php
				header('Location: ?xem=tai-khoan-cua-toi');
			}
		}
	}
?>

<?php
	// login google

?>
<div class="kh_login">
	<div class="container">
		<div class="duongdan">
			<div class="ten_danh_muc"><a href="#">Trang chủ</a> / <span>Đăng Nhập</span></div>
		</div>
		<div class="login">
			<div class="top_login">
				<h3>Đăng Nhập Tài Khoản</h3>
			</div>
			<div class="main_login">
				<div class="form_dangnhap">
					<form action="" method="POST" class="login">
						<div class="top_form">
							<p>Nếu bạn có một tài khoản, vui lòng đăng nhập *</p>
							<div class="social-login">
								<a href="#" class="fb btn">
						        	<i class="fa fa-facebook fa-fw"></i> Facebook
						        </a>
								<a href="#" class="google btn"><i class="fa fa-google fa-fw">
						        	</i> Google+
						        </a>
							</div>
						</div>
						<div class="main_form">
							<label for="customer_email">Email <span class="required">*</span></label>
							<input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="email" name="email" autocomplete="off" required></input>
							<label for="customer_password">Password <span class="required">*</span></label>
							<input type="password" class="password" id="password" name="password" required></input>
							<div class="showPass">
								<input type="checkbox" onclick="showPass()"><span>Show Password</span></input>
							</div>
						</div>
						<div class="end_form">
							<p class="reg">Nếu chưa có tài khoản click vào <a href="?xem=register">đây</a> để đăng ký.</p>
							<a href="">Mất mật khẩu?</a>
							<div class="btn_login">
							    <button type="submit" name="login">Đăng Nhập</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>