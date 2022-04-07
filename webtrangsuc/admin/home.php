<?php
	require "../lib/dbCon.php";
	if( isset($_GET["xem"]) )
		$xem = $_GET["xem"];
	else
		$xem = "";
?>

<?php
	// đăng xuất
	if( isset($_POST["thoat"])) {
		session_destroy();	
		header("location:login-admin.php");
	}
?>

<div id="home_page_admin">
    <div class="top_home">
        <div class="top_home_left">
            <a href="admin/index.php" style="color:white; text-decoration:none">
                <div class="administrator">
                    <p><span class="glyphicon glyphicon-th" style="padding-right:3px"></span> Administrator</p>
                </div>
            </a>
            <div class="web_chinh">
                <p><a href="./index.php"><i class='fas fa-reply' style="padding-right: 10px;"></i>Vào trang web</a></p>
            </div>
        </div>
        <div class="top_home_right">
            <form action="" method="POST">
                <div class="thongtin_admin">
                    <i class="material-icons" style="font-size:48px;color:white">account_circle</i>
                    <div class="dropdown">
                        <a data-toggle="dropdown" href="">Xin chào Admin <?php echo $_SESSION["name"] ?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="admin/?xem=sua_thongtin_admin">Thay đổi thông tin</a></li>
                            <li><a href="admin/?xem=thaydoi_password_admin">Thay đổi mật khẩu</a></li>
                            <li><button type="submit" name="thoat">Đăng xuất</button></li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="main_home">
        <div class="main_left" id="main_left">
            <div class="menu_admin" id="main_left_menu">
                <a href="admin/?xem=trang_chu" id="trangchu"><li><span class="glyphicon glyphicon-home"></span> Trang Chủ</li></a>
                <a href="admin/?xem=ds_danh_muc" id="danhmuc"><li><span class="glyphicon glyphicon-th-list"></span> Quản Trị Danh Mục</li></a>
                <a href="admin/?xem=ds_san_pham" id="sanpham"><li><span style="padding-right: 24px;"><i class="fa fa-diamond" style="font-size:15px"></i></span>Quản Trị Sản Phẩm</li></a>
                <a href="admin/?xem=ds_don_hang" id="donhang"><li><span class="glyphicon glyphicon-usd"></span> Quản Trị Đơn Hàng</li></a>
                <a href="admin/?xem=ds_tin-tuc" id="blog"><li><i class='far fa-newspaper' style="padding-right: 5px;"></i> Quản Trị Blog</li></a>
                <a href="admin/?xem=ds_binh-luan" id="comment"><li><span class="glyphicon glyphicon-picture"></span> Quản Trị Bình Luận</li></a>
                <a href="admin/?xem=ds_thanh-vien_admin" id="tv_admin"><li><span class="glyphicon glyphicon-user"></span> Quản Trị Thành Viên Admin</li></a>
                <a href="admin/?xem=ds_bosutap_noibat" id="bst_noibat"><li><span class="glyphicon glyphicon-picture"></span> Quản Trị Bộ Sưu Tập Nổi Bật</li></a>
                <a href="admin/?xem=ds_banner" id="banner"><li><span class="glyphicon glyphicon-picture"></span> Quản Trị Banner</li></a>
                <a href="" id="chinhsach"><li><span class="glyphicon glyphicon-list-alt"></span> Quản Trị Chính Sách</li></a>
                <a href="admin/?xem=qt_thong-tin_shop" id="thongtin"><li><span class="glyphicon glyphicon-info-sign"></span> Quản Trị Thông Tin</li></a>
            </div>
            
        </div>
        <div class="main_right">

            <?php
                switch($xem){
					// quản trị danh mục
                    case "ds_danh_muc" : require "quantri_danhmuc/ds_danh_muc.php";  
                    break;
                    case "them_danh_muc" : require "quantri_danhmuc/them_dm.php";  
                    break;
                    case "sua_danh_muc" : require "quantri_danhmuc/sua_dm.php";  
                    break;
                    case "xoa_danh_muc" : require "quantri_danhmuc/xoa_dm.php";  
                    break;
                    // quản trị sản phẩm
                    case "ds_san_pham" : require "quantri_sanpham/qt_san_pham.php";
                    break;
                    case "ds_anh_san_pham" : require "quantri_sanpham/ds_anh_sp.php";  
                    break;
                    case "them_san_pham" : require "quantri_sanpham/them_sp.php";  
                    break;
                    case "sua_san_pham" : require "quantri_sanpham/sua_sp.php";  
                    break;
                    case "xoa_san_pham" : require "quantri_sanpham/xoa_sp.php";  
                    break;
                    // quản trị đơn hàng
                    case "ds_don_hang" : require "quantri_donhang/ds_donhang.php";  
                    break;
                    case "chi-tiet_don-hang" : require "quantri_donhang/chitiet_donhang.php";  
                    break;
                    case "sua_don_hang" : require "quantri_donhang/sua_don_hang.php";  
                    break;
                    case "xoa_don_hang" : require "quantri_donhang/xoa_donhang.php";  
                    break;
					// quản trị blog
					case "ds_tin-tuc" : require "quantri_blog/ds_tintuc.php";  
                    break;
					case "anh-tin" : require "quantri_blog/anh_tin.php";  
                    break;
					case "noi-dung-tin" : require "quantri_blog/noi_dung_tin.php";  
                    break;
					case "them-tin-tuc" : require "quantri_blog/them_tintuc.php";  
                    break;
					case "sua-tin" : require "quantri_blog/sua_tin.php";  
                    break;
                    // quản trị bình luận
                    case "ds_binh-luan" : require "quantri_binhluan/ds_binhluan.php";  
                    break;
                    case "anh-tin" : require "quantri_blog/anh_tin.php";  
                    break;
                    case "noi-dung-tin" : require "quantri_blog/noi_dung_tin.php";  
                    break;
                    case "them-tin-tuc" : require "quantri_blog/them_tintuc.php";  
                    break;
                    case "chi-tiet-binh-luan" : require "quantri_binhluan/chi-tiet-binh-luan.php";  
                    break;
                    // quản trị thành viên
                    case "ds_thanh-vien_admin" : require "quantri_thanhvien_admin/ds_thanhvien_admin.php";  
                    break;
                    case "them_thanh-vien_admin" : require "quantri_thanhvien_admin/them_thanhvien_admin.php";  
                    break;
                    case "sua_thongtin_admin" : require "quantri_thanhvien_admin/sua_thongtin_admin.php";  
                    break;
                    case "thaydoi_password_admin" : require "quantri_thanhvien_admin/thaydoi_password_admin.php";  
                    break;
                    case "xoa_thongtin_admin" : require "quantri_thanhvien_admin/xoa_thongtin_admin.php";  
                    break;
                    // quản trị bộ sưu tập nổi bật
                    case "ds_bosutap_noibat" : require "quantri_bst_noibat/ds_bst_noibat.php";  
                    break;
                    case "them_bosutap_noibat" : require "quantri_bst_noibat/them_bst_noibat.php";  
                    break;
                    case "sua_bosutap_noibat" : require "quantri_bst_noibat/sua_bst_noibat.php";  
                    break;
                    case "xoa_bosutap_noibat" : require "quantri_bst_noibat/xoa_bst_noibat.php";  
                    break;
                    // quản trị bộ sưu tập nổi bật
                    case "ds_banner" : require "quantri_banner/ds_banner.php";  
                    break;
                    case "them_banner" : require "quantri_banner/them_banner.php";  
                    break;
                    case "sua_banner" : require "quantri_banner/sua_banner.php";  
                    break;
                    case "xoa_banner" : require "quantri_banner/xoa_banner.php";  
                    break;
                    // quản trị thông tin
                    case "qt_thong-tin_shop" : require "quantri_thongtin/qt_thongtin_shop.php";  
                    break;
                    case "sua_thong-tin_shop" : require "quantri_thongtin/sua_thongtin_shop.php";  
                    break;
                    case "xoa_thong-tin_shop" : require "quantri_thongtin/xoa_thong-tin_shop.php";  
                    break;
                    // xử lý thống kê doanh thu
                    case "xu_ly" : require "xuly_donhang_thongke.php";  
                    break;

                    default : require "trang_chu.php";	
                }
            ?>
        </div>
    </div>
</div>
    