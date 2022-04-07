<?php
	session_start();
	ob_start();
?>

<?php
	require "lib/dbCon.php";
	if( isset($_GET["xem"]) )
		$xem = $_GET["xem"];
	else
		$xem = "";
?>

<!doctype html>
<html>
<head>
<base href="https://localhost/webtrangsuc/"/>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Trang Sức Khánh An</title>
	<link rel="stylesheet" type="text/css" href="style/style.css" />
    <link rel="stylesheet" type="text/css" href="style/style_pages.css" />
    <link rel="shortcut icon" href="images/pnj-icon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/54f0cb7e4a.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cunghocweb.com/data-out/js/jquery.js"></script>
    <!-- link thông báo sweet trong js -->
    <link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
	<script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>

    <div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0" nonce="4ZJr4p0Q"></script>
</head>

<body>
	<div id="webtrangsuc">
		<!--đầu trang-->
		<div id="header">
			<!--mua ngay-->
			<?php
				require "blocks/mua-ngay.php";
			?>
			<!--logo-search-login-menu-->
			<div class="logo_menu" id="myheader">
				<!--logo-search-login-->
				<?php
					require "blocks/search-logo-login.php";
				?>
				<!--menu-->
				<?php
					require "blocks/menu.php";
				?>
			</div>
		</div>
		
		<!--thân trang-->
		<div id="content">
        
        	<?php
            	switch($xem){

            		// pages khách hàng login
            		case "login" : require "page/form_kh_login.php";  
					break;
					// pages khách hàng đăng ký tài khoản
            		case "register" : require "page/form_kh_register.php";  
					break;
					// pages tài khoản của khách hàng
            		case "tai-khoan-cua-toi" : require "page/tai_khoan_cua_toi.php";  
					break;
            		// danh sách sản phẩm bán chạy
					case "ds_sanpham_banchay" : require "page/ds_sanpham_banchay.php";  
					break;
					// sản phẩm mới
					case "ds_sanpham_moi" : require "page/ds_sanpham_moi.php";  
					break;
					// pages danh sách sản phẩm
					case "ds_sanpham" : require "page/ds_sanpham.php";  
					break;
					// pages chi tiết sản phẩm
					case "chitiet_sanpham" : require "page/chitiet_sanpham.php";  
					break;
					// pages danh sách tất cả bộ sưu tập
					case "ds_all_bosuutap" : require "page/ds_all_bosuutap.php";  
					break;
					// pages danh sách sản phẩm giảm giá
					case "ds_sp_giamgia" : require "page/ds_sp_giamgia.php";  
					break;
					// pages danh sách tất cả sản phẩm
					case "ds_tatcatrangsuc" : require "page/ds_tatcatrangsuc.php";  
					break;
					// pages blog
					case "blog" : require "page/blog.php";  
					break;
					// pages chi tiết tin tức
					case "chi-tiet-tin-tuc" : require "page/chi-tiet_tin-tuc.php";  
					break;
					// pages chính sách
					case "chinh-sach" : require "page/chinh_sach.php";  
					break;
					// pages về chúng tôi
					case "ve-chung-toi" : require "page/ve_chung_toi.php";  
					break;
					// pages giỏ hàng
					case "giohang" : require "page/giohang.php";  
					break;
					// pages thanh toán
					case "thanh_toan" : require "page/thanh_toan.php";  
					break;
					// pages đặt hàng thành công
					case "dathang_thanhcong" : require "page/dathang_thanhcong.php";  
					break;
					// pages tìm kiếm
					case "tim-kiem" : require "page/tim-kiem.php";  
					break;
					// pages tra cứu đơn hàng bằng số điện thoại
					case "lich-su-don-hang" : require "page/lichsu_dh.php";  
					break;

					default : require "page/trang_chu.php";	
				}
			?>
            
		</div>

		<!--cuối trang-->
		<div id="footer">
			<!--liên hệ -->
			<?php
				require "blocks/lien-he.php";
			?>
			
			<!--địa chỉ shop -->
			<?php
				require "blocks/dia-chi-shop.php";
			?>
		</div>
        <div class="click_top">
        	<button id="myBtn" title="Go to top">^</button>
        </div>
	</div>

    <script src="style/thuvien.js"></script>
    <script type="text/javascript" src="style/bootstrap/js/bootstrap.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="./style/loadmore/js/jquery-latest.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!--js nút go top -->
	<script>
    	var showGoToTop = 500;
		
		$(window).scroll(function() {
			if ($(this).scrollTop() >= showGoToTop) {
				$('.click_top').fadeIn();
			}else {
				$('.click_top').fadeOut();
			}
		});
		$('#myBtn').click(function() {
			$('html, body').animate({scrollTop: 0}, 'slow');
		});
	</script>
    
    <!-- cố định menu -->
    <script>
    	// When the user scrolls the page, execute myFunction
		window.onscroll = function() {myFunction()};
		// Get the header
		var header = document.getElementById("myheader");
		// Get the offset position of the navbar
		var sticky = header.offsetTop;
		var carmini = document.getElementById("cart_mini");
		var menu_mobile = document.getElementById("menu_mobile");
		var search_mobile = document.getElementById("search_mobile_input");
		var width = window.matchMedia('(max-width: 46.1875em)');
		if (width.matches){
			document.getElementById("soluong_sp").addEventListener("click", show_cart_tt, false);
		}
		// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
		function myFunction() {
		  if (window.pageYOffset > sticky) {
			header.classList.add("sticky");
			if (width.matches){
				carmini.style.top = "55px"; // cart mini mobile khi add sticky thì cách top 55px
			}else{
				carmini.style.top = "60px"; // cart mini lap khi add sticky thì cách top 55px
			}
			menu_mobile.style.top = "55px"; // menu mobile khi add sticky thì cách top 55px
			search_mobile.style.top = "54px"; // search mobile khi add sticky thì cách top 54px
		  } else {
			header.classList.remove("sticky");
			if (width.matches){
				carmini.style.top = "95px"; // cart mini mobile khi xóa sticky thì cách top 95px
			}else{
				carmini.style.top = "90px"; // cart mini lap khi xóa sticky thì cách top 90px
			}
			menu_mobile.style.top = "95px"; // menu mobile khi xóa sticky thì cách top 95px
			search_mobile.style.top = "94px"; // search mobile khi xóa sticky thì cách top 94px
		  }
		}
    </script>
    
    <!-- loadmore tin tức thêm 8 tin -->
    <script>
		$(".box_tintuc").slice(0, 8).show(); //showing 8 div box_tintuc
	
		$(".loadMore").on("click",function(){
			$(".box_tintuc:hidden").slice(0, 8).show(); //showing 8 hidden div box_tintuc on click
	
			if($(".box_tintuc:hidden").length ==0)
			{
				$(".load_more").fadeOut(); //hết tin thì ẩn button loadmore
				$(".go_to_top").fadeIn(); //hết tin thì hiển thị div go to top
			}
		})
	</script>
    
    <!-- loadmore tin kiến thức trang sức thêm 5 tin -->
    <script>
		$(".box_kt_trang_suc").slice(0, 5).show(); //showing 5 div box_tintuc
	
		$(".btn_loadMore").on("click",function(){
			$(".box_kt_trang_suc:hidden").slice(0, 5).show(); //showing 5 hidden div box_tintuc on click
	
			if($(".box_kt_trang_suc:hidden").length ==0)
			{
				$(".load_more_kt").fadeOut(); //hết tin thì ẩn button loadmore
				$(".go_to_top_kt").fadeIn(); //hết tin thì hiển thị div go to top
			}
		})
	</script>
    <!-- js go to top -->
    <script>
		$('.go_to_top').click(function() {
			$('html, body').animate({ scrollTop: 0}, 'slow');
		});
		$('.go_to_top_kt').click(function() {
			$('html, body').animate({ scrollTop: 0}, 'slow');
		});
	</script>
	<!-- show số lượng sản phẩm được thêm vào giỏ hàng và show cart_chi tiết khi thêm sản phẩm vào giỏ hàng -->
	<script type="text/javascript">soluong_sp_cart();</script>
	<script type="text/javascript">
		// kiểm tra nếu trên thanh địa chỉ là trang giỏ hàng chi tiết thì gọi hàm showcart_ct
		if (window.location.href == "https://localhost/webtrangsuc/gio-hang.html") {
			showcart_ct();
		}
	</script>
	<!-- show cart trong trang thanh toán -->
	<script type="text/javascript">
		// kiểm tra nếu trên thanh địa chỉ là trang thanh toán thì gọi hàm showcart_tt
		if (window.location.href == "https://localhost/webtrangsuc/thanh-toan.html") {
			showcart_tt();
			//show_cart_tt();
		}
	</script>
	<!-- xử lý bình luận -->
	<script type="text/javascript">
		load_comment();
		//load bình luận
		
		function load_comment() {
			var id_sp = $('.id_sp').val();
			var data = {
						'id_sp': id_sp,
						'comment_load_data': true
					}
			$.ajax({
				type: "POST",
				url: "./page/xuly_binhluan.php",
				data: data,
				success: function (response) {
					console.log(response);
					var comment_data = "";
					var id_cmt = document.getElementsByClassName("rating").value;
					var rating = $('.ratings').val();
		        		console.log(rating);
		        	var div_ratings = "";
					$.each(response, function (key, value) {
						
						comment_data += '<div class="danhgia_sanpham_comment-item">'+
		        			'<div class="danhgia_sanpham_comment_item-info">'+
		        				'<span class="danhgia_sanpham_comment_item_info-name">'+value.comment['ten']+':</span>'+
		        				'<input type="hidden" class="id_cmt" id="id_comment" value="'+value.comment['id']+'">'+
		        				'<div class="rating" id="ratings">'+ 
		        					'<input type="hidden" class="ratings" id="rating" value="'+value.comment['rating']+'">'+
								'</div>'+
								'<span class="date">'+value.comment['ngay_gio']+'</span>'+
		        			'</div>'+
		        			'<div class="danhgia_sanpham_comment_item-message">'+
		        				'<p>'+value.comment['comment']+'</p>'+
		        			'</div>'+
		        		'</div>';
		        		document.getElementById("danhgia_sanpham-comment").innerHTML = comment_data;
	        		});
				}
			});
		}

		// thêm bình luận
		$(document).ready(function () {
			$('.btn_cmt').click(function (e) {
				e.preventDefault();

				var msg = $('.message').val();
				var id_sp = $('.id_sp').val();
				var ten = $('.ten').val();
				var rating = $('input:radio[name=rating]:checked').val();
				var add_cmt = $('.btn_cmt');
				if($.trim(msg).length == 0) {
					error_msg = "Vui lòng điền bình luận";
					$('#error_status').text(error_msg);
				}else{
					error_msg = "";
					$('#error_status').text(error_msg);
				}
				if (error_msg != '') {
					return false;
				}
				else
				{
					var data = {
						'id_sp': id_sp,
						'ten': ten,
						'rating': rating,
						'msg': msg,
						'add_cmt': true
					}
					$.ajax({
						type: "POST",
						url: "./page/xuly_binhluan.php",
						data: data,
						success: function (response) {
							swal("", "Bình luận sản phẩm thành công!", "success");
							//console.log(data);
							load_comment();
							close_form_binhluan();
						}
					});
				}
			});
		});
	</script>

</body>
</html>
<?php
	ob_end_flush()
?>  