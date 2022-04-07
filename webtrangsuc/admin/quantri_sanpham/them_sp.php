
<?php
	// thêm sản phẩm
	if(isset($_POST["them"]) ){
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
		// nếu ẩn được chọn thì lấy dữ liệu biến ẩn từ $_POST còn không được chọn thì ẩn bằng 0
		if(isset($_POST['an'])&& $_POST['an']=="1"){
			$an = $_POST["an"];
		}else{
			$an = 0;
		}
		
		// upload ảnh địa diện
		$folder_path = "../images/";
		$avata = $_FILES["anh_dai_dien"]["name"];
		$file_path = $folder_path . basename($_FILES["anh_dai_dien"]["name"]);
		$flag_ok = true;
		if(isset($_POST["them"])) {
			$check = getimagesize($_FILES["anh_dai_dien"]["tmp_name"]);
			if($check !== false) {
				echo "file is an image - " .$check["mime"] . ".";
				$flag_ok = true;
			} else {
				echo "file is not an image";
				$flag_ok = false;	
			}	
		}
		// check file bị trùng
		if(file_exists($file_path)){
			echo "File đã tồn tại";	
			$flag_ok = false;
		}
		// check đuôi file
		$ex = array('jpg', 'png', 'jpeg');
		$file_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
		if(!in_array($file_type,$ex)){
			echo "Loại file không hợp lệ";
			$flag_ok = false;	
		}
		
		// upload file
		if($flag_ok){
			(move_uploaded_file($_FILES["anh_dai_dien"]["tmp_name"],$file_path));	
		} else {
			echo "Không upload được";	
		}
		// end upload ảnh đại diện

		// upload ảnh chi tiết 1
		$folder_path = "../images/";
		$anh_ct1 = $_FILES["anh_ct"]["name"];
		$file_path = $folder_path . basename($_FILES["anh_ct"]["name"]);
		$flag_ok = true;
		if(isset($_POST["them"])) {
			$check = getimagesize($_FILES["anh_ct"]["tmp_name"]);
			if($check !== false) {
				echo "file is an image - " .$check["mime"] . ".";
				$flag_ok = true;
			} else {
				echo "file is not an image";
				$flag_ok = false;	
			}	
		}
		// check file bị trùng
		if(file_exists($file_path)){
			echo "File đã tồn tại";	
			$flag_ok = false;
		}
		// check đuôi file
		$ex = array('jpg', 'png', 'jpeg');
		$file_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
		if(!in_array($file_type,$ex)){
			echo "Loại file không hợp lệ";
			$flag_ok = false;	
		}
		
		// upload file
		if($flag_ok){
			(move_uploaded_file($_FILES["anh_ct"]["tmp_name"],$file_path));	
		} else {
			echo "Không upload được";	
		}
		// end upload ảnh chi tiết 1

		// upload ảnh chi tiết 2
		$folder_path = "../images/";
		$anh_ct2 = $_FILES["anh_ct2"]["name"];
		$file_path = $folder_path . basename($_FILES["anh_ct2"]["name"]);
		$flag_ok = true;
		if(isset($_POST["them"])) {
			$check = getimagesize($_FILES["anh_ct2"]["tmp_name"]);
			if($check !== false) {
				echo "file is an image - " .$check["mime"] . ".";
				$flag_ok = true;
			} else {
				echo "file is not an image";
				$flag_ok = false;	
			}	
		}
		// check file bị trùng
		if(file_exists($file_path)){
			echo "File đã tồn tại";	
			$flag_ok = false;
		}
		// check đuôi file
		$ex = array('jpg', 'png', 'jpeg');
		$file_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
		if(!in_array($file_type,$ex)){
			echo "Loại file không hợp lệ";
			$flag_ok = false;	
		}
		
		// upload file
		if($flag_ok){
			(move_uploaded_file($_FILES["anh_ct2"]["tmp_name"],$file_path));	
		} else {
			echo "Không upload được";	
		}
		// end upload ảnh chi tiết 2
		
		require "../lib/dbCon.php";
		// thêm sản phẩm vào database
		$insert_sanpham = "INSERT INTO san_pham VALUES (null, '$menu_id', '$ten', '$code', '$thong_tin_sp', '$ban_chay', '$moi_ve', '$gia_ban', '$gia_giam_gia', '$giam_gia', '$avata', '$anh_ct1', '$anh_ct2', '$id_user', '$ngay_dang', '', '$an')";
		mysqli_query($conn,$insert_sanpham);
		//chuyển hướng trang đến trang danh sách sản phẩm;
		echo '<script>alert("Thêm sản phẩm thành công!")</script>';
		echo "<script> window.location.href='admin/?xem=ds_san_pham'</script>";
	}
	
?>

<?php
	// lấy danh sách menu theo các id menu
	$qr = "
		SELECT * FROM danh_muc
		WHERE menu_id IN (8,9,10,11,12,13,14,15,16,21)
	";
	$ds_danh_muc = mysqli_query($conn,$qr);
?>

<div class="page_them_san_pham">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Thêm Sản Phẩm</li>
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
                                    <option value="">-- Chọn Danh Mục --</option>
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
                            <th><input type="text" name="ten_sp" size="70"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Đường dẫn:</p></th>
                            <th><input type="text" name="duong_dan" size="70"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Thông tin sản phẩm:</p></th>
                            <th><textarea name="ckeditor" id="tt_sanpham"></textarea></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ảnh đại diện:</p></th>
                            <th><input type="file" name="anh_dai_dien"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Giá sản phẩm:</p></th>
                            <th><input type="text" name="gia_sp" size="70"></input></th>
                        </tr>
                        <tr class="thong_tin">
                           <th><p class="tieu_de" >Bán chạy:</p></th>
                           <th><input type="checkbox" name="ban_chay" value="1"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Mới về:</p></th>
                            <th><input type="checkbox" value="1" name="moi_ve"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Giảm giá:</p></th>
                            <th><input type="checkbox" name="giam_gia" value="1"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Giá giảm giá:</p></th>
                            <th><input type="text" name="gia_giam_gia" size="70"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ảnh chi tiết sản phẩm:</p></th>
                            <th><input type="file" name="anh_ct"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ảnh chỉ tiết sản phẩm 2:</p></th>
                            <th><input type="file" name="anh_ct2"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Id User:</p></th>
                            <th><select name="id_user">
                                    <option value="">-- Chọn Id User --</option>
                                    <option value="<?php echo $_SESSION["iduser"] ?>"><?php echo $_SESSION["iduser"] ?>: <?php echo $_SESSION['username'] ?></option>
                                </select>
                            </th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ngày đăng:</p></th>
                            <th><input type="date" name="ngay_dang"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ẩn:</p></th>
                            <th><input type="checkbox" name="an" value="0"></input></th>
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

<script>
	CKEDITOR.replace('ckeditor',{
		filebrowserBrowseUrl:'ckfinder/ckfinder.html',
		filebrowserUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'});
</script>

