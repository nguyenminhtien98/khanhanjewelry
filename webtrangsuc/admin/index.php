<?php
	session_start();
	ob_start();
?>

<!doctype html>
<html>
<head>
<base href="https://localhost/webtrangsuc/"/>
<meta charset="utf-8">
<title>Trang Admin Trang Sức Khánh An</title>
    <link rel="stylesheet" type="text/css" href="./style/style_admin.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./style/bootstrap/css/bootstrap.css" />
	<link rel="shortcut icon" href="./images/pnj-icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="https://kit.fontawesome.com/54f0cb7e4a.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cunghocweb.com/data-out/js/jquery.js"></script>
	<script src="admin/ckfinder/ckfinder.js"></script>
    <script src="admin/ckeditor/ckeditor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <?php
    // nếu trên thanh url có xem = danh mục (tất cả liên quan) thì đổ background cho thẻ a ở mục menu
    if(isset($_GET['xem']) && $_GET['xem'] == 'ds_danh_muc' or isset($_GET['xem']) && $_GET['xem'] == 'sua_danh_muc' or isset($_GET['xem']) && $_GET['xem'] == 'them_danh_muc'){
	?>
	    <style>
	        .menu_admin #danhmuc {background-color: #4f5b69;}
	    </style>
	<?php
		// nếu trên thanh url có xem = sản phẩm (tất cả liên quan) thì đổ background cho thẻ a ở mục menu
	    }elseif(isset($_GET['xem']) && $_GET['xem'] == 'ds_san_pham' or isset($_GET['xem']) && $_GET['xem'] == 'sua_san_pham' or isset($_GET['xem']) && $_GET['xem'] == 'them_san_pham' or isset($_GET['xem']) && $_GET['xem'] == 'ds_anh_san_pham'){
	?>
		<style>
	        .menu_admin #sanpham {background-color: #4f5b69;}
	    </style>
	<?php
		// nếu trên thanh url có xem = đơn hàng (tất cả liên quan) thì đổ background cho thẻ a ở mục menu
		}elseif(isset($_GET['xem']) && $_GET['xem'] == 'ds_don_hang' or isset($_GET['xem']) && $_GET['xem'] == 'sua_don_hang' or isset($_GET['xem']) && $_GET['xem'] == 'chi-tiet_don-hang'){
	?>
		<style>
	        .menu_admin #donhang {background-color: #4f5b69;}
	    </style>
	<?php
		// nếu trên thanh url có xem = tin tức (tất cả liên quan) thì đổ background cho thẻ a ở mục menu
		}elseif(isset($_GET['xem']) && $_GET['xem'] == 'ds_tin-tuc' or isset($_GET['xem']) && $_GET['xem'] == 'sua-tin' or isset($_GET['xem']) && $_GET['xem'] == 'them-tin-tuc' or isset($_GET['xem']) && $_GET['xem'] == 'anh-tin' or isset($_GET['xem']) && $_GET['xem'] == 'noi-dung-tin'){
	?>
		<style>
	        .menu_admin #blog {background-color: #4f5b69;}
	    </style>
	<?php
		// nếu trên thanh url có xem = thành viên admin (tất cả liên quan) thì đổ background cho thẻ a ở mục menu
		}elseif(isset($_GET['xem']) && $_GET['xem'] == 'ds_thanh-vien_admin' or isset($_GET['xem']) && $_GET['xem'] == 'sua_thongtin_admin' or isset($_GET['xem']) && $_GET['xem'] == 'them_thanh-vien_admin' or isset($_GET['xem']) && $_GET['xem'] == 'thaydoi_password_admin'){
	?>
		<style>
	        .menu_admin #tv_admin {background-color: #4f5b69;}
	    </style>
	<?php
		// nếu trên thanh url có xem = bộ sưu tập nổi bật (tất cả liên quan) thì đổ background cho thẻ a ở mục menu
		}elseif(isset($_GET['xem']) && $_GET['xem'] == 'ds_bosutap_noibat' or isset($_GET['xem']) && $_GET['xem'] == 'sua_bosutap_noibat' or isset($_GET['xem']) && $_GET['xem'] == 'them_bosutap_noibat'){
	?>
		<style>
	        .menu_admin #bst_noibat {background-color: #4f5b69;}
	    </style>
	<?php
		// nếu trên thanh url có xem = bình luận (tất cả bình luận) thì đổ background cho thẻ a ở mục menu
		}elseif(isset($_GET['xem']) && $_GET['xem'] == 'ds_binh-luan' or isset($_GET['xem']) && $_GET['xem'] == 'chi-tiet-binh-luan' or isset($_GET['xem']) && $_GET['xem'] == 'reply_binh-luan'){
	?>
		<style>
	        .menu_admin #comment {background-color: #4f5b69;}
	    </style>
	<?php
		// nếu trên thanh url có xem = banner (tất cả liên quan) thì đổ background cho thẻ a ở mục menu
		}elseif(isset($_GET['xem']) && $_GET['xem'] == 'ds_banner' or isset($_GET['xem']) && $_GET['xem'] == 'sua_banner' or isset($_GET['xem']) && $_GET['xem'] == 'them_banner'){
	?>
		<style>
	        .menu_admin #banner {background-color: #4f5b69;}
	    </style>
	<?php
		// nếu trên thanh url có xem = thông tin shop (tất cả liên quan) thì đổ background cho thẻ a ở mục menu
		}elseif(isset($_GET['xem']) && $_GET['xem'] == 'qt_thong-tin_shop' or isset($_GET['xem']) && $_GET['xem'] == 'sua_thong-tin_shop' or isset($_GET['xem']) && $_GET['xem'] == 'sua_danh_muc'){
	?>
		<style>
	        .menu_admin #thongtin {background-color: #4f5b69;}
	    </style>
	<?php
		}else{
	?>
		<style>
	        .menu_admin #trangchu  {background-color: #4f5b69;}
	    </style>
	<?php
		}
	?>
 
</head>

<body>
    <?php
		// kiểm tra nếu không tồn tại session iduser thì hiển thị form login
		if (!isset($_SESSION["iduser"]) ) {
			require "login-admin.php";
		//ngược lại nếu tồn tại session iduser thì hiển thị ra trang home
		}else{
			require "home.php";
		}
	?>
    <script src="./style/thuvien.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript" src="./style/bootstrap/js/bootstrap.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <!-- js trình soạn thảo ckeditor -->
    <script>
    	CKEDITOR.replace('.ckeditor',{
			filebrowserBrowseUrl:'ckfinder/ckfinder.html',
			filebrowserUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'});
    </script>

    <!-- js thống kê đơn hàng -->
    <script type="text/javascript">
		$(document).ready(function() {
			thongke();
			var char = new Morris.Area({
					
			  element: 'chart',
			  
			  xkey: 'date',
		
			  ykeys: ['order','sales','quantity'],
		
			  labels: ['Đơn Hàng','Doanh Thu', 'Số Lượng Bán Ra']
			});
			
			// thống kê 7 ngày, 28 ngày, 90 ngày, 365 ngày
			$('.select-date').change(function(){
				var thoigian = $(this).val();
				if(thoigian=='7ngay'){
					var text = '7 Ngày qua';	
				}else if(thoigian=='28ngay'){
					var text = '28 Ngày qua';	
				}else if(thoigian=='90ngay'){
					var text = '90 Ngày qua';	
				}else{
					var text = '365 Ngày qua';	
				}
				$.ajax({
					url:"admin/modules/thongke.php",
					method:"POST",
					dataType:"JSON",
					data:{thoigian:thoigian},
					success: function(data)
					{
						char.setData(data);
						$('#text-date').text(text);	
					}
				});	
			})
			
			function thongke(){
				var text = '7 Ngày qua';
				$('#text-date').text(text);	
				$.ajax({
					url:"admin/modules/thongke.php",
					method:"POST",
					dataType:"JSON",
					success: function(data)
					{
						char.setData(data);
						$('#text-date').text(text);	
					}
				});	
			}
		});
    </script>
    
    <!-- loadmore tin tức thêm 5 tin -->
    <script>
		$(".box_tt_tin").slice(0, 5).show(); //showing 5 div box_tt_tin
	
		$(".loadMore").on("click",function(){
			$(".box_tt_tin:hidden").slice(0, 5).show(); //showing 5 hidden div box_tt_tin on click
	
			if($(".box_tt_tin:hidden").length ==0)
			{
				$(".load_more").fadeOut(); //hết tin thì ẩn button loadmore
				$(".go_to_top").fadeIn(); //hết tin thì hiển thị div go to top
			}
		})
	</script>
    
    <!-- loadmore tin tức thêm 10 sản phẩm -->
    <script>
		$(".box_tt").slice(0, 10).show(); //showing 10 div box_tt_tin
	
		$(".btn_loadMore").on("click",function(){
			$(".box_tt:hidden").slice(0, 10).show(); //showing 10 hidden div box_tt_tin on click
	
			if($(".box_tt:hidden").length ==0)
			{
				$(".load_more").fadeOut(); //hết tin thì ẩn div loadmore
				$(".go_to_top").fadeIn(); //hết tin thì hiển thị div go to top
			}
		})
	</script>
    
    <!-- js go to top -->
    <script>
		$('.go_to_top').click(function() {
			$('html, body').animate({ scrollTop: 0}, 'slow');
		});
	</script>
</body>
</head>
</html>
<?php
	ob_end_flush()
?> 


