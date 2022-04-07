<?php
	require_once("../lib/dbCon.php");
	// Nhận dữ liệu và gán vào các biến đồng thời xử lý chuỗi
	if(isset($_POST["luu"]) ){
		$old_pass = $_POST["old_pass"];
		$new_pass = $_POST["new_pass"];
		$re_new_pass = $_POST["re_new_pass"];
		$old_pass = md5($old_pass);
		
		// Các biến chứa code JS về thông báo
		$show_alert = "<script>$('#formChangePass .alert').removeClass('hidden');</script>";
		$hide_alert = "<script>$('#formChangePass .alert').addClass('hidden');</script>";
		$success_alert = "<script>$('#formChangePass .alert').attr('class', 'alert alert-success');</script>";
		 
		// Nếu mật khẩu cũ nhập đúng
		$passcu = mysqli_fetch_array($conn->query("SELECT password From user Where id_user='".$_SESSION["iduser"]."'"));
		$pass_cu = $passcu["password"];
		if ($old_pass != $pass_cu)
		{
			echo $show_alert.'Mật khẩu cũ nhập không chính xác, đảm bảo đã tắt caps lock.';
		}
		// Ngược lại nếu độ dài mật khẩu mới nhỏ hơn 6 ký tự
		else if (strlen($new_pass) < 6)
		{
			echo $show_alert.'Mật khẩu quá ngắn, hãy thử với mật khẩu khác an toàn hơn.';
		}
		// Ngược lại nếu mật khẩu mởi nhập lại không khớp
		else if ($new_pass != $re_new_pass)
		{
			echo $show_alert.'Nhập lại mật khẩu mới không khớp, đảm bảo đã tắt caps lock.';
		}
		// Ngược lại
		else
		{
			$new_pass = md5($new_pass); // Mã hoá mật khẩu sang MD5
			// Lệnh SQL đổi mật khẩu
			$sql_change_pass = "UPDATE user SET password ='$new_pass' WHERE id_user = '".$_SESSION["iduser"]."'";
			// Thực hiện truy vấn
			mysqli_query($conn,$sql_change_pass);
			 
			// Hiển thị thông báo và tải lại trang
			echo $show_alert.$success_alert.'Đổi mật khẩu thành công.	
			';

		}

	}
?>

<div class="thay_doi_pass_admin">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Thay Đổi Password Admin</li>
        </div>
    </div>
    <div class="main_content">
        <form action="" method="POST" id="formChangePass">
            <div class="them_san_pham">
                <div class="thong_tin_chung">
                    <h3>THÔNG TIN CHUNG</h3>
                </div>
                <div class="dien_thong_tin">
                    <table>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Nhập mật khẩu cũ:</p></th>
                            <th><input type="password" name="old_pass" size="70" value=""></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Nhập mật khẩu mới:</p></th>
                            <th><input type="password" name="new_pass" size="70" value=""></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Nhập lại mật khẩu mới:</p></th>
                            <th><input type="password" name="re_new_pass" size="70" value=""></input></th>
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