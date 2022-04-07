<style>
	#header {
		display: none;
	} 
	#footer {
		display: none;
	}
</style>
<?php
	// lấy thông tin sản phẩm khi khi khách hàng chọn mua ngay ở trang chi tiết sản phẩm
	if(isset($_POST['muangay'])) {
		$id_sanpham = $_GET['id_sanpham'];
		$so_luong = $_POST['quantity'];
		// lấy thông tin sản phẩm trong database thông qua id_sanpham
		$thontin_sp = mysqli_fetch_array($conn->query("SELECT * From san_pham Where id_sp =$id_sanpham"));
	// lấy thông tin sản phẩm khi khi khách hàng chọn mua ngay ở trang index
	}elseif (isset($_GET['order'])) {
		$id_sanpham = $_GET['id_sanpham'];
		$so_luong = 1;
		// lấy thông tin sản phẩm trong database thông qua id_sanpham
		$thontin_sp = mysqli_fetch_array($conn->query("SELECT * From san_pham Where id_sp =$id_sanpham"));
	}
?>
<!-- thêm đơn hàng vào database -->
<?php 
	// gọi carbon để lấy ngày giờ hiện tại
	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	include("./admin/carbon/autoload.php");
	
	$now = Carbon::now("Asia/Ho_chi_minh")->toDateString();
	// insert đơn hàng vào database
	if(isset($_POST['hinhthuc_thanhtoan'])):
		$hoten = $_POST['hoten'];
		$sodienthoai = $_POST['sdt'];
		$thon_xa = $_POST['diachi'];
		$quan_huyen = $_POST['calc_shipping_district'];
		$tinh_tp = $_POST['calc_shipping_provinces'];
		$email = $_POST['email'];
		$ghichu = $_POST['ghichu'];
		$diachi = "{$thon_xa}, {$quan_huyen},{$tinh_tp}";
		$tongtien = $_POST['tongtien'];
		$id_sanpham = $_POST['id_sp'];
		$so_luong = $_POST['soluong'];
		$giasp = $_POST['gia_sp'];
		if (isset($_SESSION["user_kh"])) {
			$id_user = $_SESSION["user_kh"];
		}else{
			$id_user = " ";
		}
		require "./lib/dbCon.php";
		$hinhthuc_thanhtoan = $_POST['hinhthuc_thanhtoan'];
		require "./lib/dbCon.php";
		$insert_donhang = "INSERT INTO don_hang VALUES (null,'$id_user','$hoten','$sodienthoai','$diachi','$email','$ghichu','$tongtien','$now','$hinhthuc_thanhtoan','1')";
		mysqli_query($conn,$insert_donhang);

		// insert đơn hàng chi tiết vào database
		$don_hang = mysqli_fetch_array($conn->query("SELECT id_don_hang From don_hang order by id_don_hang Desc Limit 1"));
		$id_donhang = $don_hang['id_don_hang'];

		
		// chạy vòng lặp
		foreach (array_keys($id_sanpham) as $key=> $value) {
		$id_san_pham = $id_sanpham[$key];
		$sl = $so_luong[$key];

		$san_pham = mysqli_fetch_array($conn->query("SELECT * From san_pham Where id_sp =$id_san_pham"));

		// nếu sản phẩm được giảm giá thì gia_sp = gia_giam_gia, còn không được giảm giá thì gia_sp = gia_ban
		if($san_pham['giam_gia']>0){$gia_sp = $san_pham['gia_giam_gia'];}else{$gia_sp = $san_pham['gia_ban'];};
		
		
		require "./lib/dbCon.php";
		$insert_donhang_chitiet = mysqli_query($conn, "INSERT INTO don_hang_chi_tiet(id_don_hang,id_sp,so_luong,gia_sp) values ('$id_donhang','$id_san_pham','$sl','$gia_sp')");
		// trừ 1 số lượng của sản phẩm khi đặt hàng thành công
		$tru_sl_sp = mysqli_query($conn, "UPDATE san_pham SET so_luong = so_luong - 1 WHERE id_sp ='".$id_san_pham."'");
		}
		// làm rỗng mảng giỏ hàng trong localstorage khi đặt hàng thành công
		echo '<script>
		var storage = localStorage.getItem("giohang");
		var giohang = JSON.parse(storage);
		for (let i = 0; i < giohang.length; i++) {
				giohang.splice(0, giohang.length)
			// lưu giỏ hàng lên sesionStorage
			localStorage.setItem("giohang", JSON.stringify(giohang));

		}</script>';
		// chuyển hướng đến trang đặt hàng thành công
		echo "<script>window.location.href='thank-you-$id_donhang.html'</script>";
		//header("Location:thank-you-$id_donhang.html");
	endif;

?>
<div class="pages_thanhtoan">
	<form action="" method="POST">
    	<div class="thongtin_donhang">
            <div class="tt_left">
            	<div class="logo"><a href="./"><img src="./images/logo.png" style="width: 75%;"/></a></div>
                <div class="thongtin_sanpham">
                    <div id="soluong_sp" class="soluong_dh">
                    	<!-- nếu người người dùng chọn mua ngay từ trang chi tiết sản phẩm và trang index -->
                    	<?php
                    	if(isset($_POST['muangay']) or isset($_GET['order'])) {
                    	?>
                    	<h3>Đơn hàng ( 1 sản phẩm )</h3>
                    	<?php	
                    	}else{
                    	?>
                    	<!-- nếu không chọn mua ngay thì hiển thị rỗng để số lượng sản phẩm trong giỏ hàng  -->
                    	<?php	
                    	}
                    	?>
                    </div>
                    <div class="thongtin_dichvu_dh" id="thongtin_dichvu_dh">
                        <!-- nếu người dùng chọn mua ngay sản phẩm từ trang chi tiết sản phẩm và trang index thì hiển thị div thongtin_dh -->
                        <?php
                        if(isset($_POST['muangay']) or isset($_GET['order'])) {	
                        	$tongtien = 0;
                        ?>
                        <div class="thongtin_dh" style="padding: 10px 19px;">
                            <div class="anhsp">
                                <img src="images_sanpham/<?= $thontin_sp['anh_dai_dien']?>" width="100%" />
                            </div>
                            <div class="thongtin_sp">
                            	<input type="hidden" name="id_sp[]" value ="<?php echo $id_sanpham ?>">
                                <span class="ten_sp"><?= $thontin_sp['ten']?></span>
                                <div class="gia_soluong">
                                    <span class="soluong_sp" name="quantity">Số lượng: <?php echo $so_luong ?></span>
                                    <input type="hidden" name="soluong[]" value ="<?php echo $so_luong ?>">
                                    <!-- nếu sản phẩm đươc giảm giá thì hiển thị giá giảm giá -->
                                    <?php if($thontin_sp['giam_gia']>0){?>
                                    <p><?=number_format($thontin_sp['gia_giam_gia'], 0, ",", ".") ?><sup class="gia">₫</sup></p>
                                    <!-- còn nếu sản phẩm không đươc giảm giá thì thì hiển thị giá bán -->
                                    <?php }else{ ?>
                                    <p><?=number_format($thontin_sp['gia_ban'], 0, ",", ".")?><sup class="gia">₫</sup></p>
                                    <?php } ?>
                                    
                                </div>
                            </div>
                        </div>
                        <?php
							// nếu sản phẩm đươc giảm giá thì lấy giá giảm giá nhân với số lượng
							if($thontin_sp['giam_gia']>0){
								$tongtien += ($thontin_sp['gia_giam_gia']*$so_luong);
							// còn nếu sản phẩm không đươc giảm giá thì lấy giá bán nhân với số lượng
							}else{
								$tongtien += ($thontin_sp['gia_ban']*$so_luong);
							}
                        ?>
                        <div class="phi_vanchuyen">
                            <div class="tamtinh">
                                <p>Tạm tính</p>
                                <span><?= number_format($tongtien, 0, ",", ".")?><sup class="gia">₫</sup></span>
                            </div>
                            <div class="phi_ship">
                                <p>Phí vận chuyển</p>
                                <span>Miễn Phí</span>
                            </div>
                        </div>
                        <div class="thanhtien">
                            <p>Tổng cộng</p>
                            <span><?= number_format($tongtien, 0, ",", ".")?><sup class="gia">₫</sup></span>
                            <input type="hidden" name="tongtien" value ="<?= number_format($tongtien, 0, ",", ".")?>">
                        </div>
                        <div class="dathang">
                            <input type="submit" name="order" value="ĐẶT HÀNG"></input>
                        </div>
                        <!-- còn nếu người dùng không chọn mua ngay thì hiển thị div mycart_tt -->
                        <?php }else{?>
                        <div id="mycart_tt">
                        	<!-- sản phẩm trong giỏ hàng -->
                        	<div id="thongtin_sanpham"></div>
                        	<div id="tongtien_dathang"></div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="tt_right">
                <div class="tt_nhanhang">
                    <div class="logo"><a href="./"><img src="./images/logo.png" style="width: 75%;"/></a></div>
                    <div class="thongtin_hinhthuc">
                        <div class="hinhthuc_vanchuyen_thanhtoan">
                            <div class="vanchuyen">
                                <h3>Vận Chuyển</h3>
                                <div class="giaohang">
                                    <div class="radio_gh">
                                        <input class="input-radio" type="radio" name="phi_vanchuyen" value="" checked />
                                        <p>GIAO HÀNG</p>
                                    </div>
                                    <span>Miễn phí</span>
                                </div>
                            </div>
                            <div class="thanhtoan">
                                <h3>Hình Thức Thanh Toán</h3>
                                <?php
                                	require "./lib/dbCon.php";
                            		$qr = "select * from hinhthuc_thanhtoan";
									$result = mysqli_query($conn,$qr);
									foreach($result as $hinhthuc_thanhtoan):
								?>
                                <div class="hinhthuc_tt">
                                    <div class="radio_tt">
                                        <input class="input-radio" type="radio" name="hinhthuc_thanhtoan" value="<?= $hinhthuc_thanhtoan['id_ht_tt']?>" <?= $hinhthuc_thanhtoan['id_ht_tt']!=1?:'checked' ?> />
                                        <p><?= $hinhthuc_thanhtoan['ten_hinhthuc_tt']?></p>
                                    </div>
                                    <div id="tt_cod">
                                        <span><?= $hinhthuc_thanhtoan['thongtin_hinhthuc']?></span>
                                    </div>
                                </div>
                                <?php
									endforeach;
								?>
                            </div>
                        </div>
                        <div class="tt_nguoinhan">
                            <div class="thongtin_nhanhang">
                                <h3>Thông tin nhận hàng</h3>
                            </div>
                            <div class="hoten">
                                <p>Họ Và Tên <span>*</span></p>
                                <input name="hoten" type="text" value="" autocomplete="off" required/>
                            </div>
                            <div class="sodienthoai">
                                <p>Số Điện Thoại <span>*</span></p>
                                <input name="sdt" type="tel" value="" autocomplete="off" required />
                            </div>
                            <div class="diachi">
                                <p>Địa Chỉ <span>*</span></p>
                                <input name="diachi" type="text" value="" autocomplete="off" required />
                            </div>
                            <div class="tinh_thanhpho">
                                <p>Tỉnh / Thành Phố <span>*</span></p>
                                <select name="calc_shipping_provinces" required="">
                                    <option name="tinh_tp" value="">Tỉnh / Thành phố</option>
                                </select>
                            </div>
                            <div class="quan_huyen">
                                <p>Quận / Huyện <span>*</span></p>
                                <select name="calc_shipping_district" required="">
                                    <option name="quan_huyen" value="">Quận / Huyện</option>
                                </select>
                                <input class="billing_address_1" name="" type="hidden" value="">
                                <input class="billing_address_2" name="" type="hidden" value="">
                            </div>
                            <div class="email">
                                <p>Email</p>
                                <input name="email" type="text" value="" autocomplete="off" />
                            </div>
                
                            <div class="ghichu">
                                <p>Ghi Chú</p>
                                <textarea name="ghichu"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dathang">
	                <input type="submit" name="order" value="ĐẶT HÀNG"></input>
	            </div>
            </div>
        </div>
    </form>
</div>

 <!--js dữ liệu tỉnh huyện -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://cdn.jsdelivr.net/gh/vietblogdao/js/districts.min.js'></script>
<script>
	if (address_2 = localStorage.getItem('address_2_saved')) {
	  $('select[name="calc_shipping_district"] option').each(function() {
		if ($(this).text() == address_2) {
		  $(this).attr('selected', '')
		}
	  })
	  $('input.billing_address_2').attr('value', address_2)
	}
	if (district = localStorage.getItem('district')) {
	  $('select[name="calc_shipping_district"]').html(district)
	  $('select[name="calc_shipping_district"]').on('change', function() {
		var target = $(this).children('option:selected')
		target.attr('selected', '')
		$('select[name="calc_shipping_district"] option').not(target).removeAttr('selected')
		address_2 = target.text()
		$('input.billing_address_2').attr('value', address_2)
		district = $('select[name="calc_shipping_district"]').html()
		localStorage.setItem('district', district)
		localStorage.setItem('address_2_saved', address_2)
	  })
	}
	$('select[name="calc_shipping_provinces"]').each(function() {
	  var $this = $(this),
		stc = ''
	  c.forEach(function(i, e) {
		e += +1
		stc += '<option value=' + e + '>' + i + '</option>'
		$this.html('<option value="">Tỉnh / Thành phố</option>' + stc)
		if (address_1 = localStorage.getItem('address_1_saved')) {
		  $('select[name="calc_shipping_provinces"] option').each(function() {
			if ($(this).text() == address_1) {
			  $(this).attr('selected', '')
			}
		  })
		  $('input.billing_address_1').attr('value', address_1)
		}
		$this.on('change', function(i) {
		  i = $this.children('option:selected').index() - 1
		  var str = '',
			r = $this.val()
		  if (r != '') {
			arr[i].forEach(function(el) {
			  str += '<option value="' + el + '">' + el + '</option>'
			  $('select[name="calc_shipping_district"]').html('<option value="">Quận / Huyện</option>' + str)
			})
			var address_1 = $this.children('option:selected').text()
			var district = $('select[name="calc_shipping_district"]').html()
			localStorage.setItem('address_1_saved', address_1)
			localStorage.setItem('district', district)
			$('select[name="calc_shipping_district"]').on('change', function() {
			  var target = $(this).children('option:selected')
			  target.attr('selected', '')
			  $('select[name="calc_shipping_district"] option').not(target).removeAttr('selected')
			  var address_2 = target.text()
			  $('input.billing_address_2').attr('value', address_2)
			  district = $('select[name="calc_shipping_district"]').html()
			  localStorage.setItem('district', district)
			  localStorage.setItem('address_2_saved', address_2)
			})
		  } else {
			$('select[name="calc_shipping_district"]').html('<option value="">Quận / Huyện</option>')
			district = $('select[name="calc_shipping_district"]').html()
			localStorage.setItem('district', district)
			localStorage.removeItem('address_1_saved', address_1)
		  }
		})
	  })
	})
</script>













