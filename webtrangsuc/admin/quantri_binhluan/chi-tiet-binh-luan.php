
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
		SELECT * FROM comment
		WHERE id = '$_GET[id_cmt]'
	";
	$comment = mysqli_query($conn,$qr);
	$row_comment = mysqli_fetch_array($comment);
?>

<?php
	// lấy tên sản phẩm, ảnh sản phẩm
	$id_sp = $row_comment['id_sp'];
	$qr = "
		SELECT * FROM san_pham WHERE id_sp = '$id_sp'
	";
	$query = mysqli_query($conn,$qr);
	$row_tt_sp = mysqli_fetch_array($query);
?>



<div class="sua_danh_muc">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Chi Tiết Bình Luận</li>
        </div>
    </div>
    <div class="main_content">
        <form method="POST" enctype="multipart/form-data">
            <div class="them_san_pham">
                <div class="thong_tin_chung">
                    <h3>THÔNG TIN BÌNH LUẬN</h3>
                </div>
                <div class="dien_thong_tin">
                    <table>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">ID - Bình Luận:</p></th>
                            <th><?php echo $row_comment['id'] ?></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Trạng Thái:</p></th>
                            <th><?php echo $row_comment['trang_thai'] ?></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">ID - Sản Phẩm:</p></th>
                            <th><?php echo $row_comment['id_sp'] ?></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Tên Sản Phẩm:</p></th>
                            <th><?php echo $row_tt_sp['ten'] ?></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ảnh Sản Phẩm:</p></th>
                            <th><img src="images_sanpham/<?php echo $row_tt_sp['anh_dai_dien'] ?>" width="15%" height="15%"/></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Họ và Tên:</p></th>
                            <th><?php echo $row_comment['ten'] ?></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Rating:</p></th>
                            <th><?php echo $row_comment['rating'] ?></th>
                        </tr>
                        
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Nội Dung Comment:</p></th>
                            <th>
                            	<textarea style="width: 70%; min-height: 100px; max-height: 100px;"><?php echo $row_comment['comment'] ?></textarea>
                            </th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Trả Lời Comment:</p></th>
                            <th><textarea style="width: 70%; min-height: 100px; max-height: 100px;" name="reply_cmt"></textarea></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ngày Bình Luận:</p></th>
                            <th><input type="date" name="ngay_gio" value="<?php echo $row_comment['ngay_gio'] ?>"></input>
                            </th>
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

