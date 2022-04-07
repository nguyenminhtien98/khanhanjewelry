
<?php
	// lấy chi tiết thông tin shop theo id thông tin
	$qr = "
		SELECT * FROM thong_tin_shop
		WHERE id = '$_GET[id_thongtin]'
	";
	$ds_thongtin = mysqli_query($conn,$qr);
	$row_ds_thongtin = mysqli_fetch_array($ds_thongtin);
?>

<div class="sua_thongtin_shop">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Sửa Thông Tin Shop</li>
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
                            <th><p class="tieu_de">Tên Công Ty:</p></th>
                            <th><input type="text" name="ten_shop" size="70" value="<?php echo $row_ds_thongtin['ten_shop'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Số Điện Thoại:</p></th>
                            <th><input type="text" name="so_dien_thoai" size="70" value="<?php echo $row_ds_thongtin['so_dien_thoai'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Địa chỉ:</p></th>
                            <th><textarea name="dia_chi" style="width: 66%;"><?php echo $row_ds_thongtin['dia_chi'] ?></textarea></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Mạng Xã Hội:</p></th>
                            <th><input type="text" name="mang_xa_hoi" size="70" value="<?php echo $row_ds_thongtin['mang_xa_hoi'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Email:</p></th>
                            <th><input type="text" name="email" size="70" value="<?php echo $row_ds_thongtin['email'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Đăng Ký Bộ Công Thương:</p></th>
                            <th><input type="file" name="dang_ky_BCT" value="<?php echo $row_ds_thongtin['dang_ky_BCT'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Chứng Nhận Bộ Công Thương:</p></th>
                            <th><input type="file" name="chung_nhan_BCT"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ẩn:</p></th>
                            <th><input type="checkbox" name="an" value="1" <?php  if($row_ds_thongtin['an']==1) { ?> checked <?php } ?>></input></th>
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