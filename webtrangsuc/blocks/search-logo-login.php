<?php
	// khách đăng xuất tài khoản
	if(isset($_GET["action"]) && $_GET["action"] == "dang_xuat"){
		unset($_SESSION["user_kh"]);
		unset($_SESSION["name_kh"]);
		unset($_SESSION["sdt_kh"]);
		unset($_SESSION["email_kh"]);
		header("location: ./");
	}
?>

<?php
	$qr = "SELECT * FROM danh_muc WHERE menu_parent_id = 0";
	$query_danhmuc = mysqli_query($conn,$qr);
?>

<div id="hotro_logo_tacvu">
	<div id="box_hotro_logo_tacvu">
		<label for="menu_mobile-input" class="bars_btn">
			<i class="fas fa-bars fa-2x"></i>
		</label>
		<input type="checkbox" hidden class="menu_iput" id="menu_mobile-input">
		<!-- <label for="menu_mobile-input" class="menu_overlay"></label> -->
		<div class="menu_mobile" id="menu_mobile">
			<ul class="menu_mobile_list">
				<?php
            if (mysqli_num_rows($query_danhmuc) > 0){
            	while($row_danhmuc = mysqli_fetch_array($query_danhmuc)){
        ?>
				<li>
				<!--nếu menu id =2 thì link đến trang "tất cả trang sức"--> 
          <?php  
              if ($row_danhmuc['menu_id'] == 2) {	?>
          <a class="menu_mobile_link" style="cursor: pointer;"><?php echo $row_danhmuc['ten'] ?> <span><i class="fas fa-chevron-down"></i></span></a>
          <!--nếu menu id =3 thì link đến trang "giảm giá"--> 
          <?php }else{ if ($row_danhmuc['menu_id'] == 3) {?>
          <a class="menu_mobile_link" href="trang-suc-giam-gia.html"><?php echo $row_danhmuc['ten'] ?></a>
          <!--nếu menu id =4 thì link đến trang "Tất cả trang sức"--> 
          <?php }else{ if ($row_danhmuc['menu_id'] == 4) {?>
          <a class="menu_mobile_link" href="tat-ca-trang-suc.html"><?php echo $row_danhmuc['ten'] ?></a>
          <!--nếu menu id =5 thì link đến trang "Blog"--> 
          <?php }else{ if ($row_danhmuc['menu_id'] == 5) {?>
          <a class="menu_mobile_link" href="?xem=blog"><?php echo $row_danhmuc['ten'] ?></a>
          <!--nếu menu id = 6 thì link đến trang "chính sách"--> 
          <?php }else{ if ($row_danhmuc['menu_id'] == 6) { ?>
          <a class="menu_mobile_link" style="cursor: pointer;"><?php echo $row_danhmuc['ten'] ?> <span><i class="fas fa-chevron-down"></i></span></a>
          <!--nếu menu id = 7 thì link đến trang "về chúng tôi"--> 
          <?php }else{ if ($row_danhmuc['menu_id'] == 7) { ?>
          <a class="menu_mobile_link" href="ve-chung-toi.html"><?php echo $row_danhmuc['ten'] ?></a>
          <!--còn nếu không có menu id = với các menu id trên thì link đến trang "danh sách sản phẩm"--> 
          <?php }else{ ?>
          <a class="menu_mobile_link" style="cursor: pointer;"><?php echo $row_danhmuc['ten'] ?> <span><i class="fas fa-chevron-down"></i></span></a>
          <?php } ?>
          <?php } ?>
          <?php } ?>
          <?php } ?>
          <?php } ?>
          <?php } ?>
          <ul class="menu_mobile_sub_list" style="display: none;">
              <?php
                  $qr = "SELECT * FROM danh_muc WHERE menu_parent_id = {$row_danhmuc['menu_id']}";
                  $query_danhmuccon = mysqli_query($conn,$qr);
                                      	if (mysqli_num_rows($query_danhmuccon) > 0){
                  	while($row_danhmuccon = mysqli_fetch_array($query_danhmuccon)){
              ?>
              <li><a class="menu_mobile_sub_link" href="loai-trang-suc/<?php echo $row_danhmuccon['menu_id'] ?>-<?php echo $row_danhmuccon['code'] ?>.html">- <?php echo $row_danhmuccon['ten']?></a></li>
              <?php
              }
              }
              ?>
          </ul>
        </li>
        <?php
        }
        }
        ?>
			</ul>
			<ul class="user">
				<?php
    			if(isset($_SESSION["user_kh"])) {
    			echo '<li><a href="?xem=tai-khoan-cua-toi"><i class="fas fa-user-circle fa-1x"></i>Tài khoản của tôi</a></li> <li><a href="?action=dang_xuat"><i class="fas fa-sign-out-alt"></i>Đăng xuất</a></li>';	
    			}else{
    				echo '<li><a href="?xem=login"><i class="fas fa-user"></i>Đăng Nhập</a></li> <li><a href="?xem=register"><i class="fas fa-user-plus"></i>Đăng Ký</a></li> <li><a href="?xem=lich-su-don-hang"><span class="glyphicon glyphicon-search"></span></i>Tra cứu đơn hàng</a></li>';
    			}
    		?>
			</ul>
		</div>
		<div id="ho_tro">
			<div class="cua_hang">
      	<a href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
			<path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
			<path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
          </svg>
          <span>Cửa Hàng</span>
          </a>
      </div>
      <div class="phone">
      	<a href="">
					<svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-headset" viewBox="0 0 16 16">
            <path d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5z"/>
          </svg>
          <span>033 686 0176</span>
        </a>
      </div>
		</div>
		<div id="logo">	
      <a href="./">
				<svg xmlns="http://www.w3.org/2000/svg" height="34" width="163"><defs><clipPath id="a"><path fill="none" transform="translate(1483 272.282)" data-name="Rectangle 1" d="M0 0h1224v256.058H0z"/></clipPath></defs><g data-name="Group 5"><g data-name="Group 2"><g clip-path="url(#a)" data-name="Group 1" fill="#0500ff" transform="matrix(.13278 0 0 .13278 -196.918 -36.155)"><path d="M1611.03 282.849a117.461 117.461 0 10117.463 117.463 117.593 117.593 0 00-117.463-117.463m0 245.492a128.029 128.029 0 11128.033-128.029 128.173 128.173 0 01-128.033 128.029" data-name="Path 1"/><path d="M1610.907 330.132a16.715 16.715 0 016.7-7.153c5.568-3 12.906-1.523 17.591 2.722 4.685 4.245 6.89 10.783 6.805 17.108-.116 8.908-4.493 16.5-8.212 24.3q-2.256 4.749-4.523 9.5l-2.158 4.531-14.622-31.683a81.788 81.788 0 01-1.125-2.436c-.255-.58-.5-1.144-.711-1.651-2.134-5.134-2.358-10.183.259-15.236m35.217 187.8a122.3 122.3 0 0035.983-17.607l-11.981-25.961 55.824-117.185a123.1 123.1 0 00-6.507-14.386L1663.7 460.488l-30.775-66.746L1648.042 362l.209-.441c9.1-17.332 4.906-36.752-9.465-48.846-12.7-10.686-31.072-11.919-45.493-4a42.151 42.151 0 00-13.776 12.151 40.7 40.7 0 00-7.925 22.448 45.774 45.774 0 001.063 11.965 56.423 56.423 0 003.147 10.192l30.006 64.67-15.9 34.993-68.13-148.984a122.961 122.961 0 00-25.448 40.471l73.153 159.2a122.159 122.159 0 0041.55 7.245q3 0 5.981-.147l-22.335-48.888 15.855-33.284z" data-name="Path 2"/></g></g><path d="M49.511 25.889h3.126l5.318-10.616 5.317 10.616h3.121l7.029-14.96H69.71l-4.89 10.438-5.231-10.44H56.38l-5.248 10.44-4.893-10.44h-3.725z" data-name="Path 3"/><path d="M94.658 13.785v-2.857h-17.13v14.96h17.13v-2.822H81.065v-3.26h12.56v-2.841h-12.56v-3.18z" data-name="Path 4"/><path d="M103.358 23.064V10.928h-3.505v14.96h17.13v-2.824z" data-name="Path 5"/><g data-name="Group 4"><g clip-path="url(#a)" data-name="Group 3" transform="matrix(.13278 0 0 .13278 -196.918 -36.155)"><path d="M2502.314 388.238c0 3.429-1.875 6.174-5.722 8.409-4.01 2.316-10.335 3.487-18.806 3.487h-50.392v-23.943h50.392c8.471 0 14.8 1.179 18.806 3.491 3.847 2.231 5.722 5.03 5.722 8.556m-6.283 31.386c9.929-2.057 17.827-5.792 23.5-11.12 6.1-5.737 9.2-12.557 9.2-20.266a26.988 26.988 0 00-6.116-17.1c-4.024-5.064-9.951-9.1-17.626-12.012a77.505 77.505 0 00-27.268-4.546h-76.883v112.671h26.526l.034-45.872h37.483l35.651 45.872h32.29z" data-name="Path 6"/></g></g><path d="M157.726 10.928l-6.017 5.418-6.059-5.418h-4.827l9.153 8.044v6.917h3.507l.001-6.917 9.043-8.044z" data-name="Path 7"/></g></svg>
			</a>
    </div>
		<div class="dang-nhap">
			<div class="lichsu_dh">
				<i class="far fa-clock" style="font-size:24px"></i>
				<a href="?xem=lich-su-don-hang">Lịch Sử Đơn Hàng</a>
			</div>
			<div class="user">
				<div class="dropdown">
	        <a href="?xem=tai-khoan-cua-toi" style="text-decoration: none;">
	        	<i class="fas fa-user-circle fa-2x" style="color: black"></i>
					</a>
        	<div class="dropdown-content">
        		<?php
        			if(isset($_SESSION["user_kh"])) {
        			echo '<a href="?xem=tai-khoan-cua-toi">Tài Khoản Của Tôi</a> <a href="?action=dang_xuat">Đăng Xuất</a>';	
        			}else{
        				echo '<a href="?xem=login">Đăng Nhập</a> <a href="?xem=register">Đăng Ký</a>';
        			}
        		?>
        	</div>
        </div>
			</div>
			<div class="search_mobile">
				<i class="fa fa-search" onclick="showSearchMobile()" style="font-size:24px; padding: 0;"></i>
				<div id="search_mobile_form">
					<form method="get" action="./" autocomplete="off">
						<input name="xem" type="hidden" value="tim-kiem" />
						<input type="text" name="tu-khoa" id="search_mobile_input" class="search_mobile_input" placeholder="Search" value="<?=isset($_GET['query']) ? $_GET['query'] : ""?>">
						<span><i class="fa fa-search"></i></span> 
						
					</form>
				</div>
			</div>
			<div class="icon_cart">
				<a id="showcart" style="color:black; cursor: pointer;"><i class="fas fa-shopping-bag fa-2x"></i>
					<span id="sl_sp_cart"></span> 
					<span id="cart_mobile_number"></span>
				</a>
			</div>
		</div>
	</div>
	<div id="show_cart" style="display: none;">
	  <div id="cart_mini" class="dropdown-content">
	  	<div id="mycart">
	  		<h2>Giỏ hàng của bạn</h2>
		    <div id="thongtin_sp">
		    	<!-- show thông tin sản phẩm -->
		    </div>
		    <div id="tongtien_donhang" style="padding: 0 10px;">
		    	<!-- show tổng tiền đơn hàng -->
		    </div>
	    </div>
	  </div>
	</div>
  <span class="line_bottom"></span>
</div>