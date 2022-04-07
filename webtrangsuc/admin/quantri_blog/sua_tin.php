<?php
// hàm đổi các ký tự
function convert_name($str) {
	$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
	$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
	$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
	$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
	$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
	$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
	$str = preg_replace("/(đ)/", 'd', $str);
	$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
	$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
	$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
	$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
	$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
	$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
	$str = preg_replace("/(Đ)/", 'D', $str);
	$str = preg_replace("/(\“|\”|\‘|\’|\,|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
	$str = preg_replace("/( )/", '-', $str);
	$str = preg_replace("/(\?|\!||\.|)/", ' ', $str);
return $str;
}
?>

<?php
	// lấy danh sách tin theo id tin
	$qr = "
		SELECT * FROM blog
		WHERE id = '$_GET[id_tin]'
	";
	$tt_tin = mysqli_query($conn,$qr);
	$row_tt_tin = mysqli_fetch_array($tt_tin);
?>

<?php
	// update tin
	if(isset($_POST["luu"]) ){
		$loai_tin = $_POST["loai_tin"];
		$title = $_POST["title"];
		$code = convert_name($title);
		$tom_tat = $_POST["tom_tat"];
		$noi_dung = $_POST["ckeditor"];
		// nếu tin nổi được chọn thì lấy dữ liệu biến tin nổi bật từ $_POST còn không được chọn thì bán chạy bằng 0
		if(isset($_POST['tin_noi_bat'])&& $_POST['tin_noi_bat']=="1"){
			$tin_noi_bat = $_POST["tin_noi_bat"];
		}else{
			$tin_noi_bat = 0;
		}
		$ngay_dang = $_POST["ngay_dang"];
		$an_hien = $_POST["an_hien"];
		
		// upload hình ảnh
		$folder_path = "../images/";
		// nếu người dùng chọn ảnh mới thì lấy tên ảnh mới từ thẻ input hình ảnh
		$post_hinhanh = $_FILES["hinh_anh"]["name"];
		if (strlen($post_hinhanh)>0 ) {
			$hinh_anh = $_FILES["hinh_anh"]["name"];
		// còn nếu người dùng ko chọn ảnh mới thì lấy tên ảnh từ thẻ input hình ảnh hidden
		}else{
			$hinh_anh = $_POST["hinh_anh_hidden"];
		}
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
		// end upload hình ảnh

		require "../lib/dbCon.php";
		//update tin vào database
		$id_tin = $_GET ['id_tin'];
		$update_tin = "UPDATE blog SET loai_tin = '$loai_tin', title = '$title', code = '$code', hinh_anh = '$hinh_anh', tom_tat = '$tom_tat', noi_dung = '$noi_dung', tin_noi_bat = '$tin_noi_bat', ngay_dang = '$ngay_dang', an_hien = '$an_hien' WHERE id ='".$id_tin."'";
		mysqli_query($conn,$update_tin);
		//chuyển hướng trang đến trang danh sách tin tức;
		echo '<script>alert("Sửa tin thành công!")</script>';
		echo "<script> window.location.href='admin/?xem=ds_tin-tuc'</script>";
	}
?>

<div class="page_them_tin_tuc">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Blog <span style="color: black;">></span> Thêm Tin Tức</li>
        </div>
    </div>
    <div class="main_content">
        <form method="POST" enctype="multipart/form-data">
            <div class="them_tin_tuc">
                <div class="thong_tin_chung">
                    <h3>THÔNG TIN CHUNG</h3>
                </div>
                <div class="dien_thong_tin">
                    <table>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Loại Tin:</p></th>
                            <th><select name="loai_tin">
                                    <option value="<?php echo $row_tt_tin['loai_tin'] ?>"><?php echo $row_tt_tin['loai_tin'] ?></option>
                                    <option value="Kiến Thức Trang Sức">Kiến Thức Trang Sức</option>
                                    <option value="Tin Tức">Tin Tức</option>
                                </select>
                            </th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Tiêu Đề:</p></th>
                            <th><input type="text" name="title" size="90" value="<?php echo $row_tt_tin['title'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Hình Ảnh:</p></th>
                            <th><input type="file" name="hinh_anh"></input>
                            	<!-- thẻ input hình ảnh hidden hiển thị tên ảnh của tin đang xem -->
                                <input type="hidden" name="hinh_anh_hidden" value="<?php echo $row_tt_tin['hinh_anh'] ?>"></input>
                            </th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Tóm tắt:</p></th>
                            <th><textarea name="tom_tat" id="tom_tat" style="width: 67%; height: 100px;"><?php echo $row_tt_tin['tom_tat'] ?></textarea></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Nội Dung:</p></th>
                            <th><textarea name="ckeditor" id="noi_dung"><?php echo $row_tt_tin['noi_dung'] ?></textarea></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Tin Nổi Bật:</p></th>
                            <th><input type="checkbox" name="tin_noi_bat" value="1" <?php  if($row_tt_tin['tin_noi_bat']==1) { ?> checked <?php } ?>></input></th>
                        </tr>
                        <tr class="thong_tin">
                           <th><p class="tieu_de">Ngày Đăng:</p></th>
                           <th><input type="date" name="ngay_dang" value="<?php echo $row_tt_tin['ngay_dang'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ẩn Hiện:</p></th>
                            <th>
                            	<input type="radio" name="an_hien" value="0" <?php  if($row_tt_tin['an_hien']==0) { ?> checked <?php } ?>> Ẩn</input>
                            	<input type="radio" name="an_hien" value="1" style="margin-left: 10px;" <?php  if($row_tt_tin['an_hien']==1) { ?> checked <?php } ?>> Hiện</input>
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
<!-- kết nối trình soạn thảo ckeditor -->
<script>
	CKEDITOR.replace('ckeditor',{
		filebrowserBrowseUrl:'ckfinder/ckfinder.html',
		filebrowserUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'});
</script>