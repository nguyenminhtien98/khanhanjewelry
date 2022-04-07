<?php
	// sửa đơn hàng
	if(isset($_POST["luu"]) ){
		$ho_va_ten = $_POST["ho_va_ten"];
		$so_dien_thoai = $_POST["so_dien_thoai"];
		$dia_chi_giao_hang = $_POST["dia_chi_giao_hang"];
		$email = $_POST["email"];
		$ghi_chu = $_POST["ghi_chu"];
		$tong_tien = $_POST["tong_tien"];
		$hinhthuc_thanhtoan = $_POST["hinhthuc_thanhtoan"];
		$trang_thai = $_POST["trang_thai"];
		$ngay_dat = $_POST["ngay_dat"];
	
		$id_donhang = $_GET["id_donhang"];
		// update đơn hàng và database
		$update_donhang = "UPDATE `don_hang` SET `ho_va_ten` = '$ho_va_ten', `so_dien_thoai` = '$so_dien_thoai', `dia_chi_giao_hang` = '$dia_chi_giao_hang', `email` = '$email', `ghi_chu` = '$ghi_chu', `tong_tien` = '$tong_tien', `ngay_dat` = '$ngay_dat', `hinhthuc_thanhtoan` = '$hinhthuc_thanhtoan', `trang_thai` = '$trang_thai' WHERE `don_hang`.`id_don_hang` = '$id_donhang'";
		
		mysqli_query($conn,$update_donhang);
		//chuyển hướng trang đến trang danh sách đơn hàng;
		echo '<script>alert("Sửa đơn hàng thành công!")</script>';
		echo "<script> window.location.href='admin/?xem=ds_don_hang'</script>";
	}
?>

<?php
	// lấy chi tiết đơn hàng theo id đơn hàng
	$qr = "
		SELECT * FROM don_hang
		WHERE id_don_hang = '$_GET[id_donhang]'
	";
	$don_hang = mysqli_query($conn,$qr);
	$row_don_hang = mysqli_fetch_array($don_hang);
?>

<div class="sua_don_hang">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Sửa Đơn Hàng</li>
        </div>
    </div>
    <div class="main_content">
        <form method="POST">
            <div class="them_san_pham">
                <div class="thong_tin_chung">
                    <h3>THÔNG TIN CHUNG</h3>
                </div>
                <div class="dien_thong_tin">
                    <table>
                    	<tr class="thong_tin">
                            <th><p class="tieu_de">Id Đơn hàng:</p></th>
                            <th><input type="text" name="id_don_hang" size="20" value="-- <?php echo $row_don_hang['id_don_hang'] ?> --"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Họ và Tên:</p></th>
                            <th><input type="text" name="ho_va_ten" size="70" value="<?php echo $row_don_hang['ho_va_ten'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Số điện thoại:</p></th>
                            <th><input type="text" name="so_dien_thoai" size="70" value="<?php echo $row_don_hang['so_dien_thoai'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Địa chỉ giao hàng:</p></th>
                            <th><input type="text" name="dia_chi_giao_hang" size="70" value="<?php echo $row_don_hang['dia_chi_giao_hang'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Email:</p></th>
                            <th><input type="text" name="email" size="40" value="<?php echo $row_don_hang['email'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ghi chú:</p></th>
                            <th><input type="text" name="ghi_chu" size="70" value="<?php echo $row_don_hang['ghi_chu'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                           <th><p class="tieu_de" >Tổng tiền:</p></th>
                           <th><input type="text" name="tong_tien" value="<?php echo $row_don_hang['tong_tien'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Hình thức thanh toán:</p></th>
                            <th><select name="hinhthuc_thanhtoan">
                            		<option><?php echo $row_don_hang['hinhthuc_thanhtoan'] ?></option>
                                    <option value="1">COD</option>
                                    <option value="2">Tại cửa hàng</option>
                                    <option value="3">Chuyển khoan</option>>
                                </select>
                        	</th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Trạng thái:</p></th>
                            <th><select name="trang_thai">
                            		<option><?php echo $row_don_hang['trang_thai'] ?></option>
                                    <option value="1">Đang chờ xử lý</option>
                                    <option value="2">Đang xử lý</option>
                                    <option value="3">Đang giao hàng</option>
                                    <option value="4">Giao hàng thành công</option>
                                    <option value="5">Hủy</option>
                                </select>
                        	</th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ngày đặt:</p></th>
                            <th><input type="date" name="ngay_dat" size="70" value="<?php echo $row_don_hang['ngay_dat'] ?>"></input></th>
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

