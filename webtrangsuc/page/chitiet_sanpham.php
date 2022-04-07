<?php
		$qr = "
			SELECT * FROM san_pham
			WHERE id_sp = '$_GET[id_sanpham]'
		";
		$query_chitiet_sanpham = mysqli_query($conn,$qr);
		$chitiet_sanpham = mysqli_fetch_array($query_chitiet_sanpham);	 
?>

<!-- Truy vấn lấy 4 sản phẩm cùng loại với sản phẩm đang xem -->
<?php
	$qr ="
		SELECT * FROM san_pham
		WHERE id_sp <> '$_GET[id_sanpham]'
		AND menu_id = {$chitiet_sanpham['menu_id']}
		ORDER BY RAND()
		LIMIT 0,4
	";
	$query_sanpham_cungloai = mysqli_query($conn,$qr);
?>

<style>
	.zoom_anh {
		width: 175px; 
		height: 175px;
		position: absolute;
		border-radius: 100%;
		 
		/*Multiple box shadows to achieve the glass effect*/
		box-shadow: 0 0 0 7px rgba(255, 255, 255, 0.85), 
		0 0 7px 7px rgba(0, 0, 0, 0.25), 
		inset 0 0 40px 2px rgba(0, 0, 0, 0.25);
		 
		/*Lets load up the large image first*/
		background: url('<?php echo $chitiet_sanpham['anh_dai_dien'] ?>') no-repeat;
		 
		/*hide the glass by default*/
		display: none;
		}
</style>

<div class="chitiet_sanpham">
	<div class="chitiet">
        <div class="hinhanh_mota"> 
            <form action="?xem=thanh_toan&id_sanpham=<?php echo $chitiet_sanpham['id_sp'] ?>" method="POST">
            	<div class="thongtin_sanpham">
	                <div class="hinhanh">
	                	<div class="tensp_mobile">
	                		<h3><?php echo $chitiet_sanpham['ten'] ?></h3>
	                	</div>
	                    <!-- Container for the image gallery -->
	                    <div class="container">
	                      <!-- Full-width images with number text -->
	                      <div class="mySlides">
	                          <img name="anh_dai_dien" src="images_sanpham/<?php echo $chitiet_sanpham['anh_dai_dien'] ?>" style="width:100%">
	                      </div>
	                      <div class="mySlides">
	                          <img src="images_sanpham/<?php echo $chitiet_sanpham['anh_ct'] ?>" style="width:100%">
	                      </div>
	                      <div class="mySlides">
	                          <img src="images_sanpham/<?php echo $chitiet_sanpham['anh_ct2'] ?>" style="width:100%">
	                      </div>

	                      <!-- Thumbnail images -->
	                      <div class="row">
	                        <div class="column">
	                          <img class="demo cursor" src="images_sanpham/<?php echo $chitiet_sanpham['anh_dai_dien'] ?>" style="width:100%" onclick="currentSlide(1)">
	                        </div>
	                        <div class="column">
	                          <img class="demo cursor" src="images_sanpham/<?php echo $chitiet_sanpham['anh_ct'] ?>" style="width:100%" onclick="currentSlide(2)">
	                        </div>
	                        <div class="column">
	                          <img class="demo cursor" src="images_sanpham/<?php echo $chitiet_sanpham['anh_ct2'] ?>" style="width:100%" onclick="currentSlide(3)">
	                        </div>
	                        
	                      </div>
	                    </div>
	                </div>
	                <div class="mota_ngan">
	                    <div class="ten_sp">
	                    	<input type="hidden" name="id_sp" value="<?php echo $chitiet_sanpham['id_sp'] ?>">
	                        <h2 name="ten_sp"><?php echo $chitiet_sanpham['ten'] ?></h2>
	                    </div>
	                    <div class="gia_sp">
	                    <!-- nếu menu sản phẩm được giảm giá thì hiển thị giá giảm giá -->	
	                    <?php
	                        if( $chitiet_sanpham['giam_gia']>0){
	                    ?>	
	                        <div class="gia_sp_sale">
	                            <span><?php echo number_format($chitiet_sanpham['gia_giam_gia'], 0, ",", ".") ?><sup class="gia">₫</sup></span>
	                            <p><sub><?php echo number_format($chitiet_sanpham['gia_ban'], 0, ",", ".") ?><sup class="gia">₫</sup></sub></p>
	                        </div>
	                    <?php
	                        }else{
	                    ?>
	                        <!-- còn không sản được giảm giá thì hiển thị giá bán -->
	                        <div class="gia_ban">
	                        	<p><?php echo number_format($chitiet_sanpham['gia_ban'], 0, ",", ".") ?><sup class="gia">₫</sup></p>
	                    	</div>
	                    <?php
	                        }
	                    ?>	
	                    <!-- end -->
	                    </div>
	                    <div class="mota_sp">
	                        <h5>Về Sản Phẩm Này</h5>
	                        <?php echo $chitiet_sanpham['thong_tin_sp'] ?>
	                    </div>
	                    <!-- chọn số lượng -->
	                    <div class="soluong_chonsize">
	                        <div class="soluong">
	                            <h5>Số Lượng</h5>
	                            <div class="buttons_added">
	                              <input class="minus is-form" onclick="var result = document.getElementById('quantity'); var qty = result.value; if( !isNaN(qty) &amp; qty > 1 ) result.value--;return false;" type='button' value='-' />
	                            <input class="input-qty" id='quantity' min='1' name='quantity' type='text' value='1' />
	                            <input class="plus is-form" onclick="var result = document.getElementById('quantity'); var qty = result.value; if( !isNaN(qty)) result.value++;return false;" type='button' value='+' />
	                            </div>
	                            
	                        </div>
	                        <!-- nếu menu id = nhẫn thì hiển thị div chọn size, còn không thì thôi -->
	                        <?php
	                            if( $chitiet_sanpham['menu_id']==5){
	                        ?>
	                        <div class="chonsize">
	                            <h5>Size</h5>
	                            <div class="custom-select" style="width: 120px;">
	                                <select>
	                                    <option name="mặc định" value="">Chọn Size</option>
	                                    <option name="mặc định" value="">Chọn Size</option>
	                                    <option name="size"value="5">5</option>
	                                    <option name="size"value="6">6</option>
	                                    <option name="size"value="7">7</option>
	                                </select>
	                            </div>
	                        </div>
	                        <div class="huongdan_chonsize"><a href="#">Hướng dẫn chọn size</a></div>
	                        <?php
	                            }else
	                        ?>
	                        <!-- end -->
	                    </div>

	                    <?php 
	                    	if($chitiet_sanpham['so_luong']==0) {  	
	                    ?>
	                    <div class="sold_out">
	                    	<a class="hethang">HẾT HÀNG</a>
	                    </div>
	                    <?php
	                    	}else{
	                    ?>
	                    <div class="themgio_muangay">
	                        <div class="them_gio">
	                            <a onclick="addcart_ct(this)" name="themgiohang">THÊM GIỎ HÀNG</a>
	                        </div>
	                        <div class="mua_ngay">
	                            <input type="submit" name="muangay" value="MUA NGAY"></input>
	                        </div>
	                    </div>
	                    <?php
	                    	}
	                    ?>

	                    <div class="mota-sp_mobile">
	                    	<h5>Về Sản Phẩm Này</h5>
	                        <?php echo $chitiet_sanpham['thong_tin_sp'] ?>
	                    </div>

	                    <div class="chinhsach_doitra_baohanh">
	                        <div class="chinhsach_doitra">
	                            <button type="button" class="collapsible" style="color: #3e3e3e; font-weight: 500">Chính sách đổi trả</button>
	                            <div class="xemct">
	                              <a href="#">- Đổi sản phẩm trong vòng 5 ngày <br />
	                                          - Không áp dung ĐỔI sản phẩm trong CTKM
	                              </a>
	                            </div>
	                        </div>
	                        <div class="chinhsach_baohanh">
	                            <button type="button" class="collapsible" style="color: #3e3e3e; font-weight: 500">Chính sách bảo hành</button>
	                            <div class="xemct">
	                              <a href="#">- Sản phẩm được bảo hành <br />12 tháng từ ngày nhận hàng</a>
	                            </div>
	                        </div>  
	                    </div>
	                    
	                    <div class="tuvan_mxh">
	                        <div class="tuvan_muahang">
	                            <h5>Tư vấn mua hàng: <span>0336860176</span></h5>
	                        </div>
	                        <div class="mxh">
	                            <!-- Add font awesome icons -->
	                            <a href="#" class="fa fa-facebook" title="Facebook"></a>
	                            <a href="#" class="fa fa-instagram" title="Instagram"></a>
	                            <a href="#" class="fa fa-google" title="Gmail"></a>
	                        </div> 
	                    </div>
	                </div>
            	</div>
            </form> 
        </div>
        <div class="danhgia_sanpham" id="danhgia_sanpham">
        	<div class="danhgia_sanpham-top">
        		<button type="button" onclick="show_list_comment()"><i class="fas fa-pen"></i> <span>Xem đánh giá sản phẩm</span></button>
        		<div class="danhgia_sanpham_overlay" id="danhgia_sanpham_overlay"></div>
        	</div>
        	<div class="danhgia_sanpham-list" id="danhgia_sanpham-list">
	        	<div class="danhgia_sanpham-comment" id="danhgia_sanpham-comment">
	        		
	        	</div>
	        	<div class="show_form_binhluan">
	        		<button type="button" onclick="show_form_binhluan()">Viết bình luận</button>
	        	</div>
        	</div>
        	<div class="form_binhluan">
				<form action="page/xuly_binhluan.php" method="POST">
		        	<div class="danhgia_sanpham-form" id="danhgia_sanpham-form">
		        		<h2>Viết Đánh Giá</h2>
		        		<button type="button" class="danhgia_sanpham-form_close" onclick="close_form_binhluan()"><i class="fas fa-times"></i></button>
	        			<div class="danhgia_sanpham-form_name">
	        				<label>Tên <span>*</span></label>
	        				<input type="text" class="ten" name="ten" placeholder="Tên" autocomplete="off" required>
	        				<input type="hidden" class="id_sp" name="id_sp" value="<?php echo $chitiet_sanpham['id_sp'] ?>">
	        			</div>
	        			<div class="danhgia_sanpham-form_rating">
	        				<label>Đánh giá của bạn <span>*</span></label>
	        				<div class="rating"> 
	        					<input type="radio" class="ratings" name="rating" value="5" id="5"><label for="5">☆</label> <input type="radio" class="ratings" name="rating" value="4" id="4"><label for="4">☆</label> <input type="radio" class="ratings" name="rating" value="3" id="3"><label for="3">☆</label> <input type="radio" class="ratings" name="rating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="rating" class="ratings" value="1" id="1"><label for="1">☆</label>
							</div>
	        			</div>
	        			<div class="danhgia_sanpham-form_message">
	        				<label>Tin nhắn của bạn <span>*</span></label>
	        				<div id="error_status"></div>
	        				<textarea name="msg" class="message" placeholder="Tin nhắn của bạn" required></textarea>
	        			</div>
	        			<div class="danhgia_sanpham-form_submit">
	        				<button type="button" class="btn_cmt add_cmt" name="add_cmt">Gửi</button>
	        			</div>
		        	</div>
	    		</form>
    		</div>
        </div>
        
        <div class="sp_cungloai">
        	<div class="cungloai_header" style="padding-top: 30px; text-align: center">
                <div class="text">
                    <h1>SẢN PHẨM CÙNG LOẠI</h1>
                </div>
            </div>
        	<div class="list_ds_sanpham">
                <div class="list">
                    <div class="row">
                        
						<?php
							while($row_sanpham_cungloai = mysqli_fetch_array($query_sanpham_cungloai)){
						?>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="avatar">
                                    <a href="trang-suc/<?php echo $row_sanpham_cungloai['id_sp'] ?>-<?php echo $row_sanpham_cungloai['code'] ?>.html"><img src="images_sanpham/<?php echo $row_sanpham_cungloai['anh_dai_dien'] ?>" alt="Image"/></a>
                                    <div class="addcart">
                                	<a href="?xem=giohang&action=add_ct&id_sanpham=<?php echo $row_sanpham_cungloai['id_sp'] ?>" class="themvaogio">Thêm Vào Giỏ</a>
                                	</div>
                                </div>
                                <a href="#">
                                    <div class="name_gia">
                                        <h5><?php echo $row_sanpham_cungloai['ten'] ?></h5>
                                        <span><?php echo number_format($row_sanpham_cungloai['gia_ban'], 0, ",", ".")?><sup class="gia">₫</sup></span>
                                    </div>
                                </a>
                            </div>
                        </div>
						<?php
							}
						?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- js hover vào ảnh nhỏ hiện lên ảnh to -->
<script>
	var slideIndex = 1;
	showSlides(slideIndex);
	
	// Thumbnail image controls
	function currentSlide(n) {
	  showSlides(slideIndex = n);
	}
	
	function showSlides(n) {
	  var i;
	  var slides = document.getElementsByClassName("mySlides");
	  var dots = document.getElementsByClassName("demo");
	  var captionText = document.getElementById("caption");
	  if (n > slides.length) {slideIndex = 1}
	  if (n < 1) {slideIndex = slides.length}
	  for (i = 0; i < slides.length; i++) {
		slides[i].style.display = "none";
	  }
	  for (i = 0; i < dots.length; i++) {
		dots[i].className = dots[i].className.replace(" active", "");
	  }
	  slides[slideIndex-1].style.display = "block";
	  dots[slideIndex-1].className += " active";
	  captionText.innerHTML = dots[slideIndex-1].alt;
	}
</script>


<!-- js chọn size -->
<script>
	var x, i, j, l, ll, selElmnt, a, b, c;
	/* Look for any elements with the class "custom-select": */
	x = document.getElementsByClassName("custom-select");
	l = x.length;
	for (i = 0; i < l; i++) {
	  selElmnt = x[i].getElementsByTagName("select")[0];
	  ll = selElmnt.length;
	  /* For each element, create a new DIV that will act as the selected item: */
	  a = document.createElement("DIV");
	  a.setAttribute("class", "select-selected");
	  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
	  x[i].appendChild(a);
	  /* For each element, create a new DIV that will contain the option list: */
	  b = document.createElement("DIV");
	  b.setAttribute("class", "select-items select-hide");
	  for (j = 1; j < ll; j++) {
		/* For each option in the original select element,
		create a new DIV that will act as an option item: */
		c = document.createElement("DIV");
		c.innerHTML = selElmnt.options[j].innerHTML;
		c.addEventListener("click", function(e) {
			/* When an item is clicked, update the original select box,
			and the selected item: */
			var y, i, k, s, h, sl, yl;
			s = this.parentNode.parentNode.getElementsByTagName("select")[0];
			sl = s.length;
			h = this.parentNode.previousSibling;
			for (i = 0; i < sl; i++) {
			  if (s.options[i].innerHTML == this.innerHTML) {
				s.selectedIndex = i;
				h.innerHTML = this.innerHTML;
				y = this.parentNode.getElementsByClassName("same-as-selected");
				yl = y.length;
				for (k = 0; k < yl; k++) {
				  y[k].removeAttribute("class");
				}
				this.setAttribute("class", "same-as-selected");
				break;
			  }
			}
			h.click();
		});
		b.appendChild(c);
	  }
	  x[i].appendChild(b);
	  a.addEventListener("click", function(e) {
		/* When the select box is clicked, close any other select boxes,
		and open/close the current select box: */
		e.stopPropagation();
		closeAllSelect(this);
		this.nextSibling.classList.toggle("select-hide");
		this.classList.toggle("select-arrow-active");
	  });
	}
	
	function closeAllSelect(elmnt) {
	  /* A function that will close all select boxes in the document,
	  except the current select box: */
	  var x, y, i, xl, yl, arrNo = [];
	  x = document.getElementsByClassName("select-items");
	  y = document.getElementsByClassName("select-selected");
	  xl = x.length;
	  yl = y.length;
	  for (i = 0; i < yl; i++) {
		if (elmnt == y[i]) {
		  arrNo.push(i)
		} else {
		  y[i].classList.remove("select-arrow-active");
		}
	  }
	  for (i = 0; i < xl; i++) {
		if (arrNo.indexOf(i)) {
		  x[i].classList.add("select-hide");
		}
	  }
	}
	
	/* If the user clicks anywhere outside the select box,
	then close all select boxes: */
	document.addEventListener("click", closeAllSelect);
</script>





<!-- js chính sách đổi trả -->
<script>
	var coll = document.getElementsByClassName("collapsible");
	var i;
	
	for (i = 0; i < coll.length; i++) {
	  coll[i].addEventListener("click", function() {
		this.classList.toggle("active");
		var content = this.nextElementSibling;
		if (content.style.display === "block") {
		  content.style.display = "none";
		} else {
		  content.style.display = "block";
		}
	  });
	}
</script>


<script type="text/javascript">
$(document).ready(function(){
 
    var native_width = 0;
    var native_height = 0;
 
    //Now the mousemove function
    $(".hinhanh").mousemove(function(e){
        //When the user hovers on the image, the script will first calculate
        //the native dimensions if they don't exist. Only after the native dimensions
        //are available, the script will show the zoomed version.
        if(!native_width && !native_height)
        {
            //This will create a new image object with the same image as that in .small
            //We cannot directly get the dimensions from .small because of the 
            //width specified to 200px in the html. To get the actual dimensions we have
            //created this image object.
            var image_object = new Image();
            image_object.src = $(".mySlides").attr("src");
             
            //This code is wrapped in the .load function which is important.
            //width and height of the object would return 0 if accessed before 
            //the image gets loaded.
            native_width = image_object.width;
            native_height = image_object.height;
        }
        else
        {
            //x/y coordinates of the mouse
            //This is the position of .magnify with respect to the document.
            var magnify_offset = $(this).offset();
            //We will deduct the positions of .magnify from the mouse positions with
            //respect to the document to get the mouse positions with respect to the 
            //container(.magnify)
            var mx = e.pageX - magnify_offset.left;
            var my = e.pageY - magnify_offset.top;
             
            //Finally the code to fade out the glass if the mouse is outside the container
            if(mx < $(this).width() && my < $(this).height() && mx > 0 && my > 0)
            {
                $(".zoom_anh").fadeIn(100);
            }
            else
            {
                $(".zoom_anh").fadeOut(100);
            }
            if($(".zoom_anh").is(":visible"))
            {
                //The background position of .large will be changed according to the position
                //of the mouse over the .small image. So we will get the ratio of the pixel
                //under the mouse pointer with respect to the image and use that to position the 
                //large image inside the magnifying glass
                var rx = Math.round(mx/$(".mySlides").width()*native_width - $(".zoom_anh").width()/2)*-1;
                var ry = Math.round(my/$(".mySlides").height()*native_height - $(".zoom_anh").height()/2)*-1;
                var bgp = rx + "px " + ry + "px";
                 
                //Time to move the magnifying glass with the mouse
                var px = mx - $(".zoom_anh").width()/2;
                var py = my - $(".zoom_anh").height()/2;
                //Now the glass moves with the mouse
                //The logic is to deduct half of the glass's width and height from the 
                //mouse coordinates to place it with its center at the mouse coordinates
                 
                //If you hover on the image now, you should see the magnifying glass in action
                $(".zoom_anh").css({left: px, top: py, backgroundPosition: bgp});
            }
        }
    })
})
</script>

