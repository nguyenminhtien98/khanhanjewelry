
<!--kiểm tra đăng nhập-->
<?php
	//Gọi file connection.php ở bài trước
	require_once("../lib/dbCon.php");
	// Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
	if (isset($_POST["submit"])) {
		// lấy thông tin người dùng
		$username = $_POST["username"];
		$password = $_POST["password"];
		$password = md5($password);
		//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
		//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
		$username = strip_tags($username);
		$username = addslashes($username);
		$password = strip_tags($password);
		$password = addslashes($password);
		if ($username == "" || $password =="") {
			echo "username hoặc password bạn không được để trống!";
		}else{
			$sql = "select * from user where username = '$username' and password = '$password' ";
			$query = mysqli_query($conn,$sql);
			$num_rows = mysqli_num_rows($query);
			if ($num_rows==0) {
				echo "<script type='text/javascript'>alert('Tên đăng nhập hoặc mật khẩu không đúng');</script>";
			}else{
				// Lấy ra thông tin người dùng và lưu vào session
				while ( $data = mysqli_fetch_array($query) ) {
					$_SESSION["iduser"] = $data["id_user"];
					$_SESSION['username'] = $data["username"];
					$_SESSION["name"] = $data["ho_va_ten"];
					$_SESSION["vai_tro"] = $data["vai_tro"];
					
				}
				
				// Thực thi hành động sau khi lưu thông tin vào session
				// tiến hành chuyển hướng trang web index.php
				header('Location: index.php');
			}
		}
	}
?>

<div id="home_admin">
    <div class="login">
        <form action="" method="POST">
            <div class="form">
                <h2>HELLO ADMIN</h2>
                <div class="form-field">
                    <label for="login-mail"><i class="fa fa-user"></i></label>
                    <input id="mail" type="text" name="username" placeholder="E-Mail" required>
                </div>
                <div class="form-field">
                    <label for="login-password"><i class="fa fa-lock"></i></label>
                    <input id="password" type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="button" name="submit">
                    <div class="arrow-wrapper">
                        <p class="button_text">ĐĂNG NHẬP</p>
                    </div>  
                </button>
            </div>
        </form>
    </div>
</div>
