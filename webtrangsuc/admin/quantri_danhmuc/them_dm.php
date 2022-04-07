
<?php
	// thêm danh mục
	if(isset($_POST["them"]) ){
		$ten_dm = $_POST["ten_dm"];
		$code = $_POST["duong_dan"];
		$menu_parent_id = $_POST["danh_muc_cha"];
		$an = $_POST["an"];
		
		// upload ảnh địa diện
		$folder_path = "./images/";
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
		require "../lib/dbCon.php";
		// thêm danh mục vào database
		$insert_danh_muc = "INSERT INTO danh_muc VALUES(null, '$ten_dm', '$code', '$menu_parent_id', '$avata', '$an')";
		mysqli_query($conn,$insert_danh_muc);
		//chuyển hướng trang đến trang danh sách danh mục;
		echo '<script>alert("Thêm danh mục thành công!")</script>';
		echo "<script> window.location.href='admin/?xem=ds_danh_muc'</script>";
	}	
?>

<?php
	// lấy danh sách các danh mục
	$qr = "
		SELECT * FROM danh_muc
	";
	$query_ds_danhmuc = mysqli_query($conn,$qr);
?>

<div class="them_danh_muc">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Thêm Danh Mục</li>
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
                            <th><p class="tieu_de">Danh mục cha:</p></th>
                            <th><select name="danh_muc_cha">
                                    <option value="">-- Chọn Danh Mục --</option>
                                    <?php
                                        while($row_ds_danhmuc = mysqli_fetch_array($query_ds_danhmuc)){
                                    ?>
                                    <option value="<?php echo $row_ds_danhmuc['menu_id'] ?>"><?php echo $row_ds_danhmuc['menu_id'] ?>: <?php echo $row_ds_danhmuc['ten'] ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Tên danh mục:</p></th>
                            <th><input type="text" name="ten_dm" size="70"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Đường dẫn:</p></th>
                            <th><input type="text" name="duong_dan" size="70"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ảnh danh mục:</p></th>
                            <th><input type="file" name="anh_dai_dien"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ẩn:</p></th>
                            <th><input type="checkbox" name="an" value="1"></input></th>
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
