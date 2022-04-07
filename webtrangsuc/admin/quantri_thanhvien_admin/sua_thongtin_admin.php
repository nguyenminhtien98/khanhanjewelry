<?php
	// sửa thông tin admin
	if(isset($_POST["luu"]) ){
		$username = $_POST["username"];
		$ho_va_ten = $_POST["ho_va_ten"];
		$email = $_POST["email"];
		$so_dien_thoai = $_POST["so_dien_thoai"];
		$vai_tro = $_POST["vai_tro"];
		$ngay_tao = $_POST["ngay_tao"];
		//update vào database
		$update_thanh_vien = "UPDATE user SET username='$username', ho_va_ten='$ho_va_ten', email='$email', so_dien_thoai='$so_dien_thoai', ngay_tao='$ngay_tao', vai_tro='$vai_tro' WHERE id_user ='".$_SESSION["iduser"]."'";
		mysqli_query($conn,$update_thanh_vien);
		//chuyển hướng trang đến trang danh sách thành viên admin;
		echo '<script>alert("Sửa thông tin thành công!")</script>';
		echo "<script> window.location.href='admin/?xem=ds_thanh-vien_admin'</script>";
	}
?>

<?php
	// lấy thông tin admin
	$id_user = $_SESSION["iduser"];
	$qr = "SELECT * FROM user WHERE id_user='".$id_user."'";
	$thongtin_admin = mysqli_query($conn,$qr);
	$row_thongtin_admin = mysqli_fetch_array($thongtin_admin);

?>
<div class="sua_thongtin_admin">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Thay Đổi Thông Tin Admin</li>
        </div>
    </div>
    <div class="main_content">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="them_san_pham">
                <div class="thong_tin_chung">
                    <h3>THÔNG TIN CHUNG</h3>
                </div>
                <div class="dien_thong_tin">
                    <table>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Username:</p></th>
                            <th><input type="text" name="username" size="70" value="<?php echo $row_thongtin_admin['username'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Họ và tên:</p></th>
                            <th><input type="text" name="ho_va_ten" size="70" value="<?php echo $row_thongtin_admin['ho_va_ten'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Email:</p></th>
                            <th><input type="text" name="email" size="70" value="<?php echo $row_thongtin_admin['email'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                           <th><p class="tieu_de" >Số điện thoại:</p></th>
                           <th><input type="text" name="so_dien_thoai" size="70" value="0<?php echo $row_thongtin_admin['so_dien_thoai'] ?>"></input></th>
                        </tr>
                        <!--kiểm tra nếu admin là chủ shop thì mới được sửa vai trò của admin-->
                        <?php
						if($_SESSION["iduser"]==9){
						?>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Vai trò:</p></th>
                            <th><select name="vai_tro">
                            		<option value="<?php echo $row_thongtin_admin['vai_tro'] ?>">-- <?php echo $row_thongtin_admin['vai_tro'] ?> --</option>
                                    <option value="1">Chủ Shop</option>
                                    <option value="2">Quản Trị Viên</option>
                                    <option value="3">Khách Hàng</option>
                                </select>
                            </th>
                        </tr>
                        <?php
						}else{
						?>
                        <!--còn nếu admin là quản trị viên thì không được sửa vai trò-->
                        <?php
						}
						?>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ngày tạo:</p></th>
                            <th><input type="date" name="ngay_tao" value="<?php echo $row_thongtin_admin['ngay_tao'] ?>"></input></th>
                        </tr>
                    </table>
                    <div class="btn_luu">
                        <button type="submit" name="luu">LƯU</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>