
<?php
	// thêm bộ sưu tập nổi bật
	if(isset($_POST["them"]) ){
		$ten = $_POST["ten"];
		$mo_ta = $_POST["ckeditor"];
		$link = $_POST["link"];
		
		// upload ảnh địa diện
		$folder_path = "./images/";
		$hinh_anh = $_FILES["hinh_anh"]["name"];
		$file_path = $folder_path . basename($_FILES["hinh_anh"]["name"]);
		$flag_ok = true;
		if(isset($_POST["them"])) {
			$check = getimagesize($_FILES["hinh_anh"]["tmp_name"]);
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
			(move_uploaded_file($_FILES["hinh_anh"]["tmp_name"],$file_path));	
		} else {
			echo "Không upload được";	
		}
		// end upload ảnh đại diện
		require "../lib/dbCon.php";
		// thêm bộ sưu tập nổi bật vào database
		$insert_bst_noibat = "INSERT INTO bosuutap_noibat VALUES(null, '$ten', '$mo_ta', '$link', '$hinh_anh', '1')";
		mysqli_query($conn,$insert_bst_noibat);
		//chuyển hướng trang đến trang danh sách danh mục;
		echo '<script>alert("Thêm bộ sưu tập nổi bật thành công!")</script>';
		//echo "<script> window.location.href='admin/?xem=ds_danh_muc'</script>";
	}	
?>

<div class="page_them_bst_noibat">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Thêm Bộ Sưu Tập Nổi Bật</li>
        </div>
    </div>
    <div class="main_content">
        <form method="POST" enctype="multipart/form-data">
            <div class="them_bst_noibat">
                <div class="thong_tin_chung">
                    <h3>THÔNG TIN CHUNG</h3>
                </div>
                <div class="dien_thong_tin">
                    <table>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Tên bộ sưu tập:</p></th>
                            <th><input type="text" name="ten" size="70"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Mô tả:</p></th>
                            <th><textarea name="ckeditor" id="mo_ta"></textarea></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Đường dẫn:</p></th>
                            <th><input type="text" name="link" size="70"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ảnh bộ sưu tập:</p></th>
                            <th><input type="file" name="hinh_anh"></input></th>
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