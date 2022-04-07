<?php
    // lấy chi tiết bộ sưu tập nổi bật theo id_bst
    $qr = "
        SELECT * FROM banner
        WHERE id = '$_GET[id_banner]'
    ";
    $banner = mysqli_query($conn,$qr);
    $row_banner = mysqli_fetch_array($banner);
?>

<?php
    // sửa bộ sưu tập nổi bật
    if(isset($_POST["luu"]) ){
        $ten = $_POST["ten"];
        $link = $_POST["link"];
        $vi_tri = $_POST["vi_tri"];
        $an_hien = $_POST["an_hien"];
        // nếu người dùng chọn ảnh mới thì lấy tên ảnh mới từ thẻ input hình ảnh
        $post_hinhanh = $_FILES["hinh_anh"]["name"];
        if (strlen($post_hinhanh)>0 ) {
            $hinh_anh = $_FILES["hinh_anh"]["name"];
        // còn nếu người dùng ko chọn ảnh mới thì lấy tên ảnh từ thẻ input hình ảnh hidden
        }else{
            $hinh_anh = $_POST["hinhanh_hidden"];
        }

        // upload ảnh địa diện
        $folder_path = "images/";
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
        $id_banner = $_GET['id_banner'];
        // update danh mục
        $update_banner = "UPDATE banner SET ten='$ten', hinh_anh='$hinh_anh', link='$link', vi_tri='$vi_tri', an_hien='$an_hien' WHERE id ='".$id_banner."'";
        mysqli_query($conn,$update_banner);
        //chuyển hướng trang đến trang danh sách danh mục;
        //echo '<script type="text/javascript">"alert("Sửa danh mục thành công!")"</script>';
        header("location: ?xem=ds_banner");
    }
?>
<div class="page_sua_bst_noibat">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Sửa Bộ Sưu Tập Nổi Bật</li>
        </div>
    </div>
    <div class="main_content">
        <form method="POST" enctype="multipart/form-data">
            <div class="sua_bst_noibat">
                <div class="thong_tin_chung">
                    <h3>THÔNG TIN CHUNG</h3>
                </div>
                <div class="dien_thong_tin">
                    <table>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Tên banner:</p></th>
                            <th><input type="text" name="ten" size="70" value="<?php echo $row_banner['ten'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Ảnh banner:</p></th>
                            <th class="hinh_anh">
                                <div class="chon_file">
                                    <input type="file" name="hinh_anh"></input>
                                    <!-- thẻ input hình ảnh hidden hiển thị tên ảnh của banner đang xem -->
                                    <input type="hidden" name="hinhanh_hidden" value="<?php echo $row_banner['hinh_anh'] ?>"></input>
                                </div>
                                <div class="anh">
                                    <img src="admin/images/<?php echo $row_banner['hinh_anh'] ?>">
                                </div>
                            </th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Đường dẫn:</p></th>
                            <th><input type="text" name="link" size="70" value="<?php echo $row_banner['link'] ?>"></input></th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Vị trí:</p></th>
                            <th><input type="radio" name="vi_tri" value="0" <?php if($row_banner['vi_tri']==0) { ?> checked <?php } ?>><span style="padding-left: 7px; color: #333; font-weight: 400;">Giữa</span>
                                <input type="radio" name="vi_tri" value="1" style="margin-left: 15px;" <?php if($row_banner['vi_tri']==1) { ?> checked <?php } ?>><span style="padding-left: 7px; color: #333; font-weight: 400;">Cuối</span>
                            </th>
                        </tr>
                        <tr class="thong_tin">
                            <th><p class="tieu_de">Trạng thái:</p></th>
                            <th><input type="radio" name="an_hien" value="0" <?php if($row_banner['an_hien']==0) { ?> checked <?php } ?>><span style="padding-left: 7px; color: #333; font-weight: 400;">Ẩn</span>
                                <input type="radio" name="an_hien" value="1" style="margin-left: 15px;" <?php if($row_banner['an_hien']==1) { ?> checked <?php } ?>><span style="padding-left: 7px; color: #333; font-weight: 400;">Hiện</span>
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
