
<?php
	// thêm bộ sưu tập nổi bật
	if(isset($_POST["them"]) ){
		$ten = $_POST["ten"];
        $link = $_POST["link"];
        $vi_tri = $_POST["vi_tri"];
        $an_hien = $_POST["an_hien"];
		
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
		$insert_banner = "INSERT INTO banner VALUES(null, '$ten', '$hinh_anh', '$link', '$vi_tri', '1')";
		mysqli_query($conn,$insert_banner);
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
                            <th><p class="tieu_de">Tên banner:</p></th>
                            <th><input type="text" name="ten" size="70"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ảnh banner:</p></th>
                            <th class="hinh_anh">
                                <div class="chon_file">
                                    <input type="file" name="hinh_anh"></input>
                                </div>
                            </th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Đường dẫn:</p></th>
                            <th><input type="text" name="link" size="70"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Vị trí:</p></th>
                            <th><input type="radio" name="vi_tri" value="0"><span style="padding-left: 7px; color: #333; font-weight: 400;">Giữa</span>
                                <input type="radio" name="vi_tri" value="1" style="margin-left: 15px;"><span style="padding-left: 7px; color: #333; font-weight: 400;">Cuối</span>
                            </th>
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