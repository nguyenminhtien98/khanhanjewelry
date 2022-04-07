
<?php
	// sửa dang mục
	if(isset($_POST["luu"]) ){
		$ten_dm = $_POST["ten_dm"];
		$code = $_POST["duong_dan"];
		$menu_parent_id = $_POST["danh_muc_cha"];
		// nếu ẩn được chọn thì lấy dữ liệu biến ẩn từ $_POST còn không được chọn thì ẩn bằng 0
		if(isset($_POST['an'])&& $_POST['an']=="1"){
			$an = $_POST["an"];
		}else{
			$an = 0;
		}
		// nếu người dùng chọn ảnh mới thì lấy tên ảnh mới từ thẻ input hình ảnh
		$post_hinhanh = $_FILES["anh_dai_dien"]["name"];
		if (strlen($post_hinhanh)>0 ) {
			$avata = $_FILES["anh_dai_dien"]["name"];
		// còn nếu người dùng ko chọn ảnh mới thì lấy tên ảnh từ thẻ input hình ảnh hidden
		}else{
			$avata = $_POST["anh_dai_dien_hidden"];
		}

		// upload ảnh địa diện
		$folder_path = "images/";
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
		$id_danh_muc = $_GET["id_danhmuc"];
		// update danh mục
		$update_danh_muc = "UPDATE danh_muc SET menu_parent_id='$menu_parent_id', ten='$ten_dm', code='$code', hinh_anh='$avata', an_hien='$an' WHERE menu_id='$id_danh_muc'";
		mysqli_query($conn,$update_danh_muc);
		//chuyển hướng trang đến trang danh sách danh mục;
		echo '<script type="text/javascript">"alert("Sửa danh mục thành công!")"</script>';
		header("location: ?xem=ds_danh_muc");
	}
?>

<?php
	// lấy chi tiết danh mục theo id danh mục
	$qr = "
		SELECT * FROM danh_muc
		WHERE menu_id = '$_GET[id_danhmuc]'
	";
	$danh_muc = mysqli_query($conn,$qr);
	$row_danh_muc = mysqli_fetch_array($danh_muc);
?>

<?php
	// lấy danh sách các danh mục
	$qr = "
		SELECT * FROM danh_muc
	";
	$query_ds_danhmuc = mysqli_query($conn,$qr);
?>



<div class="sua_danh_muc">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Sửa Danh Mục</li>
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
                                    <option value="<?php echo $row_danh_muc['menu_parent_id'] ?>">-- <?php echo $row_danh_muc['menu_parent_id'] ?> -- </option> 
                                    <option value="0">0: Danh mục cha</option>
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
                            <th><input type="text" name="ten_dm" size="70" value="<?php echo $row_danh_muc['ten'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Đường dẫn:</p></th>
                            <th><input type="text" name="duong_dan" size="70" value="<?php echo $row_danh_muc['code'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ảnh danh mục:</p></th>
                            <th><input type="file" name="anh_dai_dien"></input>
                            	<!-- thẻ input hình ảnh hidden hiển thị tên ảnh của tin đang xem -->
                                <input type="hidden" name="anh_dai_dien_hidden" value="<?php echo $row_danh_muc['hinh_anh'] ?>"></input>
                            </th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ẩn Hiện:</p></th>
                            <th><input type="checkbox" name="an" value="1" <?php  if($row_danh_muc['an_hien']==1) { ?> checked <?php } ?>></input></th>
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

