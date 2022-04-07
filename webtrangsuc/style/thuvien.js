// ------------------------------------thêm sản phẩm vào giỏ hàng từ trang index--------------------------------------//
var giohang = new Array();
function themgiohang(x) {
	// lấy giỏ hàng từ localStorage về
	var storage = localStorage.getItem("giohang");
	var giohang = JSON.parse(storage);
	var boxsp = x.parentElement.parentElement.children;
	var avata = boxsp[0].children[0].children[0].src;
	var id_sp = boxsp[2].children[0].value;
	var tensp = boxsp[2].children[1].innerText;
	var giasp = boxsp[2].children[2].innerText;
	var soluong = parseInt(boxsp[2].children[3].value);
	var sp = new Array(avata, id_sp, tensp, giasp, soluong);
	// kiểm tra giỏ hàng
	var kiemtra = 0;
	for (let i = 0; i < giohang.length; i++) {
		if(giohang[i][2] == tensp) {
			kiemtra = 1;
			soluong += parseFloat(giohang[i][4]);
			giohang[i][4] = soluong;
			break;
		}
	}

	if (kiemtra == 0) {
		// thêm mới giở hàng
		giohang.push(sp);
		// thông báo thêm mới giỏ hàng thành công
		swal("", "Thêm mới giỏ hàng thành công!", "success");
	}
	// lưu giỏ hàng lên localStorage
	localStorage.setItem("giohang", JSON.stringify(giohang));
	showmycart();
	soluong_sp_cart();
}

// ----------thêm sản phẩm từ trang danh sách sản phẩm, trang giảm giá, trang tất cả trang sức------------ //
function addcart(x) {
	// lấy giỏ hàng từ localStorage về
	var storage = localStorage.getItem("giohang");
	var giohang = JSON.parse(storage);
	var boxsp = x.parentElement.parentElement.parentElement.children;
	var avata = boxsp[0].children[0].children[0].children[0].src;
	var id_sp = boxsp[1].children[0].children[0].value
	var tensp = boxsp[1].children[0].children[1].innerText;
	var giasp = boxsp[1].children[0].children[2].innerText;
	var soluong = parseInt(boxsp[1].children[0].children[3].value);
	var sp = Array(avata, id_sp, tensp, giasp, soluong);
	// kiểm tra giỏ hàng
	var kiemtra = 0;
	for (let i = 0; i < giohang.length; i++) {
		if(giohang[i][2] == tensp) {
			kiemtra = 1;
			soluong += parseFloat(giohang[i][4]);
			giohang[i][4] = soluong;
			break;
		}
	}
	if (kiemtra == 0) {
		// thêm mới giở hàng
		giohang.push(sp);
		// thông báo thêm mới giỏ hàng thành công
		swal("", "Thêm mới giỏ hàng thành công!", "success");
	}
	// lưu giỏ hàng lên localStorage
	localStorage.setItem("giohang", JSON.stringify(giohang));
	showmycart();
	soluong_sp_cart();
}


// ----------thêm sản phẩm từ trang chi tiết sản phẩm------------ //
function addcart_ct(x) {
	// lấy giỏ hàng từ localStorage về
	var storage = localStorage.getItem("giohang");
	var giohang = JSON.parse(storage);
	var boxsp = x.parentElement.parentElement.parentElement.parentElement.parentElement.children;
	var avata = boxsp[0].children[0].children[1].children[0].children[0].src;
	var id_sp = boxsp[0].children[1].children[0].children[0].value;
	var tensp = boxsp[0].children[1].children[0].children[1].innerText;
	var giasp = boxsp[0].children[1].children[1].children[0].children[0].innerText;
	var soluong = parseInt(boxsp[0].children[1].children[3].children[0].children[1].children[1].value);
	var sp = Array(avata, id_sp, tensp, giasp, soluong);
	// kiểm tra giỏ hàng
	//console.log(avata);
	var kiemtra = 0;
	for (let i = 0; i < giohang.length; i++) {
		if(giohang[i][2] == tensp) {
			kiemtra = 1;
			soluong += parseFloat(giohang[i][4]);
			giohang[i][4] = soluong;
			break;
		}
	}
	if (kiemtra == 0) {
		// thêm mới giở hàng
		giohang.push(sp);
		// thông báo thêm mới giỏ hàng thành công
		swal("", "Thêm mới giỏ hàng thành công!", "success");
	}
	// lưu giỏ hàng lên localStorage
	localStorage.setItem("giohang", JSON.stringify(giohang));
	showmycart();
	soluong_sp_cart();
}


// --------------------------------------show cart mini khi click------------------------- //		
function show_cart() {
	var cart = document.getElementById("show_cart");
	if (cart.style.display == "block") {
		cart.style.display = "none";	
	} else {
		cart.style.display = "block";
		showmycart();
	}

}

// ----------------------------------------cart mini--------------------------------------- //
// show cart mini
function showmycart() {
	// lấy giỏ hàng từ localStorage về
	var storage = localStorage.getItem("giohang");
	var giohang = JSON.parse(storage);
	var thongtin_giohang = "";
	var tongtien_dh = "";
	var tongtien = 0;
	var count = 0;
	var sl_sp_dh = "";
	for (let i = 0; i < giohang.length; i++) {
		var thanhtien = parseFloat(giohang[i][3]) * parseFloat(giohang[i][4])*1000000;
		// chuyển đổi sang đơn vị tiền tệ
		thanh_tien = thanhtien.toLocaleString('de-DE')
		tongtien += thanhtien;
		count ++;
		// chuyển đổi sang đơn vị tiền tệ
		tong_tien = tongtien.toLocaleString('de-DE')
		thongtin_giohang += '<div class="minicart_tt_sp">'+
      '<div class="minicart_anh_sp">'+
          '<img src="'+giohang[i][0]+'" width="100%" />'+
      '</div>'+
      '<div class="minicart_ten_size">'+
          '<p>'+giohang[i][2]+'</p>'+
          '<h4>'+giohang[i][3]+'</h4>'+
          '<div class="minicart_gia_sl">'+
              '<div class="chon_sl">'+
	              '<div class="buttons_added">'+
	              		'<input type="button" class="minus is-form" onclick="giam(this)" value="-" />'+
	                    '<input type="text" class="input-qty" id="soluong" name="'+giohang[i][1]+'" value="'+giohang[i][4]+'" readonly />'+
	                    '<input type="button" class="plus is-form" onclick="tang(this)" value="+" />'+
	              '</div>'+
	          '</div>'+
              '<div class="delete_sp"><a name="'+giohang[i][1]+'" onclick="xoasp(this)"><i class="fa fa-trash-o"></i></a></div>'+  
          '</div>'+
      '</div>'+
  	'</div>';
  	document.getElementById("thongtin_sp").innerHTML = thongtin_giohang;
	}
	tongtien_dh += '<div class="tongtien_thanhtoan">'+
      '<div class="tien_tamtinh">'+
          '<p>Tổng tiền tạm tính: </p>'+
          '<h4>'+tong_tien+'₫</h4>'+
      '</div>'+
      '<div class="nut_thanhtoan">'+
          '<a class="xemgiohang" href="gio-hang.html">XEM GIỎ HÀNG</a>'+
          '<a class="thanhtoan" href="thanh-toan.html">THANH TOÁN</a>'+
      '</div>'+
  	'</div>';
  	document.getElementById("tongtien_donhang").innerHTML = tongtien_dh;
  	//soluong_sp_cart()
}

// show số lượng sản phẩm trong cart mini và cart chi tiết
function soluong_sp_cart() {
	// lấy giỏ hàng từ localStorage về
	var storage = localStorage.getItem("giohang");
	var sk_click = document.getElementById('showcart');
	var giohang = JSON.parse(storage);
	var count = 0;
	var sl_sp_dh = "";
	sl_sp = "";
	for (let i = 0; i < giohang.length; i++) {
		count ++;
	}
	// nếu count = 0 thì remove sự kiện onclick 
	if (count == 0) {
		document.getElementById('showcart').removeAttribute("onclick");
	// nếu count > 0 thì add sự kiện onclick function là show_cart 
	}else if(count > 0) {
		sk_click.addEventListener("click", show_cart, false);
	}
	sl_sp_dh += '( '+count+' sản phẩm )';
  	document.getElementById("sl_sp_cart").innerText = sl_sp_dh;	
  	// show số lượng sản phẩm trong giỏ hàng khi hiển thị trên moblie
  	if (count <= 9) {
  		document.getElementById("cart_mobile_number").innerText = count;
  	}else if (count > 9) {
  		document.getElementById("cart_mobile_number").innerText = '9+';
  	}
}

// xóa sản phẩm
function xoasp(x) {
	// xóa div sản phẩm
	var div_sp = x.parentElement.parentElement.parentElement.parentElement;
	var id_sp = parseInt(div_sp.children[1].children[2].children[1].children[0].name);
	div_sp.remove();
	//xóa sản phẩm trong mảng 
	var storage = localStorage.getItem("giohang");
	var giohang = JSON.parse(storage);
	for (let i = 0; i < giohang.length; i++) {
		if (giohang[i][1]==id_sp) {
			giohang.splice(i, 1);

		}
		// lưu giỏ hàng lên localStorage
		localStorage.setItem("giohang", JSON.stringify(giohang));

	}
	soluong_sp_cart();
	showmycart();
	// kiểm tra nếu trên thanh địa chỉ là trang giỏ hàng chi tiết thì gọi hàm showcart_ct
	if (window.location.href == "https://localhost/webtrangsuc/gio-hang.html") {
		showcart_ct();
	}
}

// -----------------------------------chi tiết cart------------------------------------------ //
// show chi tiết cart
function showcart_ct() {
	var storage = localStorage.getItem("giohang");
	var giohang = JSON.parse(storage);
	var thongtin_giohang_ct = "";
	var count = 0;
	var sl_sp = "";
	for (let i = 0; i < giohang.length; i++) {
		var thanhtien = parseFloat(giohang[i][3]) * parseFloat(giohang[i][4])*1000000;
		// chuyển đổi sang đơn vị tiền tệ
		thanh_tien = thanhtien.toLocaleString('de-DE')
		count ++;
		thongtin_giohang_ct += '<div class="chitiet_giohang_body">'+
                    '<div class="cart_item" id="cart_item">'+
                        '<div class="tt_sp" name="stt" style="width: 5%;"><p>'+count+'</p></div>'+
                        '<div class="tt_sp" name="avata" style="width: 20%;">'+
                            '<img src="'+giohang[i][0]+'">'+
                        '</div>'+
                        '<div class="tt_sp" name="ten_size_sp" style="width: 30%;">'+
                            '<p>'+giohang[i][2]+'</p>'+
                            '<span>Size 5</span>'+
                        '</div>'+
                        '<div class="tt_sp" name="gia_sp" style="width: 12%;"><p>'+giohang[i][3]+'</p></div>'+
                        '<div class="tt_sp" name="soluong_sp" style="width: 15%;">'+
                            '<div class="chon_sl">'+
                                '<div class="buttons_added">'+
                                	'<input type="button" class="minus is-form" onclick="giam(this)" value="-" />'+
                                    '<input type="text" class="input-qty" id="soluong" name="'+giohang[i][1]+'" value="'+giohang[i][4]+'" readonly />'+
                                    '<input type="button" class="plus is-form" onclick="tang(this)" value="+" />'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="tt_sp" name="thanhtien" style="width: 12%;"><p>'+thanh_tien+'₫</p></div>'+
                        '<div class="tt_sp" name="xoa_sp" style="width: 6%;"><a onclick="xoa_sp(this)" name="'+giohang[i][1]+'" style="color: black; cursor: pointer;"><i class="fa fa-trash-o"></i></a></div>'+
                    '</div>'+
                '</div>';
    document.getElementById("my_cart").innerHTML = thongtin_giohang_ct;
	}
    sl_sp += '<p>Giỏ hàng của bạn <span>( '+count+' sản phẩm )</span></p>';
    document.getElementById("soluong_sp").innerHTML = sl_sp;
    tongtien_cart_ct();
    soluong_sp_cart();
}

// -----------------------------------show tổng tiền------------------------------------------ //
function tongtien_cart_ct() {
	var storage = localStorage.getItem("giohang");
	var giohang = JSON.parse(storage);
	var div_tongtien = "";
	var tong_tien = 0;
	var tongtien = 0;
	var sl_sp = "";
	for (let i = 0; i < giohang.length; i++) {
		var thanhtien = parseFloat(giohang[i][3]) * parseFloat(giohang[i][4])*1000000;
		// chuyển đổi sang đơn vị tiền tệ
		thanh_tien = thanhtien.toLocaleString('de-DE')
		tongtien += thanhtien;
		// chuyển đổi sang đơn vị tiền tệ
		tong_tien = tongtien.toLocaleString('de-DE')
	}
	div_tongtien += '<table>'+
                        '<tr>'+
                            '<td style="width: 65%">Tổng tiền thanh toán</td>'+
                            '<td style="width: 35%; text-align: right; font-weight: bold">'+tong_tien+'₫</td>'+
                        '</tr>'+
                    '</table>';
    document.getElementById("tong_tien").innerHTML = div_tongtien;
}

// tăng số lượng sản phẩm
function tang(x) {
	var div_soluong = x.parentElement;
	var id_sp = parseInt(div_soluong.children[1].name);
	var storage = localStorage.getItem("giohang");
	var giohang = JSON.parse(storage);
	for (let i = 0; i < giohang.length; i++) {
		if (giohang[i][1]==id_sp) {
			if (giohang[i][4] <= 9) {
				giohang[i][4]++;
			}
		}
		// lưu giỏ hàng lên localStorage
		localStorage.setItem("giohang", JSON.stringify(giohang));
	}
	// kiểm tra nếu trên thanh địa chỉ là trang giỏ hàng chi tiết thì gọi hàm showcart_ct
	if (window.location.href == "https://localhost/webtrangsuc/gio-hang.html") {
		showcart_ct();
	}
	showmycart();
}

// giảm số lượng sản phẩm
function giam(x) {
	var div_soluong = x.parentElement;
	var id_sp = parseInt(div_soluong.children[1].name);
	var storage = localStorage.getItem("giohang");
	var giohang = JSON.parse(storage);
	for (let i = 0; i < giohang.length; i++) {
		if (giohang[i][1]==id_sp) {
			if (giohang[i][4] > 1) {
				giohang[i][4]--;
			}	
		}
		// lưu giỏ hàng lên localStorage
		localStorage.setItem("giohang", JSON.stringify(giohang));
	}
	// kiểm tra nếu trên thanh địa chỉ là trang giỏ hàng chi tiết thì gọi hàm showcart_ct
	if (window.location.href == "https://localhost/webtrangsuc/gio-hang.html") {
		showcart_ct();
	}
	showmycart();
}

// xóa sản phẩm 
function xoa_sp(x) {
	// xóa div sản phẩm
	var div_sp = x.parentElement.parentElement;
	var id_sp = parseInt(div_sp.children[6].children[0].name);
	div_sp.remove();
	//xóa sản phẩm trong mảng
	var storage = localStorage.getItem("giohang");
	var giohang = JSON.parse(storage);
	//xóa sản phẩm trong mảng 
	for (let i = 0; i < giohang.length; i++) {
		if (giohang[i][1]==id_sp) {
			giohang.splice(i, 1);
		}
		 //lưu giỏ hàng lên localStorage
		localStorage.setItem("giohang", JSON.stringify(giohang));

	}
	showmycart();
	showcart_ct();
	soluong_sp_cart();
}


// -------------------------------------cart trang thanh toán---------------------------------- //
// show cart ở trang thanh toán
function showcart_tt() {
	var storage = localStorage.getItem("giohang");
	var giohang = JSON.parse(storage);
	var thongtin_giohang_tt = "";
	var tongtien_dathang = "";
	var sl_sp = "";
	var tong_tien = 0;
	var tongtien = 0;
	var count = 0;
	for (let i = 0; i < giohang.length; i++) {
		var thanhtien = parseFloat(giohang[i][3]) * parseFloat(giohang[i][4])*1000000;
		// chuyển đổi sang đơn vị tiền tệ
		thanh_tien = thanhtien.toLocaleString('de-DE')
		tongtien += thanhtien;
		// chuyển đổi sang đơn vị tiền tệ
		tong_tien = tongtien.toLocaleString('de-DE')
		count ++;
		thongtin_giohang_tt += '<div class="thongtin_dh">'+
                            '<div class="anhsp">'+
                                '<img src="'+giohang[i][0]+'" width="100%" />'+
                            '</div>'+
                            '<div class="thongtin_sp">'+
                            	'<input type="hidden" name="id_sp[]" value ="'+giohang[i][1]+'">'+
                                '<span class="ten_sp">'+giohang[i][2]+'</span>'+
                                '<div class="gia_soluong">'+
                                    '<span class="soluong_sp" name="soluong[]">Số lượng: '+giohang[i][4]+'</span>'+
                                    '<input type="hidden" name="soluong[]" value ="'+giohang[i][4]+'">'+
                                    '<p>'+giohang[i][3]+'</p>'+
                                    '<input type="hidden" name="gia_sp[]" value ="'+giohang[i][3]+'">'+
                                '</div>'+
                            '</div>'+
                        '</div>';
    	document.getElementById("thongtin_sanpham").innerHTML = thongtin_giohang_tt;
	}
	tongtien_dathang += '<div class="phi_vanchuyen">'+
                            '<div class="tamtinh">'+
                                '<p>Tạm tính</p>'+
                                '<span>'+tong_tien+'₫</span>'+
                            '</div>'+
                            '<div class="phi_ship">'+
                                '<p>Phí vận chuyển</p>'+
                                '<span>Miễn Phí</span>'+
                            '</div>'+
                        '</div>'+
                        '<div class="thanhtien">'+
                            '<p>Tổng cộng</p>'+
                            '<span>'+tong_tien+'<sup class="gia">₫</sup></span>'+
                            '<input type="hidden" name="tongtien" value ="'+tong_tien+'">'+
                        '</div>'+
                        '<div class="dathang">'+
                            '<input type="submit" name="order" value="ĐẶT HÀNG"></input>'+
                        '</div>';
  	document.getElementById("tongtien_dathang").innerHTML = tongtien_dathang;
  	sl_sp += '<h3>Đơn hàng ( '+count+' sản phẩm ) <span><i class="fas fa-angle-down"></i></span></h3>'+ 
  				'<h3 class="tongtien">'+tong_tien+'đ</h3>';
    document.getElementById("soluong_sp").innerHTML = sl_sp;
}


// -------------------------------------show password form đăng nhập---------------------------------- //
function showPass() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}


// --------------------------------------show menu_mobile_sub------------------------- //		

var sub_menu = document.getElementsByClassName("menu_mobile_link");
var i;
for (i = 0; i < sub_menu.length; i++) {
  sub_menu[i].addEventListener("click", function() {
	this.classList.toggle("active");
	var content = this.nextElementSibling;
	if (content.style.display === "block") {
	  content.style.display = "none";
	} else {
	  content.style.display = "block";
	}
  });
}


// ----------------show cart trong page thanh toán và page đặt hàng thành công------------- //		
function show_cart_tt() {
	var cart = document.getElementById("thongtin_dichvu_dh");
	//console.log(cart)
	if (cart.style.display == "block") {
		cart.style.display = "none";	
	} else {
		cart.style.display = "block";
		//showmycart();
	}

}
// nếu chiều rộng màn hình nhỏ hơn 740 px thì add sự kiện onclick
var width = window.matchMedia('(max-width: 46.1875em)');
var cart = document.getElementById("thongtin_dichvu_dh");
if (width.matches){
	document.getElementById("soluong_sp").addEventListener("click", show_cart_tt, false);
	if(window.location.toString().indexOf("order") > -1) 
	{
		cart.style.display = "block";
	}
}



// ----------------show search mobile------------- //		
function showSearchMobile() {
	var search_mobile = document.getElementById("search_mobile_form");
	//console.log(cart)
	if (search_mobile.style.display == "block") {
		search_mobile.style.display = "none";	
	} else {
		search_mobile.style.display = "block";
	}
}



// ----------------------- show list bình luận ------------------------------------//
function show_list_comment() {
	var list_comment = document.getElementById("danhgia_sanpham-list");
	var div_danhgia = document.getElementById("danhgia_sanpham");

	if (list_comment.style.display == "block") {
		list_comment.style.display = "none";	
	} else {
		list_comment.style.display = "block";
	}

	if (list_comment.style.display == "none") {
		div_danhgia.style.background = "none";
	} else {
		div_danhgia.style.backgroundColor = "#f2f2f2";
	}
}

// ----------------------- show form bình luận ------------------------------------//
function show_form_binhluan() {
	var form = document.getElementById("danhgia_sanpham-form");
	var overlay = document.getElementById("danhgia_sanpham_overlay");
	form.style.display = "block";
	overlay.style.display = "block";
	$("body").css("overflow", "hidden");	
}
// ----------------------- close form bình luận ------------------------------------//
function close_form_binhluan() {
	var form = document.getElementById("danhgia_sanpham-form");
	var overlay = document.getElementById("danhgia_sanpham_overlay");
		form.style.display = "none";
		overlay.style.display = "none";	
		$("body").css("overflow", "");
}











// // ----------------------- show form reply bình luận ------------------------------------//
// function reply(x) {
// 	var form_reply = document.getElementById("form_reply");
// 		form_reply.style.display = "block";
// }


















$(document).ready(function () {
	$('.btn_cmt').click(function (e) {
		e.preventDefault();

		var msg = $('.message').val();
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
				'msg': msg,
				'add_cmt': true,
			}
			$.ajax({
				type: "POST",
				url: "./page/chitiet_sanpham.php",
				data: data,
				success: function (response) {
					alert(response);
					console.log(data);
				}
			})
		}
	});
});








// --------------------------------------show cart mini khi click------------------------- //		
function replyDelete() {
	var sessionUser = '<%= Session["vai_tro"] %>';
	var replyDelete = document.getElementById("reply-delete");
	if(sessionUser == 1) {
		replyDelete.style.display = "block";
	}	

}


// function realy(x) {
// 	var commentItem = x.parentElement.parentElement;
// 	var idCmt = parseInt(commentItem.children[0].children[1].value);
// 	var formReply = document.getElementById("form_reply");
// 	console.log(idCmt);
// 	$.each(response, function (key, value) {
// 		if (value.comment[id] == idCmt) {
// 				formReply.style.display = "block";
// 		}
// 	}
// }


