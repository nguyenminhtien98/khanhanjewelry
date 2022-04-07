<?php 
	$qr = "select * from thong_tin_shop";
	$query_tt_shop = mysqli_query($conn,$qr);
	$tt_shop = mysqli_fetch_array($query_tt_shop);
?>
<div id="lienhe">
	<div class="lh">
		<div class="phone">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi 				bi-		telephone-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
			</svg>
		</div>
		<div class="sdt">
			<h4>GỌI MUA HÀNG (PHÍM 1) (8h-21h)</h4>
			<p><?php echo $tt_shop['so_dien_thoai'] ?></p>
			<span>Tất cả các ngày trong tuần</span>
		</div>
	</div>
	<div class="lh">
		<div class="phone">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi 				bi-		telephone-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
			</svg>
		</div>
		<div class="sdt">
			<h4>GÓP Ý, KHIẾU NẠI (PHÍM 3) (8h-21h)</h4>
			<p><?php echo $tt_shop['so_dien_thoai'] ?></p>
			<span>Tất cả các ngày trong tuần</span>
		</div>
	</div>
	<div class="lh ketnoi_mxh">
		<div class="sdt">
			<h4>KẾT NỐI VỚI CHÚNG TÔI</h4>
		</div>
		<div class="face">
			<a href="<?php echo $tt_shop['mang_xa_hoi'] ?>" target="_blank">
				<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-facebook" 		viewBox="0 0 16 16" style=""><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
				</svg>
			</a>
		</div>
	</div>
    <div class="nhan_thong_tin">
    	<div class="dang_ky-nhan_tt"><h4>NHẬN THÔNG TIN MỚI TỪ KHÁNH AN JEWELRY</h4></div>
        <form>
            <input class="email" type="email" placeholder="Nhập mail của bạn..." />
            <button class="gui_mail" type="submit">ĐĂNG KÝ</button>
        </form>
    </div>
</div>