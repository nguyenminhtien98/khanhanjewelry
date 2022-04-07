<?php
	// thêm thành viên admin
	if(isset($_POST["them"]) ){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$ho_va_ten = $_POST["ho_va_ten"];
		$email = $_POST["email"];
		$so_dien_thoai = $_POST["so_dien_thoai"];
		$vai_tro = $_POST["vai_tro"];
		$ngay_tao = $_POST["ngay_tao"];
		$password = md5($password);
		// thêm thành viên admin vào database
		$insert_thanh_vien = "INSERT INTO user VALUES(null, '$username', '$password', '$ho_va_ten', '$email', '$so_dien_thoai', '$ngay_tao', '$vai_tro')";
		mysqli_query($conn,$insert_thanh_vien);
		//chuyển hướng trang đến trang danh sách thành viên admin;
		echo '<script>alert("Thêm thành viên thành công!")</script>';
		echo "<script> window.location.href='admin/?xem=ds_thanh-vien_admin'</script>";
	}
?>
<div class="them_thanh-vien_admin">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Thêm Thành Viên Admin</li>
        </div>
    </div>
    <div class="main_content">
        <form method="POST" enctype="multipart/form-data">
            <div class="them_san_pham">
                <div class="thong_tin_chung">
                    <h3>THÔNG TIN CHUNG</h3>
                </div>
                <div class="dien_thong_tin">
                    <table>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Username:</p></th>
                            <th><input type="text" name="username" size="70"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Password:</p></th>
                            <th><input type="password" name="password" size="70"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Họ và tên:</p></th>
                            <th><input type="text" name="ho_va_ten" size="70"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Email:</p></th>
                            <th><input type="text" name="email" size="70"></input></th>
                        </tr>
                        <tr class="thong_tin">
                           <th><p class="tieu_de" >Số điện thoại:</p></th>
                           <th><input type="text" name="so_dien_thoai" size="70"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Vai trò:</p></th>
                            <th><select name="vai_tro">
                                    <option value="1">-- Chủ Shop --</option>
                                    <option value="2">Quản Trị Viên</option>
                                    <option value="3">Khách Hàng</option>
                                </select>
                            </th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ngày tạo:</p></th>
                            <th><input type="date" name="ngay_tao"></input></th>
                        </tr>
                    </table>
                    <div class="btn_luu">
                        <button type="submit" name="them">THÊM</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>