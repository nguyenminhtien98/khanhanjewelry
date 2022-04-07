
<?php
	// sửa sản phẩm
	if(isset($_POST["luu"]) ){
		$menu_id = $_POST["id_danhmuc"];
		$ten = $_POST["ten_sp"];
		$code = $_POST["duong_dan"];
		$thong_tin_sp = $_POST["ckeditor"];
		// nếu bán chạy được chọn thì lấy dữ liệu biến bán chạy từ $_POST còn không được chọn thì bán chạy bằng 0
		if(isset($_POST['ban_chay'])&& $_POST['ban_chay']=="1"){
			$ban_chay = $_POST["ban_chay"];
		}else{
			$ban_chay = 0;
		}
		// nếu mới về được chọn thì lấy dữ liệu biên mới về từ $_POST còn không được chọn thì mới về bằng 0
		if(isset($_POST['moi_ve'])&& $_POST['moi_ve']=="1"){
			$moi_ve = $_POST["moi_ve"];
		}else{
			$moi_ve = 0;
		}
		$gia_ban = $_POST["gia_sp"];
		$gia_giam_gia = $_POST["gia_giam_gia"];
		// nếu giảm giá được chọn thì lấy dữ liệu biến giảm giá từ $_POST còn không được chọn thì giảm giá bằng 0
		if(isset($_POST['giam_gia'])&& $_POST['giam_gia']=="1"){
			$giam_gia = $_POST["giam_gia"];
		}else{
			$giam_gia = 0;
		}
		$id_user = $_POST["id_user"];
		$ngay_dang = $_POST["ngay_dang"];
		$ngay_sua = $_POST["ngay_sua"];
		// nếu ẩn được chọn thì lấy dữ liệu biến ẩn từ $_POST còn không được chọn thì ẩn bằng 0
		if(isset($_POST['an_hien'])&& $_POST['an']=="1"){
			$an = $_POST["an_hien"];
		}else{
			$an = 0;
		}
		
		// upload ảnh địa diện
		$folder_path = "../images_sanpham/";
		$avata = $_FILES["anh_dai_dien"]["name"];
		$file_path = $folder_path . basename($_FILES["anh_dai_dien"]["name"]);
		if(isset($_POST["luu"])) {
			move_uploaded_file($_FILES["anh_dai_dien"]["tmp_name"],$file_path);
		}
		// end upload ảnh đại diện
	
		// upload ảnh chi tiết 1
		$folder_path = "../images_sanpham/";
		$anh_ct1 = $_FILES["anh_ct"]["name"];
		$file_path = $folder_path . basename($_FILES["anh_ct"]["name"]);
		if(isset($_POST["luu"])) {
			// upload file
			move_uploaded_file($_FILES["anh_ct"]["tmp_name"],$file_path);
		}

		// end upload ảnh chi tiết 1

		// upload ảnh chi tiết 2
		$folder_path = "../images_sanpham/";
		$anh_ct2 = $_FILES["anh_ct2"]["name"];
		$file_path = $folder_path . basename($_FILES["anh_ct2"]["name"]);
		if(isset($_POST["luu"])) {
			// upload file
			move_uploaded_file($_FILES["anh_ct2"]["tmp_name"],$file_path);
		}
		// end upload ảnh chi tiết 2
		
		require "../lib/dbCon.php";
		$id_sp = $_GET['id_sanpham'];
		// uadate sản phẩm vào database
		$sua_sanpham = "UPDATE san_pham SET menu_id='$menu_id', ten='$ten', code='$code', thong_tin_sp='$thong_tin_sp', ban_chay ='$ban_chay', moi_ve ='$moi_ve', gia_ban ='$gia_ban', gia_giam_gia='$gia_giam_gia', giam_gia ='$giam_gia', anh_dai_dien='$avata', anh_ct='$anh_ct1', anh_ct2='$anh_ct2', ngay_dang='$ngay_dang', ngay_sua ='$ngay_sua', an_hien='$an' WHERE id_sp ='".$id_sp."'";
		$query = mysqli_query($conn,$sua_sanpham);
		//chuyển hướng trang đến trang danh sách sản phẩm;
		//echo '<script>alert("Sửa sản phẩm thành công!")</script>';
		//echo "<script> window.location.href='admin/?xem=ds_san_pham'</script>";
		header("location: ?xem=ds_san_pham");
	}
?>

<?php
	// lấy danh chi tiết sản phẩm theo id sản phẩm
	$qr = "
		SELECT * FROM san_pham
		WHERE id_sp = '$_GET[id_sanpham]'
	";
	$ds_san_pham = mysqli_query($conn,$qr);
	$row_ds_san_pham = mysqli_fetch_array($ds_san_pham);
?>

<?php
	// lấy danh sách menu theo các id menu
	$qr = "
		SELECT * FROM danh_muc
		WHERE menu_id IN (8,9,10,11,12,13,14,15,16,21)
	";
	$ds_danh_muc = mysqli_query($conn,$qr);
?>

<div class="sua_sanpham">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Sửa Sản Phẩm</li>
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
                            <th><p class="tieu_de">Id Danh mục:</p></th>
                            <th><select name="id_danhmuc">
                                    <option value="<?php echo $row_ds_san_pham['menu_id'] ?>">-- <?php echo $row_ds_san_pham['menu_id'] ?> -- </option>
                                    <?php
                                        while($row_ds_danhmuc = mysqli_fetch_array($ds_danh_muc)){
                                    ?>
                                    <option value="<?php echo $row_ds_danhmuc['menu_id'] ?>"><?php echo $row_ds_danhmuc['menu_id'] ?>: <?php echo $row_ds_danhmuc['ten'] ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Tên sản phẩm:</p></th>
                            <th><input type="text" name="ten_sp" size="70" value="<?php echo $row_ds_san_pham['ten'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Đường dẫn:</p></th>
                            <th><input type="text" name="duong_dan" size="70" value="<?php echo $row_ds_san_pham['code'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Thông tin sản phẩm:</p></th>
                            <th><textarea class="ckeditor" name="ckeditor" id="tt_sanpham"><?php echo $row_ds_san_pham['thong_tin_sp'] ?></textarea></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ảnh đại diện:</p></th>
                            <th><input type="file" name="anh_dai_dien" value="<?php echo $row_ds_san_pham['anh_dai_dien'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Giá sản phẩm:</p></th>
                            <th><input type="text" name="gia_sp" size="70" value="<?php echo $row_ds_san_pham['gia_ban'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                           <th><p class="tieu_de" >Bán chạy:</p></th>
                           <th><input type="checkbox" name="ban_chay" value="1" <?php  if($row_ds_san_pham['ban_chay']==1) { ?> checked <?php } ?>></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Mới về:</p></th>
                            <th><input type="checkbox" value="1" name="moi_ve" <?php  if($row_ds_san_pham['moi_ve']==1) { ?> checked <?php } ?>></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Giảm giá:</p></th>
                            <th><input type="checkbox" name="giam_gia" value="1" <?php  if($row_ds_san_pham['giam_gia']==1) { ?> checked <?php } ?>></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Giá giảm giá:</p></th>
                            <th><input type="text" name="gia_giam_gia" size="70" value="<?php echo $row_ds_san_pham['gia_giam_gia'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ảnh chi tiết sản phẩm:</p></th>
                            <th><input type="file" name="anh_ct" value="<?php echo $row_ds_san_pham['anh_ct'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ảnh chỉ tiết sản phẩm 2:</p></th>
                            <th><input type="file" name="anh_ct2" value="<?php echo $row_ds_san_pham['anh_ct2'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ngày đăng:</p></th>
                            <th><input type="date" name="ngay_dang" value="<?php echo $row_ds_san_pham['ngay_dang'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ngày sửa:</p></th>
                            <th><input type="date" name="ngay_sua"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ẩn:</p></th>
                            <th><input type="checkbox" name="an" value="1" <?php  if($row_ds_san_pham['an_hien']==1) { ?> checked <?php } ?>></input></th>
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

